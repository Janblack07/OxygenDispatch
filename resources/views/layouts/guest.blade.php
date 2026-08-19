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
    <title>
        {{ config('app.name', 'Oxygen Dispatch') }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            background: #f8fafc;
        }

        .guest-page {
            min-height: 100vh;
            min-height: 100dvh;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 12px 16px;

            box-sizing: border-box;
        }

        .guest-logo {
            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 8px;
        }

        .guest-logo svg,
        .guest-logo img {
            width: auto;
            height: 112px;
            max-width: 100%;
            object-fit: contain;
        }

        .guest-content {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        @media (max-height: 720px) {
            .guest-page {
                justify-content: flex-start;
                padding-top: 8px;
                padding-bottom: 8px;
            }

            .guest-logo {
                margin-bottom: 4px;
            }

            .guest-logo svg,
            .guest-logo img {
                height: 84px;
            }
        }

        @media (max-width: 640px) {
            .guest-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .guest-logo svg,
            .guest-logo img {
                height: 88px;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">

    <main class="guest-page">

        {{-- Logo --}}
        <a
            href="/"
            class="guest-logo"
            aria-label="Inicio"
        >
            <x-application-logo />
        </a>

        {{-- Contenido --}}
        <div class="guest-content">
            {{ $slot }}
        </div>

    </main>

</body>

</html>
