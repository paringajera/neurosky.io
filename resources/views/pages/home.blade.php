@php($home = require resource_path('content/home.php'))
<x-layouts.app :pageLabel="$pageLabel">
    <div class="flex flex-col">
        <section class="relative flex w-full flex-col" id="overview">
            @include('pages.home.hero', ['hero' => $home['hero']])
            @include('pages.home.collage', ['collage' => $home['collage']])
            @include('pages.home.benefits', ['benefits' => $home['benefits']])
        </section>

        <section class="relative flex w-full flex-col" id="technology">
            @include('pages.home.technology', ['technology' => $home['technology']])
            @include('pages.home.cards', ['cards' => $home['technology']['cards']])
        </section>

        @include('pages.home.safety', ['safety' => $home['safety']])

        <section class="relative flex w-full flex-col" id="partnerships">
            @include('pages.home.partners', ['partners' => $home['partners']])
        </section>

        <x-insights-carousel :articles="$articles" :heading="$home['insights']['heading']" :body="$home['insights']['body']" />

        @include('pages.home.careers', ['careers' => $home['careers']])
    </div>
</x-layouts.app>
