<x-layouts.app :pageLabel="$pageLabel" :title="$article['title'].' | NeuroSky'">
    <section class="relative flex w-full flex-col" id="insights">
        <div class="flex flex-col gap-60 overflow-clip pt-[12.2rem] pb-[9rem] md:gap-80 lg:pt-[var(--padding-y)] lg:pb-[var(--padding-y)]">
            <div class="flex flex-col gap-40 md:gap-88">
                <div class="w-calc">
                    <div class="flex justify-between">
                        <a class="group flex items-center gap-16" href="{{ route('insights.index') }}" aria-label="Link to /insights">
                            <div class="flex-center h-24 w-24 rounded-full border-1 border-current/25 transition-colors group-hover:border-transparent group-hover:bg-pink group-hover:text-white">
                                <x-icons.arrow-left />
                            </div>
                            <span class="type-s-11 md:type-s-12">View All Articles</span>
                        </a>
                        <div class="md:hidden">
                            <x-share-menu :title="$article['title']" />
                        </div>
                    </div>
                </div>
                <div class="w-calc flex flex-col gap-30 md:gap-80">
                    <div class="relative flex flex-col gap-24">
                        <div class="absolute top-0 right-0 max-md:hidden">
                            <x-share-menu :title="$article['title']" />
                        </div>
                        <div class="flex flex-row flex-wrap items-center gap-x-12 gap-y-8">
                            <div class="flex flex-row flex-wrap items-center gap-x-12 gap-y-8">
                                @foreach ($article['tags'] as $tag)
                                    <a href="{{ route('insights.index', ['category' => \Illuminate\Support\Str::slug($tag)]) }}" aria-label="Browse {{ $tag }}">
                                        <div class="flex-center ease-snappy h-26 shrink-0 gap-6 rounded-[4rem] bg-[#DEDCD9] px-11 text-current/50 transition-colors duration-500 hover:bg-pink/25 hover:text-pink">
                                            <span class="type-s-10">{{ $tag }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <p class="translate-y-[0.1rem] text-[1.2rem]">{{ \Carbon\Carbon::parse($article['date'])->format('F j, Y') }}</p>
                        </div>
                        <h1 class="type-z-34 md:type-z-80 max-w-919">{{ $article['title'] }}</h1>
                        @if (! empty($article['intro']))
                            <div class="flex flex-col gap-16">
                                @foreach ($article['intro'] as $p)
                                    <p class="type-z-15 max-w-919">{{ $p }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <hr class="h-1 w-full border-0 bg-current/10">
                </div>
            </div>

            <div class="relative flex flex-col gap-30 md:gap-(--padding-y)">
                @if ($article['author'])
                    <div class="px-calc mx-auto flex w-[calc(100%-8rem)] flex-col gap-14 pr-0 max-lg:px-0 md:w-600 lg:absolute lg:top-0 lg:left-0 lg:w-auto">
                        <div class="flex max-w-157 flex-col gap-14">
                            @if ($article['author_image'])
                                <div class="relative hidden aspect-square size-50 overflow-hidden rounded-[1rem] lg:flex">
                                    <img class="h-full w-full object-cover" src="{{ asset('media/images/'.$article['author_image']) }}" alt="{{ $article['author'] }}" loading="lazy">
                                </div>
                            @endif
                            <span class="type-s-11 md:type-s-12">by {{ $article['author'] }}</span>
                        </div>
                    </div>
                @endif
                <div class="relative mx-auto flex w-[calc(100%-8rem)] flex-col gap-30 md:w-600 md:gap-60 lg:w-810">
                    @if ($article['body_view'])
                        @include($article['body_view'])
                    @else
                        <div class="rich-text w-full"><p>{{ implode(' ', $article['intro']) }}</p></div>
                    @endif

                    <div class="flex flex-col gap-32">
                        <hr class="h-px w-full border-0 bg-foreground/15">
                        <x-careers-callout />
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
