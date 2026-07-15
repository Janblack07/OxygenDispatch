<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Oxygen Dispatch') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <main class="min-h-screen bg-slate-50">
        <div class="mx-auto flex min-h-screen w-full flex-col items-center justify-center px-4 py-4">

            {{-- Logo --}}
            <a href="/" class="mb-2 inline-flex items-center justify-center">
                <x-application-logo class="h-24 w-auto object-contain sm:h-28" />
            </a>

            {{-- Contenido --}}
            <div class="flex w-full justify-center">
                {{ $slot }}
            </div>

        </div>
    </main>
</body>

</html>
