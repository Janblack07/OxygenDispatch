<x-app-layout>
    @php
        /*
        |--------------------------------------------------------------------------
        | KPI actuales
        |--------------------------------------------------------------------------
        */

        $available = (int) ($counts['disponible'] ?? 0);
        $dispatched = (int) ($counts['despachado'] ?? 0);
        $decommissioned = (int) ($counts['baja'] ?? 0);

        $quarantine = (int) ($counts['tanques_cuarentena'] ?? 0);
        $pendingTechnical = (int) ($counts['tanques_pendientes_tecnicos'] ?? 0);
        $rejected = (int) ($counts['tanques_rechazados'] ?? 0);

        $dispatchesTotal = (int) ($counts['despachos_realizados'] ?? 0);
        $dispatchedTanksTotal = (int) ($counts['tanques_despachados_total'] ?? 0);

        $dispatchesToday = (int) ($counts['despachos_hoy'] ?? 0);
        $dispatchedTanksToday = (int) ($counts['tanques_despachados_hoy'] ?? 0);

        $clientsTotal = (int) ($counts['clientes_atendidos'] ?? 0);
        $movementsTotal = (int) ($counts['movimientos_total'] ?? 0);
        $batchesTotal = (int) ($counts['lotes_registrados'] ?? 0);

        /*
        |--------------------------------------------------------------------------
        | Dona de estado operativo
        |--------------------------------------------------------------------------
        */

        $inventoryChart = [
            [
                'label' => 'Disponibles',
                'value' => $available,
                'color' => '#10b981',
            ],
            [
                'label' => 'Despachados',
                'value' => $dispatched,
                'color' => '#0ea5e9',
            ],
            [
                'label' => 'Baja',
                'value' => $decommissioned,
                'color' => '#f43f5e',
            ],
            [
                'label' => 'Cuarentena',
                'value' => $quarantine,
                'color' => '#f59e0b',
            ],
            [
                'label' => 'Pendientes técnicos',
                'value' => $pendingTechnical,
                'color' => '#8b5cf6',
            ],
            [
                'label' => 'Rechazados / retiro',
                'value' => $rejected,
                'color' => '#ef4444',
            ],
        ];

        $inventoryTotal = collect($inventoryChart)->sum('value');

        $gradientParts = [];
        $currentPercentage = 0;

        foreach ($inventoryChart as $item) {
            if ($inventoryTotal <= 0 || $item['value'] <= 0) {
                continue;
            }

            $percentage = ($item['value'] / $inventoryTotal) * 100;
            $endPercentage = $currentPercentage + $percentage;

            $gradientParts[] =
                $item['color']
                . ' '
                . number_format($currentPercentage, 4, '.', '')
                . '% '
                . number_format($endPercentage, 4, '.', '')
                . '%';

            $currentPercentage = $endPercentage;
        }

        $donutGradient = count($gradientParts) > 0
            ? 'conic-gradient(' . implode(', ', $gradientParts) . ')'
            : 'conic-gradient(#e2e8f0 0% 100%)';

        /*
        |--------------------------------------------------------------------------
        | Barras históricas
        |--------------------------------------------------------------------------
        */

        $historicalBars = [
            [
                'label' => 'Tanques despachados',
                'value' => $dispatchedTanksTotal,
                'class' => 'cyan',
            ],
            [
                'label' => 'Movimientos totales',
                'value' => $movementsTotal,
                'class' => 'violet',
            ],
            [
                'label' => 'Despachos realizados',
                'value' => $dispatchesTotal,
                'class' => 'indigo',
            ],
            [
                'label' => 'Clientes atendidos',
                'value' => $clientsTotal,
                'class' => 'emerald',
            ],
            [
                'label' => 'Lotes registrados',
                'value' => $batchesTotal,
                'class' => 'amber',
            ],
        ];

        $historicalMax = max(
            1,
            collect($historicalBars)->max('value')
        );

        /*
        |--------------------------------------------------------------------------
        | Actividad de hoy
        |--------------------------------------------------------------------------
        */

        $todayActivityTotal = $dispatchesToday + $dispatchedTanksToday;
    @endphp

    <x-slot name="header">
        <div class="dashboard-header-layout">
            <div>
                <h2 class="dashboard-page-title">
                    Dashboard
                </h2>

                <p class="dashboard-page-subtitle">
                    Resumen de disponibilidad, revisión técnica, operación y trazabilidad.
                </p>
            </div>

            <span class="dashboard-live-badge">
                <span class="dashboard-live-dot"></span>
                Estado actual
            </span>
        </div>
    </x-slot>

    <style>
        /*
        |--------------------------------------------------------------------------
        | Página
        |--------------------------------------------------------------------------
        */

        .oxygen-dashboard-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .oxygen-dashboard-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .dashboard-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .dashboard-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .dashboard-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .dashboard-live-badge {
            flex-shrink: 0;
            min-height: 30px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 0 10px;
            border: 1px solid #a7f3d0;
            border-radius: 999px;
            background: #ecfdf5;
            color: #047857;
            font-size: 10px;
            font-weight: 700;
        }

        .dashboard-live-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12);
        }

        /*
        |--------------------------------------------------------------------------
        | Secciones
        |--------------------------------------------------------------------------
        */

        .dashboard-section {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .dashboard-section + .dashboard-section,
        .dashboard-section + .dashboard-analytics-grid,
        .dashboard-analytics-grid + .dashboard-section {
            margin-top: 20px;
        }

        .dashboard-section-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .dashboard-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            line-height: 1.4;
            font-weight: 700;
        }

        .dashboard-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .dashboard-section-body {
            padding: 18px 20px;
        }

        /*
        |--------------------------------------------------------------------------
        | KPI cards
        |--------------------------------------------------------------------------
        */

        .dashboard-kpi-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .dashboard-kpi-card {
            position: relative;
            min-width: 0;
            min-height: 118px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 17px;
            border: 1px solid #dbe3ef;
            border-radius: 14px;
            background: #ffffff;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
        }

        .dashboard-kpi-card::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: var(--kpi-accent, #64748b);
        }

        .dashboard-kpi-main {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .dashboard-kpi-icon {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: var(--kpi-soft, #f1f5f9);
            color: var(--kpi-accent, #64748b);
        }

        .dashboard-kpi-icon svg {
            width: 22px;
            height: 22px;
        }

        .dashboard-kpi-content {
            min-width: 0;
        }

        .dashboard-kpi-label {
            color: #64748b;
            font-size: 11px;
            line-height: 1.35;
            font-weight: 500;
        }

        .dashboard-kpi-value {
            margin-top: 2px;
            color: #020617;
            font-size: 29px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -0.035em;
        }

        .dashboard-kpi-caption {
            margin-top: 12px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.45;
        }

        /*
        |--------------------------------------------------------------------------
        | Colores KPI
        |--------------------------------------------------------------------------
        */

        .dashboard-kpi-card.emerald {
            --kpi-accent: #10b981;
            --kpi-soft: #ecfdf5;
        }

        .dashboard-kpi-card.sky {
            --kpi-accent: #0ea5e9;
            --kpi-soft: #eff6ff;
        }

        .dashboard-kpi-card.rose {
            --kpi-accent: #f43f5e;
            --kpi-soft: #fff1f2;
        }

        .dashboard-kpi-card.amber {
            --kpi-accent: #f59e0b;
            --kpi-soft: #fffbeb;
        }

        .dashboard-kpi-card.violet {
            --kpi-accent: #8b5cf6;
            --kpi-soft: #f5f3ff;
        }

        .dashboard-kpi-card.red {
            --kpi-accent: #ef4444;
            --kpi-soft: #fef2f2;
        }

        .dashboard-kpi-card.indigo {
            --kpi-accent: #6366f1;
            --kpi-soft: #eef2ff;
        }

        .dashboard-kpi-card.cyan {
            --kpi-accent: #06b6d4;
            --kpi-soft: #ecfeff;
        }

        .dashboard-kpi-card.blue {
            --kpi-accent: #2563eb;
            --kpi-soft: #eff6ff;
        }

        .dashboard-kpi-card.fuchsia {
            --kpi-accent: #c026d3;
            --kpi-soft: #fdf4ff;
        }

        .dashboard-kpi-card.slate {
            --kpi-accent: #64748b;
            --kpi-soft: #f8fafc;
        }

        /*
        |--------------------------------------------------------------------------
        | Zona analítica
        |--------------------------------------------------------------------------
        */

        .dashboard-analytics-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(320px, .8fr);
            gap: 20px;
            align-items: stretch;
        }

        .dashboard-analytic-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .dashboard-analytic-header {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .dashboard-analytic-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .dashboard-analytic-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .dashboard-analytic-body {
            padding: 20px;
        }

        /*
        |--------------------------------------------------------------------------
        | Dona
        |--------------------------------------------------------------------------
        */

        .dashboard-inventory-chart-layout {
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            gap: 26px;
            align-items: center;
        }

        .dashboard-donut-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-donut {
            width: 218px;
            height: 218px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: {{ $donutGradient }};
            box-shadow:
                inset 0 0 0 1px rgba(15, 23, 42, 0.03),
                0 12px 30px rgba(15, 23, 42, 0.06);
        }

        .dashboard-donut::after {
            content: '';
            position: absolute;
            width: 142px;
            height: 142px;
            border: 1px solid #f1f5f9;
            border-radius: 50%;
            background: #ffffff;
            box-shadow:
                0 4px 14px rgba(15, 23, 42, 0.04);
        }

        .dashboard-donut-center {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .dashboard-donut-label {
            display: block;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .dashboard-donut-value {
            display: block;
            margin-top: 4px;
            color: #020617;
            font-size: 30px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -0.035em;
        }

        .dashboard-donut-caption {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 9px;
        }

        /*
        |--------------------------------------------------------------------------
        | Leyenda de dona
        |--------------------------------------------------------------------------
        */

        .dashboard-chart-legend {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 9px;
        }

        .dashboard-chart-legend-item {
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 11px 12px;
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            background: #f8fafc;
        }

        .dashboard-chart-legend-main {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dashboard-chart-dot {
            width: 8px;
            height: 8px;
            flex-shrink: 0;
            border-radius: 999px;
        }

        .dashboard-chart-legend-label {
            overflow: hidden;
            color: #64748b;
            font-size: 10px;
            font-weight: 600;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dashboard-chart-legend-value {
            flex-shrink: 0;
            color: #0f172a;
            font-size: 12px;
            font-weight: 800;
        }

        /*
        |--------------------------------------------------------------------------
        | Hoy
        |--------------------------------------------------------------------------
        */

        .dashboard-today-body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .dashboard-today-hero {
            position: relative;
            overflow: hidden;
            padding: 18px;
            border: 1px solid #c7d2fe;
            border-radius: 14px;
            background:
                linear-gradient(
                    135deg,
                    rgba(79, 70, 229, 0.10),
                    rgba(14, 165, 233, 0.06)
                );
        }

        .dashboard-today-hero::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            top: -55px;
            right: -40px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.09);
        }

        .dashboard-today-overline {
            position: relative;
            z-index: 1;
            color: #4338ca;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .dashboard-today-total {
            position: relative;
            z-index: 1;
            margin-top: 6px;
            color: #0f172a;
            font-size: 36px;
            line-height: 1;
            font-weight: 850;
            letter-spacing: -0.04em;
        }

        .dashboard-today-description {
            position: relative;
            z-index: 1;
            margin-top: 7px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.45;
        }

        .dashboard-today-metrics {
            margin-top: 12px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .dashboard-today-metric {
            padding: 13px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
        }

        .dashboard-today-metric-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .dashboard-today-metric-value {
            margin-top: 5px;
            color: #0f172a;
            font-size: 24px;
            line-height: 1;
            font-weight: 800;
        }

        .dashboard-today-metric.dispatches {
            border-color: #c7d2fe;
        }

        .dashboard-today-metric.dispatches .dashboard-today-metric-value {
            color: #4f46e5;
        }

        .dashboard-today-metric.tanks {
            border-color: #a5f3fc;
        }

        .dashboard-today-metric.tanks .dashboard-today-metric-value {
            color: #0891b2;
        }

        .dashboard-today-note {
            margin-top: auto;
            padding-top: 14px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Barras históricas
        |--------------------------------------------------------------------------
        */

        .dashboard-bars {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .dashboard-bar-row {
            display: grid;
            grid-template-columns: 190px minmax(0, 1fr) 70px;
            align-items: center;
            gap: 14px;
        }

        .dashboard-bar-label {
            min-width: 0;
            overflow: hidden;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dashboard-bar-track {
            height: 11px;
            overflow: hidden;
            border-radius: 999px;
            background: #f1f5f9;
        }

        .dashboard-bar-fill {
            height: 100%;
            min-width: 3px;
            border-radius: inherit;
            transform-origin: left center;
        }

        .dashboard-bar-fill.indigo {
            background:
                linear-gradient(
                    90deg,
                    #6366f1,
                    #818cf8
                );
        }

        .dashboard-bar-fill.cyan {
            background:
                linear-gradient(
                    90deg,
                    #0891b2,
                    #22d3ee
                );
        }

        .dashboard-bar-fill.violet {
            background:
                linear-gradient(
                    90deg,
                    #7c3aed,
                    #a78bfa
                );
        }

        .dashboard-bar-fill.emerald {
            background:
                linear-gradient(
                    90deg,
                    #059669,
                    #34d399
                );
        }

        .dashboard-bar-fill.amber {
            background:
                linear-gradient(
                    90deg,
                    #d97706,
                    #fbbf24
                );
        }

        .dashboard-bar-value {
            color: #0f172a;
            font-size: 12px;
            font-weight: 800;
            text-align: right;
        }

        .dashboard-bars-footer {
            margin-top: 17px;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1000px) {
            .dashboard-analytics-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-inventory-chart-layout {
                grid-template-columns: 220px minmax(0, 1fr);
            }
        }

        @media (max-width: 800px) {
            .dashboard-kpi-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-inventory-chart-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-chart-legend {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-bar-row {
                grid-template-columns: 150px minmax(0, 1fr) 55px;
            }
        }

        @media (max-width: 640px) {
            .oxygen-dashboard-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .dashboard-header-layout {
                flex-direction: column;
            }

            .dashboard-kpi-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-chart-legend {
                grid-template-columns: 1fr;
            }

            .dashboard-donut {
                width: 200px;
                height: 200px;
            }

            .dashboard-donut::after {
                width: 132px;
                height: 132px;
            }

            .dashboard-bar-row {
                grid-template-columns: 1fr auto;
                gap: 7px 12px;
            }

            .dashboard-bar-track {
                grid-column: 1 / -1;
                grid-row: 2;
            }

            .dashboard-bar-value {
                grid-column: 2;
                grid-row: 1;
            }
        }
    </style>

    <div class="oxygen-dashboard-page">
        <div class="oxygen-dashboard-container">

            {{-- ============================================================
                 DISPONIBILIDAD Y ESTADO TÉCNICO
            ============================================================ --}}

            <section class="dashboard-section">
                <div class="dashboard-section-header">
                    <div>
                        <h3 class="dashboard-section-title">
                            Disponibilidad y estado técnico
                        </h3>

                        <p class="dashboard-section-subtitle">
                            Resumen de disponibilidad, revisión técnica y estado operativo.
                        </p>
                    </div>
                </div>

                <div class="dashboard-section-body">
                    <div class="dashboard-kpi-grid">

                        {{-- Disponibles --}}
                        <article class="dashboard-kpi-card emerald">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5.25 6.75A2.25 2.25 0 0 1 7.5 4.5h9a2.25 2.25 0 0 1 2.25 2.25v12A2.25 2.25 0 0 1 16.5 21h-9a2.25 2.25 0 0 1-2.25-2.25v-12Z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8.25 8.25h.008v.008H8.25V8.25Zm3.75 0h.008v.008H12V8.25Zm3.75 0h.008v.008h-.008V8.25ZM8.25 12h7.5"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Disponibles
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($available) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Aprobados y listos para despacho
                            </div>
                        </article>

                        {{-- Despachados --}}
                        <article class="dashboard-kpi-card sky">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.75 6.75h10.5v10.5H3.75V6.75Zm10.5 3h3.25l2.75 3.5v4h-6v-7.5Z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M7.5 20.25a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm9 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Despachados
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($dispatched) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Actualmente fuera de almacén
                            </div>
                        </article>

                        {{-- Baja --}}
                        <article class="dashboard-kpi-card rose">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v3.75m9.303 3.376c.866 1.5-.217 3.374-1.948 3.374H4.645c-1.73 0-2.813-1.874-1.948-3.374l7.355-12.75c.866-1.5 3.03-1.5 3.896 0l7.355 12.75Z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 16.5h.008v.008H12V16.5Z"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Baja
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($decommissioned) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Retirados definitivamente
                            </div>
                        </article>

                        {{-- Cuarentena --}}
                        <article class="dashboard-kpi-card amber">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m5.25 12.75 4.5 4.5 9-10.5"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Cuarentena
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($quarantine) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Unidades temporalmente aisladas
                            </div>
                        </article>

                        {{-- Pendientes técnicos --}}
                        <article class="dashboard-kpi-card violet">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m9 18 6-6-6-6"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Pendientes técnicos
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($pendingTechnical) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Esperando revisión y aprobación
                            </div>
                        </article>

                        {{-- Rechazados --}}
                        <article class="dashboard-kpi-card red">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 18 18 6M6 6l12 12"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Rechazados / retiro
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($rejected) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                En devolución o retiro de mercado
                            </div>
                        </article>

                    </div>
                </div>
            </section>

            {{-- ============================================================
                 ANÁLISIS VISUAL
            ============================================================ --}}

            <div class="dashboard-analytics-grid">

                {{-- Dona --}}
                <section class="dashboard-analytic-card">
                    <div class="dashboard-analytic-header">
                        <h3 class="dashboard-analytic-title">
                            Estado operativo del inventario
                        </h3>

                        <p class="dashboard-analytic-subtitle">
                            Distribución actual de las unidades según su condición operativa y técnica.
                        </p>
                    </div>

                    <div class="dashboard-analytic-body">
                        <div class="dashboard-inventory-chart-layout">

                            <div class="dashboard-donut-wrapper">
                                <div
                                    class="dashboard-donut"
                                    role="img"
                                    aria-label="Distribución del inventario por estado"
                                >
                                    <div class="dashboard-donut-center">
                                        <span class="dashboard-donut-label">
                                            Total unidades
                                        </span>

                                        <strong class="dashboard-donut-value">
                                            {{ number_format($inventoryTotal) }}
                                        </strong>

                                        <span class="dashboard-donut-caption">
                                            registradas por estado
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-chart-legend">
                                @foreach($inventoryChart as $item)
                                    <div class="dashboard-chart-legend-item">
                                        <div class="dashboard-chart-legend-main">
                                            <span
                                                class="dashboard-chart-dot"
                                                style="background: {{ $item['color'] }};"
                                            ></span>

                                            <span
                                                class="dashboard-chart-legend-label"
                                                title="{{ $item['label'] }}"
                                            >
                                                {{ $item['label'] }}
                                            </span>
                                        </div>

                                        <strong class="dashboard-chart-legend-value">
                                            {{ number_format($item['value']) }}
                                        </strong>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </section>

                {{-- Actividad de hoy --}}
                <section class="dashboard-analytic-card">
                    <div class="dashboard-analytic-header">
                        <h3 class="dashboard-analytic-title">
                            Actividad de hoy
                        </h3>

                        <p class="dashboard-analytic-subtitle">
                            Operación registrada durante la jornada actual.
                        </p>
                    </div>

                    <div class="dashboard-analytic-body dashboard-today-body">

                        <div class="dashboard-today-hero">
                            <div class="dashboard-today-overline">
                                Actividad operacional
                            </div>

                            <div class="dashboard-today-total">
                                {{ number_format($todayActivityTotal) }}
                            </div>

                            <div class="dashboard-today-description">
                                Suma de despachos realizados y tanques movilizados hoy.
                            </div>
                        </div>

                        <div class="dashboard-today-metrics">
                            <div class="dashboard-today-metric dispatches">
                                <div class="dashboard-today-metric-label">
                                    Despachos
                                </div>

                                <div class="dashboard-today-metric-value">
                                    {{ number_format($dispatchesToday) }}
                                </div>
                            </div>

                            <div class="dashboard-today-metric tanks">
                                <div class="dashboard-today-metric-label">
                                    Tanques
                                </div>

                                <div class="dashboard-today-metric-value">
                                    {{ number_format($dispatchedTanksToday) }}
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-today-note">
                            Los valores corresponden a las operaciones registradas en el sistema durante el día actual.
                        </div>

                    </div>
                </section>

            </div>

            {{-- ============================================================
                 OPERACIÓN Y TRAZABILIDAD
            ============================================================ --}}

            <section class="dashboard-section">
                <div class="dashboard-section-header">
                    <div>
                        <h3 class="dashboard-section-title">
                            Operación y trazabilidad
                        </h3>

                        <p class="dashboard-section-subtitle">
                            Indicadores acumulados de despachos, clientes, movimientos y lotes.
                        </p>
                    </div>
                </div>

                <div class="dashboard-section-body">
                    <div class="dashboard-kpi-grid">

                        {{-- Despachos realizados --}}
                        <article class="dashboard-kpi-card indigo">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3.75 9h16.5m-15 12h13.5a1.5 1.5 0 0 0 1.5-1.5V6.75a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5V19.5a1.5 1.5 0 0 0 1.5 1.5Z"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Despachos realizados
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($dispatchesTotal) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Total histórico de operaciones
                            </div>
                        </article>

                        {{-- Tanques despachados --}}
                        <article class="dashboard-kpi-card cyan">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 3h6m-4.5 0v3m3-3v3M8.25 6h7.5A2.25 2.25 0 0 1 18 8.25v10.5A2.25 2.25 0 0 1 15.75 21h-7.5A2.25 2.25 0 0 1 6 18.75V8.25A2.25 2.25 0 0 1 8.25 6Z"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Tanques despachados total
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($dispatchedTanksTotal) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Unidades movilizadas históricamente
                            </div>
                        </article>

                        {{-- Despachos hoy --}}
                        <article class="dashboard-kpi-card emerald">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Despachos hoy
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($dispatchesToday) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Operaciones realizadas hoy
                            </div>
                        </article>

                        {{-- Tanques hoy --}}
                        <article class="dashboard-kpi-card cyan">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 3h6m-4.5 0v3m3-3v3M8.25 6h7.5A2.25 2.25 0 0 1 18 8.25v10.5A2.25 2.25 0 0 1 15.75 21h-7.5A2.25 2.25 0 0 1 6 18.75V8.25A2.25 2.25 0 0 1 8.25 6Z"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Tanques despachados hoy
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($dispatchedTanksToday) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Unidades movilizadas hoy
                            </div>
                        </article>

                        {{-- Clientes --}}
                        <article class="dashboard-kpi-card fuchsia">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Clientes atendidos
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($clientsTotal) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Clientes con despachos registrados
                            </div>
                        </article>

                        {{-- Movimientos --}}
                        <article class="dashboard-kpi-card violet">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 7.5h12m0 0-3-3m3 3-3 3M21 16.5H9m0 0 3-3m-3 3 3 3"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Movimientos total
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($movementsTotal) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Registro histórico de trazabilidad
                            </div>
                        </article>

                        {{-- Lotes --}}
                        <article class="dashboard-kpi-card slate">
                            <div class="dashboard-kpi-main">
                                <div class="dashboard-kpi-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 8.25 12 3 3 8.25m18 0L12 13.5m9-5.25v7.5L12 21m0-7.5L3 8.25m9 5.25V21m-9-12.75v7.5L12 21"
                                        />
                                    </svg>
                                </div>

                                <div class="dashboard-kpi-content">
                                    <div class="dashboard-kpi-label">
                                        Lotes registrados
                                    </div>

                                    <div class="dashboard-kpi-value">
                                        {{ number_format($batchesTotal) }}
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-kpi-caption">
                                Lotes ingresados al sistema
                            </div>
                        </article>

                    </div>
                </div>
            </section>

            {{-- ============================================================
                 GRÁFICO DE BARRAS
            ============================================================ --}}

            <section class="dashboard-section">
                <div class="dashboard-section-header">
                    <div>
                        <h3 class="dashboard-section-title">
                            Indicadores históricos acumulados
                        </h3>

                        <p class="dashboard-section-subtitle">
                            Comparación visual de los principales KPI de operación y trazabilidad.
                        </p>
                    </div>
                </div>

                <div class="dashboard-section-body">
                    <div class="dashboard-bars">

                        @foreach($historicalBars as $bar)
                            @php
                                $barPercentage = $historicalMax > 0
                                    ? ($bar['value'] / $historicalMax) * 100
                                    : 0;
                            @endphp

                            <div class="dashboard-bar-row">
                                <div
                                    class="dashboard-bar-label"
                                    title="{{ $bar['label'] }}"
                                >
                                    {{ $bar['label'] }}
                                </div>

                                <div class="dashboard-bar-track">
                                    <div
                                        class="dashboard-bar-fill {{ $bar['class'] }}"
                                        style="width: {{ number_format($barPercentage, 4, '.', '') }}%;"
                                    ></div>
                                </div>

                                <div class="dashboard-bar-value">
                                    {{ number_format($bar['value']) }}
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="dashboard-bars-footer">
                        La longitud de cada barra se calcula proporcionalmente respecto al indicador con mayor valor. Los datos son acumulados y no representan una evolución temporal.
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
