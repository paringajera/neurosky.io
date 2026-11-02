<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ?? config('neurosky.title') }}</title>
    <meta name="description" content="{{ $description ?? config('neurosky.description') }}">
    <link rel="icon" href="{{ asset('media/images/favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('media/images/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('media/images/apple-touch-icon.png') }}">
    <link rel="preload" href="{{ Vite::asset('resources/fonts/F37ZagmaSerif-Book.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ Vite::asset('resources/fonts/NeueHaasGroteskText-RoundDots-65Medium.woff2') }}" as="font" type="font/woff2" crossorigin>
    <script>
        // Restore the dismissed state of the announcement banner before paint.
        try { if (sessionStorage.getItem('neurosky:banner') === 'dismissed') document.documentElement.classList.add('banner-dismissed'); } catch (e) {}
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $head ?? '' }}
</head>
<body class="antialiased" data-page="{{ $pageLabel ?? 'Home' }}">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-[1001] focus:rounded-full focus:bg-pink focus:px-16 focus:py-8 focus:text-white type-s-12">Skip to content</a>

    <x-announcement-banner />
    <x-site-header :label="$pageLabel ?? 'Home'" />

    <main id="main" class="relative min-h-svh w-full">
        {{ $slot }}
    </main>

    <x-site-footer />
    <x-cookie-banner />
</body>
</html>
