@php($c = require resource_path('content/safety.php'))
<x-layouts.app :pageLabel="$pageLabel" title="Safety | NeuroSky">
    <div class="flex flex-col gap-(--padding-y) pb-40 md:pb-120">
        <x-page-hero :heading="$c['hero']['heading']" :image="$c['hero']['image']" />

        {{-- The stakes --}}
        <section class="relative flex w-full flex-col gap-[var(--padding-y)] overflow-clip bg-white">
            <x-split-heading :heading="$c['stakes']['heading']" :body="$c['stakes']['body']" />
            <div class="w-calc">
                <div class="flex w-full flex-col">
                    @foreach ($c['stakes']['stats'] as $i => $stat)
                        <div class="relative flex w-full flex-col gap-20 border-t border-black/15 pt-20 md:flex-row md:items-start md:justify-between md:gap-0 md:pt-40 {{ $loop->last ? 'pb-15 md:pb-0' : 'pb-15 md:pb-30' }}" data-reveal-up="{{ ($i + 1) * 200 }}" style="transform:translateY({{ ($i + 1) * 200 }}px)">
                            <div class="md:flex-1">
                                <div class="type-s-14 text-balance text-black/50 md:max-w-200">{{ $stat['label'] }}</div>
                            </div>
                            <div class="md:flex-1 md:text-right">
                                <div class="type-z-72 md:type-z-200 text-[#191818]">{{ $stat['value'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Core to our DNA (scrolly-telling) --}}
        <section class="bg-cream relative w-full pt-(--padding-y) text-black md:pt-[calc(var(--padding-y)*1.5)]">
            <div class="w-calc flex flex-col items-center gap-48">
                <div class="flex w-full justify-center text-balance md:max-w-525">
                    <h2 class="w-calc type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide>
                        <x-words :lines="[$c['dna']['heading']]" lineClass="text-center" />
                    </h2>
                </div>
                <div class="type-z-24 mx-auto max-w-670 text-center whitespace-pre-line text-current/50">{{ $c['dna']['body'] }}</div>
            </div>
            <div class="w-calc relative flex gap-180 max-md:w-full max-md:flex-col-reverse max-md:gap-48 max-md:pt-48 md:mt-102 md:pt-100" data-scrolly>
                <div class="absolute top-0 left-1/2 h-full -translate-x-1/2 overflow-clip pb-[50svh] max-md:hidden" aria-hidden="true">
                    <div class="flex h-full flex-col items-center justify-center" data-scrolly-line style="transform:translateY(-100%)">
                        <div class="bg-pink h-full w-2 translate-y-12"></div>
                        <div class="bg-pink size-12 translate-y-12 rounded-full -mb-full"></div>
                    </div>
                </div>
                <div class="flex h-full w-full gap-24 max-md:flex-col max-md:overflow-x-clip md:gap-90">
                    <div class="w-full pr-12 md:hidden" aria-hidden="true">
                        <div class="flex items-center" data-scrolly-line-mobile style="transform:translateX(-100%)">
                            <div class="bg-pink h-2 w-full"></div>
                            <div class="bg-pink absolute right-0 size-12 rounded-full -ml-full"></div>
                        </div>
                    </div>
                    <div class="flex-center top-0 md:sticky md:h-svh">
                        <div class="flex items-baseline gap-4 md:gap-12" data-reveal-up="200" style="transform:translateY(200px)">
                            <div class="relative grid w-30 overflow-clip md:w-48">
                                <p class="area type-z-24 md:type-z-40" data-scrolly-counter>01</p>
                            </div>
                            <p class="type-s-12 whitespace-nowrap text-current/50">/{{ count($c['dna']['steps']) }}</p>
                        </div>
                    </div>
                    <div class="no-scrollbar flex gap-24 max-md:overflow-scroll max-md:pb-60 md:flex-col md:gap-90" data-scrolly-steps>
                        @foreach ($c['dna']['steps'] as $i => $step)
                            <div class="pointer-events-none flex w-full items-center max-md:w-full max-md:shrink-0 max-md:px-40 md:min-h-[100svh] {{ $i > 0 ? 'md:mt-[-50svh]' : '' }}" data-scrolly-step="{{ $i }}">
                                <div class="scrolly-step flex h-fit flex-col gap-24 max-md:opacity-100!" style="opacity:{{ $i === 0 ? 1 : 0.15 }}">
                                    <h2 class="type-z-40 pointer-events-auto max-w-290 max-md:text-center">{{ $step['title'] }}</h2>
                                    <div class="type-s-15 prose-links pointer-events-auto whitespace-pre-line text-current/50 max-md:text-center [&_a]:underline [&_a]:underline-offset-2">{!! $step['body'] !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex-center w-full max-md:px-40 md:sticky md:top-0 md:h-svh md:py-100">
                    <div class="relative aspect-square w-full md:aspect-[525/600]">
                        <div class="relative grid h-full w-full overflow-clip rounded-[1.2rem] bg-black" data-reveal-up="600" style="transform:translateY(600px)">
                            @foreach ($c['dna']['steps'] as $i => $step)
                                <img class="area h-full w-full object-cover transition-opacity duration-700" src="{{ asset('media/images/'.$step['image']) }}" alt="" loading="lazy" decoding="async" data-scrolly-media="{{ $i }}" style="opacity:{{ $i === 0 ? 1 : 0 }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Technology designed to protect --}}
        <section class="relative flex w-full flex-col gap-(--padding-y) overflow-clip bg-white">
            <x-split-heading :heading="$c['technology']['heading']" :body="$c['technology']['body']" :cta="$c['technology']['cta']['label']" :ctaHref="route($c['technology']['cta']['route'])" />
            <section class="flex w-full gap-24 p-24 max-md:flex-col" data-accordion>
                @foreach ($c['technology']['cards'] as $i => $card)
                    <div class="accordion-card group relative grid w-full place-items-center justify-center overflow-clip bg-black text-white md:h-720 {{ $i === 0 ? 'is-active max-md:h-600' : 'max-md:h-112' }}" style="border-radius:12px;transform:translateY({{ ($i + 1) * 200 }}px)" data-reveal-up="{{ ($i + 1) * 200 }}" data-accordion-item>
                        <div class="absolute inset-0 overflow-clip">
                            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('media/images/'.$card['image']) }}" alt="{{ $card['title'] }}" loading="lazy" decoding="async">
                        </div>
                        <div class="accordion-card__text absolute bottom-40 flex flex-col gap-16 max-md:px-28 md:bottom-48 md:left-48 md:w-400">
                            <h2 class="type-z-24 md:type-z-40 text-balance md:pr-50">{{ $card['title'] }}</h2>
                            <p class="type-s-14 md:type-s-15 text-white/60">{{ $card['body'] }}</p>
                        </div>
                        <div class="area flex-center w-full max-md:mb-auto max-md:h-112 md:mt-auto md:pb-48">
                            <div>
                                <span class="btn-arrow group-hover:border-transparent group-hover:bg-pink" aria-hidden="true"><x-icons.arrow-right /></span>
                            </div>
                        </div>
                        <a class="absolute inset-0 {{ $i > 0 ? 'max-md:pointer-events-none' : '' }}" href="{{ url($card['href']) }}" aria-label="Link to {{ $card['href'] }}"></a>
                    </div>
                @endforeach
            </section>
        </section>

        {{-- Best practices slider --}}
        <section class="flex flex-col bg-black text-white" data-snap-slider>
            <div class="relative flex h-svh w-full">
                <div class="no-scrollbar flex h-full w-full snap-x snap-mandatory flex-row flex-nowrap overflow-x-auto" data-snap-track>
                    @foreach ($c['practices']['slides'] as $i => $slide)
                        <div class="relative flex h-full w-full shrink-0 snap-center flex-col items-center justify-end pt-24 pb-110 md:items-start md:pb-158">
                            <div class="absolute inset-0 bg-black/20">
                                <img class="size-full object-cover" src="{{ asset('media/images/'.$slide['image']) }}" alt="" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-l from-transparent to-black/50"></div>
                            <div class="w-calc relative flex flex-col gap-16 md:gap-82">
                                <div class="flex flex-col gap-16 md:gap-24">
                                    <div class="flex flex-col">
                                        <div class="flex items-baseline gap-4 md:gap-12">
                                            <div class="relative grid w-30 overflow-clip md:w-48">
                                                <p class="area type-z-24 md:type-z-40">0{{ $i + 1 }}</p>
                                            </div>
                                            <p class="type-s-12 whitespace-nowrap text-current/50">/{{ count($c['practices']['slides']) }}</p>
                                        </div>
                                        <span class="type-z-24 md:type-z-40 w-full text-current">{{ $c['practices']['title'] }}</span>
                                        <span class="type-z-24 md:type-z-40 w-full text-current/60 md:max-w-368">{{ $slide['subtitle'] }}</span>
                                    </div>
                                    <p class="type-s-14 md:type-s-15 text-current/60 md:max-w-368">{{ $slide['body'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="absolute right-0 bottom-40 left-0 md:bottom-60">
                    <div class="w-calc relative flex items-center justify-between">
                        <div class="flex items-center gap-8 md:gap-12">
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Previous" data-snap-prev><x-icons.arrow-left /></button>
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Next" data-snap-next><x-icons.arrow-right /></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-insights-carousel :articles="$articles" :heading="$c['insights']['heading']" :body="$c['insights']['body']" background="bg-white" :padded="false" />
    </div>
</x-layouts.app>
