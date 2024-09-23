<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title & Favicon -->
        <link rel="icon" href="images/droplet.png" type="image/x-icon">
        <title>{{ Auth::guest() ? 'Reservoir' : 'Reservoir - App' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Young+Serif&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-midnight">
        @if (Auth::guest())
        <x-guest-nav />
        @else
        <x-user-nav />
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <x-footer></x-footer>
    </body>
</html>