@props(['title'])
@php($shareUrl = url()->current())
<div class="relative z-10" data-share>
    <div class="share-menu absolute top-34 left-0 w-fit min-w-124 rounded-[8px] bg-black/15 p-1" data-share-menu>
        <div class="relative h-full w-full rounded-[7px] bg-white">
            <div class="border-b border-b-black/15">
                <button type="button" class="type-s-12 flex h-36 w-full flex-row flex-nowrap items-center justify-start gap-x-10 px-12 text-nowrap bg-white text-black/50 hover:bg-cream-light hover:text-black rounded-t-[7px]" data-share-copy>
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M4.5 7.5L7.5 4.5M5 3L5.6 2.4A2.5 2.5 0 0 1 9.6 5.9L9 6.5M7 9L6.4 9.6A2.5 2.5 0 0 1 2.4 6.1L3 5.5" stroke="currentColor" stroke-linecap="round"/></svg>
                    <span>Copy link</span>
                </button>
            </div>
            <div class="border-b border-b-black/15">
                <a class="type-s-12 flex h-36 w-full flex-row flex-nowrap items-center justify-start gap-x-10 px-12 text-nowrap bg-white text-black/50 hover:bg-cream-light hover:text-black" href="https://x.com/intent/post?text={{ rawurlencode($title) }}&url={{ rawurlencode($shareUrl) }}" target="_blank" rel="noopener noreferrer">
                    <x-icons.x class="h-12 w-12" />
                    <span>on X</span>
                </a>
            </div>
            <div>
                <a class="type-s-12 flex h-36 w-full flex-row flex-nowrap items-center justify-start gap-x-10 px-12 text-nowrap bg-white text-black/50 hover:bg-cream-light hover:text-black rounded-b-[7px]" href="https://www.linkedin.com/sharing/share-offsite/?url={{ rawurlencode($shareUrl) }}" target="_blank" rel="noopener noreferrer">
                    <x-icons.linkedin class="h-12 w-12" />
                    <span>on Linkedin</span>
                </a>
            </div>
        </div>
    </div>
    <button type="button" class="group relative flex flex-row items-center gap-x-16" aria-expanded="false" data-share-toggle>
        <div class="flex h-24 w-24 items-center justify-center rounded-[2.4rem] border border-solid border-black/15 bg-white transition-colors group-hover:border-pink group-hover:bg-pink">
            <svg class="stroke-black group-hover:stroke-white" width="10" height="10" viewBox="0 0 10 10" fill="none" aria-hidden="true"><path d="M5 1V6.5M5 1L3 3M5 1L7 3M1.5 5.5V8.5H8.5V5.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <span class="type-s-12 text-black">Share</span>
    </button>
</div>
