// Horizontal snap carousels (insights cards, partner tab strip): arrow buttons,
// pointer drag on desktop, and overflow detection for the grab cursor.
export function initCarousels() {
    document.querySelectorAll('[data-carousel]').forEach((track) => {
        const section = track.closest('[data-insights]') || track.parentElement;
        const prev = section?.querySelector('[data-carousel-prev]');
        const next = section?.querySelector('[data-carousel-next]');
        const isTrack = track.hasAttribute('data-carousel-track');

        const updateOverflow = () => {
            track.dataset.overflow = String(track.scrollWidth > track.clientWidth + 2);
        };
        updateOverflow();
        window.addEventListener('resize', updateOverflow);

        const step = () => {
            const first = track.firstElementChild;
            if (!first) return track.clientWidth * 0.8;
            const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 0;
            return first.getBoundingClientRect().width + gap;
        };
        prev?.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
        next?.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }));

        // pointer drag (mouse only – touch scrolls natively)
        let down = false;
        let startX = 0;
        let startLeft = 0;
        let moved = false;
        track.addEventListener('pointerdown', (e) => {
            if (e.pointerType !== 'mouse' || track.dataset.overflow !== 'true') return;
            down = true;
            moved = false;
            startX = e.clientX;
            startLeft = track.scrollLeft;
            track.setPointerCapture(e.pointerId);
        });
        track.addEventListener('pointermove', (e) => {
            if (!down) return;
            const dx = e.clientX - startX;
            if (!moved && Math.abs(dx) > 4) {
                moved = true;
                track.classList.add('is-dragging');
            }
            if (moved) track.scrollLeft = startLeft - dx;
        });
        const release = (e) => {
            if (!down) return;
            down = false;
            track.releasePointerCapture?.(e.pointerId);
            if (moved) {
                // snap back to the nearest item via smooth scroll
                track.classList.remove('is-dragging');
                if (isTrack) {
                    const s = step();
                    const target = Math.round(track.scrollLeft / s) * s;
                    track.scrollTo({ left: target, behavior: 'smooth' });
                }
                // swallow the click that follows a drag
                const stop = (ev) => {
                    ev.preventDefault();
                    ev.stopPropagation();
                };
                track.addEventListener('click', stop, { capture: true, once: true });
                setTimeout(() => track.removeEventListener('click', stop, { capture: true }), 0);
            }
        };
        track.addEventListener('pointerup', release);
        track.addEventListener('pointercancel', release);
    });
}
