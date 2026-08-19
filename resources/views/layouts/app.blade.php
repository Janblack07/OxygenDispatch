<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Oxygen Dispatch') }}</title>

    {{-- Fuente --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    >
   <link
    rel="icon"
    type="image/png"
    href="https://res.cloudinary.com/dv2gulc60/image/upload/v1772404076/OxigenDispatch/Logo_Distribuidora_tmn7yp.png"
>

<link
    rel="shortcut icon"
    type="image/png"
    href="https://res.cloudinary.com/dv2gulc60/image/upload/v1772404076/OxigenDispatch/Logo_Distribuidora_tmn7yp.png"
>

<link
    rel="apple-touch-icon"
    href="https://res.cloudinary.com/dv2gulc60/image/upload/v1772404076/OxigenDispatch/Logo_Distribuidora_tmn7yp.png"
>

    {{-- Assets --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            min-height: 100%;
            background: #f8fafc;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f8fafc;
            color: #0f172a;
            font-family: 'Figtree', sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .app-shell {
            min-height: 100vh;
            background: #f8fafc;
        }

        .app-header {
            position: relative;
            z-index: 20;
            width: 100%;
            border-bottom: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .app-header-inner {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 18px 16px;
        }

        .app-main {
            position: relative;
            width: 100%;
            min-height: calc(100vh - 128px);
            background: #f8fafc;
        }

        @media (min-width: 640px) {
            .app-header-inner {
                padding-left: 24px;
                padding-right: 24px;
            }
        }

        @media (min-width: 1024px) {
            .app-header-inner {
                padding-left: 0;
                padding-right: 0;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="app-shell">

        {{-- Navbar --}}
        @include('layouts.navigation')

        {{-- Encabezado de página --}}
        @isset($header)
            <header class="app-header">
                <div class="app-header-inner">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Contenido --}}
        <main class="app-main">
            {{ $slot }}
        </main>

    </div>

</body>

</html>
