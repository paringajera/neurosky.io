import { onScroll, progress, pageTop, isDesktop, reducedMotion } from '../lib/scroll';

// Interactions used by the Safety / Company / Careers pages.
export function initSecondary() {
    initScrollNext();
    initScrolly();
    initAccordion();
    initSnapSliders();
    initVoices();
}

// "Scroll down" button on page heroes: scroll to the next section.
function initScrollNext() {
    document.querySelectorAll('[data-scroll-next]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const hero = btn.closest('[data-page-hero]');
            const next = hero?.nextElementSibling;
            const top = next ? pageTop(next) - 40 : window.innerHeight;
            window.scrollTo({ top, behavior: reducedMotion() ? 'auto' : 'smooth' });
        });
    });
}

// Safety "core to our DNA": sticky counter + media, steps light up as they pass the viewport centre,
// the pink line fills with overall progress.
function initScrolly() {
    const root = document.querySelector('[data-scrolly]');
    if (!root) return;
    const steps = [...root.querySelectorAll('[data-scrolly-step]')];
    const media = [...root.querySelectorAll('[data-scrolly-media]')];
    const counter = root.querySelector('[data-scrolly-counter]');
    const line = root.querySelector('[data-scrolly-line]');
    const lineMobile = root.querySelector('[data-scrolly-line-mobile]');
    let active = -1;

    const setActive = (i) => {
        if (i === active) return;
        active = i;
        steps.forEach((s, j) => {
            const inner = s.querySelector('.scrolly-step');
            if (inner) inner.style.opacity = j === i ? '1' : '0.15';
        });
        media.forEach((m, j) => (m.style.opacity = j === i ? '1' : '0'));
        if (counter) {
            counter.classList.remove('is-flip');
            void counter.offsetWidth;
            counter.textContent = String(i + 1).padStart(2, '0');
            counter.classList.add('is-flip');
        }
    };
    setActive(0);

    let top = 0;
    let height = 0;
    const measure = () => {
        top = pageTop(root);
        height = root.offsetHeight;
    };

    onScroll(({ y, vh }) => {
        if (isDesktop()) {
            const centre = y + vh / 2;
            let idx = 0;
            steps.forEach((s, j) => {
                const r = s.getBoundingClientRect();
                const mid = r.top + window.scrollY + r.height / 2;
                if (centre >= mid - vh * 0.25) idx = j;
            });
            setActive(idx);
            const p = progress(y, top - vh * 0.5, top + height - vh);
            if (line) line.style.transform = `translateY(${(-100 * (1 - p)).toFixed(3)}%)`;
        } else if (line) {
            line.style.transform = 'none';
        }
    }, measure);

    // Mobile: horizontal scroll-snap list drives the active step
    const list = root.querySelector('[data-scrolly-steps]');
    if (list) {
        list.addEventListener(
            'scroll',
            () => {
                if (isDesktop()) return;
                const i = Math.round(list.scrollLeft / list.clientWidth);
                setActive(Math.max(0, Math.min(steps.length - 1, i)));
                if (lineMobile) lineMobile.style.transform = `translateX(${(-100 * (1 - i / (steps.length - 1))).toFixed(2)}%)`;
            },
            { passive: true }
        );
    }
}

// Hover accordion (NeuroSky Driver / NeuroSky World / MRT cards)
function initAccordion() {
    document.querySelectorAll('[data-accordion]').forEach((root) => {
        const items = [...root.querySelectorAll('[data-accordion-item]')];
        const activate = (el) => {
            items.forEach((it) => it.classList.toggle('is-active', it === el));
        };
        items.forEach((it) => {
            it.addEventListener('pointerenter', (e) => {
                if (e.pointerType === 'mouse' && isDesktop()) activate(it);
            });
            it.addEventListener('focusin', () => activate(it));
            it.addEventListener('click', (e) => {
                if (!it.classList.contains('is-active') && !isDesktop()) {
                    e.preventDefault();
                    activate(it);
                }
            });
        });
    });
}

// Full-screen snap sliders (safety best practices): arrows + keyboard
function initSnapSliders() {
    document.querySelectorAll('[data-snap-slider]').forEach((root) => {
        const track = root.querySelector('[data-snap-track]');
        const prev = root.querySelector('[data-snap-prev]');
        const next = root.querySelector('[data-snap-next]');
        if (!track) return;
        const count = track.children.length;
        const index = () => Math.round(track.scrollLeft / track.clientWidth);
        const go = (i) => {
            const target = Math.max(0, Math.min(count - 1, i));
            track.scrollTo({ left: target * track.clientWidth, behavior: reducedMotion() ? 'auto' : 'smooth' });
        };
        prev?.addEventListener('click', () => go(index() - 1));
        next?.addEventListener('click', () => go(index() + 1));
        root.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') go(index() + 1);
            if (e.key === 'ArrowLeft') go(index() - 1);
        });
    });
}

// Careers "NeuroSky voices": quote slider with image pair that shifts along a pool
function initVoices() {
    const root = document.querySelector('[data-voices]');
    if (!root) return;
    const voices = [...root.querySelectorAll('[data-voice]')];
    const bar = root.querySelector('[data-voices-bar]');
    const counter = root.querySelector('[data-voices-counter]');
    const stage = root.querySelector('[data-voices-stage]');
    const pool = [...(root.querySelector('[data-voices-pool]')?.content.querySelectorAll('img') || [])].map((i) => i.getAttribute('src'));
    const count = voices.length;
    let active = 0;
    let imageIndex = 0; // pool index shown in the left slot

    const show = (i) => {
        voices.forEach((v, j) => {
            const on = j === i;
            v.hidden = !on;
            if (on) {
                const words = v.querySelector('[data-reveal-words]');
                const author = v.querySelector('[data-partner-author]');
                [words, author].forEach((el) => {
                    if (!el) return;
                    el.classList.remove('is-revealed', 'is-in');
                    void el.offsetWidth;
                    el.classList.add(el === words ? 'is-revealed' : 'is-in');
                });
            }
        });
        if (bar) bar.style.transform = `scaleX(${(i / Math.max(1, count - 1)).toFixed(4)})`;
        if (counter) {
            counter.classList.remove('is-flip');
            void counter.offsetWidth;
            counter.textContent = String(i + 1);
            counter.classList.add('is-flip');
        }
    };

    const shiftImages = (dir) => {
        if (!stage || pool.length < 3) return;
        const slots = [...stage.querySelectorAll('[data-voice-slot]')];
        if (slots.length < 2) return;
        imageIndex = (imageIndex + dir + pool.length) % pool.length;
        const left = slots[0];
        const right = slots[1];
        const incoming = document.createElement('div');
        incoming.className = 'voice-slot absolute right-0 z-5 aspect-[320/427] w-[70%] md:w-[76.64%] is-entering';
        incoming.dataset.voiceSlot = '1';
        incoming.innerHTML = `<div class="size-full overflow-clip bg-gray-300 rounded-[12px]"><img class="size-full object-cover" src="${pool[(imageIndex + 1) % pool.length]}" alt="" decoding="async"></div>`;
        // right becomes left, left leaves
        left.classList.add('is-leaving');
        setTimeout(() => left.remove(), 650);
        right.classList.remove('right-0', 'z-5', 'w-[70%]', 'md:w-[76.64%]');
        right.classList.add('left-0', 'z-4', 'w-[46.71%]');
        right.dataset.voiceSlot = '0';
        stage.appendChild(incoming);
        void incoming.offsetWidth;
        incoming.classList.remove('is-entering');
    };

    const go = (i, dir) => {
        active = ((i % count) + count) % count;
        show(active);
        shiftImages(dir);
    };
    root.querySelector('[data-voices-prev]')?.addEventListener('click', () => go(active - 1, -1));
    root.querySelector('[data-voices-next]')?.addEventListener('click', () => go(active + 1, 1));

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                show(0);
                io.disconnect();
            }
        });
    });
    io.observe(root);
}
