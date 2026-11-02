// Lazy, fade-in video loader. Sources are attached and buffered when the video
// comes within 120% of the viewport; playback only runs while the video is within
// 40% of the viewport and not gated off-stage (an ancestor with [data-video-offstage],
// used by the benefits deck for layers parked at +100vh). Decoding several hidden
// videos at once was a major source of scroll jank.

const offstage = (video) => video.closest('[data-video-offstage]') !== null;

export function initVideos() {
    const videos = document.querySelectorAll('video[data-video-lazy]');
    if (!videos.length) return;

    const tryPlay = (video) => {
        const p = video.play();
        if (p && typeof p.catch === 'function') {
            p.catch(() => {
                // Autoplay blocked: show the first frame and retry on first interaction.
                video.closest('[data-video-fade]')?.classList.add('is-ready');
                const retry = () => {
                    sync(video);
                    window.removeEventListener('pointerdown', retry);
                    window.removeEventListener('touchstart', retry);
                };
                window.addEventListener('pointerdown', retry, { once: true });
                window.addEventListener('touchstart', retry, { once: true });
            });
        }
    };

    // Reconcile playback with visibility + gating.
    const sync = (video) => {
        if (!video.dataset.attached) return;
        const shouldPlay = video.dataset.visible === '1' && !offstage(video) && !document.hidden;
        if (shouldPlay) {
            if (video.paused) tryPlay(video);
        } else if (!video.paused) {
            video.pause();
        }
    };

    const attach = (video) => {
        if (video.dataset.attached) return;
        video.dataset.attached = '1';
        // Playback is driven by sync(); the autoplay attribute would start parked
        // (off-stage) videos on its own as soon as they buffer.
        video.autoplay = false;
        video.addEventListener('play', () => {
            if (video.dataset.visible !== '1' || offstage(video) || document.hidden) video.pause();
        });
        const sources = [...video.querySelectorAll('source[data-src]')];
        if (sources.length) {
            // Pick the first source whose media query matches (Chromium ignores `media` on <video><source>).
            const pick = sources.find((s) => !s.media || window.matchMedia(s.media).matches) || sources[0];
            video.src = pick.dataset.src;
        } else if (video.dataset.src) {
            video.src = video.dataset.src;
        }
        // Buffer and decode the first frame even while paused, so a gated video
        // starts instantly (and shows its poster frame) when it is revealed.
        video.preload = 'auto';
        video.load();
        const fade = video.closest('[data-video-fade]');
        const ready = () => {
            fade?.classList.add('is-ready');
            video.removeEventListener('loadeddata', ready);
            video.removeEventListener('playing', ready);
        };
        video.addEventListener('loadeddata', ready);
        video.addEventListener('playing', ready);
        video.addEventListener('error', () => fade?.classList.add('is-ready'));
        sync(video);
    };

    const loader = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    attach(entry.target);
                    loader.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '120% 0px 120% 0px' }
    );

    const player = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                entry.target.dataset.visible = entry.isIntersecting ? '1' : '0';
                sync(entry.target);
            });
        },
        { rootMargin: '40% 0px 40% 0px' }
    );

    videos.forEach((v) => {
        loader.observe(v);
        player.observe(v);
    });

    document.addEventListener('visibilitychange', () => videos.forEach(sync));

    // Controllers that gate videos (toggle [data-video-offstage]) dispatch a bubbling
    // `video:sync` event on the gated element so playback is reconciled at once.
    document.addEventListener('video:sync', (e) => {
        const t = e.target;
        if (t instanceof HTMLVideoElement) sync(t);
        else if (t instanceof Element) t.querySelectorAll('video[data-video-lazy]').forEach(sync);
    });
}
