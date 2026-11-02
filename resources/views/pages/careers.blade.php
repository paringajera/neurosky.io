@php($c = require resource_path('content/careers.php'))
<x-layouts.app :pageLabel="$pageLabel" title="Careers | NeuroSky">
    <div class="flex flex-col gap-(--padding-y) pb-40">
        <x-page-hero :heading="$c['hero']['heading']" :image="$c['hero']['image']" />

        <section class="relative w-full overflow-clip bg-white py-50 md:py-40">
            <div class="w-calc flex flex-col gap-48 md:max-w-760">
                <p class="type-z-24 md:type-z-40" data-reveal-words data-reveal-fade><x-words :text="$c['intro']" :pre="true" /></p>
                <div class="flex"><div><x-pill-link :href="$c['jobs_url']" label="Join the team" external /></div></div>
            </div>
        </section>

        {{-- Mission --}}
        <section class="bg-cream relative w-full py-[var(--padding-y)]">
            <div class="flex flex-col items-center justify-center gap-40 md:gap-96">
                <div class="relative flex w-full shrink-0 items-center justify-center px-12 md:w-[min(123.4rem,calc(1234/1440*100vw))] md:px-0" data-parallax-root>
                    <div class="relative h-[60rem] w-full shrink-0 overflow-clip rounded-[1.2rem] bg-black/20 md:h-[86rem] md:rounded-[2rem]">
                        <div class="absolute inset-0" data-parallax style="transform:translateY(-12%)">
                            <img class="size-full object-cover" src="{{ asset('media/images/'.$c['mission']['image']) }}" alt="" loading="lazy" decoding="async">
                        </div>
                    </div>
                </div>
                <div class="w-calc relative flex shrink-0 gap-24 max-md:flex-col md:items-start md:justify-between md:gap-40">
                    <div class="max-w-390">
                        <div class="flex w-full justify-center">
                            <h2 class="w-calc type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide><x-words :lines="[$c['mission']['heading']]" /></h2>
                        </div>
                    </div>
                    <div class="max-w-617">
                        <p class="type-z-18 md:type-z-24">{{ $c['mission']['body'] }}<br><br></p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Voices --}}
        <section class="relative w-full overflow-clip bg-white py-[calc(var(--padding-y)*0.5)]" data-voices>
            <div class="w-calc flex items-center gap-40 max-md:flex-col-reverse md:justify-between md:gap-100 lg:gap-179">
                <div class="flex w-full flex-col gap-28 md:w-370 md:gap-90">
                    <div class="max-md:hidden">
                        <div class="flex w-full text-balance">
                            <h2 class="type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide><x-words :lines="[$c['voices']['heading']]" /></h2>
                        </div>
                    </div>
                    <div class="relative flex flex-col gap-28 md:gap-24">
                        <div class="bg-foreground/15 grid h-px w-full overflow-clip">
                            <div class="bg-pink area h-full w-full origin-left transition-transform duration-500 ease-out" data-voices-bar style="transform:scaleX(0)"></div>
                        </div>
                        <div class="relative grid">
                            @foreach ($c['voices']['items'] as $i => $voice)
                                <div class="area voice flex flex-col gap-12 md:gap-24" data-voice="{{ $i }}" @if($i !== 0) hidden @endif>
                                    <p class="type-h-18 md:type-z-24" data-reveal-words data-reveal-fade data-reveal-manual><x-words :text="$voice['quote']" :pre="true" /></p>
                                    <div class="relative flex flex-col" data-partner-author>
                                        <span class="type-s-11 md:type-s-12 text-current/50">{{ $voice['name'] }}</span>
                                        <span class="type-s-11 md:type-s-12 text-current/50">{{ $voice['role'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <div class="relative flex items-end gap-12 overflow-clip pt-5">
                            <span class="type-z-60 leading-[0.65]" data-voices-counter>1</span>
                            <span class="type-s-12 text-current/50">/ {{ count($c['voices']['items']) }}</span>
                        </div>
                        <div class="flex gap-12">
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Previous" data-voices-prev><x-icons.arrow-left /></button>
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Next" data-voices-next><x-icons.arrow-right /></button>
                        </div>
                    </div>
                </div>
                <div class="relative w-full max-w-685 overflow-clip">
                    <div class="relative flex h-302 w-full items-center overflow-clip md:h-700" data-voices-stage>
                        <div class="voice-slot absolute left-0 z-4 aspect-[320/427] w-[46.71%]" data-voice-slot="0">
                            <div class="size-full overflow-clip bg-gray-300 rounded-[12px]"><img class="size-full object-cover" src="{{ asset('media/images/'.$c['voices']['images'][0]) }}" alt="" loading="lazy" decoding="async"></div>
                        </div>
                        <div class="voice-slot absolute right-0 z-5 aspect-[320/427] w-[70%] md:w-[76.64%]" data-voice-slot="1">
                            <div class="size-full overflow-clip bg-gray-300 rounded-[12px]"><img class="size-full object-cover" src="{{ asset('media/images/'.$c['voices']['images'][1]) }}" alt="" loading="lazy" decoding="async"></div>
                        </div>
                        <template data-voices-pool>
                            @foreach ($c['voices']['images'] as $image)
                                <img src="{{ asset('media/images/'.$image) }}" alt="" loading="lazy" decoding="async">
                            @endforeach
                        </template>
                    </div>
                </div>
                <div class="w-full md:hidden">
                    <div class="flex w-full justify-center">
                        <h2 class="w-calc type-z-34 md:type-z-80 text-balance">{{ $c['voices']['heading'] }}</h2>
                    </div>
                </div>
            </div>
        </section>

        {{-- Values --}}
        <section class="bg-cream-light relative flex w-full flex-col gap-60 overflow-clip py-[var(--padding-y)] md:gap-48" id="values" data-insights>
            <div class="w-calc flex flex-col gap-24 md:gap-48">
                <div class="flex items-end justify-between">
                    <div class="flex w-full text-balance md:max-w-700">
                        <h2 class="type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide><x-words :lines="[$c['values']['heading']]" /></h2>
                    </div>
                    <div class="flex items-center gap-8 md:hidden">
                        <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Previous" data-carousel-prev><x-icons.arrow-left /></button>
                        <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Next" data-carousel-next><x-icons.arrow-right /></button>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="md:max-w-525">
                        <p class="type-s-14 md:type-s-15 text-current/50">{{ $c['values']['body'] }}</p>
                    </div>
                    <div class="hidden items-center gap-8 md:flex md:gap-12">
                        <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Previous" data-carousel-prev><x-icons.arrow-left /></button>
                        <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Next" data-carousel-next><x-icons.arrow-right /></button>
                    </div>
                </div>
            </div>
            <div class="flex w-full flex-nowrap">
                <div class="px-calc flex snap-x snap-mandatory flex-nowrap gap-40 lg:gap-[calc(((min(123.4rem,1234/1440*100vw)-(21.5rem*4)))/3)]" data-carousel data-carousel-track>
                    @foreach ($c['values']['items'] as $i => $value)
                        <div class="flex w-245 shrink-0 snap-start flex-col gap-24 pb-24 md:w-215">
                            <div class="flex flex-col gap-12">
                                <div class="bg-pink flex-center size-28 rounded-full text-white"><span class="type-s-11 md:type-s-12">{{ sprintf('%02d', $i + 1) }}.</span></div>
                                <span class="type-z-24 md:type-z-40">{{ $value['title'] }}</span>
                            </div>
                            <p class="type-s-14 md:type-s-15 text-current/50">{{ $value['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Next mile --}}
        <section class="relative w-full overflow-clip bg-white py-[calc(var(--padding-y)*0.5)] lg:min-h-screen">
            <div class="flex flex-col gap-65 md:gap-96">
                <x-split-heading :heading="$c['next']['heading']" :body="$c['next']['body']" :cta="$c['next']['cta']" :ctaHref="$c['jobs_url']" :external="true" />
                <x-image-stage :images="$c['next']['images']" />
            </div>
        </section>
    </div>
</x-layouts.app>
