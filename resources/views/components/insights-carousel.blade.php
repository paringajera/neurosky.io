@props(['articles', 'heading' => 'Insights.', 'body' => null, 'background' => 'bg-cream', 'padded' => true])
<section class="relative flex w-full flex-col overflow-clip {{ $background }} {{ $padded ? 'py-(--padding-y)' : '' }}" id="insights" data-insights>
    <div class="flex flex-col gap-30 md:gap-48">
        <div class="w-calc grid grid-cols-2 gap-y-24 md:gap-y-48">
            <div class="order-1 md:col-span-2">
                <div class="flex w-full justify-center">
                    <h2 class="w-calc type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide>
                        <x-words :lines="[$heading]" />
                    </h2>
                </div>
            </div>
            <div class="order-3 max-md:col-span-2 md:order-2">
                @if ($body)
                    <p class="type-s-14 md:type-s-15 text-balance text-black/50">{{ $body }}</p>
                @endif
            </div>
            <div class="order-2 flex items-end gap-24 justify-self-end md:order-3">
                <div>
                    <x-pill-link :href="route('insights.index')" label="View all" class="hidden md:flex" />
                </div>
                <div class="flex items-center gap-8 md:gap-12">
                    <button type="button" class="btn-arrow hover:bg-pink hover:border-transparent hover:text-white" aria-label="Previous" data-carousel-prev><x-icons.arrow-left /></button>
                    <button type="button" class="btn-arrow hover:bg-pink hover:border-transparent hover:text-white" aria-label="Next" data-carousel-next><x-icons.arrow-right /></button>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-45 md:gap-0">
            <div class="flex w-full flex-nowrap">
                <div class="px-calc flex snap-x snap-mandatory flex-nowrap gap-28 md:gap-24" data-carousel data-carousel-track>
                    @foreach ($articles as $i => $article)
                        <a class="group relative flex w-[calc(100vw-8rem)] shrink-0 snap-start flex-col items-start justify-start gap-16 border-b border-current/15 pb-24 md:w-450" href="{{ $article['url'] }}" aria-label="Link to {{ route('insights.show', $article['slug'], false) }}" draggable="false">
                            <x-article-card :article="$article" :offset="($i + 1) * 200" />
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-center md:hidden">
                <div>
                    <x-pill-link :href="route('insights.index')" label="View all" />
                </div>
            </div>
        </div>
    </div>
</section>
