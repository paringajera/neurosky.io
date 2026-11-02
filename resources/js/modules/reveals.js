import { SpringValue } from '../lib/spring';
import { reducedMotion, onScroll, pageTop } from '../lib/scroll';

// One-shot entrance animations:
//  - [data-reveal-words]  word-by-word fade/slide (CSS transitions, 85ms stagger)
//  - [data-reveal-up]     spring from an offset (px) to 0
//  - [data-reveal-clip]   clip-path wipe from the bottom (CSS transition)

export function initReveals() {
    const reduce = reducedMotion();

    // Words revealed on load (hero) – wait for fonts so the layout is final.
    const onload = document.querySelectorAll('[data-reveal-onload]');
    const revealOnLoad = () => onload.forEach((el) => el.classList.add('is-revealed'));
    if (reduce) revealOnLoad();
    else (document.fonts?.ready || Promise.resolve()).then(() => setTimeout(revealOnLoad, 350));

    const words = document.querySelectorAll('[data-reveal-words]:not([data-reveal-onload]):not([data-reveal-manual])');
    const clips = document.querySelectorAll('[data-reveal-clip]');
    const ups = document.querySelectorAll('[data-reveal-up]');

    if (reduce) {
        words.forEach((el) => el.classList.add('is-revealed'));
        clips.forEach((el) => el.classList.add('is-revealed'));
        ups.forEach((el) => (el.style.transform = 'none'));
        return;
    }

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-revealed');
                io.unobserve(entry.target);
            });
        },
        { threshold: 0.01 }
    );
    words.forEach((el) => io.observe(el));

    const clipIo = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-revealed');
                clipIo.unobserve(entry.target);
            });
        },
        { rootMargin: '0px 0px -28% 0px', threshold: 0 }
    );
    clips.forEach((el) => clipIo.observe(el));

    // Spring reveals are triggered from the element's *layout* position (not its
    // transformed box), so items pushed below a clipped section still fire.
    const pending = new Set(ups);
    const trigger = (el) => {
        pending.delete(el);
        const from = parseFloat(el.dataset.revealUp) || 0;
        const spring = new SpringValue(from, { stiffness: 100, damping: 26, restDelta: 0.05 });
        spring.onUpdate((v) => {
            el.style.transform = v <= 0.05 ? 'none' : `translateY(${v.toFixed(2)}px)`;
        });
        spring.set(0, () => {
            el.style.transform = 'none';
            spring.destroy();
        });
    };
    if (pending.size) {
        onScroll(({ y, vh }) => {
            if (!pending.size) return;
            for (const el of [...pending]) {
                if (el.offsetParent === null && getComputedStyle(el).position !== 'fixed') continue; // hidden
                const top = pageTop(el);
                if (top < y + vh * 0.98) trigger(el);
            }
        });
    }
}
