@php($c = require resource_path('content/research.php'))
@php($tag = request()->query('tag'))
@php($pubs = collect($c['publications'])->when($tag, fn ($col) => $col->filter(fn ($p) => in_array(\Illuminate\Support\Str::slug($tag), array_map([\Illuminate\Support\Str::class, 'slug'], $p['tags']), true)))->values())
<x-layouts.app :pageLabel="$pageLabel" title="Research | NeuroSky">
    <div data-theme="dark" class="bg-dark text-white">
    <section class="relative flex w-full flex-col gap-[var(--padding-y)]" id="research">
        <div class="flex flex-col">
            <div class="w-calc flex flex-col gap-30 pt-195 pb-90 md:pt-240 md:pb-120 lg:gap-0">
                <div class="flex w-full justify-start md:max-w-3/5">
                    <h1 class="type-display-section text-balance" data-reveal-words data-reveal-slide data-reveal-onload><x-words :lines="[$c['heading']]" /></h1>
                </div>
                <div class="flex w-full justify-end">
                    <div class="flex w-448">
                        <p class="type-z-18 md:type-z-24 whitespace-pre-line text-current/60">{{ $c['intro'] }}</p>
                    </div>
                </div>
            </div>
            <div class="w-full overflow-clip">
                <div class="flex flex-col items-start gap-10">
                    <div class="px-calc shrink-0"><span class="type-s-11 md:type-s-12 text-current/60">Browse by:</span></div>
                    <div class="px-calc no-scrollbar flex snap-x snap-mandatory flex-nowrap gap-12 overflow-x-auto" data-carousel>
                        @foreach ($c['filters'] as $filter)
                            @php($on = $tag && \Illuminate\Support\Str::slug($tag) === \Illuminate\Support\Str::slug($filter))
                            <div>
                                <a class="flex h-36 shrink-0 snap-start items-center justify-center whitespace-nowrap px-24 md:h-48 {{ $on ? 'bg-pink text-white' : 'border border-current/15 hover:border-transparent hover:bg-pink hover:text-white' }}" style="border-radius:50px" href="{{ $on ? route('research') : route('research', ['tag' => \Illuminate\Support\Str::slug($filter)]) }}#publications">
                                    <span class="type-s-11 md:type-s-12 leading-[140%] tracking-[0.024rem]">{{ $filter }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Spotlight --}}
            <div class="flex flex-col pt-60">
                <div class="w-calc relative mx-auto flex flex-col items-center justify-between max-md:w-[calc(100%-2rem)] md:flex-row">
                    <div class="relative aspect-square w-full overflow-clip rounded-t-[var(--rounded-unit)] bg-dark-light md:aspect-[unset] md:h-[80.7rem] md:w-10/12 md:rounded-[var(--rounded-unit)]" data-reveal-up="200" style="transform:translateY(200px)">
                        <img class="h-full w-full object-cover" src="{{ asset('media/images/'.$c['spotlight']['image']) }}" alt="{{ $c['spotlight']['title'] }}" loading="lazy" decoding="async">
                    </div>
                    <a class="rounded-calc group relative mt-[-2.8rem] flex w-full flex-col items-start justify-center bg-dark p-28 text-white md:absolute md:right-0 md:mt-0 md:w-[44.7rem] md:p-48" href="{{ url($c['spotlight']['href']) }}" data-reveal-up="400" style="transform:translateY(400px)">
                        <div class="flex flex-col gap-24 md:gap-90">
                            <div class="flex flex-col gap-12 md:gap-16">
                                <div class="flex flex-wrap gap-6">
                                    @foreach ($c['spotlight']['tags'] as $t)
                                        <div class="flex-center ease-snappy h-26 shrink-0 gap-6 rounded-[4rem] bg-current/25 px-11 text-pink transition-colors duration-500"><span class="type-s-10">{{ $t }}</span></div>
                                    @endforeach
                                </div>
                                <div class="flex flex-col gap-3">
                                    <h2 class="type-z-24 md:type-z-40">{{ $c['spotlight']['title'] }}</h2>
                                    <span class="type-s-14 md:type-s-15 text-current/60">{{ $c['spotlight']['venue'] }}</span>
                                </div>
                                <p class="type-s-11 md:type-s-12">{{ $c['spotlight']['authors'] }}</p>
                            </div>
                            <span class="btn-arrow group-hover:border-transparent group-hover:bg-pink" aria-hidden="true"><x-icons.arrow-right /></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Featured --}}
        <section class="bg-dark-light relative w-full overflow-clip py-[var(--padding-y)]" data-insights>
            <div class="flex flex-col gap-30 md:gap-48">
                <div class="w-calc flex items-center justify-between">
                    <h3 class="type-z-34 md:type-z-80">Featured</h3>
                    <div class="flex items-center gap-24">
                        <div class="flex items-center gap-12">
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Previous" data-carousel-prev><x-icons.arrow-left /></button>
                            <button type="button" class="btn-arrow hover:border-transparent hover:bg-pink hover:text-white" aria-label="Next" data-carousel-next><x-icons.arrow-right /></button>
                        </div>
                    </div>
                </div>
                <div class="flex w-full flex-nowrap">
                    <div class="px-calc flex snap-x snap-mandatory flex-nowrap gap-28 md:gap-24" data-carousel data-carousel-track>
                        @foreach ($c['featured'] as $f)
                            <a class="group relative flex w-full shrink-0 snap-start flex-col items-start justify-start gap-16 border-b border-current/15 pb-24 md:w-600 lg:w-920" href="{{ url($f['href']) }}" draggable="false">
                                <article class="relative flex w-full flex-col items-start justify-start gap-12 md:gap-16">
                                    <div class="rounded-calc relative flex aspect-[295/221] w-full items-center justify-center overflow-clip bg-current md:aspect-[917/516]">
                                        <div class="ease-snappy relative h-full w-full scale-105 transition-transform duration-500 group-hover:scale-110">
                                            @if ($f['video'])
                                                <div class="absolute inset-0 size-full"><div class="absolute inset-0" data-video-fade><video class="size-full object-cover" autoplay playsinline loop muted preload="none" data-video-lazy data-src="{{ asset('media/videos/'.$f['video']) }}"></video></div></div>
                                            @else
                                                <img class="absolute h-full w-full object-cover" src="{{ asset('media/images/'.$f['image']) }}" alt="" loading="lazy" decoding="async" draggable="false">
                                            @endif
                                        </div>
                                        <div class="absolute top-16 left-16 flex items-center gap-12">
                                            @foreach ($f['tags'] as $t)
                                                <div class="flex-center ease-snappy h-26 shrink-0 gap-6 rounded-[4rem] bg-pink/25 px-11 text-pink transition-colors duration-500"><span class="type-s-10">{{ $t }}</span></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="relative flex w-full flex-col gap-10">
                                        <div class="flex flex-col gap-6">
                                            <span class="type-s-14 md:type-s-15 text-current/60">{{ $f['venue'] }}</span>
                                            <h2 class="type-z-18 md:type-z-24 ease-snappy max-w-600 text-balance text-current transition-colors duration-500 group-hover:text-pink">{{ $f['title'] }}</h2>
                                        </div>
                                        <p class="type-s-11 md:type-s-12 text-current">{{ $f['authors'] }}</p>
                                    </div>
                                </article>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Publications --}}
        <section class="flex flex-col gap-25 overflow-hidden pb-(--padding-y) md:gap-48" id="publications">
            <div class="flex w-full justify-center">
                <h2 class="w-calc type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide><x-words :lines="[$c['list_heading'] ?? 'Publications']" /></h2>
            </div>
            <div class="w-calc flex flex-col gap-48">
                <ul class="flex flex-col gap-20 md:gap-0">
                    @forelse ($pubs as $p)
                        <li class="flex w-full">
                            <a class="rounded-calc group flex w-full flex-col gap-16 hover:bg-pink hover:text-white md:gap-32 md:px-16 md:pt-32" href="{{ url($p['href']) }}" aria-label="Read about {{ $p['title'] }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex grow flex-col gap-16 md:gap-20">
                                        <div class="flex flex-wrap gap-6">
                                            @foreach ($p['tags'] as $t)
                                                <div class="flex-center ease-snappy h-26 shrink-0 gap-6 rounded-[4rem] bg-current/25 px-11 text-pink transition-colors duration-500 group-hover:text-white"><span class="type-s-10">{{ $t }}</span></div>
                                            @endforeach
                                        </div>
                                        <div class="flex flex-col gap-16 md:gap-20">
                                            <div class="flex flex-col gap-3">
                                                <div class="type-s-14 md:type-s-15 text-white/60">{{ $p['venue'] }}</div>
                                                <div class="type-z-18 md:type-z-24 text-pretty text-white">{{ $p['title'] }}</div>
                                            </div>
                                            <div class="type-s-11 md:type-s-12 text-balance text-white">{{ $p['authors'] }}</div>
                                        </div>
                                    </div>
                                    <div class="hidden shrink-0 md:flex">
                                        <span class="btn-arrow group-hover:border-transparent group-hover:bg-white group-hover:text-pink" aria-hidden="true"><x-icons.arrow-right /></span>
                                    </div>
                                </div>
                                <hr class="h-1 w-full border-0 bg-white/25 group-hover:opacity-0">
                            </a>
                        </li>
                    @empty
                        <li class="type-z-18 text-white/60">No projects match this topic yet.</li>
                    @endforelse
                </ul>
            </div>
        </section>
    </section>
    </div>
</x-layouts.app>
