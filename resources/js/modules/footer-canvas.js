import { reducedMotion } from '../lib/scroll';

// Footer "light tunnel" canvas, reproduced from the reference's "layered" canvas variant:
// 250 concentric rectangles shrink by 1% per layer towards the centre of the footer;
// the outer frames are centred on a smoothed mouse position (window-relative), the inner
// ones on the footer centre, and the palette flows along the layers over time.
// The canvas stays hidden (showing the video underneath) until the first mouse move.
const PALETTE = ['#FCB3F7', '#FF2C6B', '#80031C', '#977E75'].map((hex) => ({
    r: parseInt(hex.slice(1, 3), 16),
    g: parseInt(hex.slice(3, 5), 16),
    b: parseInt(hex.slice(5, 7), 16),
}));
const CFG = {
    NUM_LAYERS: 250,
    SCALE_FACTOR: 0.99,
    MAX_WIDTH_MULTIPLIER: 4.5,
    MAX_HEIGHT_MULTIPLIER: 4.2,
    TIME_SCALE: 0.007,
    FLOW_MULTIPLIER: 5.5,
    EXAGGERATION: 1,
    MOUSE_SMOOTHING: 0.15,
};

const lerp = (a, b, t) => (1 - t) * a + t * b;
const clamp01 = (v) => Math.max(0, Math.min(1, v));
const lerpColor = (a, b, t) => ({
    r: Math.round(a.r + (b.r - a.r) * t),
    g: Math.round(a.g + (b.g - a.g) * t),
    b: Math.round(a.b + (b.b - a.b) * t),
});

export function initFooterCanvas() {
    const wrap = document.querySelector('[data-footer-canvas]');
    const canvas = wrap?.querySelector('canvas');
    const footer = wrap?.closest('footer');
    if (!wrap || !canvas || !footer || reducedMotion()) return;
    const ctx = canvas.getContext('2d', { alpha: false });
    if (!ctx) return;

    let width = 0;
    let height = 0;
    let dpr = 1;
    let started = false;
    let inView = false;
    let frame = 0;
    let raf = 0;
    const raw = { x: 0, y: 0 };
    const smooth = { x: 0, y: 0 };

    const resize = () => {
        const r = wrap.getBoundingClientRect();
        width = r.width;
        height = r.height;
        dpr = Math.min(2, window.devicePixelRatio || 1);
        canvas.width = Math.round(width * dpr);
        canvas.height = Math.round(height * dpr);
        if (!started) {
            raw.x = smooth.x = width / 2;
            raw.y = smooth.y = height / 2;
        }
    };

    // Each layer is an opaque rectangle, so only the ring between a layer and the next (smaller)
    // one is ever visible. Painting just that ring as four plain bands, clipped to the canvas, keeps
    // the fill area close to one canvas per frame instead of ~250 full-canvas fills (which pegged
    // the GPU and froze weaker machines). Edges are snapped to whole device pixels so neighbouring
    // bands tile without anti-aliased seams; plain fillRect stays on the fast GPU quad path.
    const edges = (i, mx, my, cx, cy, maxW, maxH, W, H) => {
        const r = i / (CFG.NUM_LAYERS - 1);
        const x = lerp(mx, cx, r);
        const y = lerp(my, cy, r);
        const w = maxW * Math.pow(CFG.SCALE_FACTOR, i);
        const h = maxH * Math.pow(CFG.SCALE_FACTOR, i);
        return [
            Math.max(0, Math.round((x - w / 2) * dpr)),
            Math.max(0, Math.round((y - h / 2) * dpr)),
            Math.min(W, Math.round((x + w / 2) * dpr)),
            Math.min(H, Math.round((y + h / 2) * dpr)),
        ];
    };
    const band = (l, t, r, b) => {
        if (r > l && b > t) ctx.fillRect(l, t, r - l, b - t);
    };

    const draw = () => {
        const { NUM_LAYERS, MAX_WIDTH_MULTIPLIER, MAX_HEIGHT_MULTIPLIER, TIME_SCALE, FLOW_MULTIPLIER, EXAGGERATION } = CFG;
        const W = canvas.width;
        const H = canvas.height;
        const maxW = width * MAX_WIDTH_MULTIPLIER;
        const maxH = height * MAX_HEIGHT_MULTIPLIER;
        const time = frame * TIME_SCALE;
        const cx = width / 2;
        const cy = height / 2;
        const mx = cx + (smooth.x - cx) * EXAGGERATION;
        const my = cy + (smooth.y - cy) * EXAGGERATION;

        ctx.setTransform(1, 0, 0, 1, 0, 0);
        let cur = edges(0, mx, my, cx, cy, maxW, maxH, W, H);
        for (let i = 0; i < NUM_LAYERS; i++) {
            const next = i < NUM_LAYERS - 1 ? edges(i + 1, mx, my, cx, cy, maxW, maxH, W, H) : null;
            const [l, t, r, b] = cur;
            if (r > l && b > t) {
                const c = (() => {
                    const v = (i / (NUM_LAYERS - 1)) * FLOW_MULTIPLIER + time;
                    const a = Math.floor(v) % PALETTE.length;
                    return lerpColor(PALETTE[a], PALETTE[(a + 1) % PALETTE.length], v % 1);
                })();
                ctx.fillStyle = `rgb(${c.r}, ${c.g}, ${c.b})`;
                if (!next) {
                    band(l, t, r, b);
                } else {
                    // cur minus next: top band, bottom band, then the left/right bands between them.
                    const [nl, nt, nr, nb] = next;
                    const midT = Math.max(t, nt);
                    const midB = Math.min(b, nb);
                    band(l, t, r, Math.min(b, nt));
                    band(l, Math.max(t, nb), r, b);
                    band(l, midT, Math.min(r, nl), midB);
                    band(Math.max(l, nr), midT, r, midB);
                }
            }
            cur = next;
        }
    };

    const tick = () => {
        raf = 0;
        if (!inView || !started || document.hidden) return;
        smooth.x = lerp(smooth.x, raw.x, CFG.MOUSE_SMOOTHING);
        smooth.y = lerp(smooth.y, raw.y, CFG.MOUSE_SMOOTHING);
        draw();
        frame++;
        raf = requestAnimationFrame(tick);
    };
    const run = () => {
        if (!raf && inView && started) raf = requestAnimationFrame(tick);
    };

    resize();
    if ('ResizeObserver' in window) new ResizeObserver(resize).observe(wrap);
    else window.addEventListener('resize', resize);

    window.addEventListener(
        'mousemove',
        (e) => {
            raw.x = width * clamp01(e.clientX / window.innerWidth);
            raw.y = height * clamp01(e.clientY / window.innerHeight);
            if (!started) {
                started = true;
                draw();
                wrap.style.visibility = 'visible';
            }
            run();
        },
        { passive: true }
    );

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            inView = entry.isIntersecting;
            if (inView) run();
        });
    });
    io.observe(footer);
    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) run();
    });
}
