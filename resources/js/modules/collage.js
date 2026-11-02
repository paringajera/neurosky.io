import { onScroll, progress, isDesktop, pageTop, reducedMotion } from '../lib/scroll';

// Image collage under the hero:
//  - outer columns drift from +600px to -600px while the section crosses the viewport
//  - the centre copy drifts from -200px to +200px (desktop)
//  - paragraph words light up (0.1 → 1) following scroll, catching up at ~10 words/s
export function initCollage() {
    const section = document.querySelector('[data-collage]');
    if (!section) return;
    const hero = document.querySelector('[data-hero]');
    const columns = [...section.querySelectorAll('[data-collage-column]')];
    const text = section.querySelector('[data-collage-text]');
    const words = [...section.querySelectorAll('[data-collage-words] [data-word]')];
    const reduce = reducedMotion();

    let top = 0;
    let height = 0;
    let heroTop = 0;
    let lit = 0;
    let target = 0;
    let timer = 0;

    const measure = () => {
        top = pageTop(section);
        height = section.offsetHeight;
        heroTop = hero ? pageTop(hero) : top - 1.75 * window.innerHeight;
    };

    // Only touch words whose state changes (toggling all of them invalidated
    // every span's style on each catch-up tick).
    let painted = 0;
    const applyLit = () => {
        for (let i = painted; i < lit; i++) words[i].classList.add('is-lit');
        for (let i = lit; i < painted; i++) words[i].classList.remove('is-lit');
        painted = lit;
    };

    const catchUp = () => {
        timer = 0;
        if (lit === target) return;
        lit += 1;
        applyLit();
        timer = window.setTimeout(catchUp, 100);
    };

    if (reduce) {
        lit = words.length;
        applyLit();
    }

    onScroll(({ y, vh }) => {
        const p = progress(y, top - vh, top + height);
        const ty = 600 * (1 - 2 * p);
        columns.forEach((col) => {
            col.style.transform = Math.abs(ty) < 0.5 ? 'none' : `translateY(${ty.toFixed(2)}px)`;
        });

        if (text) {
            if (isDesktop()) {
                const pt = progress(y, top - 0.25 * vh, top + height - vh);
                text.style.transform = `translateY(${(-200 + 400 * pt).toFixed(2)}px)`;
            } else {
                text.style.transform = 'none';
            }
        }

        if (words.length && !reduce) {
            const pw = progress(y - heroTop, 1.17 * vh, 1.44 * vh);
            target = Math.max(target, Math.round(pw * words.length));
            if (!timer && lit !== target) timer = window.setTimeout(catchUp, 0);
        }
    }, measure);
}
