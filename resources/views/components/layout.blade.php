<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Young+Serif&display=swap" rel="stylesheet">

        <title>Reservoir</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-midnight">
        <x-new-navbar></x-new-navbar>
        {{ $slot }}
    </body>
    <x-footer></x-footer>
</html>