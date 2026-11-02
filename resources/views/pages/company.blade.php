@php($c = require resource_path('content/company.php'))
<x-layouts.app :pageLabel="$pageLabel" title="Company | NeuroSky">
    <div class="flex flex-col gap-(--padding-y) md:pb-40">
        <x-page-hero :heading="$c['hero']['heading']" :image="$c['hero']['image']" />

        <section class="relative w-full overflow-clip bg-white py-50 md:py-40">
            <div class="w-calc flex flex-col gap-48 md:max-w-760">
                <p class="type-z-24 md:type-z-40" data-reveal-words data-reveal-fade>
                    <x-words :text="$c['intro']" :pre="true" /><br><br><br>
                </p>
            </div>
        </section>

        {{-- Founder quote --}}
        <section class="relative w-full text-white md:px-24" data-parallax-root>
            <div class="relative flex aspect-[9/16] w-full items-end overflow-clip bg-current/20 p-40 md:aspect-[1.6] md:items-start md:rounded-[2rem] md:p-0">
                <div class="absolute inset-0 overflow-clip" data-parallax style="transform:translateY(-12%)">
                    <img class="absolute inset-0 size-full object-cover" src="{{ asset('media/images/'.$c['quote']['image']) }}" alt="{{ $c['quote']['author'] }}" loading="lazy" decoding="async">
                </div>
                <div class="absolute inset-0 bg-gradient-to-l from-transparent to-black/36"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-black/36 via-black/18 to-transparent"></div>
                <div class="relative flex flex-col gap-24 md:top-2/12 md:left-12/18 md:max-w-370 md:gap-36">
                    <p class="type-z-24">{{ $c['quote']['text'] }}</p>
                    <div class="flex flex-col">
                        <span class="type-s-15 text-current">{{ $c['quote']['author'] }}</span>
                        <span class="type-s-15 text-current/60">{{ $c['quote']['role'] }}</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- People --}}
        <section class="w-calc flex flex-col gap-60 py-[calc(var(--padding-y)+4rem)] md:flex-row md:items-center md:justify-between">
            <div class="flex w-full items-center justify-center md:order-2 lg:justify-start">
                <div class="relative w-full max-w-685 overflow-clip">
                    <div class="relative flex h-302 w-full items-center overflow-clip md:h-700">
                        <div class="absolute left-0 z-4 aspect-[320/427] w-[46.71%]" data-reveal-up="200" style="transform:translateY(200px)">
                            <div class="size-full overflow-clip bg-gray-300 rounded-[12px]"><img class="size-full object-cover" src="{{ asset('media/images/'.$c['people']['images'][0]) }}" alt="" loading="lazy" decoding="async"></div>
                        </div>
                        <div class="absolute right-0 z-5 aspect-[320/427] w-[70%] md:w-[76.64%]" data-reveal-up="400" style="transform:translateY(400px)">
                            <div class="size-full overflow-clip bg-gray-300 rounded-[12px]"><img class="size-full object-cover" src="{{ asset('media/images/'.$c['people']['images'][1]) }}" alt="" loading="lazy" decoding="async"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-full max-w-330 flex-col gap-23 md:order-1 md:gap-48 lg:max-w-448">
                <div class="flex flex-col gap-23 md:gap-32">
                    <p class="type-z-34 md:type-z-80" data-reveal-words data-reveal-slide><x-words :text="$c['people']['heading']" /></p>
                    <div class="w-full max-w-[90%]">
                        <p class="type-s-14 md:type-z-24 text-balance text-current/60">{{ $c['people']['body'] }}</p>
                    </div>
                </div>
                <div class="flex"><div><x-pill-link :href="route($c['people']['cta']['route'])" :label="$c['people']['cta']['label']" /></div></div>
            </div>
        </section>

        {{-- Investors marquee --}}
        <section class="bg-cream-light relative w-full overflow-clip py-[var(--padding-y)]">
            <div class="flex flex-col items-center justify-center gap-60 md:gap-96">
                <div class="flex max-w-290 flex-col items-center gap-24 text-center md:max-w-670 md:gap-48">
                    <span class="type-z-34 md:type-z-80" data-reveal-words data-reveal-slide><x-words :text="$c['investors']['heading']" /></span>
                    <p class="type-z-18 md:type-z-24 text-current/50">{{ $c['investors']['body'] }}</p>
                </div>
                <div class="marquee flex w-full flex-nowrap" aria-label="Investors">
                    @for ($copy = 0; $copy < 3; $copy++)
                        <div class="marquee__track flex w-fit shrink-0 flex-nowrap gap-24 px-12 md:gap-48 md:px-24" @if($copy > 0) aria-hidden="true" @endif>
                            @foreach ($c['investors']['logos'] as $logo)
                                <div class="flex-center bg-dark-light h-120 w-175 shrink-0 rounded-[1.2rem] md:h-215 md:w-315">
                                    <div class="flex-center relative h-65 w-auto max-w-150 md:h-90 md:max-w-200 [&>img]:h-full [&>img]:w-auto [&>img]:max-w-full">
                                        <img src="{{ asset('media/images/'.$logo['file']) }}" alt="{{ $logo['alt'] }}" loading="lazy" decoding="async">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <x-insights-carousel :articles="$articles" :heading="$c['insights']['heading']" :body="$c['insights']['body']" background="bg-white" :padded="false" />

        {{-- Locations --}}
        <section class="relative w-full md:px-24">
            <div class="bg-cream-light relative flex aspect-[375/620] max-h-svh w-full items-start overflow-clip p-40 md:aspect-[1392/1000] md:rounded-[2rem]">
                <div class="bg-dark absolute inset-0 text-white">
                    @php($loc = $c['locations'])
                    <div class="absolute bottom-[4%] left-1/2 w-[76%] -translate-x-1/2 md:top-[27%] md:bottom-[2.5%] md:left-[62%] md:w-auto" style="aspect-ratio:{{ $loc['width'] }}/{{ $loc['height'] }}" data-locations-map>
                        <div class="grid size-full">
                            <img src="{{ asset('media/images/'.$loc['map']) }}" alt="{{ $loc['map_alt'] }}" class="area size-full" width="{{ $loc['width'] }}" height="{{ $loc['height'] }}" loading="lazy" decoding="async">
                            <svg class="area size-full overflow-visible" viewBox="0 0 {{ $loc['width'] }} {{ $loc['height'] }}" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                @foreach ($loc['routes'] as $route)
                                    <path d="{{ $route }}" stroke="var(--color-pink)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" data-route opacity="0"/>
                                @endforeach
                            </svg>
                        </div>
                        @foreach ($loc['pins'] as $pin)
                            <button type="button" class="map-pin bg-pink absolute z-3 size-12 -translate-x-1/2 -translate-y-1/2" style="left:{{ $pin['left'] }}%;top:{{ $pin['top'] }}%" aria-label="{{ $pin['name'] }}" title="{{ $pin['name'] }}"><span class="map-pin__label type-s-11">{{ $pin['name'] }}</span></button>
                        @endforeach
                    </div>
                </div>
                <div class="w-calc relative z-2 pt-40 text-white md:pt-50">
                    <div class="w-calc flex gap-30 max-lg:flex-col md:gap-48 xl:gap-240">
                        <div class="flex flex-col gap-y-48">
                            <div class="flex w-full text-balance">
                                <h2 class="type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide><x-words :lines="[$c['locations']['heading']]" /></h2>
                            </div>
                        </div>
                        <div class="max-lg:w-calc flex flex-col justify-end gap-30 lg:max-w-447 lg:gap-48 lg:pl-48">
                            <div class="type-z-18 md:type-z-24 whitespace-pre-line text-current/50">{{ $c['locations']['body'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
