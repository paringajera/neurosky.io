@props(['heading', 'image'])
{{-- Full-height dark hero used by Safety / Company / Careers --}}
<div class="bg-foreground text-background relative min-h-screen w-full" data-parallax-root data-page-hero>
    <div class="absolute top-0 left-0 h-full w-full overflow-clip">
        <div class="absolute top-0 left-0 h-lvh w-full overflow-clip" data-parallax style="transform:translateY(-12%)">
            <div>
                <div class="absolute inset-0">
                    <img class="absolute inset-0 size-full object-cover" src="{{ asset('media/images/'.$image) }}" alt="" decoding="async" fetchpriority="high">
                </div>
            </div>
        </div>
        <div class="absolute inset-0 bg-linear-to-l from-transparent to-black/60"></div>
        <div class="w-calc relative flex h-full flex-col justify-between py-(--padding-y) pt-120">
            <div class="flex max-w-full flex-col gap-48 pb-40 md:sticky md:top-120 lg:max-w-8/12">
                <div class="flex w-full text-balance">
                    <h1 class="type-display-section text-balance" data-reveal-words data-reveal-slide data-reveal-onload>
                        <x-words :lines="[$heading]" />
                    </h1>
                </div>
            </div>
            <button type="button" class="flex-center bg-pink h-24 w-24 cursor-pointer rounded-full" aria-label="Scroll Down" data-scroll-next>
                <x-icons.scroll-down />
            </button>
        </div>
    </div>
</div>
