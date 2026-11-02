<div class="relative flex h-64 w-full max-w-[calc(100vw-2.4rem)] sm:w-338 md:h-auto lg:w-370 lg:max-w-370">
    <a class="group text-foreground relative flex size-full items-center justify-between gap-20 overflow-clip rounded-[1.2rem] pr-24 pl-28 transition-colors hover:bg-cream-light md:py-12 lg:pl-12" href="{{ route('careers') }}" aria-label="Link to /careers">
        <div class="flex items-center gap-16">
            <div class="bg-dark relative hidden h-[6rem] w-[8.2rem] shrink-0 overflow-hidden rounded-[0.4rem] lg:flex">
                <img class="h-full w-full object-cover" src="{{ asset('media/images/profile/team-engineering.jpg') }}" alt="" loading="lazy">
            </div>
            <div class="flex min-w-0 grow flex-col justify-center text-left">
                <p class="type-s-11 md:type-s-12 text-current/60">Build the future of logistics with us</p>
                <p class="type-s-11 md:type-s-12 text-balance text-current">Explore open positions</p>
            </div>
        </div>
        <div class="text-foreground flex h-24 w-24 shrink-0 items-center justify-center rounded-full border border-current/25 p-[1rem] transition-colors group-hover:border-transparent group-hover:bg-pink group-hover:text-white">
            <div class="relative h-8 w-8">
                <x-icons.arrow-right class="-rotate-45" />
            </div>
        </div>
    </a>
</div>
