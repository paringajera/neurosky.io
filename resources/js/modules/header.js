import { onScroll } from '../lib/scroll';

// Floating pill header: page-progress underline + expandable thumbnail menu.
export function initHeader() {
    const header = document.querySelector('[data-header]');
    if (!header) return;

    const bar = header.querySelector('[data-scroll-progress]');
    const toggle = header.querySelector('[data-menu-toggle]');
    const panel = header.querySelector('[data-menu-panel]');
    const frame = panel?.querySelector('.site-nav__frame');

    onScroll(({ y, vh, docH }) => {
        if (!bar) return;
        const max = Math.max(1, docH - vh);
        const p = Math.min(1, Math.max(0, y / max));
        bar.style.transform = p >= 1 ? 'none' : `scaleX(${p.toFixed(5)})`;
    });

    if (!toggle || !panel || !frame) return;

    let open = false;
    let lastFocus = null;
    let pointerOpen = false;
    toggle.addEventListener('pointerdown', () => (pointerOpen = true));
    toggle.addEventListener('keydown', () => (pointerOpen = false));

    const setOpen = (next) => {
        if (next === open) return;
        open = next;
        toggle.setAttribute('aria-expanded', String(open));
        if (open) {
            lastFocus = document.activeElement;
            panel.hidden = false;
            header.setAttribute('data-open', '');
            frame.style.height = '0px';
            // force layout, then animate to the natural height
            void frame.offsetHeight;
            frame.style.height = `${frame.scrollHeight}px`;
            const onEnd = (e) => {
                if (e.propertyName !== 'height') return;
                frame.style.height = 'auto';
                frame.removeEventListener('transitionend', onEnd);
            };
            frame.addEventListener('transitionend', onEnd);
            if (!pointerOpen) panel.querySelector('a')?.focus({ preventScroll: true });
            pointerOpen = false;
        } else {
            frame.style.height = `${frame.scrollHeight}px`;
            void frame.offsetHeight;
            frame.style.height = '0px';
            header.removeAttribute('data-open');
            const onEnd = (e) => {
                if (e.propertyName !== 'height') return;
                panel.hidden = true;
                frame.removeEventListener('transitionend', onEnd);
            };
            frame.addEventListener('transitionend', onEnd);
            if (lastFocus instanceof HTMLElement) lastFocus.focus({ preventScroll: true });
        }
    };

    toggle.addEventListener('click', () => setOpen(!open));
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && open) setOpen(false);
    });
    document.addEventListener('pointerdown', (e) => {
        if (open && !header.contains(e.target)) setOpen(false);
    });
    // Keep the frame height correct if the viewport changes while open.
    window.addEventListener('resize', () => {
        if (open) frame.style.height = 'auto';
    });
    // Close before leaving the page so the view transition starts from a clean header.
    window.addEventListener('pagehide', () => setOpen(false));
}
