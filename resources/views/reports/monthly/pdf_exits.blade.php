<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    @include('reports.monthly._pdf_styles')
</head>
<body>
    <div class="header">
        <div class="title">{{ $title }}</div>
        <div class="subtitle">
            Mes: {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}
            | Tipo: {{ $entityFilterLabel }}
        </div>
        <div class="meta">
            Generado por: {{ $generatedBy }} |
            Fecha de generación: {{ $generatedAt->format('Y-m-d H:i') }}
        </div>
    </div>

    <div class="summary">
        <div class="summary-box">
            <div class="summary-label">Total despachos</div>
            <div class="summary-value">{{ $summary['total_dispatches'] }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-label">Total tanques</div>
            <div class="summary-value">{{ $summary['total_tanks'] }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-label">Filtro</div>
            <div class="summary-value small">{{ $summary['filter_label'] }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Despacho</th>
                <th>Cliente</th>
                <th>Tipo cliente</th>
                <th>Doc. cliente</th>
                <th>Lote</th>
                <th>Serial</th>
                <th>Gas</th>
                <th>Capacidad</th>
                <th>Comprobante</th>
                <th>Remisión</th>
                <th>Placa</th>
                <th>Usuario</th>
                <th>Notas</th>
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
                        <td>{{ optional($dispatch->dispatched_at)->format('Y-m-d H:i') }}</td>
                        <td>#{{ $dispatch->id }}</td>
                        <td>{{ $dispatch->client?->name ?? '—' }}</td>
                        <td>{{ $clientType }}</td>
                        <td>{{ $dispatch->client?->document ?? '—' }}</td>
                        <td>{{ $tank?->batch?->batch_number ?? '—' }}</td>
                        <td>{{ $tank?->serial ?? '—' }}</td>
                        <td>{{ $tank?->gasType?->name ?? '—' }}</td>
                        <td>{{ $tank?->capacity?->name ?? '—' }}</td>
                        <td>{{ trim(($dispatch->voucher_type ?? '') . ' ' . ($dispatch->voucher_number ?? '')) ?: '—' }}</td>
                        <td>{{ $dispatch->remission_number ?? '—' }}</td>
                        <td>{{ $dispatch->remission_plate ?? '—' }}</td>
                        <td>{{ $dispatch->performed_by_user_email ?? '—' }}</td>
                        <td>{{ $dispatch->notes ?? '—' }}</td>
                    </tr>
                @endforeach
            @endforeach

            @unless($hasRows)
                <tr>
                    <td colspan="14" class="text-center">No existen salidas para el período y filtro seleccionado.</td>
                </tr>
            @endunless
        </tbody>
    </table>
</body>
</html>
