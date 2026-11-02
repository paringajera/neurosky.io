<section class="relative h-svh w-full overflow-clip px-24" data-parallax-root>
    <div class="relative h-full w-full">
        <div class="rounded-calc absolute inset-0 h-full w-full overflow-clip text-white">
            <div class="absolute inset-0" data-parallax style="transform:translateY(-12%)">
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('media/images/'.$technology['image']) }}" alt="{{ $technology['heading'] }}" loading="lazy" decoding="async">
            </div>
            <div class="relative flex h-full w-full flex-col items-start justify-end gap-24 pb-40 md:gap-48 md:pb-105">
                <div class="flex w-full justify-center">
                    <h2 class="w-calc type-display-section text-balance" data-reveal-words data-reveal-slide>
                        <x-words :lines="[$technology['heading']]" />
                    </h2>
                </div>
                <div class="w-calc flex justify-start">
                    <div>
                        <x-pill-link :href="route($technology['cta']['route'])" :label="$technology['cta']['label']" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
