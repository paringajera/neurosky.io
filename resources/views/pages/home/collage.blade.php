<section class="bg-background relative w-full overflow-clip h-[150vh]" data-collage>
    <div class="absolute inset-0 origin-top">
        @foreach ($collage['columns'] as $column)
            <div class="absolute flex h-[150vh] flex-col justify-between will-change-transform {{ $column['class'] }}" @if($column['parallax']) data-collage-column style="transform:translateY(600px)" @endif>
                @foreach ($column['tiles'] as $tile)
                    <div class="rounded-calc tile bg-cream relative overflow-clip {{ $tile['class'] ?? '' }}">
                        @if (isset($tile['video']))
                            <div class="absolute inset-0 size-full">
                                <div class="absolute inset-0" data-video-fade>
                                    <video class="size-full object-cover" autoplay playsinline loop muted preload="none" data-video-lazy data-src="{{ asset('media/videos/'.$tile['video']) }}"></video>
                                </div>
                            </div>
                        @else
                            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('media/images/'.$tile['image']) }}" alt="" loading="lazy" decoding="async">
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="flex-center absolute inset-0 flex-col">
        <div class="flex-center relative">
            <div class="relative flex max-w-295 flex-col items-center justify-center gap-18 text-center md:max-w-full" data-collage-text style="transform:translateY(-200px)">
                <div class="absolute aspect-square w-full rounded-full" aria-hidden="true">
                    <div class="absolute size-full rounded-full bg-white blur-2xl"></div>
                </div>
                <p class="type-z-18 md:type-z-24 relative text-black/50">{{ $collage['eyebrow'] }}</p>
                <p class="type-z-18 md:type-z-24 text-dark relative max-w-558 overflow-clip" data-collage-words>
                    <x-words :text="$collage['body']" :pre="true" />
                </p>
            </div>
        </div>
        <div class="rounded-calc tile bg-cream relative overflow-clip max-md:translate-y-[20svh] md:top-400">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('media/images/'.$collage['center_tile']) }}" alt="" loading="lazy" decoding="async">
        </div>
    </div>
</section>
