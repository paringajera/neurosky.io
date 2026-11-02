// Central scroll/resize loop. Every scroll-driven scene subscribes here so there
// is exactly one rAF per frame and one owner for each animated property.

export const viewport = { y: 0, vh: 0, vw: 0, docH: 0 };

const subscribers = new Set();
const resizers = new Set();
let scheduled = false;

function measure() {
    viewport.vh = window.innerHeight;
    viewport.vw = window.innerWidth;
    viewport.docH = document.documentElement.scrollHeight;
}

function frame() {
    scheduled = false;
    viewport.y = window.scrollY;
    for (const fn of subscribers) fn(viewport);
}

export function requestFrame() {
    if (!scheduled) {
        scheduled = true;
        requestAnimationFrame(frame);
    }
}

function handleResize() {
    measure();
    for (const fn of resizers) fn(viewport);
    requestFrame();
}

export function onScroll(fn, onResize) {
    subscribers.add(fn);
    if (onResize) {
        resizers.add(onResize);
        onResize(viewport);
    }
    fn(viewport);
    return () => {
        subscribers.delete(fn);
        if (onResize) resizers.delete(onResize);
    };
}

export const clamp01 = (v) => (v < 0 ? 0 : v > 1 ? 1 : v);
export const lerp = (a, b, t) => a + (b - a) * t;
export const progress = (value, start, end) => clamp01((value - start) / (end - start));
export const isDesktop = () => window.matchMedia('(min-width: 48rem)').matches;
export const isSm = () => window.matchMedia('(min-width: 40rem)').matches;
export const reducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/** Document-relative top of an element, ignoring CSS transforms (offset chain). */
export function pageTop(el) {
    let top = 0;
    let node = el;
    while (node) {
        top += node.offsetTop;
        node = node.offsetParent;
    }
    return top;
}

export function boot() {
    measure();
    window.addEventListener('scroll', requestFrame, { passive: true });
    window.addEventListener('resize', handleResize);
    window.addEventListener('orientationchange', handleResize);
    if ('ResizeObserver' in window) {
        const ro = new ResizeObserver(() => {
            const h = document.documentElement.scrollHeight;
            if (h !== viewport.docH) handleResize();
        });
        ro.observe(document.body);
    }
    document.fonts?.ready.then(handleResize);
    window.addEventListener('load', handleResize);
    requestFrame();
}
