// Announcement strip: slides in on load, pushes the floating header down by
// its own height, and can be dismissed for the session.

export function initBanner() {
    const banner = document.querySelector('[data-banner]');
    const root = document.documentElement;
    if (!banner) return;

    const setHeight = () => root.style.setProperty('--banner-height', `${banner.offsetHeight - 1}px`);
    setHeight();
    window.addEventListener('resize', setHeight);

    if (!root.classList.contains('banner-dismissed')) {
        // Let the first paint happen before sliding in (matches the reference's post-hydration entrance).
        requestAnimationFrame(() => requestAnimationFrame(() => root.classList.add('banner-ready')));
    }

    banner.querySelector('[data-banner-close]')?.addEventListener('click', () => {
        root.classList.add('banner-dismissed');
        banner.setAttribute('aria-hidden', 'true');
        try {
            sessionStorage.setItem('neurosky:banner', 'dismissed');
        } catch (e) {
            /* storage unavailable */
        }
    });
}
