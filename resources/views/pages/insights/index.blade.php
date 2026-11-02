@php($extra = require resource_path('content/insights-page.php'))
<x-layouts.app :pageLabel="$pageLabel" title="Insights | NeuroSky">
    <section class="relative flex w-full flex-col gap-(--padding-y) pb-40 max-md:gap-y-30 md:pb-120" id="insights">
        {{-- Featured slider --}}
        <section class="flex flex-col bg-black" data-featured-slider data-interval="6000">
            <div class="relative flex h-svh w-full">
                <div class="flex h-full w-full snap-x snap-mandatory flex-row flex-nowrap overflow-x-auto no-scrollbar" data-featured-track>
                    @foreach ($extra['featured'] as $slide)
                        @php($a = collect($articles)->firstWhere('slug', $slide['slug']))
                        @continue(! $a)
                        <div class="featured-slide relative flex h-full w-full shrink-0 snap-center flex-col items-center justify-end px-40 pt-24 pb-80 md:items-start md:px-[10.3rem] md:pb-130">
                            <div class="absolute inset-0 bg-black/20">
                                <img class="h-full w-full object-cover" src="{{ asset($slide['image']) }}" alt="" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async" style="object-position:50% 50%">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-b from-black/0 via-black/0 to-black/40"></div>
                            <div class="relative flex w-full flex-col gap-16 md:gap-82">
                                <a class="flex flex-col gap-16 md:gap-24" href="{{ $a['url'] }}" aria-label="Link to {{ route('insights.show', $a['slug'], false) }}">
                                    <h1 class="type-z-28 md:type-z-60 featured-slide__title w-full text-white md:w-[76.3rem]">{{ $a['title'] }}</h1>
                                    <p class="type-s-11 md:type-s-12 featured-slide__date text-white">{{ \Carbon\Carbon::parse($a['date'])->format('F j, Y') }}</p>
                                    <div class="flex">
                                        <span class="btn-pill featured-slide__cta"><span class="type-s-11 md:type-s-12 leading-[140%] tracking-[0.024rem]">Read more</span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="absolute bottom-20 left-40 md:bottom-60 md:left-[10.3rem]">
                    <div class="relative flex w-full gap-10 sm:gap-16 md:gap-24">
                        @foreach ($extra['featured'] as $i => $slide)
                            <button type="button" class="group relative h-45 w-60 md:w-110" aria-label="Scroll to article {{ $i + 1 }}" data-featured-dot>
                                <div class="ease-snappy relative h-2 w-full overflow-clip rounded-[0.3rem] bg-white/25 transition-colors duration-300 group-hover:bg-white/50">
                                    <div class="absolute inset-0 h-full w-full origin-left bg-white" data-featured-bar style="transform:scaleX(0)"></div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- All articles --}}
        <div class="flex flex-col gap-y-30 md:gap-y-48">
            <div class="relative flex w-full flex-col gap-30 md:gap-y-48">
                <div class="flex w-full justify-center">
                    <h2 class="w-calc type-z-28 md:type-z-60 text-balance" data-reveal-words data-reveal-slide>
                        <x-words :lines="['All articles']" wrapClass="flex flex-col md:max-w-[max(60%,91.8rem)]" />
                    </h2>
                </div>
            </div>
            <div class="md:w-calc flex flex-col gap-y-16">
                <div class="max-md:w-calc">
                    <p class="type-s-12 text-black/50">Browse by:</p>
                </div>
                @php($filters = [['label' => 'All', 'slug' => null], ['label' => 'Technology', 'slug' => 'technology'], ['label' => 'Company news', 'slug' => 'company-news'], ['label' => 'Research', 'slug' => 'research']])
                <div class="flex flex-row flex-nowrap gap-x-12 gap-y-8 overflow-x-auto no-scrollbar max-md:px-40 md:flex-wrap">
                    @foreach ($filters as $f)
                        @php($on = ($category ?? null) === $f['slug'])
                        <div>
                            <a class="flex h-36 shrink-0 items-center justify-center px-24 text-nowrap md:h-48 {{ $on ? 'bg-pink text-white' : 'border border-current/15 hover:border-transparent hover:bg-pink hover:text-white' }}" style="border-radius:50px" href="{{ $f['slug'] ? route('insights.index', ['category' => $f['slug']]) : route('insights.index') }}" aria-label="Browse {{ $f['label'] }}" @if($on) aria-current="true" @endif>
                                <span class="type-s-11 md:type-s-12 leading-[140%] tracking-[0.024rem]">{{ $f['label'] }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="relative flex w-full flex-col gap-30 md:gap-y-48">
            <div class="w-calc grid grid-cols-1 gap-x-23 gap-y-30 md:grid-cols-3 md:gap-y-48">
                @forelse ($category ? $articles : $articles->take(6) as $i => $article)
                    <a class="group relative flex w-full shrink-0 flex-col items-start justify-start gap-16 border-b border-current/15 pb-24" href="{{ $article['url'] }}" aria-label="Link to {{ route('insights.show', $article['slug'], false) }}">
                        <x-article-card :article="$article" />
                    </a>
                @empty
                    <p class="type-z-18 col-span-full text-black/50">No articles in this category yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Press --}}
        <section class="relative w-full overflow-clip bg-cream-light py-60 md:py-120" data-insights>
            <div class="flex flex-col gap-30 md:gap-48">
                <div class="w-calc flex items-center justify-between">
                    <h3 class="type-z-28 md:type-z-60">{{ $extra['press_heading'] }}</h3>
                    <div class="flex items-center gap-24">
                        <div class="hidden md:flex">
                            <div><x-pill-link :href="url($extra['press_href'])" label="See all" /></div>
                        </div>
                        <div class="flex items-center gap-8 md:gap-12">
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Previous" data-carousel-prev><x-icons.arrow-left /></button>
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Next" data-carousel-next><x-icons.arrow-right /></button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-45 md:gap-0">
                    <div class="flex w-full flex-nowrap">
                        <div class="px-calc flex snap-x snap-mandatory flex-nowrap gap-28 md:gap-24" data-carousel data-carousel-track>
                            @foreach ($extra['press'] as $item)
                                <a class="group flex w-[calc(100vw-8rem)] shrink-0 snap-start flex-col gap-20 md:w-315" href="{{ $item['href'] }}" @if (str_starts_with($item['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif draggable="false">
                                    <div class="flex flex-col gap-20">
                                        <div class="rounded-calc relative flex aspect-[315/214] items-center justify-center overflow-clip bg-cream">
                                            <img class="aspect-[315/214] w-full object-contain" src="{{ asset('media/images/press/'.$item['logo']) }}" alt="{{ $item['source'] }}" loading="lazy" decoding="async" draggable="false">
                                        </div>
                                        <div class="flex flex-col gap-8">
                                            <p class="type-s-14 md:type-s-15 font-medium">{{ $item['source'] }}</p>
                                            <p class="type-z-18 md:type-z-24 ease-snappy transition-colors duration-500 group-hover:text-pink">{{ $item['title'] }}</p>
                                        </div>
                                    </div>
                                    <span class="type-s-11 md:type-s-12 text-current/50">{{ $item['date'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex w-full justify-center md:hidden">
                        <div><x-pill-link :href="url($extra['press_href'])" label="See all" /></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Media block --}}
        <section class="mx-auto w-full max-w-1440 max-md:h-686 md:aspect-[1440/860] md:px-24">
            <div class="rounded-calc relative size-full overflow-clip bg-dark text-white">
                <img class="h-full w-full object-cover" src="{{ asset($extra['media']['image']) }}" alt="" loading="lazy" decoding="async" style="object-position:50% 50%">
                <div class="absolute inset-0 bg-gradient-to-b from-black/0 to-black/40"></div>
                <div class="absolute inset-0 flex flex-col items-start justify-end gap-24 p-40 md:p-[10.3rem]">
                    <p class="type-z-24 md:type-z-40 max-w-600 text-white">{{ $extra['media']['text'] }}</p>
                    @if (! empty($extra['media']['href']))
                        <x-pill-link :href="$extra['media']['href']" :label="$extra['media']['cta']" :external="str_starts_with($extra['media']['href'], 'http')" />
                    @endif
                </div>
            </div>
        </section>

        @if (! $category && $articles->count() > 6)
            <div class="relative flex w-full flex-col gap-30 md:gap-y-48">
                <div class="w-calc grid grid-cols-1 gap-x-23 gap-y-30 md:grid-cols-3 md:gap-y-48">
                    @foreach ($articles->slice(6, 6) as $article)
                        <a class="group relative flex w-full shrink-0 flex-col items-start justify-start gap-16 border-b border-current/15 pb-24" href="{{ $article['url'] }}" aria-label="Link to {{ route('insights.show', $article['slug'], false) }}">
                            <x-article-card :article="$article" />
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</x-layouts.app>
