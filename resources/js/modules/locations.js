import { reducedMotion } from '../lib/scroll';

// Company "Our locations" map, matching the reference timing:
//  - once the map scrolls into view the route lines draw one after another
//    (stroke-dashoffset), each following a critically damped spring (ω ≈ 1.65/s,
//    ~5s to settle), started 0.4s after entry and 2.5s apart
//  - the pins' square rings start pulsing in sync (CSS, see .map-pin in site.css)
const OMEGA = 1.65;
const START_DELAY = 400;
const STAGGER = 2500;
const SETTLE = 6000;

export function initLocations() {
    const map = document.querySelector('[data-locations-map]');
    if (!map) return;
    const routes = [...map.querySelectorAll('[data-route]')].map((path) => {
        const length = path.getTotalLength();
        path.setAttribute('stroke-dasharray', length.toFixed(2));
        path.setAttribute('stroke-dashoffset', length.toFixed(2));
        return { path, length };
    });

    const finish = () => {
        routes.forEach(({ path }) => {
            path.setAttribute('stroke-dashoffset', '0');
            path.setAttribute('opacity', '1');
        });
    };

    const play = () => {
        map.classList.add('is-live');
        if (reducedMotion()) return finish();
        routes.forEach(({ path }) => path.setAttribute('opacity', '1'));
        const t0 = performance.now();
        const tick = (now) => {
            let running = false;
            routes.forEach(({ path, length }, i) => {
                const t = (now - t0 - START_DELAY - i * STAGGER) / 1000;
                if (t <= 0) {
                    running = true;
                    return;
                }
                const wt = OMEGA * t;
                const p = t * 1000 >= SETTLE ? 1 : 1 - (1 + wt) * Math.exp(-wt);
                if (p < 1) running = true;
                path.setAttribute('stroke-dashoffset', (length * (1 - p)).toFixed(2));
            });
            if (running) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    const io = new IntersectionObserver(
        (entries) => {
            if (entries.some((e) => e.isIntersecting)) {
                io.disconnect();
                play();
            }
        },
        { threshold: 0.35 }
    );
    io.observe(map);
}
