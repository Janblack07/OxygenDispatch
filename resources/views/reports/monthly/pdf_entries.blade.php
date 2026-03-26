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
                    <th>Referencia</th>
                    <th class="text-right">Detalle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total de entradas</td>
                    <td class="text-right value-strong">{{ number_format($summary['total_movements']) }}</td>
                    <td>Total de tanques</td>
                    <td class="text-right value-strong">{{ number_format($summary['total_tanks']) }}</td>
                </tr>
                <tr>
                    <td>Volumen total ingresado</td>
                    <td class="text-right value-soft">{{ number_format($summary['total_m3'], 2) }} m³</td>
                    <td>Lotes distintos</td>
                    <td class="text-right">{{ number_format($summary['distinct_batches']) }}</td>
                </tr>
                <tr>
                    <td>Área principal de destino</td>
                    <td class="text-right">{{ $summary['main_area_label'] }}</td>
                    <td>Volumen del área principal</td>
                    <td class="text-right">{{ number_format($summary['main_area_m3'], 2) }} m³</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section mini-grid clearfix">
        <div class="col">
            <div class="section-title">Volumen por área destino</div>
            <table class="mini-table">
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
                            <td colspan="3" class="text-center muted">Sin datos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="col">
            <div class="section-title">Distribución por gas y capacidad</div>
            <table class="mini-table" style="margin-bottom: 8px;">
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
                            <td colspan="3" class="text-center muted">Sin datos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <table class="mini-table">
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
                            <td colspan="3" class="text-center muted">Sin datos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Detalle de entradas</div>
        <table class="detail-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Lote</th>
                    <th>Serial</th>
                    <th>Gas</th>
                    <th>Capacidad</th>
                    <th class="text-right">m³</th>
                    <th>Reg. sanitario</th>
                    <th>Área destino</th>
                    <th>Estado técnico</th>
                    <th>Documento</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entries as $entry)
                    @php($tank = $entry->tankUnit)
                    <tr>
                        <td>{{ optional($entry->occurred_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $entry->batch?->batch_number ?? '—' }}</td>
                        <td>{{ $tank?->serial ?? '—' }}</td>
                        <td>{{ $tank?->gasType?->name ?? '—' }}</td>
                        <td>{{ $tank?->capacity?->name ?? '—' }}</td>
                        <td class="text-right">{{ number_format((float) ($tank?->capacity?->m3 ?? 0), 2) }}</td>
                        <td>{{ $tank?->sanitary_registry ?? $tank?->product?->sanitary_registry ?? '—' }}</td>
                        <td>{{ $entry->toArea?->name ?? '—' }}</td>
                        <td>{{ $tank?->technicalStatus?->name ?? '—' }}</td>
                        <td>{{ $entry->reference_document ?? $entry->batch?->document_number ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center muted">No existen entradas para el período seleccionado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="totals-strip">
            <strong>Totales del período:</strong>
            {{ number_format($summary['total_tanks']) }} tanques registrados ·
            {{ number_format($summary['total_m3'], 2) }} m³ ingresados.
        </div>
    </div>
</body>
</html>
