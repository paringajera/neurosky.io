import { reducedMotion } from '../lib/scroll';

// Careers image stage: every 2s the smallest tile exits (shrink + nudge), every
// tile shifts one slot left, and the next image enters from the right into the
// largest slot. Slot geometry mirrors the reference (23/31/39/47vw).
const SLOTS = [
    { left: '0px', width: '23vw', height: '17vw' },
    { left: 'calc(100% - (47vw + (39vw * 0.5) + (31vw * 0.5)))', width: '31vw', height: '23vw' },
    { left: 'calc(100% - (47vw + (39vw * 0.5)))', width: '39vw', height: '29vw' },
    { left: 'calc(100% - 47vw)', width: '47vw', height: '35vw' },
];

export function initCareers() {
    const section = document.querySelector('[data-careers]');
    if (!section) return;
    const stage = section.querySelector('[data-careers-stage]');
    const pool = [...(section.querySelector('[data-careers-pool]')?.content.querySelectorAll('img') || [])].map((img) => img.getAttribute('src'));
    const interval = parseInt(section.dataset.interval, 10) || 2000;
    if (!stage || pool.length < 4 || reducedMotion()) return;

    let slots = [...stage.querySelectorAll('[data-careers-slot]')];
    let nextIndex = slots.length % pool.length; // next image to enter
    let timer = 0;

    const applySlot = (el, i) => {
        el.style.left = SLOTS[i].left;
        el.style.width = SLOTS[i].width;
        el.style.height = SLOTS[i].height;
        el.dataset.careersSlot = String(i);
    };
    slots.forEach(applySlot);

    const makeSlot = (src) => {
        const el = document.createElement('div');
        el.className = 'careers-slot absolute is-entering';
        el.innerHTML = `<div class="size-full overflow-clip bg-gray-300 rounded-[12px]"><div class="size-full"><img class="size-full object-cover" src="${src}" alt="" decoding="async"></div></div>`;
        return el;
    };

    const cycle = () => {
        const leaving = slots.shift();
        if (leaving) {
            leaving.classList.add('is-leaving');
            setTimeout(() => leaving.remove(), 650);
        }
        slots.forEach((el, i) => applySlot(el, i));
        const entering = makeSlot(pool[nextIndex]);
        nextIndex = (nextIndex + 1) % pool.length;
        applySlot(entering, 3);
        stage.appendChild(entering);
        void entering.offsetWidth;
        entering.classList.remove('is-entering');
        slots.push(entering);
    };

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                clearInterval(timer);
                if (entry.isIntersecting) timer = window.setInterval(cycle, interval);
            });
        },
        { threshold: 0.1 }
    );
    io.observe(stage);
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) clearInterval(timer);
    });
}
