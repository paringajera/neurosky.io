@props(['href', 'label', 'external' => false])
<a {{ $attributes->merge(['class' => 'btn-pill']) }} href="{{ $href }}" aria-label="Link to {{ $href }}" @if($external) target="_blank" rel="noopener noreferrer" @endif>
    <span class="type-s-11 md:type-s-12 leading-[140%] tracking-[0.024rem]">{{ $label }}</span>
</a>
