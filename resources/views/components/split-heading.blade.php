@props(['heading', 'body' => null, 'cta' => null, 'ctaHref' => null, 'external' => false, 'bodyClass' => 'text-current/50'])
{{-- Heading on the left, supporting copy (and optional pill) bottom-aligned on the right --}}
<div class="w-calc flex gap-30 max-lg:flex-col md:gap-48 xl:gap-240">
    <div class="flex flex-col gap-y-48">
        <div class="flex w-full text-balance">
            <h2 class="type-z-34 md:type-z-80 text-balance" data-reveal-words data-reveal-slide>
                <x-words :lines="[$heading]" />
            </h2>
        </div>
    </div>
    <div class="max-lg:w-calc flex flex-col justify-end gap-30 lg:max-w-447 lg:gap-48 lg:pl-48">
        @if ($body)
            <div class="type-z-18 md:type-z-24 whitespace-pre-line {{ $bodyClass }}">{{ $body }}</div>
        @endif
        @if ($cta)
            <div class="flex">
                <div>
                    <x-pill-link :href="$ctaHref" :label="$cta" :external="$external" />
                </div>
            </div>
        @endif
        {{ $slot }}
    </div>
</div>
