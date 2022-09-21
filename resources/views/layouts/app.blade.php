<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" html class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased">

        <div class="min-h-full">

            <x-layout.header />

            <main class="-mt-24 pb-8">
                <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                    {{ $slot }}
                </div>
            </main>

        </div>

        @stack('scripts')
        @livewireScripts
    </body>
</html>
