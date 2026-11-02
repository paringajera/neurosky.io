// Local cookie-consent dialog (stores the choice only in localStorage).
export function initCookie() {
    const el = document.querySelector('[data-cookie-banner]');
    if (!el) return;
    let choice = null;
    try {
        choice = localStorage.getItem('neurosky:consent');
    } catch (e) {
        /* ignore */
    }
    if (choice) return;
    setTimeout(() => (el.hidden = false), 800);
    el.querySelectorAll('[data-cookie-action]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const action = btn.dataset.cookieAction;
            try {
                localStorage.setItem('neurosky:consent', action === 'accept' ? 'all' : action === 'reject' ? 'none' : 'essential');
            } catch (e) {
                /* ignore */
            }
            el.hidden = true;
        });
    });
}
