<x-app-layout>
    <x-slot name="header">
        <div class="report-header-layout">
            <div>
                <h2 class="report-page-title">
                    Reportes mensuales
                </h2>

                <p class="report-page-subtitle">
                    Consulta indicadores operativos de entradas, despachos, volumen y clientes atendidos.
                </p>
            </div>

            <span class="report-period-badge">
                {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                {{ $year }}
            </span>
        </div>
    </x-slot>

    <style>
        /*
        |--------------------------------------------------------------------------
        | Página
        |--------------------------------------------------------------------------
        */

        .report-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .report-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .report-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .report-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .report-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .report-period-badge {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            padding: 7px 11px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        /*
        |--------------------------------------------------------------------------
        | Cards
        |--------------------------------------------------------------------------
        */

        .report-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .report-card + .report-card {
            margin-top: 18px;
        }

        .report-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .report-card-body {
            padding: 20px;
        }

        .report-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .report-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Filtros
        |--------------------------------------------------------------------------
        */

        .report-filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .report-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .report-control {
            width: 100%;
            min-height: 42px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            padding: 9px 12px;
            color: #0f172a;
            font-family: inherit;
            font-size: 13px;
            line-height: 1.4;
            outline: none;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
            transition:
                border-color .15s ease,
                box-shadow .15s ease;
        }

        .report-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .report-consult-button {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 15px;
            border: 0;
            border-radius: 10px;
            background: #4f46e5;
            color: #ffffff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
            transition:
                background-color .15s ease,
                box-shadow .15s ease;
        }

        .report-consult-button:hover {
            background: #4338ca;
        }

        .report-consult-button svg {
            width: 16px;
            height: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Resumen general
        |--------------------------------------------------------------------------
        */

        .report-summary-card {
            margin-top: 18px;
        }

        .report-summary-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 10px;
        }

        .report-summary-item {
            min-width: 0;
            position: relative;
            overflow: hidden;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            background: #ffffff;
        }

        .report-summary-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: #cbd5e1;
        }

        .report-summary-item.entries::before {
            background: #059669;
        }

        .report-summary-item.dispatches::before {
            background: #4f46e5;
        }

        .report-summary-item.tanks::before {
            background: #64748b;
        }

        .report-summary-item.entry-volume::before {
            background: #0891b2;
        }

        .report-summary-item.exit-volume::before {
            background: #7c3aed;
        }

        .report-summary-item.clients::before {
            background: #2563eb;
        }

        .report-summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .report-summary-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .report-summary-icon {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #f8fafc;
            color: #475569;
        }

        .report-summary-icon svg {
            width: 15px;
            height: 15px;
        }

        .report-summary-item.entries .report-summary-icon {
            background: #ecfdf5;
            color: #047857;
        }

        .report-summary-item.dispatches .report-summary-icon {
            background: #eef2ff;
            color: #4338ca;
        }

        .report-summary-item.tanks .report-summary-icon {
            background: #f1f5f9;
            color: #475569;
        }

        .report-summary-item.entry-volume .report-summary-icon {
            background: #ecfeff;
            color: #0e7490;
        }

        .report-summary-item.exit-volume .report-summary-icon {
            background: #f5f3ff;
            color: #6d28d9;
        }

        .report-summary-item.clients .report-summary-icon {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .report-summary-value {
            margin-top: 10px;
            color: #0f172a;
            font-size: 24px;
            line-height: 1;
            font-weight: 750;
            letter-spacing: -0.02em;
        }

        .report-summary-unit {
            font-size: 11px;
            font-weight: 700;
        }

        .report-summary-caption {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.4;
        }

        /*
        |--------------------------------------------------------------------------
        | Secciones de entradas y salidas
        |--------------------------------------------------------------------------
        */

        .report-section-card {
            margin-top: 18px;
        }

        .report-section-heading-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        /*
        |--------------------------------------------------------------------------
        | Subtablas
        |--------------------------------------------------------------------------
        */

        .report-subtables-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .report-subsection {
            min-width: 0;
        }

        .report-subsection-header {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .report-subsection-title {
            margin: 0;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .report-subsection-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            background: #f8fafc;
            color: #64748b;
            font-size: 9px;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | Tablas
        |--------------------------------------------------------------------------
        */

        .report-table-wrapper {
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .report-table {
            width: 100%;
            min-width: 100%;
            border-collapse: collapse;
        }

        .report-table thead {
            background: #f8fafc;
        }

        .report-table th {
            padding: 11px 13px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .05em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .report-table td {
            padding: 12px 13px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 11px;
            vertical-align: middle;
        }

        .report-table tbody tr {
            transition: background-color .15s ease;
        }

        .report-table tbody tr:hover {
            background: #f8fafc;
        }

        .report-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .report-table-label {
            color: #0f172a;
            font-weight: 600;
        }

        .report-table-number {
            color: #334155;
            font-weight: 700;
            white-space: nowrap;
        }

        .report-table-percentage {
            display: inline-flex;
            align-items: center;
            padding: 4px 7px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 9px;
            font-weight: 700;
        }

        .report-empty-state {
            padding: 34px 16px;
            color: #94a3b8;
            font-size: 11px;
            text-align: center;
        }

        /*
        |--------------------------------------------------------------------------
        | Exportación
        |--------------------------------------------------------------------------
        */

        .report-export-panel {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .report-export-panel.inline {
            margin-top: 0;
            padding-top: 0;
            border-top: 0;
        }

        .report-export-title {
            margin: 0 0 9px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .report-export-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .report-pdf-button {
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 11px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #ffffff;
            color: #475569;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease,
                box-shadow .15s ease;
        }

        .report-pdf-button:hover {
            border-color: #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        .report-pdf-icon {
            width: 25px;
            height: 25px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: #fef2f2;
            color: #dc2626;
        }

        .report-pdf-icon svg {
            width: 14px;
            height: 14px;
        }

        /*
        |--------------------------------------------------------------------------
        | Salidas
        |--------------------------------------------------------------------------
        */

        .report-exits-table {
            min-width: 760px;
        }

        .report-exit-export-layout {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {
            .report-summary-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .report-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .report-filter-grid > div:last-child {
                grid-column: 1 / -1;
            }

            .report-consult-button {
                width: 100%;
            }

            .report-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .report-subtables-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .report-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .report-header-layout {
                flex-direction: column;
            }

            .report-filter-grid {
                grid-template-columns: 1fr;
            }

            .report-summary-grid {
                grid-template-columns: 1fr;
            }

            .report-card-header {
                flex-direction: column;
            }

            .report-section-heading-actions {
                width: 100%;
            }

            .report-export-actions {
                flex-direction: column;
            }

            .report-pdf-button {
                width: 100%;
            }
        }
    </style>

    <div class="report-page">
        <div class="report-container">

            {{-- Período --}}
            <section class="report-card">
                <div class="report-card-header">
                    <div>
                        <h3 class="report-section-title">
                            Período del reporte
                        </h3>

                        <p class="report-section-subtitle">
                            Selecciona el mes y el año que deseas analizar.
                        </p>
                    </div>

                    <span class="report-period-badge">
                        {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                        {{ $year }}
                    </span>
                </div>

                <div class="report-card-body">
                    <form
                        method="GET"
                        action="{{ route('reports.monthly.index') }}"
                    >
                        <div class="report-filter-grid">

                            {{-- Mes --}}
                            <div>
                                <label
                                    for="month"
                                    class="report-field-label"
                                >
                                    Mes
                                </label>

                                <select
                                    id="month"
                                    name="month"
                                    class="report-control"
                                >
                                    @for($m = 1; $m <= 12; $m++)
                                        <option
                                            value="{{ $m }}"
                                            @selected($month == $m)
                                        >
                                            {{ \Carbon\Carbon::create()
                                                ->month($m)
                                                ->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Año --}}
                            <div>
                                <label
                                    for="year"
                                    class="report-field-label"
                                >
                                    Año
                                </label>

                                <input
                                    id="year"
                                    type="number"
                                    name="year"
                                    value="{{ $year }}"
                                    class="report-control"
                                    min="2020"
                                    max="2100"
                                >
                            </div>

                            {{-- Consultar --}}
                            <div>
                                <button
                                    type="submit"
                                    class="report-consult-button"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                                        />
                                    </svg>

                                    Consultar
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </section>

            {{-- Resumen general --}}
            <section class="report-card report-summary-card">
                <div class="report-card-header">
                    <div>
                        <h3 class="report-section-title">
                            Resumen general del mes
                        </h3>

                        <p class="report-section-subtitle">
                            Principales indicadores operativos del período seleccionado.
                        </p>
                    </div>
                </div>

                <div class="report-card-body">
                    <div class="report-summary-grid">

                        {{-- Entradas --}}
                        <div class="report-summary-item entries">
                            <div class="report-summary-top">
                                <div class="report-summary-label">
                                    Entradas
                                </div>

                                <div class="report-summary-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="report-summary-value">
                                {{ $entriesSummary['total_movements'] }}
                            </div>

                            <div class="report-summary-caption">
                                Movimientos de entrada
                            </div>
                        </div>

                        {{-- Despachos --}}
                        <div class="report-summary-item dispatches">
                            <div class="report-summary-top">
                                <div class="report-summary-label">
                                    Despachos
                                </div>

                                <div class="report-summary-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 7.5h11.25v9H3v-9Zm11.25 3h3.836a1.5 1.5 0 0 1 1.342.83L21 14.25v2.25h-6.75v-6Zm-8.25 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm11.25 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="report-summary-value">
                                {{ $exitsSummary['total_dispatches'] }}
                            </div>

                            <div class="report-summary-caption">
                                Despachos realizados
                            </div>
                        </div>

                        {{-- Tanques --}}
                        <div class="report-summary-item tanks">
                            <div class="report-summary-top">
                                <div class="report-summary-label">
                                    Tanques despachados
                                </div>

                                <div class="report-summary-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 3h6m-4.5 0v3m3-3v3M8.25 6h7.5A2.25 2.25 0 0 1 18 8.25v10.5A2.25 2.25 0 0 1 15.75 21h-7.5A2.25 2.25 0 0 1 6 18.75V8.25A2.25 2.25 0 0 1 8.25 6Z"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="report-summary-value">
                                {{ $exitsSummary['total_tanks'] }}
                            </div>

                            <div class="report-summary-caption">
                                Unidades despachadas
                            </div>
                        </div>

                        {{-- Volumen entrada --}}
                        <div class="report-summary-item entry-volume">
                            <div class="report-summary-top">
                                <div class="report-summary-label">
                                    Volumen entrada
                                </div>

                                <div class="report-summary-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="report-summary-value">
                                {{ number_format($entriesSummary['total_m3'], 2) }}
                                <span class="report-summary-unit">
                                    m³
                                </span>
                            </div>

                            <div class="report-summary-caption">
                                Volumen total recibido
                            </div>
                        </div>

                        {{-- Volumen salida --}}
                        <div class="report-summary-item exit-volume">
                            <div class="report-summary-top">
                                <div class="report-summary-label">
                                    Volumen salida
                                </div>

                                <div class="report-summary-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 21V9m0 0 4 4m-4-4-4 4M5 3h14"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="report-summary-value">
                                {{ number_format($exitsSummary['total_m3'], 2) }}
                                <span class="report-summary-unit">
                                    m³
                                </span>
                            </div>

                            <div class="report-summary-caption">
                                Volumen total despachado
                            </div>
                        </div>

                        {{-- Clientes --}}
                        <div class="report-summary-item clients">
                            <div class="report-summary-top">
                                <div class="report-summary-label">
                                    Clientes atendidos
                                </div>

                                <div class="report-summary-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                        />
                                    </svg>
                                </div>
                            </div>

                            <div class="report-summary-value">
                                {{ $exitsSummary['total_clients'] }}
                            </div>

                            <div class="report-summary-caption">
                                Clientes únicos atendidos
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- Entradas --}}
            <section class="report-card report-section-card">
                <div class="report-card-header">
                    <div>
                        <h3 class="report-section-title">
                            Entradas del mes
                        </h3>

                        <p class="report-section-subtitle">
                            Distribución de los movimientos de entrada registrados durante
                            {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                            de {{ $year }}.
                        </p>
                    </div>

                    <div class="report-section-heading-actions">
                        <a
                            href="{{ route('reports.monthly.entries.pdf', [
                                'month' => $month,
                                'year' => $year,
                            ]) }}"
                            class="report-pdf-button"
                        >
                            <span class="report-pdf-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.25 2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V7.5l-5.25-5.25Z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.25 2.25V7.5h5.25"
                                    />
                                </svg>
                            </span>

                            Exportar entradas
                        </a>
                    </div>
                </div>

                <div class="report-card-body">
                    <div class="report-subtables-grid">

                        {{-- Por área --}}
                        <div class="report-subsection">
                            <div class="report-subsection-header">
                                <h4 class="report-subsection-title">
                                    Entradas por área destino
                                </h4>

                                <span class="report-subsection-badge">
                                    {{ count($entriesSummary['by_area']) }} registro(s)
                                </span>
                            </div>

                            <div class="report-table-wrapper">
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Área</th>

                                            <th style="text-align: right;">
                                                Tanques
                                            </th>

                                            <th style="text-align: right;">
                                                m³
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($entriesSummary['by_area'] as $row)
                                            <tr>
                                                <td>
                                                    <span class="report-table-label">
                                                        {{ $row->label }}
                                                    </span>
                                                </td>

                                                <td style="text-align: right;">
                                                    <span class="report-table-number">
                                                        {{ $row->total_tanks }}
                                                    </span>
                                                </td>

                                                <td style="text-align: right;">
                                                    <span class="report-table-number">
                                                        {{ number_format($row->total_m3, 2) }}
                                                    </span>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <div class="report-empty-state">
                                                        No existen entradas por área para el período seleccionado.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Por capacidad --}}
                        <div class="report-subsection">
                            <div class="report-subsection-header">
                                <h4 class="report-subsection-title">
                                    Entradas por capacidad
                                </h4>

                                <span class="report-subsection-badge">
                                    {{ count($entriesSummary['by_capacity']) }} registro(s)
                                </span>
                            </div>

                            <div class="report-table-wrapper">
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Capacidad</th>

                                            <th style="text-align: right;">
                                                Tanques
                                            </th>

                                            <th style="text-align: right;">
                                                m³
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($entriesSummary['by_capacity'] as $row)
                                            <tr>
                                                <td>
                                                    <span class="report-table-label">
                                                        {{ $row->label }}
                                                    </span>
                                                </td>

                                                <td style="text-align: right;">
                                                    <span class="report-table-number">
                                                        {{ $row->total_tanks }}
                                                    </span>
                                                </td>

                                                <td style="text-align: right;">
                                                    <span class="report-table-number">
                                                        {{ number_format($row->total_m3, 2) }}
                                                    </span>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <div class="report-empty-state">
                                                        No existen entradas por capacidad para el período seleccionado.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- Salidas --}}
            <section class="report-card report-section-card">
                <div class="report-card-header">
                    <div>
                        <h3 class="report-section-title">
                            Salidas del mes
                        </h3>

                        <p class="report-section-subtitle">
                            Distribución de despachos, tanques y volumen por tipo de cliente.
                        </p>
                    </div>
                </div>

                <div class="report-card-body">

                    {{-- Tabla principal --}}
                    <div class="report-subsection">
                        <div class="report-subsection-header">
                            <h4 class="report-subsection-title">
                                Volumen por tipo de cliente
                            </h4>

                            <span class="report-subsection-badge">
                                {{ count($exitsSummary['by_entity_type']) }} tipo(s)
                            </span>
                        </div>

                        <div class="report-table-wrapper">
                            <table class="report-table report-exits-table">
                                <thead>
                                    <tr>
                                        <th>Tipo de cliente</th>

                                        <th style="text-align: right;">
                                            Despachos
                                        </th>

                                        <th style="text-align: right;">
                                            Tanques
                                        </th>

                                        <th style="text-align: right;">
                                            Volumen m³
                                        </th>

                                        <th style="text-align: right;">
                                            Participación
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($exitsSummary['by_entity_type'] as $row)
                                        <tr>
                                            <td>
                                                <span class="report-table-label">
                                                    {{ $row->label }}
                                                </span>
                                            </td>

                                            <td style="text-align: right;">
                                                <span class="report-table-number">
                                                    {{ $row->total_dispatches }}
                                                </span>
                                            </td>

                                            <td style="text-align: right;">
                                                <span class="report-table-number">
                                                    {{ $row->total_tanks }}
                                                </span>
                                            </td>

                                            <td style="text-align: right;">
                                                <span class="report-table-number">
                                                    {{ number_format($row->total_m3, 2) }}
                                                </span>
                                            </td>

                                            <td style="text-align: right;">
                                                <span class="report-table-percentage">
                                                    {{ number_format($row->percentage_m3, 2) }}%
                                                </span>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <div class="report-empty-state">
                                                    No existen salidas para el período seleccionado.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Exportaciones --}}
                    <div class="report-exit-export-layout">
                        <h4 class="report-export-title">
                            Exportar reportes de salida
                        </h4>

                        <div class="report-export-actions">

                            {{-- General --}}
                            <a
                                href="{{ route('reports.monthly.exits.pdf', [
                                    'month' => $month,
                                    'year' => $year,
                                ]) }}"
                                class="report-pdf-button"
                            >
                                <span class="report-pdf-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V7.5l-5.25-5.25Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25V7.5h5.25"
                                        />
                                    </svg>
                                </span>

                                General
                            </a>

                            {{-- Entidades --}}
                            <a
                                href="{{ route('reports.monthly.exits.pdf', [
                                    'month' => $month,
                                    'year' => $year,
                                    'entity_type' => 1,
                                ]) }}"
                                class="report-pdf-button"
                            >
                                <span class="report-pdf-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V7.5l-5.25-5.25Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25V7.5h5.25"
                                        />
                                    </svg>
                                </span>

                                Entidades
                            </a>

                            {{-- IESS --}}
                            <a
                                href="{{ route('reports.monthly.exits.pdf', [
                                    'month' => $month,
                                    'year' => $year,
                                    'entity_type' => 2,
                                ]) }}"
                                class="report-pdf-button"
                            >
                                <span class="report-pdf-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V7.5l-5.25-5.25Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25V7.5h5.25"
                                        />
                                    </svg>
                                </span>

                                Intradomiciliario IESS
                            </a>

                            {{-- No afiliado --}}
                            <a
                                href="{{ route('reports.monthly.exits.pdf', [
                                    'month' => $month,
                                    'year' => $year,
                                    'entity_type' => 3,
                                ]) }}"
                                class="report-pdf-button"
                            >
                                <span class="report-pdf-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V7.5l-5.25-5.25Z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.25 2.25V7.5h5.25"
                                        />
                                    </svg>
                                </span>

                                No afiliado / Apoyo
                            </a>

                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</x-app-layout>
