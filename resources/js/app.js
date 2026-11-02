import { boot } from './lib/scroll';
import { initBanner } from './modules/banner';
import { initHeader } from './modules/header';
import { initVideos } from './modules/videos';
import { initReveals } from './modules/reveals';
import { initParallax } from './modules/parallax';
import { initHero } from './modules/hero';
import { initCollage } from './modules/collage';
import { initBenefits } from './modules/benefits';
import { initPartners } from './modules/partners';
import { initCarousels } from './modules/carousel';
import { initCareers } from './modules/careers';
import { initFooter } from './modules/footer';
import { initFooterCanvas } from './modules/footer-canvas';
import { initCookie } from './modules/cookie';
import { initPages } from './modules/pages';
import { initSecondary } from './modules/secondary';
import { initLocations } from './modules/locations';

// Modules are initialised in short tasks with a yield between them. Run as one
// block, init plus its first layout measurements took ~30 ms (~120 ms on slow
// CPUs) right while the cross-document view transition animates the new page,
// which stalled the page-change animation.
const yieldToMain = () =>
    globalThis.scheduler?.yield ? globalThis.scheduler.yield() : new Promise((resolve) => setTimeout(resolve, 0));

const steps = [
    boot,
    initBanner,
    initHeader,
    initHero,
    initReveals,
    initVideos,
    initParallax,
    initCollage,
    initBenefits,
    initPartners,
    initCarousels,
    initCareers,
    initFooter,
    initFooterCanvas,
    initCookie,
    initPages,
    initSecondary,
    initLocations,
];

async function start() {
    for (const step of steps) {
        step();
        await yieldToMain();
    }
    document.documentElement.classList.add('js-ready');
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
else start();

// Restore scroll-driven state when navigating back via bfcache.
window.addEventListener('pageshow', (e) => {
    if (e.persisted) window.dispatchEvent(new Event('resize'));
});
