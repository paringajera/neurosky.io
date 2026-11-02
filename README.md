# NeuroSky website (Laravel)

The NeuroSky site for [neurosky.io](https://neurosky.io), built as a faithful recreation of the [waabi.ai](https://waabi.ai) design with Laravel 13, Blade components,
Tailwind CSS 4 and a small vanilla-JS motion layer. No external animation library is used; every
scroll-mapped value and spring was measured on the live site (see `docs/reference-spec.md`).

## Requirements

- PHP 8.3+ with Composer
- Node 20+ with npm

## Run locally

```bash
composer install
```

```bash
npm install
```

```bash
cp .env.example .env && php artisan key:generate
```

Development (PHP server + Vite with hot reload, in one process):

```bash
composer run dev
```

The site is served at **http://localhost:8000** (Vite runs on 5173 for HMR).

Production assets:

```bash
npm run build
```

```bash
php artisan serve
```

## Routes

| Path | View |
| --- | --- |
| `/` | Homepage (hero, collage, benefits, technology, safety, partners, insights, careers, footer) |
| `/safety`, `/research`, `/company`, `/careers` | Main navigation destinations |
| `/insights`, `/insights?category=technology` | Insights index with tag filters, press carousel |
| `/insights/{slug}` | Article template (16 articles mirrored from the reference) |
| `/privacy-policy` | Privacy policy |

## Project layout

- `resources/css/app.css` — design tokens (`@theme`), typography utilities (`type-z-*`, `type-s-*`), layout helpers (`w-calc`, `px-calc`, `tile`), base rules copied from the reference.
- `resources/css/site.css` — component states (header/menu, banner, word reveals, benefits, careers stage, accordion, sliders).
- `resources/views/components/` — layout, header, banner, footer, cookie dialog, icons, `words` (word-splitting reveal helper), carousels, cards, page hero.
- `resources/views/pages/` — one Blade view per route; homepage sections live in `pages/home/*`.
- `resources/content/*.php` — all page copy and media references (editable without touching templates).
- `resources/views/content/insights/*.blade.php` — article bodies.
- `resources/js/lib/` — scroll loop (`scroll.js`), easing (`ease.js`), spring integrator (`spring.js`).
- `resources/js/modules/` — one module per interactive feature (hero, collage, benefits, partners, carousel, careers, footer, header, banner, videos, reveals, parallax, secondary pages).
- `public/media/` — local copies of every image and video (see `docs/asset-manifest.md`).
- `docs/reference-spec.md` — measured geometry, type scale and motion inventory of the reference.

## Notes

- Videos are lazy-loaded when they approach the viewport and fade in once ready; playback pauses off-screen.
- `prefers-reduced-motion` disables scroll-driven transforms, word reveals and auto-advancing modules while keeping all content visible.
- The "Get in touch" link opens the reference's external HubSpot form; nothing is submitted from this project.

## Performance notes

Scroll-driven scenes are tuned so that a scroll frame never repaints full-viewport media:

- Every scroll-mapped layer (`[data-parallax]`, collage columns, benefits stage and deck, hero clip, page-progress bar) carries `will-change`, so its per-frame `transform`/`opacity` update is a compositor-only change.
- Videos are buffered when they come within 120% of the viewport but play only while within 40% of it and not parked off-stage (benefits deck layers waiting at +100vh toggle `[data-video-offstage]`; see `resources/js/modules/videos.js`). The `autoplay` attribute is cleared on attach so it cannot bypass this.
- The 2160×2160 `Scalable.mp4` master is only served to hi-dpi desktops; everyone else gets the 1080×1080 re-encode.
- The footer light tunnel paints only the visible ring of each layer (four device-pixel-snapped `fillRect` bands) instead of 250 canvas-sized fills.

Measured with a wheel scroll through the technology section (y 5000→7400 at 1920×1080, Google Chrome, Playwright):

| Metric | Before | After |
| --- | --- | --- |
| Videos decoding at once | 11 | 3 |
| GPU process busy during the scroll (traced) | 6.8 s of 9.1 s | 1.7 s of 4.3 s |
| Weak-machine emulation (no GPU, 4× CPU throttle): frames over 50 ms | 16–30 of ~160 | 6–11 of ~150 |
| Weak-machine emulation: 95th-percentile frame | 67–83 ms | 50 ms |
| Footer canvas, software raster | 71 ms/frame | 6 ms/frame |

On a GPU-accelerated machine the page scrolls at 60 fps before and after; the fixes target machines without hardware acceleration.

## Branding

The site is branded **NeuroSky** (domain `neurosky.io`). Brand strings, slugs, media filenames, storage keys and
the `config/neurosky.php` site config were renamed from the reference. The wordmark in
`resources/views/components/icons/logo*.blade.php` is the word "neurosky" outlined from the site's Neue Haas
Grotesk RoundDots font. For production set `APP_URL=https://neurosky.io` (already in `.env.example`).

Links to third-party sites (press articles, partner sites, the article video CDN `static.ext.waabi.ai`, the
safety self-assessment PDF, social profiles, the HubSpot contact form) were left unchanged so they keep working;
replace them with NeuroSky's own accounts and assets before launch.

## Deploying to Hostinger

The repository is ready for Hostinger shared hosting: built assets (`public/build`) are committed,
and the root `.htaccess` sends every request into `public/`.

1. In hPanel open **Websites → neurosky.io → Advanced → Git** and add
   `https://github.com/paringajera/neurosky.io.git`, branch `main`, install path empty
   (so it deploys into `public_html`). Click **Deploy**.
2. Open **Advanced → SSH Access**, connect, go to the site folder (`cd domains/neurosky.io/public_html`)
   and run `bash deploy/hostinger.sh` once. It installs PHP packages, creates `.env` from
   `deploy/env.production`, generates the app key, fixes folder permissions and caches config.
3. After later pushes, deploy again in hPanel and re-run `bash deploy/hostinger.sh`.

After changing CSS or JavaScript, run `npm run build` locally and commit `public/build` before pushing.
