<section class="relative min-h-svh w-full overflow-clip text-white" data-parallax-root>
    <div class="absolute inset-0 overflow-clip" data-parallax style="transform:translateY(-12%)">
        <img class="h-full w-full object-cover" src="{{ asset('media/images/'.$safety['image']) }}" alt="" loading="lazy" decoding="async">
        <div class="absolute inset-0 bg-linear-to-b from-black/50 to-transparent"></div>
    </div>
    <div class="relative z-2 px-40 py-60 md:p-103">
        <div class="w-calc">
            <div class="flex w-full flex-col items-start gap-24 md:max-w-525 md:gap-48">
                <h2 class="type-z-34 md:type-z-80 text-pretty">{{ $safety['heading'] }}</h2>
                <div class="type-z-18 md:type-z-24 whitespace-pre-line text-current/60"><span>For us, safety isn't a box to check—</span><span>it's a commitment we <strong>strengthen daily with</strong> driver behavior AI, smart truck displays, and drones that see the road ahead.</span></div>
                <div>
                    <x-pill-link :href="route($safety['cta']['route'])" :label="$safety['cta']['label']" />
                </div>
            </div>
        </div>
    </div>
</section>
