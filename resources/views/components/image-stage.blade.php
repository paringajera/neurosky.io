@props(['images', 'interval' => 2000])
{{-- Four overlapping tiles that cycle every few seconds (careers / home) --}}
@php($slots = [
    'left-0 h-[17vw] w-[23vw]',
    'left-[calc(100%-(47vw+(39vw*0.5)+(31vw*0.5)))] h-[23vw] w-[31vw]',
    'left-[calc(100%-(47vw+(39vw*0.5)))] h-[29vw] w-[39vw]',
    'left-[calc(100%-47vw)] h-[35vw] w-[47vw]',
])
<div class="relative flex w-full px-24" data-careers data-interval="{{ $interval }}">
    <div class="rounded-calc relative flex h-[35vw] w-full items-center overflow-clip" data-careers-stage>
        @foreach (array_slice($images, 0, 4) as $i => $image)
            <div class="careers-slot absolute {{ $slots[$i] }}" data-careers-slot="{{ $i }}">
                <div class="size-full overflow-clip bg-gray-300 rounded-[12px]">
                    <div class="size-full">
                        <img class="size-full object-cover" src="{{ asset('media/images/'.$image) }}" alt="" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        @endforeach
        <template data-careers-pool>
            @foreach ($images as $image)
                <img class="size-full object-cover" src="{{ asset('media/images/'.$image) }}" alt="" loading="lazy" decoding="async">
            @endforeach
        </template>
    </div>
</div>
