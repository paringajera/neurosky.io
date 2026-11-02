@php($banner = config('neurosky.banner'))
<div class="announcement fixed top-0 left-0 z-999 flex w-full items-center justify-center border-b border-b-black/15 bg-white" data-banner>
    <div class="mr-48 flex-1 overflow-hidden">
        <div class="flex justify-center py-12">
            <div class="flex flex-nowrap items-start gap-4">
                <p class="type-s-11 md:type-s-12 text-dark whitespace-nowrap">{{ $banner['text'] }}&nbsp;</p>
                <a href="{{ $banner['href'] }}" target="_blank" rel="noopener noreferrer" class="text-dark" aria-label="Link to {{ $banner['href'] }}">
                    <span class="inline-flex flex-nowrap items-center gap-2">
                        <span class="type-s-11 md:type-s-12 under whitespace-nowrap">{{ $banner['cta'] }}</span>
                        <x-icons.arrow-up-right class="relative top-1 left-1 size-6" />
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="flex-center absolute top-0 right-0 mr-12 h-full">
        <button type="button" class="p-10" aria-label="Close news banner" data-banner-close>
            <x-icons.close class="text-dark size-8" />
        </button>
    </div>
</div>
