@props(['label' => 'Home'])
@php($nav = config('neurosky.nav'))
<header class="css-header site-header fixed right-0 left-0 z-500 mx-auto flex flex-col items-center justify-center top-24 w-[calc(100vw-2.4rem)] sm:top-34 sm:w-338 sm:gap-10" data-header>
    <div class="site-header__pill relative flex w-full items-start overflow-clip bg-black/15 p-1 h-55 rounded-[12px]">
        <div class="site-header__pill-inner relative h-full w-full bg-white pt-0 rounded-[11px]">
            <div class="site-header__row relative flex h-full w-full pr-13 pl-28">
                <div class="flex w-full justify-between">
                    <div class="flex gap-25 [@media(max-width:320px)]:gap-15">
                        <a class="flex h-53 w-auto items-center" href="{{ route('home') }}" aria-label="NeuroSky Logo">
                            <x-icons.logo class="h-auto w-64 sm:w-80" />
                        </a>
                        <div class="relative mt-[1.4rem] mb-[1.4rem] flex h-fit w-156 flex-col [@media(max-width:320px)]:mt-[1.7rem] [@media(max-width:320px)]:mb-[1.7rem]">
                            <span class="font-neue inline-flex text-[1.5rem] leading-[160%] tracking-[0.015rem] capitalize [@media(max-width:320px)]:text-[1.25rem]" data-header-label>{{ $label }}</span>
                        </div>
                    </div>
                    <button type="button" class="flex-center mt-[0.95rem] h-36 w-36 rounded-full" aria-label="Menu" aria-expanded="false" aria-controls="site-nav" data-menu-toggle>
                        <x-icons.menu />
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-pink absolute right-25 bottom-0 left-25 h-2 origin-left" style="transform:scaleX(0)" data-scroll-progress aria-hidden="true"></div>
    </div>

    <nav id="site-nav" class="site-nav relative flex h-full w-[100vw] flex-col sm:w-full" aria-label="Main" data-menu-panel hidden>
        <div class="site-nav__frame relative flex size-full flex-col overflow-clip sm:bg-black/15 sm:p-1 rounded-[12px]">
            <div class="relative flex w-full bg-white rounded-[11px]">
                <div class="site-nav__body flex h-[calc(100svh-10.1rem)] w-full flex-col justify-between border-t-1 border-t-black/15 px-40 py-20 sm:h-auto sm:gap-48 sm:border-t-0 sm:px-24">
                    <div class="flex flex-col gap-20">
                        <div class="type-s-11 md:type-s-12 text-current/50">Menu</div>
                        <div class="flex flex-col gap-12">
                            @foreach ($nav as $item)
                                @php($active = $item['label'] === $label)
                                <a href="{{ route($item['route']) }}" class="group flex h-50 w-[26rem] items-center gap-12" aria-label="Link to {{ route($item['route'], [], false) }}" @if($active) aria-current="page" @endif>
                                    <div class="relative h-43 w-65 shrink-0 overflow-clip rounded-lg bg-current/20 sm:h-50 sm:w-75">
                                        <img src="{{ asset('media/images/'.$item['thumb']) }}" alt="{{ $item['label'] }}" width="150" height="100" loading="lazy" decoding="async" class="h-full w-full object-cover">
                                    </div>
                                    <span class="group-hover:text-pink text-[3.4rem] leading-[110%] font-normal tracking-[-0.102rem] transition-colors duration-300 {{ $active ? 'text-pink' : '' }}">{{ $item['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
