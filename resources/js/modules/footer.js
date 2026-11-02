import { onScroll, progress, pageTop } from '../lib/scroll';

// Footer: the pink panel is revealed with a -200px → 0 parallax as it enters,
// and its content fades in over the last quarter of that travel.
export function initFooter() {
    const footer = document.querySelector('[data-footer]');
    const panel = footer?.querySelector('[data-footer-panel]');
    const content = footer?.querySelector('[data-footer-content]');
    if (!footer || !panel) return;

    let top = 0;
    let height = 0;
    const measure = () => {
        top = pageTop(footer);
        height = footer.offsetHeight;
    };

    onScroll(({ y, vh }) => {
        const p = progress(y, top - vh, top - vh + height);
        const ty = -200 * (1 - p);
        panel.style.transform = p >= 1 ? 'none' : `translateY(${ty.toFixed(2)}px)`;
        if (content) content.style.opacity = progress(p, 0.75, 1).toFixed(3);
    }, measure);
}
