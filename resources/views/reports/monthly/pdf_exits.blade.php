<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    @include('reports.monthly._pdf_styles')
</head>
<body>
    <div class="page-header clearfix">
        <div class="brand-left">
    <table class="brand-table">
        <tr>
            <td class="brand-logo-cell">
                <div class="logo-wrap">
                    @if(!empty($logoBase64))
                        <img src="{{ $logoBase64 }}" alt="Logo OxygenDispatch">
                    @else
                        <div class="logo-fallback">OD</div>
                    @endif
                </div>
            </td>
            <td class="brand-copy-cell">
                <div class="brand-copy">
                    <div class="system-name">OxygenDispatch</div>
                    <p class="report-name">{{ $title }}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
        <div class="brand-right">
            <table class="meta-table">
                <tr>
                    <td class="meta-label">Período</td>
                    <td class="meta-value">{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</td>
                </tr>
                <tr>
                    <td class="meta-label">Filtro</td>
                    <td class="meta-value">{{ $entityFilterLabel }}</td>
                </tr>
                <tr>
                    <td class="meta-label">Generado por</td>
                    <td class="meta-value">{{ $generatedBy }}</td>
                </tr>
                <tr>
                    <td class="meta-label">Fecha de emisión</td>
                    <td class="meta-value">{{ $generatedAt->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="page-footer clearfix">
        <div class="footer-left">OxygenDispatch · Documento generado automáticamente</div>
        <div class="footer-right">
            <script type="text/php">
                if (isset($pdf)) {
                    $pdf->page_text(730, 565, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 8, [107, 114, 128]);
                }
            </script>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Resumen ejecutivo</div>
        <table class="summary-table">
            <thead>
                <tr>
                    <th>Indicador</th>
                    <th class="text-right">Valor</th>
                    <th>Indicador</th>
                    <th class="text-right">Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total despachos</td>
                    <td class="text-right value-strong">{{ number_format($summary['total_dispatches']) }}</td>
                    <td>Total tanques</td>
                    <td class="text-right value-strong">{{ number_format($summary['total_tanks']) }}</td>
                </tr>
                <tr>
                    <td>Volumen total despachado</td>
                    <td class="text-right value-soft">{{ number_format($summary['total_m3'], 2) }} m³</td>
                    <td>Clientes atendidos</td>
                    <td class="text-right">{{ number_format($summary['total_clients']) }}</td>
                </tr>
                <tr>
                    <td>Filtro aplicado</td>
                    <td class="text-right">{{ $summary['filter_label'] }}</td>
                    <td>Participación clasificada</td>
                    <td class="text-right">{{ number_format(collect($summary['by_entity_type'])->sum('percentage_m3'), 2) }}%</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section mini-grid clearfix">
        <div class="col">
            <div class="section-title">Volumen por tipo de cliente</div>
            <table class="mini-table">
                <thead>
                    <tr>
                        <th>Tipo de cliente</th>
                        <th class="text-right">Despachos</th>
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
                            <td colspan="5" class="text-center muted">Sin datos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="col">
            <div class="section-title">Lectura operativa del período</div>
            <table class="mini-table">
                <tbody>
                    <tr>
                        <th style="width: 48%;">Tipo líder por volumen</th>
                        <td>
                            @php($topType = collect($summary['by_entity_type'])->sortByDesc('total_m3')->first())
                            {{ $topType?->label ?? '—' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Volumen del tipo líder</th>
                        <td>{{ number_format((float) ($topType?->total_m3 ?? 0), 2) }} m³</td>
                    </tr>
                    <tr>
                        <th>Participación del tipo líder</th>
                        <td>{{ number_format((float) ($topType?->percentage_m3 ?? 0), 2) }}%</td>
                    </tr>
                    <tr>
                        <th>Filtro del documento</th>
                        <td><span class="badge">{{ $summary['filter_label'] }}</span></td>
                    </tr>
                    <tr>
                        <th>Observación</th>
                        <td>El volumen total del mes se calculó sumando los m³ de la capacidad registrada en cada cilindro despachado.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Detalle de salidas</div>
        <table class="detail-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Despacho</th>
                    <th>Cliente</th>
                    <th>Tipo cliente</th>
                    <th>Lote</th>
                    <th>Serial</th>
                    <th>Gas</th>
                    <th>Capacidad</th>
                    <th class="text-right">m³</th>
                    <th>Comprobante / Remisión</th>
                </tr>
            </thead>
            <tbody>
                @php($hasRows = false)

                @foreach($dispatches as $dispatch)
                    @php($clientType = $dispatch->entity_type?->label() ?? $dispatch->client?->entity_type?->label() ?? '—')

                    @foreach($dispatch->lines as $line)
                        @php($hasRows = true)
                        @php($tank = $line->tankUnit)
                        <tr>
                            <td>{{ optional($dispatch->dispatched_at)->format('d/m/Y H:i') }}</td>
                            <td>#{{ $dispatch->id }}</td>
                            <td>{{ $dispatch->client?->name ?? '—' }}</td>
                            <td>{{ $clientType }}</td>
                            <td>{{ $tank?->batch?->batch_number ?? '—' }}</td>
                            <td>{{ $tank?->serial ?? '—' }}</td>
                            <td>{{ $tank?->gasType?->name ?? '—' }}</td>
                            <td>{{ $tank?->capacity?->name ?? '—' }}</td>
                            <td class="text-right">{{ number_format((float) ($tank?->capacity?->m3 ?? 0), 2) }}</td>
                            <td>
                                {{ trim(($dispatch->voucher_type ?? '') . ' ' . ($dispatch->voucher_number ?? '')) ?: '—' }}
                                @if($dispatch->remission_number)
                                    <br><span class="muted">Remisión: {{ $dispatch->remission_number }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach

                @unless($hasRows)
                    <tr>
                        <td colspan="10" class="text-center muted">No existen salidas para el período y filtro seleccionado.</td>
                    </tr>
                @endunless
            </tbody>
        </table>

        <div class="totals-strip">
            <strong>Totales del período:</strong>
            {{ number_format($summary['total_dispatches']) }} despachos ·
            {{ number_format($summary['total_tanks']) }} tanques ·
            {{ number_format($summary['total_m3'], 2) }} m³ despachados.
        </div>
    </div>
</body>
</html>
