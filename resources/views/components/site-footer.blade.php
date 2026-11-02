@php($footer = config('neurosky.footer'))
<footer class="relative w-full overflow-clip" data-footer>
    <div class="relative w-full bg-pink text-white lg:h-[60rem]" data-footer-panel style="transform:translateY(-200px)">
        <div class="absolute inset-0 size-full" aria-hidden="true">
            <div class="absolute inset-0 size-full">
                <div class="absolute inset-0" data-video-fade>
                    <video class="size-full object-fill" autoplay playsinline loop muted preload="none" data-video-lazy data-src="{{ asset('media/videos/'.$footer['video']) }}"></video>
                </div>
            </div>
            {{-- Pointer-driven light tunnel (hidden until the first mouse move, like the reference) --}}
            <div class="absolute inset-0 size-full" style="visibility:hidden;pointer-events:auto" data-footer-canvas>
                <canvas class="pointer-events-none size-full"></canvas>
            </div>
        </div>
        <div class="relative flex size-full flex-col justify-between gap-64 pt-60 pb-30 lg:gap-0 lg:pt-80 lg:pb-80" data-footer-content style="opacity:0">
            <div class="w-calc relative flex flex-col gap-30 lg:flex-row lg:justify-between lg:gap-0">
                <div class="flex w-full flex-col gap-30 lg:w-[68.4rem] lg:gap-32">
                    <div class="flex flex-col gap-16">
                        <h2 class="text-[2.4rem] leading-[110%] tracking-[-0.072rem] text-balance md:max-w-[40%] md:text-[4rem] md:tracking-[-0.12rem]">{{ str_replace("\n", ' ', $footer['heading']) }}</h2>
                        <div class="w-full">
                            <p class="font-neue text-[1.4rem] leading-[140%] tracking-[0.028rem] md:text-[1.5rem] md:tracking-[0.015rem]">
                                {{ $footer['contact'] }}<br>
                                @foreach ($footer['emails'] as $email)
                                    <a class="text-current/60 underline decoration-solid underline-offset-auto transition-colors hover:text-current" href="mailto:{{ $email }}">{{ $email }}</a>@if (! $loop->last)<span class="px-6 text-current/60">|</span>@endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex w-full flex-col gap-12 lg:w-[32.5rem] lg:gap-24">
                    <div class="type-s-11 md:type-s-12 text-current/60">About us</div>
                    <nav class="flex flex-col gap-4" aria-label="Footer">
                        <ul>
                            @foreach (config('neurosky.nav') as $item)
                                <li><a class="type-z-20 inline-flex transition-colors hover:text-current/80" href="{{ route($item['route']) }}" aria-label="Link to {{ route($item['route'], [], false) }}">{{ $item['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="flex items-start gap-12">
                    @foreach (config('neurosky.social') as $social)
                        <a class="flex h-[3.6rem] w-[3.6rem] cursor-pointer items-center justify-center rounded-full bg-white text-black transition-colors hover:bg-dark hover:text-white lg:h-[5rem] lg:w-[5rem]" href="{{ $social['href'] }}" target="_blank" rel="noopener noreferrer" aria-label="Link to {{ $social['href'] }}">
                        <x-dynamic-component :component="'icons.'.$social['icon']" />
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="w-calc relative flex flex-col gap-30 lg:flex-row lg:items-end lg:justify-between lg:gap-0">
                <div class="order-1 flex h-[8rem] w-full items-center justify-start lg:order-2 lg:h-[14rem] lg:w-[52.6rem] lg:justify-end">
                    <x-icons.logo-large class="h-auto w-[26rem] lg:w-[52.6rem]" />
                </div>
                <div class="order-2 flex flex-col gap-8 lg:order-1">
                    <div class="type-s-11 md:type-s-12 lg:type-s-11 text-current/60">© {{ date('Y') }} NeuroSky. All Rights Reserved.</div>
                    <div class="type-s-11 md:type-s-12 lg:type-s-11 flex gap-12 lg:gap-24">
                        <a class="transition-colors hover:text-current/80" href="{{ route('privacy') }}">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
