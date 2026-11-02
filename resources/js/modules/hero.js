import { onScroll, progress, isDesktop, reducedMotion, pageTop } from '../lib/scroll';
import { easeStandard, easeSnappy } from '../lib/ease';

// Homepage hero. All values are mapped directly to scroll position (no smoothing),
// matching the reference's measured curves (see docs/reference-spec.md):
//  - tagline fades in over [0.15vh, 0.30vh] and out over [0.875vh, 1vh]
//  - scroll cue fades out over [0, 0.15vh]
//  - headline lines slide apart ±50px until the headline leaves the top (md+)
//  - after 1vh of scroll the video is clipped to a centred square (ease-snappy)
//    and scaled down to one collage tile (CSS "ease"), overlay fades over [1.175vh, 1.5vh]
export function initHero() {
    const hero = document.querySelector('[data-hero]');
    if (!hero) return;

    const clip = hero.querySelector('[data-hero-clip]');
    const overlay = hero.querySelector('[data-hero-overlay]');
    const tagline = hero.querySelector('[data-hero-tagline]');
    const taglineInner = hero.querySelector('[data-hero-tagline-inner]');
    const cue = hero.querySelector('[data-hero-cue]');
    const cueInner = hero.querySelector('[data-hero-cue-inner]');
    const title = hero.querySelector('[data-hero-title]');
    const lines = title ? [...title.querySelectorAll('[data-line]')] : [];
    const tile = hero.querySelector('.tile');
    const reduce = reducedMotion();

    let tileSize = 177;
    let heroTop = 0;
    let titleBottom = 0;
    let lineHeight = 0;

    const measure = ({ vh }) => {
        tileSize = isDesktop() ? (133 / 1440) * window.innerWidth : tile ? tile.offsetWidth : 133;
        heroTop = pageTop(hero);
        if (title) {
            const padding = parseFloat(getComputedStyle(title.closest('.w-calc')).paddingBottom) || 0;
            titleBottom = vh - padding; // headline block is 100lvh tall with bottom padding
            lineHeight = parseFloat(getComputedStyle(title).lineHeight) || title.offsetHeight / 2;
        }
    };

    // scroll cue entrance (after hydration in the reference)
    if (cueInner) setTimeout(() => (cueInner.style.opacity = '1'), 1500);

    hero.querySelector('[data-scroll-down]')?.addEventListener('click', () => {
        window.scrollTo({ top: heroTop + window.innerHeight * 1.5, behavior: reduce ? 'auto' : 'smooth' });
    });

    onScroll(({ y, vh, vw }) => {
        const rel = y - heroTop;

        if (tagline) tagline.style.opacity = progress(rel, 0.15 * vh, 0.3 * vh).toFixed(4);
        if (taglineInner) taglineInner.style.opacity = (1 - progress(rel, 0.875 * vh, vh)).toFixed(4);
        if (cue) cue.style.opacity = (1 - progress(rel, 0, 0.15 * vh)).toFixed(4);

        if (lines.length === 2) {
            if (isDesktop() && !reduce) {
                const end = titleBottom;
                const start = titleBottom - lineHeight - vh / 2;
                const p = progress(rel, start, end);
                const tx = (50 * p).toFixed(3);
                lines[0].style.transform = p === 0 ? 'none' : `translateX(${tx}px)`;
                lines[1].style.transform = p === 0 ? 'none' : `translateX(-${tx}px)`;
            } else {
                lines[0].style.transform = 'none';
                lines[1].style.transform = 'none';
            }
        }

        if (clip) {
            const p = progress(rel, vh, 1.5 * vh);
            if (p === 0) {
                clip.style.transform = 'translate3d(0,0,0) scale3d(1,1,1)';
                clip.style.clipPath = 'inset(0px)';
            } else {
                const side = Math.min(vw, vh);
                const finalScale = tileSize / side;
                const s = 1 - (1 - finalScale) * easeStandard(p);
                const insetMax = (Math.max(vw, vh) - side) / 2;
                const inset = insetMax * easeSnappy(p);
                const radius = 16 / s;
                const insetValue = vw >= vh ? `0px ${inset.toFixed(2)}px` : `${inset.toFixed(2)}px 0px`;
                clip.style.transform = `translate3d(0,0,0) scale3d(${s.toFixed(5)},${s.toFixed(5)},1)`;
                clip.style.clipPath = `inset(${insetValue} round ${radius.toFixed(2)}px)`;
            }
        }
        if (overlay) overlay.style.opacity = (1 - progress(rel, 1.175 * vh, 1.5 * vh)).toFixed(4);
    }, measure);
}
