// Behaviours used by secondary pages (insights hero slider, share menu, video players).
export function initPages() {
    initFeaturedSlider();
    initShareMenus();
    initVideoPlayers();
    initLoadMore();
}

function initLoadMore() {
    const btn = document.querySelector('[data-more-button]');
    if (!btn) return;
    btn.addEventListener('click', () => {
        document.querySelectorAll('[data-more-item]').forEach((el) => el.classList.remove('hidden'));
        btn.closest('[data-more-wrap]')?.remove();
    });
}

function initFeaturedSlider() {
    const slider = document.querySelector('[data-featured-slider]');
    if (!slider) return;
    const track = slider.querySelector('[data-featured-track]');
    const slides = [...track.children];
    const dots = [...slider.querySelectorAll('[data-featured-dot]')];
    const bars = dots.map((d) => d.querySelector('[data-featured-bar]'));
    const interval = parseInt(slider.dataset.interval, 10) || 6000;
    let active = 0;
    let startedAt = performance.now();
    let raf = 0;

    const go = (i, smooth = true) => {
        active = ((i % slides.length) + slides.length) % slides.length;
        track.scrollTo({ left: slides[active].offsetLeft, behavior: smooth ? 'smooth' : 'auto' });
        slides.forEach((s, j) => s.classList.toggle('is-active', j === active));
        startedAt = performance.now();
    };
    const loop = (now) => {
        const p = Math.min(1, (now - startedAt) / interval);
        bars.forEach((b, j) => {
            if (!b) return;
            b.style.transform = j < active ? 'none' : j === active ? `scaleX(${p.toFixed(4)})` : 'scaleX(0)';
        });
        if (p >= 1) go(active + 1);
        raf = requestAnimationFrame(loop);
    };
    dots.forEach((d, j) => d.addEventListener('click', () => go(j)));
    let scrollTimer = 0;
    track.addEventListener('scroll', () => {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => {
            const i = Math.round(track.scrollLeft / track.clientWidth);
            if (i !== active) {
                active = i;
                slides.forEach((s, j) => s.classList.toggle('is-active', j === active));
                startedAt = performance.now();
            }
        }, 80);
    });
    slides[0]?.classList.add('is-active');
    if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) raf = requestAnimationFrame(loop);
    document.addEventListener('visibilitychange', () => {
        cancelAnimationFrame(raf);
        if (!document.hidden) {
            startedAt = performance.now();
            raf = requestAnimationFrame(loop);
        }
    });
}

function initShareMenus() {
    document.querySelectorAll('[data-share]').forEach((root) => {
        const btn = root.querySelector('[data-share-toggle]');
        const menu = root.querySelector('[data-share-menu]');
        const copy = root.querySelector('[data-share-copy]');
        if (!btn || !menu) return;
        const setOpen = (open) => {
            root.toggleAttribute('data-open', open);
            btn.setAttribute('aria-expanded', String(open));
        };
        btn.addEventListener('click', () => setOpen(!root.hasAttribute('data-open')));
        document.addEventListener('pointerdown', (e) => {
            if (!root.contains(e.target)) setOpen(false);
        });
        copy?.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(location.href);
                copy.querySelector('span').textContent = 'Copied!';
                setTimeout(() => (copy.querySelector('span').textContent = 'Copy link'), 1500);
            } catch (e) {
                /* ignore */
            }
        });
    });
}

function initVideoPlayers() {
    document.querySelectorAll('[data-player]').forEach((root) => {
        const video = root.querySelector('video');
        const play = root.querySelector('[data-player-play]');
        if (!video || !play) return;
        const toggle = () => {
            if (video.paused) {
                video.play();
                root.setAttribute('data-playing', '');
            } else {
                video.pause();
                root.removeAttribute('data-playing');
            }
        };
        play.addEventListener('click', toggle);
        video.addEventListener('click', toggle);
        video.addEventListener('ended', () => root.removeAttribute('data-playing'));
    });
}
