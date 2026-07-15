<x-app-layout>
    <x-slot name="header">
        <div class="report-header-layout">
            <div>
                <h2 class="report-page-title">
                    Reportes mensuales
                </h2>

                <p class="report-page-subtitle">
                    Consulta indicadores mensuales de entradas y salidas y exporta los reportes en PDF.
                </p>
            </div>
        </div>
    </x-slot>

    <style>
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
            padding: 17px 20px;
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
            min-height: 40px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            padding: 8px 11px;
            color: #0f172a;
            font-family: inherit;
            font-size: 13px;
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
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
            transition: background-color .15s ease;
        }

        .report-consult-button:hover {
            background: #4338ca;
        }

        .report-period-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .report-main-grid {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            align-items: start;
        }

        .report-metrics-grid {
            display: grid;
            gap: 12px;
        }

        .report-metrics-grid.entries {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .report-metrics-grid.exits {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .report-metric-card {
            min-width: 0;
            padding: 14px 15px;
            border-radius: 12px;
        }

        .report-metric-card.indigo {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
        }

        .report-metric-card.green {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
        }

        .report-metric-card.cyan {
            border: 1px solid #a5f3fc;
            background: #ecfeff;
        }

        .report-metric-card.red {
            border: 1px solid #fecaca;
            background: #fef2f2;
        }

        .report-metric-card.emerald {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
        }

        .report-metric-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .report-metric-card.indigo .report-metric-label,
        .report-metric-card.indigo .report-metric-value {
            color: #4338ca;
        }

        .report-metric-card.green .report-metric-label,
        .report-metric-card.green .report-metric-value {
            color: #047857;
        }

        .report-metric-card.cyan .report-metric-label,
        .report-metric-card.cyan .report-metric-value {
            color: #0e7490;
        }

        .report-metric-card.red .report-metric-label,
        .report-metric-card.red .report-metric-value {
            color: #b91c1c;
        }

        .report-metric-card.emerald .report-metric-label,
        .report-metric-card.emerald .report-metric-value {
            color: #047857;
        }

        .report-metric-value {
            margin-top: 5px;
            font-size: 24px;
            line-height: 1.1;
            font-weight: 750;
        }

        .report-metric-unit {
            font-size: 11px;
            font-weight: 700;
        }

        .report-subtables-grid {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .report-subsection {
            min-width: 0;
        }

        .report-subsection-title {
            margin: 0 0 8px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .report-table-wrapper {
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
        }

        .report-table {
            width: 100%;
            min-width: 440px;
            border-collapse: collapse;
        }

        .report-table.wide {
            min-width: 620px;
        }

        .report-table thead {
            background: #f8fafc;
        }

        .report-table th {
            padding: 10px 12px;
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
            padding: 11px 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 11px;
            vertical-align: middle;
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

        .report-empty-cell {
            padding: 28px 14px;
            color: #94a3b8;
            font-size: 11px;
            text-align: center;
        }

        .report-export-section {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
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
            gap: 6px;
            padding: 0 12px;
            border: 1px solid #fecaca;
            border-radius: 9px;
            background: #fef2f2;
            color: #b91c1c;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease;
        }

        .report-pdf-button:hover {
            border-color: #fca5a5;
            background: #fee2e2;
            color: #991b1b;
        }

        .report-pdf-button svg {
            width: 15px;
            height: 15px;
        }

        @media (max-width: 1100px) {
            .report-main-grid {
                grid-template-columns: 1fr;
            }

            .report-metrics-grid.exits {
                grid-template-columns: repeat(4, minmax(130px, 1fr));
            }
        }

        @media (max-width: 800px) {
            .report-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .report-filter-grid > div:last-child {
                grid-column: span 2;
            }

            .report-consult-button {
                width: 100%;
            }

            .report-metrics-grid.entries,
            .report-metrics-grid.exits {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .report-subtables-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 540px) {
            .report-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .report-filter-grid {
                grid-template-columns: 1fr;
            }

            .report-filter-grid > div:last-child {
                grid-column: auto;
            }

            .report-metrics-grid.entries,
            .report-metrics-grid.exits {
                grid-template-columns: 1fr;
            }

            .report-card-header {
                flex-direction: column;
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

            {{-- Filtros --}}
            <section class="report-card">
                <div class="report-card-header">
                    <div>
                        <h3 class="report-section-title">
                            Período del reporte
                        </h3>

                        <p class="report-section-subtitle">
                            Selecciona el mes y año que deseas consultar.
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
                                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

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

                            <div>
                                <button
                                    type="submit"
                                    class="report-consult-button"
                                >
                                    Consultar
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </section>

            <div class="report-main-grid">

                {{-- Entradas --}}
                <section class="report-card">
                    <div class="report-card-header">
                        <div>
                            <h3 class="report-section-title">
                                Entradas del mes
                            </h3>

                            <p class="report-section-subtitle">
                                Movimientos de entrada registrados durante el período seleccionado.
                            </p>
                        </div>
                    </div>

                    <div class="report-card-body">

                        <div class="report-metrics-grid entries">

                            <div class="report-metric-card indigo">
                                <div class="report-metric-label">
                                    Total entradas
                                </div>

                                <div class="report-metric-value">
                                    {{ $entriesSummary['total_movements'] }}
                                </div>
                            </div>

                            <div class="report-metric-card green">
                                <div class="report-metric-label">
                                    Total tanques
                                </div>

                                <div class="report-metric-value">
                                    {{ $entriesSummary['total_tanks'] }}
                                </div>
                            </div>

                            <div class="report-metric-card cyan">
                                <div class="report-metric-label">
                                    Volumen total
                                </div>

                                <div class="report-metric-value">
                                    {{ number_format($entriesSummary['total_m3'], 2) }}
                                    <span class="report-metric-unit">
                                        m³
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="report-subtables-grid">

                            {{-- Entradas por área --}}
                            <div class="report-subsection">
                                <h4 class="report-subsection-title">
                                    Entradas por área destino
                                </h4>

                                <div class="report-table-wrapper">
                                    <table class="report-table">
                                        <thead>
                                            <tr>
                                                <th>Área</th>
                                                <th style="text-align: right;">Tanques</th>
                                                <th style="text-align: right;">m³</th>
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
                                                        <div class="report-empty-cell">
                                                            Sin datos para el período seleccionado.
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Entradas por capacidad --}}
                            <div class="report-subsection">
                                <h4 class="report-subsection-title">
                                    Entradas por capacidad
                                </h4>

                                <div class="report-table-wrapper">
                                    <table class="report-table">
                                        <thead>
                                            <tr>
                                                <th>Capacidad</th>
                                                <th style="text-align: right;">Tanques</th>
                                                <th style="text-align: right;">m³</th>
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
                                                        <div class="report-empty-cell">
                                                            Sin datos para el período seleccionado.
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="report-export-section">
                            <h4 class="report-export-title">
                                Exportar entradas
                            </h4>

                            <div class="report-export-actions">
                                <a
                                    href="{{ route('reports.monthly.entries.pdf', [
                                        'month' => $month,
                                        'year' => $year,
                                    ]) }}"
                                    class="report-pdf-button"
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
                                            d="M19.5 14.25v-2.625A3.375 3.375 0 0 0 16.125 8.25h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5A3.375 3.375 0 0 0 10.125 2.25H8.25m0 12.75h7.5m-7.5 3h7.5M10.5 2.25H5.625A1.875 1.875 0 0 0 3.75 4.125v15.75a1.875 1.875 0 0 0 1.875 1.875h12.75a1.875 1.875 0 0 0 1.875-1.875V11.25a9 9 0 0 0-9-9Z"
                                        />
                                    </svg>

                                    PDF entradas del mes
                                </a>
                            </div>
                        </div>

                    </div>
                </section>

                {{-- Salidas --}}
                <section class="report-card">
                    <div class="report-card-header">
                        <div>
                            <h3 class="report-section-title">
                                Salidas del mes
                            </h3>

                            <p class="report-section-subtitle">
                                Despachos registrados durante el período seleccionado.
                            </p>
                        </div>
                    </div>

                    <div class="report-card-body">

                        <div class="report-metrics-grid exits">

                            <div class="report-metric-card indigo">
                                <div class="report-metric-label">
                                    Total despachos
                                </div>

                                <div class="report-metric-value">
                                    {{ $exitsSummary['total_dispatches'] }}
                                </div>
                            </div>

                            <div class="report-metric-card red">
                                <div class="report-metric-label">
                                    Total tanques
                                </div>

                                <div class="report-metric-value">
                                    {{ $exitsSummary['total_tanks'] }}
                                </div>
                            </div>

                            <div class="report-metric-card cyan">
                                <div class="report-metric-label">
                                    Volumen total
                                </div>

                                <div class="report-metric-value">
                                    {{ number_format($exitsSummary['total_m3'], 2) }}

                                    <span class="report-metric-unit">
                                        m³
                                    </span>
                                </div>
                            </div>

                            <div class="report-metric-card emerald">
                                <div class="report-metric-label">
                                    Clientes atendidos
                                </div>

                                <div class="report-metric-value">
                                    {{ $exitsSummary['total_clients'] }}
                                </div>
                            </div>

                        </div>

                        <div class="report-subsection" style="margin-top: 16px;">
                            <h4 class="report-subsection-title">
                                Volumen por tipo de cliente
                            </h4>

                            <div class="report-table-wrapper">
                                <table class="report-table wide">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th style="text-align: right;">Despachos</th>
                                            <th style="text-align: right;">Tanques</th>
                                            <th style="text-align: right;">m³</th>
                                            <th style="text-align: right;">%</th>
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
                                                    <span class="report-table-number">
                                                        {{ number_format($row->percentage_m3, 2) }}%
                                                    </span>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="report-empty-cell">
                                                        Sin datos para el período seleccionado.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="report-export-section">
                            <h4 class="report-export-title">
                                Exportar reportes de salida
                            </h4>

                            <div class="report-export-actions">

                                <a
                                    href="{{ route('reports.monthly.exits.pdf', [
                                        'month' => $month,
                                        'year' => $year,
                                    ]) }}"
                                    class="report-pdf-button"
                                >
                                    PDF salidas general
                                </a>

                                <a
                                    href="{{ route('reports.monthly.exits.pdf', [
                                        'month' => $month,
                                        'year' => $year,
                                        'entity_type' => 1,
                                    ]) }}"
                                    class="report-pdf-button"
                                >
                                    PDF entidades
                                </a>

                                <a
                                    href="{{ route('reports.monthly.exits.pdf', [
                                        'month' => $month,
                                        'year' => $year,
                                        'entity_type' => 2,
                                    ]) }}"
                                    class="report-pdf-button"
                                >
                                    PDF intradomiciliario IESS
                                </a>

                                <a
                                    href="{{ route('reports.monthly.exits.pdf', [
                                        'month' => $month,
                                        'year' => $year,
                                        'entity_type' => 3,
                                    ]) }}"
                                    class="report-pdf-button"
                                >
                                    PDF no afiliado / apoyo
                                </a>

                            </div>
                        </div>

                    </div>
                </section>

            </div>

        </div>
    </div>
</x-app-layout>
