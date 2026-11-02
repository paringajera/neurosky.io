<x-layouts.app :pageLabel="$pageLabel" title="Privacy Policy | NeuroSky">
    <section class="relative flex w-full flex-col" id="privacy">
        <div class="flex flex-col gap-60 pt-[12.2rem] pb-[9rem] md:gap-80 lg:pt-[var(--padding-y)] lg:pb-[var(--padding-y)]">
            <div class="w-calc flex flex-col gap-30 md:gap-80">
                <h1 class="type-z-34 md:type-z-80 max-w-919">Privacy Policy</h1>
                <hr class="h-1 w-full border-0 bg-current/10">
            </div>
            <div class="relative mx-auto flex w-[calc(100%-8rem)] flex-col gap-30 md:w-600 md:gap-60 lg:w-810">
                <div class="rich-text w-full">
                    @include('content.privacy-body')
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
