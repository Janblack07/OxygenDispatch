<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    @include('reports.monthly._pdf_styles')

    <style>
        .w-dispatch {
            width: 5%;
        }

        .w-client {
            width: 11%;
        }

        .w-type {
            width: 9%;
        }

        .w-voucher {
            width: 8.8%;
        }
    </style>
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

        $topType = collect($summary['by_entity_type'] ?? [])
            ->sortByDesc('total_m3')
            ->first();

        $exitRows = $dispatches->flatMap(function ($dispatch) {
            return $dispatch->lines->map(function ($line) use ($dispatch) {
                return [
                    'dispatch' => $dispatch,
                    'line' => $line,
                    'tank' => $line->tankUnit,
                ];
            });
        })->values();
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
                            Reporte mensual de salidas
                        </p>

                        <p class="report-note">
                            Documento de control operativo, trazabilidad de despachos y revisión de vencimientos.
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
                        Filtro
                    </td>

                    <td class="meta-value">
                        {{ $entityFilterLabel }}
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
                        Total de despachos
                    </td>

                    <td class="value-cell text-right">
                        {{ number_format($summary['total_dispatches']) }}
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
                        Volumen total despachado
                    </td>

                    <td class="value-cell value-important text-right">
                        {{ number_format($summary['total_m3'], 2) }} m³
                    </td>

                    <td class="label-cell">
                        Clientes atendidos
                    </td>

                    <td class="value-cell text-right">
                        {{ number_format($summary['total_clients']) }}
                    </td>
                </tr>

                <tr>
                    <td class="label-cell">
                        Filtro aplicado
                    </td>

                    <td class="value-cell">
                        {{ $summary['filter_label'] ?? $entityFilterLabel }}
                    </td>

                    <td class="label-cell">
                        Período
                    </td>

                    <td class="value-cell text-right">
                        {{ $periodLabel }}
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
                Volumen por tipo de cliente
            </div>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>Tipo de cliente</th>
                        <th class="text-right">Desp.</th>
                        <th class="text-right">Tanques</th>
                        <th class="text-right">m³</th>
                        <th class="text-right">%</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($summary['by_entity_type'] as $row)
                        <tr>
                            <td>{{ $row->label }}</td>
                            <td class="text-right">{{ number_format($row->total_dispatches) }}</td>
                            <td class="text-right">{{ number_format($row->total_tanks) }}</td>
                            <td class="text-right">{{ number_format($row->total_m3, 2) }}</td>
                            <td class="text-right">{{ number_format($row->percentage_m3, 2) }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center muted">
                                Sin datos
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="column">
            <div class="section-title">
                Lectura operativa
            </div>

            <table class="report-table">
                <tbody>
                    <tr>
                        <td class="label-cell" style="width: 45%;">
                            Tipo líder
                        </td>

                        <td class="value-cell">
                            {{ $topType?->label ?? '—' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label-cell">
                            Volumen tipo líder
                        </td>

                        <td class="value-cell value-important">
                            {{ number_format((float) ($topType?->total_m3 ?? 0), 2) }} m³
                        </td>
                    </tr>

                    <tr>
                        <td class="label-cell">
                            Participación
                        </td>

                        <td class="value-cell">
                            {{ number_format((float) ($topType?->percentage_m3 ?? 0), 2) }}%
                        </td>
                    </tr>

                    <tr>
                        <td class="label-cell">
                            Observación
                        </td>

                        <td>
                            El volumen se calcula con base en la capacidad asociada a cada cilindro despachado.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="document-note">
        Este resumen consolida los despachos registrados en el período seleccionado. Los valores de volumen se calculan con base en la capacidad asociada a cada cilindro.
    </div>

    {{-- Detalle --}}
    <div class="section detail-section">
        <div class="section-title">
            Detalle de salidas
        </div>

        <div class="section-subtitle">
            Detalle por despacho y cilindro. Incluye cliente, lote, serial, vencimiento, orden/nota de entrega y comprobante.
        </div>

        <table class="detail-table">
            <thead>
                <tr>
                    <th class="w-date">Fecha</th>
                    <th class="w-dispatch">Desp.</th>
                    <th class="w-client">Cliente</th>
                    <th class="w-type">Tipo</th>
                    <th class="w-lote">Lote</th>
                    <th class="w-serial">Serial</th>
                    <th class="w-gas">Gas</th>
                    <th class="w-cap">Cap.</th>
                    <th class="w-m3 text-right">m³</th>
                    <th class="w-exp">Vence</th>
                    <th class="w-order">Orden</th>
                    <th class="w-voucher">Comp.</th>
                </tr>
            </thead>

            <tbody>
                @forelse($exitRows as $row)
                    @php
                        $dispatch = $row['dispatch'];
                        $tank = $row['tank'];

                        $clientType = $dispatch->entity_type?->label()
                            ?? $dispatch->client?->entity_type?->label()
                            ?? '—';

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

                        $voucherText = trim(
                            ($dispatch->voucher_type ?? '') .
                            ' ' .
                            ($dispatch->voucher_number ?? '')
                        );
                    @endphp

                    <tr>
                        <td>
                            {{ optional($dispatch->dispatched_at)->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            #{{ $dispatch->id }}
                        </td>

                        <td>
                            {{ $dispatch->client?->name ?? '—' }}
                        </td>

                        <td>
                            {{ $clientType }}
                        </td>

                        <td>
                            {{ $tank?->batch?->batch_number ?? '—' }}
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
                            {{ $tank?->batch?->document_number ?? $dispatch->document_number ?? '—' }}
                        </td>

                        <td>
                            {{ $voucherText ?: '—' }}

                            @if($dispatch->remission_number)
                                <br>
                                <span class="muted">
                                    Rem.: {{ $dispatch->remission_number }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center muted">
                            No existen salidas para el período y filtro seleccionado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="totals-strip">
            <strong>Totales del período:</strong>
            {{ number_format($summary['total_dispatches']) }} despachos ·
            {{ number_format($summary['total_tanks']) }} tanques ·
            {{ number_format($summary['total_m3'], 2) }} m³ despachados ·
            {{ number_format($expiration['valid'] ?? 0) }} vigentes ·
            {{ number_format($expiration['warning'] ?? 0) }} próximos a vencer ·
            {{ number_format($expiration['expired'] ?? 0) }} vencidos ·
            {{ number_format($expiration['without_date'] ?? 0) }} sin fecha.
        </div>
    </div>
</body>
</html>
