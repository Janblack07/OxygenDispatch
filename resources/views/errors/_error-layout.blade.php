@php
    $statusCode = $statusCode ?? 'Error';
    $title = $title ?? 'Ha ocurrido un error';
    $message = $message ?? 'No se pudo completar la solicitud.';
    $description = $description ?? 'Por favor, intente nuevamente o comuníquese con el administrador del sistema si el problema continúa.';
    $primaryActionLabel = $primaryActionLabel ?? 'Volver al inicio';
    $primaryActionUrl = $primaryActionUrl ?? url('/');
    $secondaryActionLabel = $secondaryActionLabel ?? null;
    $secondaryActionUrl = $secondaryActionUrl ?? null;

    $logoUrl = 'https://res.cloudinary.com/dv2gulc60/image/upload/v1772404076/OxigenDispatch/Logo_Distribuidora_tmn7yp.png';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="robots"
        content="noindex, nofollow"
    >

    <title>
        {{ $statusCode }} | {{ config('app.name', 'OxygenDispatch') }}
    </title>
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

    <style>
        :root {
            --page-bg: #f8fafc;
            --surface: #ffffff;
            --surface-soft: #f1f5f9;
            --border: #e2e8f0;
            --text: #0f172a;
            --muted: #64748b;
            --muted-strong: #475569;
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-soft: #eef2ff;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
            --radius-xl: 28px;
            --radius-lg: 18px;
            --radius-md: 12px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            font-family:
                Figtree,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            background:
                radial-gradient(circle at top left, rgba(79, 70, 229, 0.12), transparent 34%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.10), transparent 30%),
                var(--page-bg);
            color: var(--text);
        }

        .error-page {
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 18px;
        }

        .error-shell {
            width: min(100%, 980px);
            display: grid;
            grid-template-columns: 0.92fr 1.08fr;
            gap: 22px;
            align-items: stretch;
        }

        .error-brand-card,
        .error-content-card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(226, 232, 240, 0.95);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .error-brand-card {
            position: relative;
            overflow: hidden;
            padding: 28px;
            min-height: 420px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .error-brand-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(79, 70, 229, 0.10), transparent 42%),
                linear-gradient(315deg, rgba(14, 165, 233, 0.10), transparent 44%);
            pointer-events: none;
        }

        .error-brand-inner {
            position: relative;
            z-index: 1;
        }

        .error-logo-wrap {
            width: 128px;
            height: 128px;
            border-radius: 28px;
            background: #ffffff;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.10);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .error-logo {
            max-width: 104px;
            max-height: 104px;
            object-fit: contain;
            display: block;
        }

        .error-brand-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 30px;
            padding: 0 11px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .error-brand-title {
            margin: 0;
            font-size: 24px;
            line-height: 1.12;
            letter-spacing: -0.04em;
            color: var(--text);
        }

        .error-brand-text {
            margin: 12px 0 0;
            max-width: 360px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .error-brand-footer {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 10px;
            padding-top: 24px;
        }

        .error-mini-row {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted-strong);
            font-size: 13px;
            line-height: 1.45;
        }

        .error-mini-icon {
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            border-radius: 10px;
            background: var(--surface-soft);
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .error-content-card {
            padding: 34px;
            min-height: 420px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .error-code {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            min-height: 42px;
            padding: 0 15px;
            border-radius: 999px;
            background: var(--danger-soft);
            color: var(--danger);
            font-size: 15px;
            font-weight: 900;
            letter-spacing: 0.06em;
            margin-bottom: 18px;
        }

        .error-title {
            margin: 0;
            color: var(--text);
            font-size: clamp(30px, 4vw, 52px);
            line-height: 1;
            letter-spacing: -0.06em;
        }

        .error-message {
            margin: 16px 0 0;
            color: var(--muted-strong);
            font-size: 18px;
            line-height: 1.55;
            font-weight: 700;
        }

        .error-description {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.75;
        }

        .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .error-button {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 18px;
            border-radius: 14px;
            border: 1px solid transparent;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            transition:
                transform 0.16s ease,
                box-shadow 0.16s ease,
                background-color 0.16s ease,
                border-color 0.16s ease,
                color 0.16s ease;
        }

        .error-button:hover {
            transform: translateY(-1px);
        }

        .error-button.primary {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.22);
        }

        .error-button.primary:hover {
            background: var(--primary-dark);
        }

        .error-button.secondary {
            background: #ffffff;
            color: var(--muted-strong);
            border-color: var(--border);
        }

        .error-button.secondary:hover {
            color: var(--primary-dark);
            border-color: #c7d2fe;
            background: var(--primary-soft);
        }

        .error-note {
            margin-top: 22px;
            padding: 14px 16px;
            border-radius: var(--radius-lg);
            background: #f8fafc;
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .error-note strong {
            color: var(--text);
        }

        @media (max-width: 860px) {
            .error-page {
                padding: 20px 14px;
                align-items: flex-start;
            }

            .error-shell {
                grid-template-columns: 1fr;
            }

            .error-brand-card,
            .error-content-card {
                min-height: auto;
            }

            .error-brand-card {
                padding: 22px;
            }

            .error-content-card {
                padding: 24px;
            }

            .error-logo-wrap {
                width: 100px;
                height: 100px;
                border-radius: 22px;
                margin-bottom: 18px;
            }

            .error-logo {
                max-width: 82px;
                max-height: 82px;
            }

            .error-brand-footer {
                display: none;
            }
        }

        @media (max-width: 520px) {
            .error-actions {
                flex-direction: column;
            }

            .error-button {
                width: 100%;
            }

            .error-content-card {
                border-radius: 22px;
            }

            .error-brand-card {
                border-radius: 22px;
            }
        }
    </style>
</head>

<body>
    <main class="error-page">
        <section
            class="error-shell"
            aria-label="Página de error"
        >
            <aside class="error-brand-card">
                <div class="error-brand-inner">
                    <div class="error-logo-wrap">
                        <img
                            src="{{ $logoUrl }}"
                            alt="{{ config('app.name', 'OxygenDispatch') }}"
                            class="error-logo"
                        >
                    </div>

                    <div class="error-brand-kicker">
                        OxygenDispatch
                    </div>

                    <h1 class="error-brand-title">
                        Gestión segura de cilindros de oxígeno medicinal.
                    </h1>

                    <p class="error-brand-text">
                        El sistema protege la trazabilidad de lotes, tanques,
                        recepciones técnicas, despachos, movimientos y reportes.
                    </p>
                </div>

                <div class="error-brand-footer">
                    <div class="error-mini-row">
                        <span class="error-mini-icon">✓</span>
                        <span>Control operativo y documental del inventario.</span>
                    </div>

                    <div class="error-mini-row">
                        <span class="error-mini-icon">✓</span>
                        <span>Trazabilidad desde el ingreso hasta el despacho.</span>
                    </div>
                </div>
            </aside>

            <section class="error-content-card">
                <div class="error-code">
                    ERROR {{ $statusCode }}
                </div>

                <h2 class="error-title">
                    {{ $title }}
                </h2>

                <p class="error-message">
                    {{ $message }}
                </p>

                <p class="error-description">
                    {{ $description }}
                </p>

                <div class="error-actions">
                    <a
                        href="{{ $primaryActionUrl }}"
                        class="error-button primary"
                    >
                        {{ $primaryActionLabel }}
                    </a>

                    @if($secondaryActionLabel && $secondaryActionUrl)
                        <a
                            href="{{ $secondaryActionUrl }}"
                            class="error-button secondary"
                        >
                            {{ $secondaryActionLabel }}
                        </a>
                    @endif
                </div>

                <div class="error-note">
                    <strong>Nota:</strong>
                    si este mensaje aparece durante una operación importante,
                    no repita el proceso varias veces. Verifique el estado del registro
                    o comuníquese con el administrador del sistema.
                </div>
            </section>
        </section>
    </main>
</body>
</html>

