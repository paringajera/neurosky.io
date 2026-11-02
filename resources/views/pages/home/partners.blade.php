<section class="relative min-h-screen w-full overflow-clip bg-white py-[var(--padding-y)]" data-partners data-interval="{{ $partners['interval'] }}" data-parallax-root>
    <div class="flex flex-col items-center gap-48 md:gap-96">
        <div class="w-calc flex gap-30 max-lg:flex-col md:gap-48 xl:gap-240">
            <div class="flex flex-col gap-y-48">
                <div class="flex w-full text-balance">
                    <h2 class="type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide>
                        <x-words :lines="[$partners['heading']]" />
                    </h2>
                </div>
            </div>
            <div class="max-lg:w-calc flex flex-col justify-end gap-30 lg:max-w-447 lg:gap-48 lg:pl-48">
                <div class="type-z-18 md:type-z-24 whitespace-pre-line text-current/50">{{ $partners['body'] }}</div>
            </div>
        </div>

        <div class="w-calc relative flex flex-col items-center justify-between md:flex-row" style="--padding:2.4rem">
            <div class="relative aspect-square w-full overflow-clip rounded-t-[var(--rounded-unit)] bg-dark md:aspect-[unset] md:h-[80.7rem] md:w-10/12 md:rounded-[var(--rounded-unit)]" data-reveal-up="200">
                @foreach ($partners['items'] as $i => $item)
                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" data-partner-image="{{ $i }}" data-parallax data-parallax-scale="1.1" style="opacity:{{ $i === 0 ? 1 : 0 }};transform:translateY(-12%) scale(1.1)">
                        <img class="h-full w-full object-cover" src="{{ asset('media/images/'.$item['image']) }}" alt="{{ $item['name'] }}" loading="lazy" decoding="async">
                    </div>
                @endforeach
            </div>

            <div class="rounded-calc relative mt-[-2.8rem] flex w-full flex-col items-start justify-center gap-24 overflow-clip bg-dark p-28 text-white md:absolute md:right-0 md:mt-0 md:w-[44.7rem] md:gap-36 md:p-48" data-reveal-up="400">
                <div class="relative flex h-32 w-full items-center gap-24 border-b border-current/10 no-scrollbar overflow-x-auto" role="tablist" aria-label="Partners" data-carousel>
                    @foreach ($partners['items'] as $i => $item)
                        <button type="button" role="tab" id="partner-tab-{{ $i }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}" aria-controls="partner-panel-{{ $i }}" class="partner-tab relative h-33 shrink-0 items-center border-b-2 px-10 transition-colors duration-500 {{ $i === 0 ? 'border-pink text-current' : 'border-transparent text-current/25' }}" data-partner-tab="{{ $i }}">
                            <span class="type-s-14 md:type-s-15">{{ $item['name'] }}</span>
                        </button>
                    @endforeach
                </div>
                <div class="relative flex flex-col md:gap-90">
                    <div class="relative flex w-full flex-col items-start justify-start gap-30 md:gap-34">
                        <div class="relative grid w-full shrink-0 grow basis-0">
                            @foreach ($partners['items'] as $i => $item)
                                <div class="area relative flex w-full flex-col items-start justify-between gap-24 md:justify-start" id="partner-panel-{{ $i }}" role="tabpanel" aria-labelledby="partner-tab-{{ $i }}" data-partner-panel="{{ $i }}" @if($i !== 0) hidden @endif>
                                    <div class="flex flex-col gap-24">
                                        <p class="type-h-18 md:type-z-24" data-reveal-words data-reveal-fade>
                                            <x-words :text="$item['quote']" :pre="true" />
                                        </p>
                                        <div class="relative flex flex-col" data-partner-author>
                                            <span class="type-s-11 md:type-s-12 block">{{ $item['author'] }}</span>
                                            <span class="type-s-11 md:type-s-12 block">{{ $item['role'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center justify-between self-stretch">
                        <div class="hidden md:flex">
                            <div class="flex-center relative h-80 w-80">
                                <x-icons.circle-progress />
                                <div class="flex-center absolute inset-0">
                                    @foreach ($partners['items'] as $i => $item)
                                        <div class="absolute transition-opacity duration-500" data-partner-logo="{{ $i }}" style="opacity:{{ $i === 0 ? 1 : 0 }}">
                                            <div class="flex-center relative w-40">
                                                <img src="{{ asset('media/images/'.$item['logo']) }}" alt="{{ $item['name'] }}-logo" width="40" loading="lazy" decoding="async">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="relative grid">
                            @foreach ($partners['items'] as $i => $item)
                                <div class="area transition-opacity duration-500" data-partner-cta="{{ $i }}" style="opacity:{{ $i === 0 ? 1 : 0 }}" @if($i !== 0) inert @endif>
                                    @if ($item['cta'])
                                        <x-pill-link :href="url($item['cta'])" label="See the details" />
                                    @else
                                        <span class="block h-36 md:h-48"></span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
