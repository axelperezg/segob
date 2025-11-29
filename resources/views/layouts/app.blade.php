<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    {{-- Meta tags --}}
    <meta name="description" content="{{ $appSettings['meta_description'] ?? config('app.name') }}">
    <title>{{ $title ?? $appSettings['meta_title'] ?? config('app.name') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <script src="https://kit.fontawesome.com/43a8eadd9b.js" crossorigin="anonymous"></script>

    {{-- Favicon --}}
    <x-favicon />

    {{-- Vite Assets --}}
    @vite(['resources/js/app-blade.js', 'resources/css/app.css'])

    {{-- Additional Head Content --}}
    @stack('head')
</head>

<body class="font-montserrat">
    <main class="px-4 pt-8 mx-auto">
        {{-- Top Bar --}}
        <x-layout.top-bar />

        {{-- Header --}}
        <x-layout.header />

        {{-- Main Menu --}}
        <x-layout.main-menu />

        {{-- Page Content --}}
        <div class="pt-8">
            @yield('content')
        </div>
    </main>

    {{-- Spacing --}}
    <div class="pt-12"></div>

    {{-- Footer --}}
    <x-layout.footer />

    {{-- Additional Scripts --}}
    @stack('scripts')
</body>

</html>
