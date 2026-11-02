# Asset manifest

All assets referenced by the site are stored locally under `public/`. Original source URLs are listed
so each file can be traced back to the reference (https://waabi.ai).

## Fonts (`resources/fonts/`, bundled by Vite)

| Local file | Original URL | Used by |
| --- | --- | --- |
| `F37ZagmaSerif-Book.woff2` | https://waabi.ai/_next/static/media/F37ZagmaSerif_Book-s.p.07ww.6n-k2vcw.woff2 | `--font-zagma` (all serif headings/body) |
| `F37ZagmaSerif-BookItalic.woff2` | https://waabi.ai/_next/static/media/F37ZagmaSerif_BookItalic-s.p.0.zzxoe5d~3ao.woff2 | italic serif |
| `NeueHaasGroteskText-RoundDots-65Medium.woff2` | https://waabi.ai/_next/static/media/NeueHaasGroteskText(RoundDots)_65Medium_Web-s.p.0nqb_m3xq-4gg.woff2 | `--font-neue` (labels, buttons, nav) |

The fallback `@font-face` metrics (`Zagma Fallback`, `NeueHaas Fallback`) are copied verbatim from the reference stylesheet.

## Videos (`public/media/videos/`)

All files were downloaded unchanged from `https://static.ext.waabi.ai/<file>`.

| File | Size | Component |
| --- | --- | --- |
| `NEUROSKY_27s_2K_antinomy_export_250823.mp4` | 16.9 MB | Homepage hero (≥768px) |
| `Hero_27Sec_responsive.mp4` | 8.3 MB | Homepage hero (<768px) |
| `Scenario_3_4k_FINAL.mp4`, `Sim_demo_scenario_4_slow_camera-SUDDEN_BRAKE_FINAL.mp4`, `Sim_construction_camera_slow_trimmed_w_actors_FINAL.mp4`, `Scenario_1_4k_FINAL.mp4` | 0.7–0.9 MB each | Collage tiles |
| `scene_1_v2_HD_FINAL.mp4`, `Scalable.mp4`, `scene_3_v5_HD_FINAL-small.mp4` | 5.5 / 29.5 / 8.0 MB | Benefits module (Safe / Scalable / Practical) |
| `intersection-trimmed.mp4`, `Crash_variant_1.mp4`, `Copy_of_Copy_of_Full_Video_-_Solution_Ready_Blog-VEED__1_.mp4` | 7.3 / 4.4 / 7.4 MB | Technology video cards |
| `NeuroSky_System_LightTunnel_1.mp4` | 1.1 MB | Footer background |
| `GenRe__1_.mp4`, `unisim_final_new_v2_1080p_compress_50m.mp4` | 0.2 / 48.7 MB | Research featured cards |

Article body videos (e.g. `Waabi_Video_1.mp4`) are **not** copied locally; article pages reference the original
`static.ext.waabi.ai` URLs.

## Images (`public/media/images/`)

Downloaded from DatoCMS (`https://www.datocms-assets.com/163962/<file>`) at `w=2400, q=82` (thumbnails at 1200/1600).
File names are the original DatoCMS names, so the source URL is `https://www.datocms-assets.com/163962/` + file name.

Key mappings:

| File | Component |
| --- | --- |
| `1760006286-kevin-wang-…`, `1761183718-neurosky_road1_01902.jpg`, `1761183902-neurosky_exterior_morning_00857.png`, `1761183903-neurosky_road2_04462.png`, `1761184004-251006_neurosky_val_fakhrutdinova_0214.jpg`, `1761183902-neurosky_road2_05483.png`, `1761183903-neurosky_scout_00826.png`, `1760006943-neurosky_scout_00286_final.jpg`, `1761184004-251006_neurosky_ashwin_kumar_0866.jpg`, `1761183902-neurosky_portrait_neiel_00646.png`, `1761184005-251006_neurosky_lunch_room_0489.jpg`, `1761183980-neurosky_inspection_02285.png`, `1761218404-neurosky_inspection_02344.jpg` | Homepage collage |
| `1761183902-neurosky_road2_05483.png` | Benefits feature image |
| `1756426717-neurosky_road1_00928.jpg` | Technology feature |
| `1761185044-neurosky_road2_05683.jpg` | Safety feature |
| `1761262941-fya_one-1.jpg`, `1769592036-logo-partner.png`, `1756426717-neurosky_road2_04115.jpg`, `1761186315-nvidia-neurosky_logos_2x_final.png` | Partner tabs (Volvo / Uber / Uber Freight / NVIDIA) |
| `1760431072-volvo-logo.svg`, `1769597315-investor-logos-11.svg`, `1761945971-investor-logos-9.svg`, `1760431057-nvidia-logo.svg` | Partner logos |
| `1760350326-neurosky_portrait_felicia_00336_final.jpg`, `1760350326-neurosky_scout_00761_final.jpg`, `1761184004-251006_neurosky_collab_05_1012_a.jpg`, `1760350326-neurosky_inspection_02613_final.jpg`, `1761184004-251006_neurosky_melinda_lu_0814.jpg`, `1760350326-neurosky_washstation_03082_final.jpg` | Homepage careers stage (cycling pool) |
| `1761183902-neurosky_road2_05483.png`, `1761183903-neurosky_scout_00376.png`, `1761218483-neurosky_research_lighttunnel_wip.jpg`, `1761185043-neurosky_scout_00739.jpg`, `1761187390-251006_neurosky_collab_03_0781.jpg`, `1761183903-neurosky_road2_04225.png` | Navigation thumbnails |
| `articles/*` | Insight article bodies, thumbnails and featured slides |
| `press/*` | Insights "Press" logo grid |
| `1761183960-neurosky_portrait_raquel_02880.jpg` | Company founder quote |
| `map.svg` | Company "Our locations" (original: https://waabi.ai/images/company/map.svg) |
| `favicon-32x32.png` | Favicon (resized, see Derived assets) |

### Substitutions

| Original | Local replacement | Reason |
| --- | --- | --- |
| `1756660745-gif-header-veed-2.gif` (22 MB animated) | `…-poster.jpg` (first frame) | Size; used in the insights closing media block |
| `1787930834-trio_website_grid_trim9_1080_cropped.gif` (90 MB), `1756736628-lottie-smith-s-video-sep-1-2025-veed.gif` (123 MB), `1764618484-teaser-1.gif` (147 MB), `1779408789-qualitative_results.gif` (17 MB), `1756482397-scene-veed.gif` (31 MB), `1790367775-copy-of-vqtraj_code_sweep_teaser.gif` | `…-poster.jpg` first frames | Research teasers are animated GIFs far too heavy for a local repo |

## Inline SVGs (`resources/views/components/icons/`)

Logo (75×23), large footer logo (526×140), menu bars, scroll-down arrow, prev/next arrows, partner progress circle,
LinkedIn / YouTube / X icons, banner arrow and close glyph — extracted verbatim from the reference DOM.

## Derived assets

- `public/media/videos/Scalable-1080.mp4` — 1080×1080 H.264 re-encode (ffmpeg, libx264 crf 22, no audio) of the 2160×2160 `Scalable.mp4` master. Served to every device except hi-dpi desktops (`(min-resolution: 1.5dppx) and (min-width: 64rem)`), where the extra pixels are visible; a 4K decode was a scroll-jank source on machines without hardware decoding.
- `public/media/images/favicon-32x32.png` (32×32 PNG) and `apple-touch-icon.png` (180×180) — resized from the reference favicon, which is a 2400×2400 JPEG that the live site serves through its image CDN at 32px. Served raw, it cost a 45–200 ms main-thread decode on every page load and stalled the page-change transition.
- `public/media/images/map-india.svg` — India state map (36 states/UTs, official outline incl. Jammu & Kashmir and Ladakh) generated from the DataMeet community dataset (`datameet/maps`, `website/docs/data/geojson/states.geojson`, open licence), equirectangular projection scaled by cos 22°, Douglas–Peucker simplified, styled like the reference map (`#232222` fill, `#191818` borders). City pins and highway-style routes in `resources/content/company.php` are projected with the same transform.
- `public/media/images/favicon.svg`, `favicon-32x32.png`, `apple-touch-icon.png` — NeuroSky "n" icon outlined from the Neue Haas font (replaces the Waabi favicon).

## NeuroSky profile content (November 2026)

Page copy and images now come from three NeuroSky documents supplied by the client
(`Neuro Sky/Profile/`): the company profile (`neuroskyProfile (1).pdf`), the investor deck
(`NEURO SKY TECHNOLOGY PRIVATE LIMITED (2).pdf`) and the Next Fleet brochure (`Next Fleet.pdf`).
Images were extracted from the PDFs, resized to at most 2200px and saved as progressive JPEGs
in `public/media/images/profile/`.

| File | Source |
| --- | --- |
| dashboard.jpg, cab-dashboard.jpg, driver-tablet.jpg, truck-rear-lcd.jpg, truck-drone.jpg, warehouse-agv.jpg, rnd-lab.jpg, abstract-stage.jpg, abstract-orbs.jpg | Company profile, pages 2–11 |
| team-engineering.jpg | Investor deck, cover |
| truck-network.jpg, air-cargo.jpg, warehouse-interface.jpg, warehouse-conveyor.jpg, warehouse-floor.jpg, containers.jpg, warehouse-operator.jpg, warehouse-supervisor.jpg | Next Fleet brochure |
| press/neurosky-profile-logo.png | Company profile logo, padded for the updates cards |
| module-*.svg | Platform module names outlined in Neue Haas Grotesk (company marquee) |
| icon-*.svg | Hand-drawn line icons for the five target audiences (home carousel) |

The truck-rear-lcd, truck-drone and warehouse-agv photos are only 640–730px wide in the source PDF,
so they are used in small slots where possible. The Waabi films that showed Waabi-branded trucks
(hero, benefits, technology cards, collage) were replaced by these stills; only the abstract footer
light-tunnel film is still in use.

### Home hero film

`NeuroSky_Hero_HUD.mp4` (1920×1080) and `NeuroSky_Hero_HUD_mobile.mp4` (720×1280 centre crop) are
re-encoded (H.264, no audio, fast start) from the 1440p stream of
https://www.youtube.com/watch?v=NAmtBnzKxO4 ("Red HUD animation clear intuitive display", channel
ganzschnell), downloaded at the client's request. `profile/hero-hud-poster*.jpg` are their first frames.

### Realistic photos from Unsplash (November 2026)

Illustrations, screenshots and AI-style renders from the PDFs were replaced with real photos from
Unsplash (Unsplash License: free for commercial use, no attribution required), resized to at most
2200px. Photo pages are `https://unsplash.com/photos/<id>`.

| File (profile/) | Unsplash id | Replaces |
| --- | --- | --- |
| team-laptops.jpg | QckxruozjRg | rnd-lab.jpg (illustration) |
| trucks-highway-aerial.jpg | lZZ_yiDelrA | truck-network.jpg (neon render) |
| port-containers.jpg | sWOvgOOFk1g | air-cargo.jpg (neon render) |
| warehouse-aisle-workers.jpg | c_4eaGRDSVU | warehouse-interface.jpg (HUD overlay) |
| warehouse-conveyor-team.jpg | 4nfPgBofTs4 | warehouse-conveyor.jpg (HUD overlay) |
| warehouse-automation.jpg | xoSw4kQMgbk | warehouse-agv.jpg (HUD overlay) |
| truck-driver-view.jpg | UhnzaVYaAQI | cab-dashboard.jpg (network overlay) |
| drone-flight.jpg | XYrjl3j7smo | truck-drone.jpg (AI-style render) |
| warehouse-aisle-team.jpg | ZlOlRnWk8zU | warehouse-operator.jpg (HUD glow) |
| truck-yard-aerial.jpg | GOD2mDNujuU | dashboard.jpg outside the Next Fleet article |
| truck-india-ghat.jpg | GFILd4oYT9M | new (collage centre, partner carousel) |
| truck-india-colorful.jpg | 82rfXKNSNOY | new (collage) |
| truck-india-driver.jpg | XyVLcjBstQs | new (collage) |
| truck-freight.jpg | EmEQ6kK_5P0 | new (collage) |
| warehouse-forklift.jpg | F2C_mSrb6iM | new (collage) |

The replaced PDF images stay in `profile/` but are no longer referenced; `dashboard.jpg` is still
shown inside the Next Fleet article as the real product screenshot.
