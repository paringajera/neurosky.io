<section class="flex w-full gap-24 p-24 max-lg:flex-col">
    @foreach ($cards as $i => $card)
        <div class="group flex-center aspect-[351/221] w-full overflow-clip rounded-[1.2rem] lg:aspect-[448/620]" data-reveal-clip style="--i:{{ $i }};clip-path:inset(0% 0% 100% 0% round 12px)">
            <a class="group/arrow group relative flex h-full w-full flex-col justify-end bg-black" href="{{ url($card['href']) }}" aria-label="Link to {{ $card['href'] }}">
                <div class="ease-snappy absolute inset-0 h-full w-full object-cover opacity-80 transition-transform duration-500 group-hover:scale-120">
                    <div class="absolute inset-0 size-full">
                        @if (! empty($card['image']))
                            <img class="size-full object-cover" src="{{ asset('media/images/'.$card['image']) }}" alt="{{ $card['title'] }}" loading="lazy" decoding="async">
                        @else
                            <div class="absolute inset-0" data-video-fade>
                                <video class="size-full object-cover" autoplay playsinline loop muted preload="none" data-video-lazy data-src="{{ asset('media/videos/'.$card['video']) }}"></video>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="relative z-2 px-28 pb-24 text-white md:px-48 md:pb-36">
                    <div class="relative flex flex-col gap-4 md:gap-8">
                        <p class="type-s-11 md:type-s-12">{{ $card['eyebrow'] }}</p>
                        <h2 class="type-z-24 md:type-z-40 text-balance md:pr-50">{{ $card['title'] }}</h2>
                        <span class="btn-arrow group-hover/arrow:bg-pink group-hover/arrow:border-transparent absolute right-0 bottom-0" aria-hidden="true">
                            <x-icons.arrow-right />
                        </span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</section>
