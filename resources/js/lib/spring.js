// Minimal damped-spring value. Retargetable while in flight (keeps velocity),
// integrates with fixed sub-steps so it is frame-rate independent.

const active = new Set();
let rafId = 0;
let lastTime = 0;

function tick(now) {
    const dt = Math.min(0.064, (now - lastTime) / 1000 || 0.016);
    lastTime = now;
    for (const s of active) s._step(dt);
    if (active.size) rafId = requestAnimationFrame(tick);
    else rafId = 0;
}

function schedule() {
    if (!rafId) {
        lastTime = performance.now();
        rafId = requestAnimationFrame(tick);
    }
}

export class SpringValue {
    constructor(value = 0, { stiffness = 100, damping = 26, mass = 1, restDelta = 0.01, restSpeed = 0.1 } = {}) {
        this.value = value;
        this.target = value;
        this.velocity = 0;
        this.stiffness = stiffness;
        this.damping = damping;
        this.mass = mass;
        this.restDelta = restDelta;
        this.restSpeed = restSpeed;
        this.listeners = new Set();
        this.done = null;
    }

    onUpdate(fn) {
        this.listeners.add(fn);
        return () => this.listeners.delete(fn);
    }

    /** Jump instantly (no animation). */
    jump(value) {
        this.value = value;
        this.target = value;
        this.velocity = 0;
        active.delete(this);
        this._emit();
    }

    set(target, onDone) {
        this.target = target;
        this.done = onDone || null;
        if (Math.abs(this.value - target) < this.restDelta && Math.abs(this.velocity) < this.restSpeed) {
            this.value = target;
            this._emit();
            this._finish();
            return;
        }
        active.add(this);
        schedule();
    }

    _step(dt) {
        const h = 1 / 240;
        let remaining = dt;
        while (remaining > 0) {
            const step = Math.min(h, remaining);
            const accel = (-this.stiffness * (this.value - this.target) - this.damping * this.velocity) / this.mass;
            this.velocity += accel * step;
            this.value += this.velocity * step;
            remaining -= step;
        }
        if (Math.abs(this.value - this.target) < this.restDelta && Math.abs(this.velocity) < this.restSpeed) {
            this.value = this.target;
            this.velocity = 0;
            active.delete(this);
            this._emit();
            this._finish();
            return;
        }
        this._emit();
    }

    _emit() {
        for (const fn of this.listeners) fn(this.value);
    }

    _finish() {
        const cb = this.done;
        this.done = null;
        if (cb) cb();
    }

    destroy() {
        active.delete(this);
        this.listeners.clear();
    }
}

/** Simple time-based tween helper. */
export function tween({ duration = 400, ease = (t) => t, onUpdate, onComplete }) {
    const start = performance.now();
    let raf = 0;
    const step = (now) => {
        const t = Math.min(1, (now - start) / duration);
        onUpdate(ease(t), t);
        if (t < 1) raf = requestAnimationFrame(step);
        else onComplete?.();
    };
    raf = requestAnimationFrame(step);
    return () => cancelAnimationFrame(raf);
}
