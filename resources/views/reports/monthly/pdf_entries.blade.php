<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    @include('reports.monthly._pdf_styles')
</head>
<body>
    @php
        $periodLabel = \Carbon\Carbon::create($year, $month, 1)
            ->locale('es')
            ->translatedFormat('F Y');

        $expiration = $summary['expiration'] ?? [
            'valid' => 0,
            'warning' => 0,
            'expired' => 0,
            'without_date' => 0,
        ];

        $totalExpirationControls =
            (int) ($expiration['valid'] ?? 0)
            + (int) ($expiration['warning'] ?? 0)
            + (int) ($expiration['expired'] ?? 0)
            + (int) ($expiration['without_date'] ?? 0);
    @endphp

    <div class="pdf-header clearfix">
        <div class="header-left">
            <table class="brand-table">
                <tr>
                    <td class="brand-logo-cell">
                        <div class="logo-wrap">
                            @if(!empty($logoBase64))
                                <img src="{{ $logoBase64 }}" alt="Logo OxygenDispatch">
                            @else
                                <div class="logo-fallback">
                                    OD
                                </div>
                            @endif
                        </div>
                    </td>

                    <td class="brand-text-cell">
                        <h1 class="company-title">
                            OxygenDispatch
                        </h1>

                        <p class="report-title">
                            Reporte mensual de entradas
                        </p>

                        <p class="report-note">
                            Documento de control operativo, trazabilidad de cilindros y revisión de vencimientos.
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="header-right">
            <table class="meta-table">
                <tr>
                    <td class="meta-label">
                        Período
                    </td>

                    <td class="meta-value">
                        {{ $periodLabel }}
                    </td>
                </tr>

                <tr>
                    <td class="meta-label">
                        Generado por
                    </td>

                    <td class="meta-value">
                        {{ $generatedBy }}
                    </td>
                </tr>

                <tr>
                    <td class="meta-label">
                        Fecha de emisión
                    </td>

                    <td class="meta-value">
                        {{ $generatedAt->format('d/m/Y H:i') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="pdf-footer clearfix">
        <div class="footer-left">
            OxygenDispatch · Documento generado automáticamente
        </div>

        <div class="footer-right">
            <script type="text/php">
                if (isset($pdf)) {
                    $pdf->page_text(730, 565, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 7, [107, 114, 128]);
                }
            </script>
        </div>
    </div>

    {{-- Resumen ejecutivo --}}
    <div class="section">
        <div class="section-title">
            Resumen ejecutivo
        </div>

        <table class="report-table">
            <thead>
                <tr>
                    <th style="width: 25%;">Indicador</th>
                    <th style="width: 25%;" class="text-right">Valor</th>
                    <th style="width: 25%;">Referencia</th>
                    <th style="width: 25%;" class="text-right">Detalle</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="label-cell">
                        Total de entradas
                    </td>

                    <td class="value-cell text-right">
                        {{ number_format($summary['total_movements']) }}
                    </td>

                    <td class="label-cell">
                        Total de tanques
                    </td>

                    <td class="value-cell text-right">
                        {{ number_format($summary['total_tanks']) }}
                    </td>
                </tr>

                <tr>
                    <td class="label-cell">
                        Volumen total ingresado
                    </td>

                    <td class="value-cell value-important text-right">
                        {{ number_format($summary['total_m3'], 2) }} m³
                    </td>

                    <td class="label-cell">
                        Lotes distintos
                    </td>

                    <td class="value-cell text-right">
                        {{ number_format($summary['distinct_batches']) }}
                    </td>
                </tr>

                <tr>
                    <td class="label-cell">
                        Área principal de destino
                    </td>

                    <td class="value-cell">
                        {{ $summary['main_area_label'] }}
                    </td>

                    <td class="label-cell">
                        Volumen del área principal
                    </td>

                    <td class="value-cell value-important text-right">
                        {{ number_format($summary['main_area_m3'], 2) }} m³
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Control de vencimientos --}}
    <div class="section">
        <div class="section-title">
            Control de vencimientos
        </div>

        <table class="report-table">
            <thead>
                <tr>
                    <th>Clasificación</th>
                    <th class="text-right">Cantidad</th>
                    <th>Clasificación</th>
                    <th class="text-right">Cantidad</th>
                    <th>Clasificación</th>
                    <th class="text-right">Cantidad</th>
                    <th>Clasificación</th>
                    <th class="text-right">Cantidad</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="label-cell">
                        Vigentes
                    </td>

                    <td class="value-cell value-important text-right">
                        {{ number_format($expiration['valid'] ?? 0) }}
                    </td>

                    <td class="label-cell">
                        Próximos a vencer
                    </td>

                    <td class="value-cell value-warning text-right">
                        {{ number_format($expiration['warning'] ?? 0) }}
                    </td>

                    <td class="label-cell">
                        Vencidos
                    </td>

                    <td class="value-cell value-danger text-right">
                        {{ number_format($expiration['expired'] ?? 0) }}
                    </td>

                    <td class="label-cell">
                        Sin fecha
                    </td>

                    <td class="value-cell text-right">
                        {{ number_format($expiration['without_date'] ?? 0) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="criteria-note">
            Criterio aplicado: se considera próximo a vencer todo cilindro cuya fecha de vencimiento sea menor o igual a 6 meses desde la fecha de emisión del reporte.
            Total de cilindros evaluados: <strong>{{ number_format($totalExpirationControls) }}</strong>.
        </div>
    </div>

    {{-- Distribución --}}
    <div class="section two-columns clearfix">
        <div class="column">
            <div class="section-title">
                Volumen por área destino
            </div>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>Área</th>
                        <th class="text-right">Tanques</th>
                        <th class="text-right">m³</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($summary['by_area'] as $row)
                        <tr>
                            <td>{{ $row->label }}</td>
                            <td class="text-right">{{ number_format($row->total_tanks) }}</td>
                            <td class="text-right">{{ number_format($row->total_m3, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center muted">
                                Sin datos
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="column">
            <div class="section-title">
                Distribución por gas y capacidad
            </div>

            <table class="report-table" style="margin-bottom: 6px;">
                <thead>
                    <tr>
                        <th>Gas</th>
                        <th class="text-right">Tanques</th>
                        <th class="text-right">m³</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($summary['by_gas'] as $row)
                        <tr>
                            <td>{{ $row->label }}</td>
                            <td class="text-right">{{ number_format($row->total_tanks) }}</td>
                            <td class="text-right">{{ number_format($row->total_m3, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center muted">
                                Sin datos
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>Capacidad</th>
                        <th class="text-right">Tanques</th>
                        <th class="text-right">m³</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($summary['by_capacity'] as $row)
                        <tr>
                            <td>{{ $row->label }}</td>
                            <td class="text-right">{{ number_format($row->total_tanks) }}</td>
                            <td class="text-right">{{ number_format($row->total_m3, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center muted">
                                Sin datos
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="document-note">
        Este resumen consolida los movimientos de entrada registrados en el período seleccionado. Los valores de volumen se calculan con base en la capacidad asociada a cada cilindro.
    </div>

    {{-- Detalle --}}
    <div class="section">
        <div class="section-title">
            Detalle de entradas
        </div>

        <div class="section-subtitle">
            Detalle por movimiento de ingreso. Incluye lote, serial, vencimiento, registro sanitario, área destino, estado técnico y número de orden.
        </div>

        <table class="detail-table">
            <thead>
                <tr>
                    <th class="w-date">Fecha</th>
                    <th class="w-lote">Lote</th>
                    <th class="w-serial">Serial</th>
                    <th class="w-gas">Gas</th>
                    <th class="w-cap">Cap.</th>
                    <th class="w-m3 text-right">m³</th>
                    <th class="w-exp">Vence</th>
                    <th class="w-reg">Reg.</th>
                    <th class="w-area">Área destino</th>
                    <th class="w-status">Estado técnico</th>
                    <th class="w-order">N.º orden</th>
                </tr>
            </thead>

            <tbody>
                @forelse($entries as $entry)
                    @php
                        $tank = $entry->tankUnit;
                        $expiresAt = $tank?->expires_at;

                        $expirationClass = 'expiration-empty';
                        $expirationText = '—';

                        if ($expiresAt) {
                            $expirationText = $expiresAt->format('d/m/Y');

                            if ($expiresAt->isPast()) {
                                $expirationClass = 'expiration-expired';
                            } elseif ($expiresAt->lte(now()->addMonths(6))) {
                                $expirationClass = 'expiration-warning';
                            } else {
                                $expirationClass = 'expiration-ok';
                            }
                        }

                        $technicalStatus = mb_strtolower(
                            trim($tank?->technicalStatus?->name ?? '')
                        );

                        $technicalClass = match($technicalStatus) {
                            'aprobado' => 'status-approved',
                            'rechazado' => 'status-rejected',
                            'pendiente' => 'status-pending',
                            default => '',
                        };
                    @endphp

                    <tr>
                        <td>
                            {{ optional($entry->occurred_at)->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            {{ $entry->batch?->batch_number ?? '—' }}
                        </td>

                        <td>
                            {{ $tank?->serial ?? '—' }}
                        </td>

                        <td>
                            {{ $tank?->gasType?->name ?? '—' }}
                        </td>

                        <td>
                            {{ $tank?->capacity?->name ?? '—' }}
                        </td>

                        <td class="text-right">
                            {{ number_format((float) ($tank?->capacity?->m3 ?? 0), 2) }}
                        </td>

                        <td class="{{ $expirationClass }}">
                            {{ $expirationText }}
                        </td>

                        <td>
                            {{ $tank?->sanitary_registry ?? $tank?->product?->sanitary_registry ?? '—' }}
                        </td>

                        <td>
                            {{ $entry->toArea?->name ?? '—' }}
                        </td>

                        <td class="{{ $technicalClass }}">
                            {{ $tank?->technicalStatus?->name ?? '—' }}
                        </td>

                        <td>
                            {{ $entry->batch?->document_number ?? $entry->reference_document ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center muted">
                            No existen entradas para el período seleccionado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="totals-strip">
            <strong>Totales del período:</strong>
            {{ number_format($summary['total_tanks']) }} tanques registrados ·
            {{ number_format($summary['total_m3'], 2) }} m³ ingresados ·
            {{ number_format($expiration['valid'] ?? 0) }} vigentes ·
            {{ number_format($expiration['warning'] ?? 0) }} próximos a vencer ·
            {{ number_format($expiration['expired'] ?? 0) }} vencidos ·
            {{ number_format($expiration['without_date'] ?? 0) }} sin fecha.
        </div>
    </div>
</body>
</html>
