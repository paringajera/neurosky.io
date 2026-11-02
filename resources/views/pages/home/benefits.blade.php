<section class="bg-background text-foreground relative w-full max-md:py-(--padding-y) md:h-[200vh]" data-benefits data-interval="5000">
    {{-- Origin marker: the position the feature image flies in from (the hidden collage tile). --}}
    <div class="rounded-calc tile absolute -top-133 -left-110 md:-top-[calc(133/1440*100vw)] md:left-[calc(16.667%)]" data-benefits-origin aria-hidden="true"></div>

    <div class="w-calc relative md:h-full md:px-90">
        <div class="flex w-full gap-40 max-md:flex-col md:h-full md:justify-between">
            <div class="relative flex flex-1 flex-col md:h-full md:max-w-527">
                <div class="md:sticky md:top-0 md:flex md:h-screen md:items-center">
                    <div class="rounded-calc absolute aspect-square w-full overflow-clip" aria-hidden="true"></div>
                    <div class="relative w-full" data-benefits-stage>
                        <div class="flex-center relative size-full" data-benefits-image-wrap>
                            <div class="rounded-calc relative aspect-square w-full overflow-clip" data-benefits-image style="transform-origin:center center">
                                <img class="h-full w-full object-cover" src="{{ asset('media/images/'.$benefits['image']) }}" alt="{{ $benefits['heading'] }}" loading="lazy" decoding="async">
                                <div class="absolute inset-0 bg-black/50" data-benefits-dim style="opacity:0"></div>
                            </div>
                        </div>
                        @foreach ($benefits['items'] as $i => $item)
                            <div class="rounded-calc absolute inset-0 overflow-clip max-md:hidden" data-benefits-video="{{ $i }}" style="z-index:{{ $i + 2 }};transform:translateY(100vh) scale({{ 1 + $i * 0.05 }})">
                                <div class="h-full w-full object-cover">
                                    <div class="absolute inset-0 size-full">
                                        @if (! empty($item['image']))
                                            <img class="size-full object-cover" src="{{ asset('media/images/'.$item['image']) }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                                        @else
                                        <div class="absolute inset-0" data-video-fade>
                                            <video class="size-full object-cover" autoplay playsinline loop muted preload="none" data-video-lazy data-src="{{ asset('media/videos/'.$item['video']) }}">
                                                @isset($item['video_sd'])
                                                    {{-- full-resolution master only where the extra pixels are visible (hi-dpi desktops) --}}
                                                    <source data-src="{{ asset('media/videos/'.$item['video']) }}" media="(min-resolution: 1.5dppx) and (min-width: 64rem)">
                                                    <source data-src="{{ asset('media/videos/'.$item['video_sd']) }}">
                                                @endisset
                                            </video>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-black/50 transition-opacity duration-500" data-benefits-video-dim></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="relative flex flex-1 flex-col md:h-[200vh] md:max-w-370">
                <div class="md:flex md:h-screen md:flex-wrap md:items-center">
                    <div class="flex w-full flex-col gap-20 md:gap-24">
                        <div class="flex w-full justify-center">
                            <h2 class="w-calc type-z-28 md:type-z-60 text-balance" data-reveal-words data-reveal-slide>
                                <x-words :lines="[$benefits['heading']]" wrapClass="flex flex-col md:max-w-[max(60%,91.8rem)]" />
                            </h2>
                        </div>
                        <p class="text-s-14 md:text-s-15 text-pretty text-black/55">{{ $benefits['body'] }}</p>
                    </div>
                </div>
                <div class="sticky top-0 hidden md:flex md:h-screen md:flex-col md:items-start md:justify-center md:gap-20 pointer-events-none -mt-[50svh]" data-benefits-list>
                    @foreach ($benefits['items'] as $i => $item)
                        <div class="benefit-item pointer-events-auto flex w-full cursor-pointer flex-col gap-20 max-md:hidden" data-benefit-item="{{ $i }}" role="button" tabindex="0" aria-pressed="false" style="opacity:0.3">
                            <p class="type-z-24 md:type-z-40">{{ $item['title'] }}</p>
                            <div class="overflow-hidden" data-benefit-desc style="height:0;opacity:0;{{ $i === 0 ? '' : 'display:none' }}">
                                <p class="text-s-14 md:text-s-15 text-pretty text-black/55">{{ $item['body'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile carousel --}}
    <div class="w-full py-(--padding-y) md:hidden" data-benefits-mobile>
        <div class="w-calc flex flex-col gap-40">
            <div class="rounded-calc relative aspect-square overflow-clip" data-benefits-mobile-stage>
                @foreach ($benefits['items'] as $i => $item)
                    <div class="absolute inset-0 overflow-clip" data-benefits-mobile-video="{{ $i }}" style="z-index:{{ $i + 1 }};transform:{{ $i === 0 ? 'none' : 'translateY(100%) scale('.(1 + $i * 0.05).')' }}">
                        <div class="absolute inset-0 size-full">
                            @if (! empty($item['image']))
                                <img class="size-full object-cover" src="{{ asset('media/images/'.$item['image']) }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                            @else
                            <div class="absolute inset-0" data-video-fade>
                                <video class="size-full object-cover" autoplay playsinline loop muted preload="none" data-video-lazy data-src="{{ asset('media/videos/'.$item['video']) }}">
                                                @isset($item['video_sd'])
                                                    {{-- full-resolution master only where the extra pixels are visible (hi-dpi desktops) --}}
                                                    <source data-src="{{ asset('media/videos/'.$item['video']) }}" media="(min-resolution: 1.5dppx) and (min-width: 64rem)">
                                                    <source data-src="{{ asset('media/videos/'.$item['video_sd']) }}">
                                                @endisset
                                            </video>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col gap-20">
                <p class="type-z-24" data-benefits-mobile-title aria-live="polite">{{ $benefits['items'][0]['title'] }}</p>
                <div class="grid">
                    @foreach ($benefits['items'] as $i => $item)
                        <p class="area text-s-14 text-pretty text-black/50 transition-opacity duration-500" data-benefits-mobile-desc="{{ $i }}" style="opacity:{{ $i === 0 ? 1 : 0 }}">{{ $item['body'] }}</p>
                    @endforeach
                </div>
                <div class="relative h-1 w-full overflow-clip bg-black/15">
                    <div class="bg-pink absolute bottom-0 left-0 h-2 w-full" data-benefits-mobile-bar style="transform:translateX(-100%)"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div class="flex gap-8">
                        <button type="button" class="btn-arrow hover:bg-pink hover:border-current/0 hover:text-white" aria-label="Previous" data-benefits-mobile-prev><x-icons.arrow-left /></button>
                        <button type="button" class="btn-arrow hover:bg-pink hover:border-current/0 hover:text-white" aria-label="Next" data-benefits-mobile-next><x-icons.arrow-right /></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
