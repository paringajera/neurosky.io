@props(['article', 'offset' => 0, 'aspect' => 'aspect-[295/221] md:aspect-[448/336]'])
<article class="relative flex w-full flex-col items-start justify-start gap-12 md:gap-16" @if($offset) data-reveal-up="{{ $offset }}" style="transform:translateY({{ $offset }}px)" @endif>
    <div class="rounded-calc relative flex w-full items-center justify-center overflow-clip bg-current {{ $aspect }}">
        <div class="ease-snappy relative h-full w-full transition-transform duration-500 group-hover:scale-110">
            <img class="absolute h-full w-full object-cover" src="{{ $article['image_url'] }}" alt="" loading="lazy" decoding="async" style="object-position:50% 50%" draggable="false">
        </div>
    </div>
    <div class="relative flex w-full flex-row flex-wrap items-center justify-start gap-16">
        @if (! empty($article['tags']))
            <div class="flex flex-wrap items-center gap-6">
                @foreach ($article['tags'] as $tag)
                    <div class="flex-center ease-snappy h-26 shrink-0 gap-6 rounded-[4rem] bg-[#DEDCD9] px-11 text-current/50 transition-colors duration-500 group-hover:bg-pink/25 group-hover:text-pink">
                        <span class="type-s-10">{{ $tag }}</span>
                    </div>
                @endforeach
            </div>
        @endif
        <span class="type-s-11 md:type-s-12 whitespace-nowrap text-current/50">{{ \Carbon\Carbon::parse($article['date'])->format('F j, Y') }}</span>
    </div>
    <h2 class="type-z-18 md:type-z-24 ease-snappy max-w-600 text-current transition-colors duration-500 group-hover:text-pink">{{ $article['title'] }}</h2>
</article>
