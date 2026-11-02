# Reference specification — waabi.ai (captured 2026-10-31)

Everything below was measured on the live site with Playwright (Chromium) and the Claude desktop browser at the
viewports 1920×1080, 1440×900, 768×1024 and 390×844. "Confirmed" items were read from the rendered DOM / computed
styles / inline animation values; "Unresolved" items could not be verified and are listed at the end.

## 1. Design tokens (confirmed, from the reference stylesheet)

- Root font size `10px`, Tailwind spacing unit `--spacing: .1rem` (so `p-24` = 24px). Breakpoints: sm 640, md 768, lg 1024, xl 1280.
- Colours: white `#fff`, dark `#191818`, dark-light `#232222`, cream `#e8e6e3`, cream-light `#f9f6f8`, pink `#ff2c6b`, light-pink `#ffbfd2`, gray-300 `#d1d5dc`, tag pill `#DEDCD9`.
- Fonts: `Zagma` (F37 Zagma Serif Book + Book Italic) for body/headings, `NeueHaas` (Neue Haas Grotesk Text RoundDots 65 Medium) for labels/buttons/nav. Base rule `p, ul, ol { font-size: 1.6rem; line-height: 140%; letter-spacing: -.032rem }`.
- Type scale (`type-z-*` serif / `type-s-*` sans): z-18 18/110%/-.054rem, z-20 20/120%, z-24 24/125%/-.072rem, z-28 28/90%, z-34 34/90%/-.102rem, z-40 40/110%/-.12rem, z-60 60/90%/-.18rem, z-72 72/85%/-.504rem, z-80 80/90%/-.32rem, z-200 200/85%/-1.4rem; s-10 10/140%/+.02rem, s-11, s-12 12/140%/+.024rem, s-14 14/160%, s-15 15/160%/+.015rem.
- Display headings: hero `7.2rem` → `md: min(14vw, 15rem)`, line-height 85%, tracking `min(-0.5vw,-0.6rem)` (150px / 127.5px / −9.6px at 1920). Section displays `5.5rem` → `md: max(9rem, min(9vw, 13rem))`, line-height 90% (130px at 1920, 129.6px at 1440, 90px at 768).
- Radii: `--rounded-unit: 1.2rem` (12px) for media, pills 50px, nav pill 12px outer / 11px inner. Section padding `--padding-y: 6rem` → `12rem` at ≥1024px.
- Content width `w-calc`: `min(123.4rem, 85.6944vw)` from 768px, `100vw − 8rem` below (1234px at 1920/1440, 658px at 768, 310px at 390). Gutter helper `px-calc` mirrors it.
- Easing: `--ease-snappy: cubic-bezier(.19,1,.22,1)`, `--ease-in-out-base: cubic-bezier(.25,.1,.25,1)`.

## 2. Page geometry (confirmed)

| Viewport | Document height | Hero (pinned) | Collage | Benefits | Technology | Cards | Safety | Partners | Insights | Careers | Footer |
| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |
| 1920×1080 | 12939 | 0–2700 (250vh, −75vh margin) | 1890–3510 | 3510–5670 | 5670–6750 | 6750–7639 | 7639–8719 | 8719–10078 | 10078–11017 | 11017–12339 | 12339–12939 |
| 1440×900 | 11244 | 0–2250 | 1575–2925 | 2925–4725 | 4725–5625 | 5625–6293 | 6293–7193 | 7193–8552 | 8552–9491 | 9491–10644 | 10644–11244 |
| 768×1024 | 12475 | 0–2560 | 1792–3328 | 3328–5376 | 5376–6400 | 6400–7856 | 7856–8880 | 8880–10185 | 10185–11025 | 11025–11752 | 11752–12475 |
| 390×844 | 9416 | 0–2110 | 1477–2743 | 2743–4060 | 4060–4904 | 4904–5646 | 5646–6490 | 6490–7503 | 7503–8224 | 8224–8762 | 8762–9416 |

The local build reproduces these heights exactly at 1920 (12939) and 390 (9463, the 47px delta is the mobile
benefits carousel description height).

Navigation pill: 338×55 at ≥640px, top 34px, centred; 1px `black/15` frame, white inner, logo 75×23, label 15px/160%
Neue Haas, menu button 36×36. With the 43px announcement strip visible the header is translated down 42px.
Below 640px the pill is `100vw − 2.4rem` wide at top 24px; when the menu is open it becomes full-width at top 0
with square corners and the panel fills `100svh − 10.1rem`.

Open menu (desktop): panel appears 10px under the pill, white with the same 1px frame, 24px padding, "Menu" label,
six rows of 50px (thumbnail 75×50 radius 8px + 34px serif label, current page in pink). Total header height 504px.

## 3. Motion inventory (confirmed values at 1920×1080; all scroll-mapped values are vh-relative)

| Element | Trigger | Property / curve |
| --- | --- | --- |
| Announcement strip | load | translateY −100% → 0 (~0.45s ease-out); header follows (translateY 0 → 42px) |
| Hero tagline | scroll | opacity 0→1 over [0.15vh, 0.30vh]; inner opacity 1→0 over [0.875vh, 1vh] |
| Scroll-down cue | scroll | opacity 1→0 over [0, 0.15vh]; appears ~1.5s after load |
| Hero headline lines | scroll (md+) | line 1 translateX 0→+50px, line 2 0→−50px while the headline bottom travels from `vh/2 + line-height` to the viewport top (start 292.5px, end 960px at 1920) |
| Hero headline words | load | per word: translateX 20→0 + opacity 0→1, ~0.42s, 85ms stagger |
| Hero video clip | scroll | over [1vh, 1.5vh]: `clip-path: inset()` to a centred square (`(vw−vh)/2` per side) with `cubic-bezier(.19,1,.22,1)`; scale 1 → tile/vh (0.164 at 1920) with CSS `ease`; radius = 16px / scale; dark overlay (35%) fades 1→0 over [1.175vh, 1.5vh] |
| Collage outer columns | scroll | translateY +600px → −600px while the section travels from "top at viewport bottom" to "bottom at viewport top" |
| Collage copy | scroll (md+) | translateY −200 → +200px over [sectionTop − 0.25vh, sectionBottom − vh] |
| Collage paragraph words | scroll + time | opacity 0.1→1, target count follows scroll over [1.17vh, 1.44vh], catching up one word per ~100ms; never reverses |
| Benefits feature image | scroll (md+) | flies from the hidden collage tile (16.667% column) to its resting square over [sectionTop − 0.75vh, sectionTop]; easeInOutCubic on translate + scale (0.336 → 1), radius 16px/scale |
| Benefits activation | scroll | at sectionTop + 0.25vh the image shrinks (scale 0.6, fade, ~0.45s) and video 1 slides up (spring k≈120 c≈22, settles ~1s). Reversible. |
| Benefits states | click | deck: active video translateY 0 / scale 1; previous −3vh·n, scale 1−0.05n; upcoming +100vh, scale 1+0.05n; inactive dim 50% black; titles 1 / 0.46 opacity; description height 0→auto (~0.45s) |
| Benefits stage | scroll | translateY 0→−50px + scale 1→0.9 over [+0.5vh, +1vh]; opacity 1→0 over [+1.5vh, +2vh] |
| Benefits (mobile) | time | auto-advance every 5s, linear progress bar, arrows, description cross-fade |
| Technology / safety images | scroll | translateY −12% → +12% across the section's traverse |
| Technology cards | viewport entry (top < ~0.7vh) | clip-path inset(0 0 100% 0 round 12px) → inset(0 round 12px), ~0.65s, 150ms stagger; hover: media scale 1.2 (0.5s snappy), arrow turns pink |
| Section headings | viewport entry | word slide/fade as above |
| Partner image / card | viewport entry | translateY 200px / 400px → 0 with an over-damped spring (k 100, c 26, settles ~1.2s) |
| Partner tabs | time / click | auto-advance every ~13.4s with a circular progress stroke; image cross-fade, quote words fade in, author slides 10px |
| Partner image | scroll | translateY −12% → +12% at scale 1.1 across the partners section |
| Insights cards | viewport entry | translateY 200·(i+1) px → 0, same spring, all cards start together |
| Insights carousel | click / drag | snap scroll, one card per arrow press; hover: image scale 1.1, title and tags turn pink |
| Careers stage | time | every 2s: smallest tile exits (translateX 20px, scale 0.5, fade), tiles shift one slot left, next pool image enters from the right (~0.6s) |
| Footer panel | scroll | translateY −200px → 0 while the footer enters; content fades in over the last quarter |
| Footer background | load / mouse | `Waabi_System_LightTunnel_1.mp4` (object-fit: fill) plays underneath. A 2D canvas (hidden until the first `mousemove`) then draws the "layered" tunnel: 250 concentric rectangles from 4.5w × 4.2h shrinking 1% per layer; the outermost is centred on the smoothed pointer (window-relative, lerp 0.15/frame), the innermost on the footer centre; colours `#FCB3F7 → #FF2C6B → #80031C → #977E75` flow along the layers at 0.007 cycles/frame (span 5.5 cycles). Drawn only while the footer is in view. On touch devices the video stays visible. Locally each layer is painted as the visible ring between it and the next layer (four device-pixel-snapped `fillRect` bands) instead of 250 canvas-sized fills: same pixels, roughly 12× cheaper on software-rendered canvases (71 ms → 6 ms per frame at 3840×1200). |
| Page navigation | click | cross-document View Transition (`@view-transition { navigation: auto }`), header keeps its own `view-transition-name` |

Videos: all `autoplay playsinline loop muted`; each sits in a wrapper that fades from 0 to 1 once the video is ready. Locally a video is buffered when it comes within 120% of the viewport but only plays while within 40% of it and not parked off-stage (benefits deck layers waiting at +100vh), and every scroll-mapped layer (`[data-parallax]`, collage columns, benefits stage/deck, hero clip) carries `will-change` so scroll frames never repaint full-viewport media; a wheel-scroll trace through the technology section went from 119/289 frames over 25 ms (GPU process busy 6.8 s of 9 s) to 1.7 s of 4.3 s with 3 videos decoding (full table in the README's Performance notes).

## 4. Secondary pages (confirmed structure)

- **/safety**: dark parallax hero ("Redefining safety."); "The stakes are real and rising." with three stat rows
  (39,345 / 5,472 / 87%, type-z-200); cream "Safety is core to our DNA." scrolly-telling block (sticky counter 01/3,
  three steps at 1 / 0.15 opacity, sticky media square 525×600 cross-fading images, pink progress line);
  "Technology designed to protect." hover accordion (active card flex-grow, inactive 15.7%); full-screen
  "Safety-first best practices." snap slider (4 slides, counter, arrows); Insights carousel.
- **/research**: dark theme; headline + intro; six topic pills; spotlight (TriO) with overlapping dark card;
  "Featured" carousel (917/516 cards); "Publications" list with pink hover rows.
- **/company**: hero ("We built our own road."); intro; founder quote over portrait with gradients; "The people
  moving us forward." two-image stack; investors marquee (15 logos on dark-light tiles); "The latest from Waabi."
  carousel; "Our locations." map with five pins.
- **/careers**: hero ("Find your place in Physical AI."); intro + Lever link; cream mission image; "Waabi voices."
  slider (9 quotes, progress bar, counter, image pair cycling through 4 photos); values carousel (8 items);
  "Fuel your career's next mile." with the cycling image stage.
- **/insights**: full-screen featured slider (5 articles, progress dots); "All articles" grid (6 newest) with tag
  filters (Technology / Company news / Research); "Press" horizontal carousel (20 items); closing media block;
  a second grid with the next 6 articles. The four oldest articles are only reachable through the homepage cards and
  partner CTAs, exactly as on the reference.
- **/insights/{slug}**: tags + date + title + intro, author aside, 810px body column (prose, blockquotes, media,
  inline video player), careers call-out, share menu (copy link / X / LinkedIn).

## 5. Unresolved / not verified

- Partner tab auto-advance period was measured from the circular progress (≈13.4s); the exact timing constant was not readable.
- Research publication detail pages (`/research/{slug}`) are not rebuilt; publication links point at the live site.
- The "Press" page (`/press`) is not rebuilt; its link points at the live site.
- The HubSpot "Get in touch" form stays external (no form submissions are sent anywhere).
- Hover/pointer behaviour was verified with synthetic events in Chromium; touch gestures on real devices were not tested.
- Article body videos stream from `static.ext.waabi.ai` (not mirrored locally).
- Tailwind's `group-hover` utilities are wrapped in `@media (hover: hover)`, so hover zooms do not run on touch-only devices (same as the reference build).
- Animated research teaser GIFs were replaced by poster frames (see the asset manifest).
