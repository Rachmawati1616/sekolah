<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="background-image: url('{{ asset('images/bg-login.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
            
            <div class="absolute inset-0 bg-blue-900/40 backdrop-blur-sm z-0"></div>

            <div class="z-10 flex flex-col items-center">
                <a href="/">
                    <x-application-logo class="w-24 h-24 fill-current text-white drop-shadow-md" />
                </a>
                <h1 class="text-3xl font-bold text-white mt-4 drop-shadow-md tracking-wider">PRESENSI SD N DEYANGAN 2</h1>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-6 py-8 bg-white/90 backdrop-blur-md shadow-2xl overflow-hidden sm:rounded-2xl z-10 border border-white/40">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
