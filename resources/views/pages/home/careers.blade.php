<section class="relative flex w-full flex-col overflow-clip bg-white py-[var(--padding-y)] lg:min-h-screen" id="careers" data-careers data-interval="{{ $careers['interval'] }}">
    <div class="flex flex-col gap-65 md:gap-96">
        <div class="flex flex-col gap-32">
            <div class="flex w-full justify-center text-balance">
                <h2 class="w-calc type-display-section text-balance" data-reveal-words data-reveal-slide>
                    <x-words :lines="[$careers['heading']]" />
                </h2>
            </div>
            <div class="w-calc flex">
                <div>
                    <x-pill-link :href="route($careers['cta']['route'])" :label="$careers['cta']['label']" />
                </div>
            </div>
        </div>
        <div class="relative flex w-full px-24">
            <div class="rounded-calc relative flex h-[35vw] w-full items-center overflow-clip" data-careers-stage>
                @php($slots = [
                    'left-0 h-[17vw] w-[23vw]',
                    'left-[calc(100%-(47vw+(39vw*0.5)+(31vw*0.5)))] h-[23vw] w-[31vw]',
                    'left-[calc(100%-(47vw+(39vw*0.5)))] h-[29vw] w-[39vw]',
                    'left-[calc(100%-47vw)] h-[35vw] w-[47vw]',
                ])
                @foreach (array_slice($careers['images'], 0, 4) as $i => $image)
                    <div class="careers-slot absolute {{ $slots[$i] }}" data-careers-slot="{{ $i }}">
                        <div class="size-full overflow-clip bg-gray-300 rounded-[12px]">
                            <div class="size-full">
                                <img class="size-full object-cover" src="{{ asset('media/images/'.$image) }}" alt="" loading="lazy" decoding="async">
                            </div>
                        </div>
                    </div>
                @endforeach
                <template data-careers-pool>
                    @foreach ($careers['images'] as $image)
                        <img class="size-full object-cover" src="{{ asset('media/images/'.$image) }}" alt="" loading="lazy" decoding="async">
                    @endforeach
                </template>
            </div>
        </div>
    </div>
</section>
