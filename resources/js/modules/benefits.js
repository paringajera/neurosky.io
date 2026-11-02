import { onScroll, progress, isDesktop, pageTop, reducedMotion } from '../lib/scroll';
import { easeInOutCubic } from '../lib/ease';
import { SpringValue } from '../lib/spring';

// Three-state "Safe / Scalable / Practical" module.
// Desktop (md+):
//  - the feature image flies in from the hidden collage tile (easeInOutCubic over [top-0.75vh, top])
//  - once the user is 0.25vh into the section the image shrinks away and the
//    first video slides up; the user picks states by clicking the titles
//  - videos form a deck: previous ones sit at -3vh/-0.05 scale per step, upcoming
//    ones wait at +100vh with +0.05 scale per step (spring k=120, c=22)
//  - the whole stage drifts up/scales down over [top+0.5vh, top+1vh] and fades
//    out over [top+1.5vh, top+2vh]
// Mobile (<md): auto-advancing carousel (5s per state) with progress bar and arrows.
export function initBenefits() {
    const section = document.querySelector('[data-benefits]');
    if (!section) return;
    const reduce = reducedMotion();

    initDesktop(section, reduce);
    initMobile(section, reduce);
}

function deckTargets(index, count, unit) {
    // unit: 'vh' (desktop uses viewport-relative) or '%' (mobile square)
    return Array.from({ length: count }, (_, j) => {
        if (j === index) return { ty: 0, scale: 1 };
        if (j < index) return { ty: -3 * (index - j), scale: 1 - 0.05 * (index - j) };
        return { ty: 100, scale: 1 + 0.05 * (j - index) };
    }).map((t) => ({ ...t, unit }));
}

function createDeck(layers, unit) {
    return layers.map((el, j) => {
        const ty = new SpringValue(j === 0 ? 100 : 100, { stiffness: 120, damping: 22, restDelta: 0.02 });
        const sc = new SpringValue(1 + 0.05 * j, { stiffness: 120, damping: 22, restDelta: 0.0005, restSpeed: 0.001 });
        const paint = () => {
            const t = ty.value;
            const s = sc.value;
            el.style.transform = Math.abs(t) < 0.02 && Math.abs(s - 1) < 0.0005 ? 'none' : `translateY(${t.toFixed(3)}${unit}) scale(${s.toFixed(4)})`;
        };
        ty.onUpdate(paint);
        sc.onUpdate(paint);
        paint();
        return { el, ty, sc, dim: el.querySelector('[data-benefits-video-dim]') };
    });
}

// Layers waiting below the stage are invisible: park their videos (no decoding)
// until the deck brings them in. See modules/videos.js.
function gate(layer, off) {
    if (layer.el.hasAttribute('data-video-offstage') === off) return;
    layer.el.toggleAttribute('data-video-offstage', off);
    layer.el.dispatchEvent(new Event('video:sync', { bubbles: true }));
}

function setDeck(deck, index, immediate) {
    const targets = deckTargets(index, deck.length);
    deck.forEach((layer, j) => {
        gate(layer, j > index);
        if (immediate) {
            layer.ty.jump(targets[j].ty);
            layer.sc.jump(targets[j].scale);
        } else {
            layer.ty.set(targets[j].ty);
            layer.sc.set(targets[j].scale);
        }
        if (layer.dim) layer.dim.style.opacity = j === index ? '0' : '1';
    });
}

function initDesktop(section, reduce) {
    const stage = section.querySelector('[data-benefits-stage]');
    const imageWrap = section.querySelector('[data-benefits-image-wrap]');
    const image = section.querySelector('[data-benefits-image]');
    const dim = section.querySelector('[data-benefits-dim]');
    const origin = section.querySelector('[data-benefits-origin]');
    const items = [...section.querySelectorAll('[data-benefit-item]')];
    const layers = [...section.querySelectorAll('[data-benefits-video]')];
    if (!stage || !image || !items.length) return;

    const deck = createDeck(layers, 'vh');
    let engaged = false; // scrolled past the activation point
    let active = 0;
    let top = 0;
    let flight = { dx: 0, dy: 0, s0: 1 };

    const measure = ({ vh }) => {
        top = pageTop(section);
        if (origin && isDesktop()) {
            const o = origin.getBoundingClientRect();
            const prev = image.style.transform;
            image.style.transform = 'none';
            const r = image.getBoundingClientRect();
            image.style.transform = prev;
            // natural position of the image while the sticky wrapper is at rest (section top, centred in 100vh)
            const naturalTop = top + (vh - r.height) / 2;
            const naturalLeft = r.left;
            flight = {
                dx: o.left + o.width / 2 - (naturalLeft + r.width / 2),
                dy: o.top + window.scrollY + o.height / 2 - (naturalTop + r.height / 2),
                s0: o.width / r.width,
            };
        }
    };

    const paintItems = () => {
        items.forEach((item, i) => {
            const on = engaged && i === active;
            item.style.opacity = engaged ? (on ? '1' : '0.46') : i === 0 ? '1' : '0.46';
            item.setAttribute('aria-pressed', String(on));
            const desc = item.querySelector('[data-benefit-desc]');
            if (!desc) return;
            const show = i === active;
            if (show && desc.dataset.open !== '1') {
                desc.dataset.open = '1';
                desc.style.display = 'block';
                desc.style.height = '0px';
                void desc.offsetHeight;
                desc.style.height = `${desc.scrollHeight}px`;
                desc.style.opacity = '1';
                const done = (e) => {
                    if (e.propertyName === 'height' && desc.dataset.open === '1') desc.style.height = 'auto';
                    desc.removeEventListener('transitionend', done);
                };
                desc.addEventListener('transitionend', done);
            } else if (!show && desc.dataset.open === '1') {
                desc.dataset.open = '0';
                desc.style.height = `${desc.scrollHeight}px`;
                void desc.offsetHeight;
                desc.style.height = '0px';
                desc.style.opacity = '0';
                const hide = (e) => {
                    if (e.propertyName === 'height' && desc.dataset.open === '0') desc.style.display = 'none';
                    desc.removeEventListener('transitionend', hide);
                };
                desc.addEventListener('transitionend', hide);
            }
        });
    };

    const applyState = (immediate = false) => {
        if (!isDesktop()) return;
        if (engaged) {
            imageWrap?.classList.add('is-hidden');
            setDeck(deck, active, immediate);
        } else {
            imageWrap?.classList.remove('is-hidden');
            // everything waits below
            deck.forEach((layer, j) => {
                gate(layer, true);
                if (immediate) {
                    layer.ty.jump(100);
                    layer.sc.jump(1 + 0.05 * j);
                } else {
                    layer.ty.set(100);
                    layer.sc.set(1 + 0.05 * j);
                }
                if (layer.dim) layer.dim.style.opacity = j === 0 ? '0' : '1';
            });
        }
        paintItems();
    };

    items.forEach((item, i) => {
        const select = () => {
            if (active === i && engaged) return;
            active = i;
            engaged = true;
            applyState();
        };
        item.addEventListener('click', select);
        item.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                select();
            }
        });
    });

    // initial paint (SSR-equivalent state)
    paintItems();
    deck.forEach((layer, j) => {
        gate(layer, true);
        layer.ty.jump(100);
        layer.sc.jump(1 + 0.05 * j);
        if (layer.dim) layer.dim.style.opacity = j === 0 ? '0' : '1';
    });

    onScroll(({ y, vh }) => {
        if (!isDesktop()) {
            image.style.transform = 'none';
            image.style.borderRadius = '';
            stage.style.transform = 'none';
            stage.style.opacity = '1';
            return;
        }
        const rel = y - top;

        // 1. flight from the collage tile
        if (!reduce) {
            const p = progress(rel, -0.75 * vh, 0);
            const e = easeInOutCubic(p);
            const s = flight.s0 + (1 - flight.s0) * e;
            const tx = flight.dx * (1 - e);
            const ty = flight.dy * (1 - e);
            if (p >= 1) {
                image.style.transform = 'translate3d(0px, 0px, 0px) scale3d(1, 1, 1)';
                image.style.borderRadius = '16px';
            } else {
                image.style.transform = `translate3d(${tx.toFixed(2)}px, ${ty.toFixed(2)}px, 0px) scale3d(${s.toFixed(5)}, ${s.toFixed(5)}, 1)`;
                image.style.borderRadius = `${(16 / s).toFixed(2)}px`;
            }
        }

        // 2. engagement threshold
        const shouldEngage = rel > 0.25 * vh;
        if (shouldEngage !== engaged) {
            engaged = shouldEngage;
            applyState();
        }

        // 3. stage drift + dim + fade
        const p2 = progress(rel, 0.5 * vh, vh);
        stage.style.transform = p2 === 0 ? 'none' : `translateY(${(-50 * p2).toFixed(2)}px) scale(${(1 - 0.1 * p2).toFixed(4)})`;
        if (dim) dim.style.opacity = p2.toFixed(3);
        const p3 = progress(rel, 1.5 * vh, 2 * vh);
        stage.style.opacity = (1 - p3).toFixed(3);
    }, measure);
}

function initMobile(section, reduce) {
    const root = section.querySelector('[data-benefits-mobile]');
    if (!root) return;
    const layers = [...root.querySelectorAll('[data-benefits-mobile-video]')];
    const descs = [...root.querySelectorAll('[data-benefits-mobile-desc]')];
    const title = root.querySelector('[data-benefits-mobile-title]');
    const bar = root.querySelector('[data-benefits-mobile-bar]');
    const prev = root.querySelector('[data-benefits-mobile-prev]');
    const next = root.querySelector('[data-benefits-mobile-next]');
    const titles = [...section.querySelectorAll('[data-benefit-item]')].map((item) => item.querySelector(':scope > p')?.textContent.trim() || '');
    const interval = parseInt(section.dataset.interval, 10) || 5000;
    const count = layers.length;
    if (!count) return;

    const deck = createDeck(layers, '%');
    let active = 0;
    let startedAt = 0;
    let raf = 0;
    let inView = false;

    const paint = (immediate) => {
        setDeck(deck, active, immediate);
        descs.forEach((d, i) => (d.style.opacity = i === active ? '1' : '0'));
        if (title && titles[active]) title.textContent = titles[active];
    };

    const loop = (now) => {
        if (!inView || reduce) return;
        const p = Math.min(1, (now - startedAt) / interval);
        if (bar) bar.style.transform = `translateX(${(-100 + 100 * p).toFixed(3)}%)`;
        if (p >= 1) {
            go(active + 1);
            return;
        }
        raf = requestAnimationFrame(loop);
    };

    const restart = () => {
        cancelAnimationFrame(raf);
        startedAt = performance.now();
        if (bar) bar.style.transform = 'translateX(-100%)';
        if (inView && !reduce) raf = requestAnimationFrame(loop);
    };

    const go = (index, immediate = false) => {
        active = ((index % count) + count) % count;
        paint(immediate);
        restart();
    };

    prev?.addEventListener('click', () => go(active - 1));
    next?.addEventListener('click', () => go(active + 1));

    // swipe
    let startX = null;
    root.addEventListener('pointerdown', (e) => (startX = e.clientX), { passive: true });
    root.addEventListener('pointerup', (e) => {
        if (startX === null) return;
        const dx = e.clientX - startX;
        startX = null;
        if (Math.abs(dx) > 40) go(dx < 0 ? active + 1 : active - 1);
    });

    paint(true);
    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                inView = entry.isIntersecting && !isDesktop();
                if (inView) restart();
                else cancelAnimationFrame(raf);
            });
        },
        { threshold: 0.2 }
    );
    io.observe(root);
}
