import { reducedMotion } from '../lib/scroll';

// Partner testimonial tabs with auto-advance (circle progress) and crossfades.
export function initPartners() {
    const section = document.querySelector('[data-partners]');
    if (!section) return;
    const tabs = [...section.querySelectorAll('[data-partner-tab]')];
    const panels = [...section.querySelectorAll('[data-partner-panel]')];
    const images = [...section.querySelectorAll('[data-partner-image]')];
    const logos = [...section.querySelectorAll('[data-partner-logo]')];
    const ctas = [...section.querySelectorAll('[data-partner-cta]')];
    const circle = section.querySelector('.motion-circle');
    const interval = parseInt(section.dataset.interval, 10) || 13400;
    const reduce = reducedMotion();
    const count = tabs.length;
    if (!count) return;

    let active = 0;
    let startedAt = performance.now();
    let raf = 0;
    let inView = false;

    const revealPanel = (panel) => {
        const words = panel.querySelector('[data-reveal-words]');
        const author = panel.querySelector('[data-partner-author]');
        if (words) {
            words.classList.remove('is-revealed');
            void words.offsetWidth;
            words.classList.add('is-revealed');
        }
        if (author) {
            author.classList.remove('is-in');
            void author.offsetWidth;
            author.classList.add('is-in');
        }
    };

    const select = (index, { user = false } = {}) => {
        active = ((index % count) + count) % count;
        tabs.forEach((tab, i) => {
            const on = i === active;
            tab.setAttribute('aria-selected', String(on));
            tab.classList.toggle('border-pink', on);
            tab.classList.toggle('text-current', on);
            tab.classList.toggle('border-transparent', !on);
            tab.classList.toggle('text-current/25', !on);
            tab.tabIndex = on ? 0 : -1;
        });
        panels.forEach((panel, i) => {
            const on = i === active;
            if (on) {
                panel.hidden = false;
                revealPanel(panel);
            } else {
                panel.hidden = true;
            }
        });
        images.forEach((img, i) => (img.style.opacity = i === active ? '1' : '0'));
        logos.forEach((l, i) => (l.style.opacity = i === active ? '1' : '0'));
        ctas.forEach((c, i) => {
            c.style.opacity = i === active ? '1' : '0';
            if (i === active) c.removeAttribute('inert');
            else c.setAttribute('inert', '');
        });
        if (user) tabs[active].scrollIntoView({ block: 'nearest', inline: 'nearest', behavior: 'smooth' });
        startedAt = performance.now();
        if (circle) circle.setAttribute('stroke-dasharray', '0px 1px');
    };

    const loop = (now) => {
        if (!inView || reduce) return;
        const p = Math.min(1, (now - startedAt) / interval);
        if (circle) circle.setAttribute('stroke-dasharray', `${p.toFixed(5)}px 1px`);
        if (p >= 1) select(active + 1);
        raf = requestAnimationFrame(loop);
    };

    tabs.forEach((tab, i) => {
        tab.addEventListener('click', () => select(i, { user: true }));
        tab.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') select(i + 1, { user: true }), tabs[active].focus();
            if (e.key === 'ArrowLeft') select(i - 1, { user: true }), tabs[active].focus();
        });
    });

    // initial: panel 0 revealed on first view
    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                const was = inView;
                inView = entry.isIntersecting;
                if (inView && !was) {
                    if (!section.dataset.started) {
                        section.dataset.started = '1';
                        revealPanel(panels[0]);
                    }
                    startedAt = performance.now();
                    cancelAnimationFrame(raf);
                    raf = requestAnimationFrame(loop);
                } else if (!inView) {
                    cancelAnimationFrame(raf);
                }
            });
        },
        { threshold: 0.15 }
    );
    io.observe(section);
}
