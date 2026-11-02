// Cubic-bezier solver (same semantics as CSS cubic-bezier) + presets measured
// from the reference site's scroll-mapped animations.

export function cubicBezier(p1x, p1y, p2x, p2y) {
    const cx = (t) => 3 * p1x * (1 - t) ** 2 * t + 3 * p2x * (1 - t) * t * t + t ** 3;
    const cy = (t) => 3 * p1y * (1 - t) ** 2 * t + 3 * p2y * (1 - t) * t * t + t ** 3;
    return (x) => {
        if (x <= 0) return 0;
        if (x >= 1) return 1;
        let lo = 0;
        let hi = 1;
        for (let i = 0; i < 24; i++) {
            const mid = (lo + hi) / 2;
            if (cx(mid) < x) lo = mid;
            else hi = mid;
        }
        return cy((lo + hi) / 2);
    };
}

export const easeStandard = cubicBezier(0.25, 0.1, 0.25, 1); // CSS "ease" (hero scale)
export const easeSnappy = cubicBezier(0.19, 1, 0.22, 1); // --ease-snappy (hero clip inset)
export const easeOut16 = cubicBezier(0.16, 1, 0.3, 1);
export const easeInOutCubic = (p) => (p < 0.5 ? 4 * p * p * p : 1 - (-2 * p + 2) ** 3 / 2);
export const easeOutExpo = (p) => (p >= 1 ? 1 : 1 - 2 ** (-10 * p));
export const linear = (p) => p;
