import { onScroll, pageTop, progress } from '../lib/scroll';

// Media parallax: translateY from -12% to +12% while the root section travels
// from "top at viewport bottom" to "bottom at viewport top".
export function initParallax() {
    const items = [...document.querySelectorAll('[data-parallax]')].map((el) => ({
        el,
        root: el.closest('[data-parallax-root]') || el.parentElement,
        scale: parseFloat(el.dataset.parallaxScale) || 1,
        top: 0,
        height: 0,
    }));
    if (!items.length) return;

    const measure = () => {
        items.forEach((it) => {
            it.top = pageTop(it.root);
            it.height = it.root.offsetHeight;
        });
    };

    onScroll(
        ({ y, vh }) => {
            items.forEach((it) => {
                const p = progress(y, it.top - vh, it.top + it.height);
                const ty = -12 + 24 * p;
                it.el.style.transform = it.scale !== 1 ? `translateY(${ty.toFixed(3)}%) scale(${it.scale})` : `translateY(${ty.toFixed(3)}%)`;
            });
        },
        measure
    );
}
