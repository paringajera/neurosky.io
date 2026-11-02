<section class="text-background relative z-50 mb-[-75vh] h-[250vh] w-full" data-hero>
    <div class="relative h-full w-full">
        <div class="sticky top-0 left-0 h-svh w-full">
            <div class="absolute top-0 left-0 h-dvh w-full">
                <div class="absolute inset-0 will-change-transform" data-hero-clip>
                    <div>
                        <div class="absolute inset-0 size-full">
                            @if (! empty($hero['image']))
                                {{-- poster: the film's first frame, shown until the video starts (or instead of it) --}}
                                <picture class="absolute inset-0 {{ empty($hero['video']) ? 'hero-drift' : '' }}">
                                    @if (! empty($hero['image_mobile']))
                                        <source srcset="{{ asset('media/images/'.$hero['image_mobile']) }}" media="(max-width: 767px)">
                                    @endif
                                    <img class="size-full object-cover" src="{{ asset('media/images/'.$hero['image']) }}" alt="" fetchpriority="high" decoding="async">
                                </picture>
                            @endif
                            @if (! empty($hero['video']))
                                <div class="absolute inset-0" data-video-fade>
                                    <video class="size-full object-cover" autoplay playsinline loop muted preload="none" data-video-lazy>
                                        <source data-src="{{ asset('media/videos/'.$hero['video']) }}" media="(min-width: 768px)" type="video/mp4">
                                        <source data-src="{{ asset('media/videos/'.($hero['video_mobile'] ?? $hero['video'])) }}" type="video/mp4">
                                    </video>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-black/35" data-hero-overlay></div>
                </div>
            </div>
            <div class="px-calc absolute top-0 flex h-svh w-full items-end justify-start pb-40 md:pb-90" data-hero-tagline style="opacity:0">
                <div class="relative flex flex-col gap-y-24" data-hero-tagline-inner>
                    <p class="type-z-24 md:type-z-40 max-w-295 text-balance md:max-w-495" data-reveal-words data-reveal-onload>
                        <x-words :text="$hero['tagline']" :pre="true" />
                    </p>
                </div>
            </div>
        </div>
        <div class="w-calc pointer-events-auto relative mt-[-100lvh] mb-[100lvh] flex h-lvh items-end justify-start py-[var(--padding-y)]">
            <div class="flex w-full pointer-events-auto">
                <h1 class="type-display-hero text-balance" data-hero-title data-reveal-words data-reveal-slide data-reveal-onload>
                    <x-words :lines="$hero['lines']" />
                </h1>
            </div>
            <div class="relative flex" data-hero-cue>
                <div class="pointer-events-auto flex w-full items-center justify-end" data-hero-cue-inner style="opacity:0">
                    <button type="button" class="flex-center bg-pink h-24 w-24 cursor-pointer rounded-full" aria-label="Scroll Down" data-scroll-down>
                        <x-icons.scroll-down />
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="rounded-calc tile absolute bottom-0 left-1/2 z-500 -translate-x-1/2" aria-hidden="true"></div>
</section>
