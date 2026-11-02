{{--
    Splits text into word spans so JS can reveal them one by one.
    Usage:
      <x-words text="Some heading" />                       -> inline words
      <x-words :lines="['Never stop logistics.', 'Always move forward.']" /> -> stacked lines (flex-col)
    Each word is wrapped as <span><span data-word>word</span><span> </span></span>
    which mirrors the reference markup so wrapping behaves identically.
--}}
@props(['text' => null, 'lines' => null, 'lineClass' => 'text-left', 'wrapClass' => 'flex flex-col', 'pre' => false])
@php
    $source = $lines ?? [$text ?? trim((string) $slot)];
    $wordClass = $pre ? 'whitespace-pre-line' : '';
    $index = 0;
@endphp
@if ($lines)
<span class="{{ $wrapClass }}">
@foreach ($source as $line)
    <span class="{{ $lineClass }}" data-line>@foreach (preg_split('/\s+/', trim($line)) as $word)<span><span data-word class="{{ $wordClass }}" style="--i:{{ $index++ }}">{{ $word }}</span><span> </span></span>@endforeach</span>
@endforeach
</span>
@else
@foreach (preg_split('/\s+/', trim($source[0])) as $word)<span><span data-word class="{{ $wordClass }}" style="--i:{{ $index++ }}">{{ $word }}</span><span> </span></span>@endforeach
@endif
