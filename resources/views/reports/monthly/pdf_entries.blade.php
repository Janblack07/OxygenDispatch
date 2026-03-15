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
        <div class="subtitle">Mes: {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</div>
        <div class="meta">
            Generado por: {{ $generatedBy }} |
            Fecha de generación: {{ $generatedAt->format('Y-m-d H:i') }}
        </div>
    </div>

    <div class="summary">
        <div class="summary-box">
            <div class="summary-label">Total entradas</div>
            <div class="summary-value">{{ $summary['total_movements'] }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-label">Total tanques</div>
            <div class="summary-value">{{ $summary['total_tanks'] }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Lote</th>
                <th>Serial</th>
                <th>Gas</th>
                <th>Capacidad</th>
                <th>Reg. sanitario</th>
                <th>Área destino</th>
                <th>Estado técnico</th>
                <th>Documento</th>
                <th>Usuario</th>
                <th>Notas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entries as $entry)
                @php($tank = $entry->tankUnit)
                <tr>
                    <td>{{ optional($entry->occurred_at)->format('Y-m-d H:i') }}</td>
                    <td>{{ $entry->batch?->batch_number ?? '—' }}</td>
                    <td>{{ $tank?->serial ?? '—' }}</td>
                    <td>{{ $tank?->gasType?->name ?? '—' }}</td>
                    <td>{{ $tank?->capacity?->name ?? '—' }}</td>
                    <td>{{ $tank?->sanitary_registry ?? $tank?->product?->sanitary_registry ?? '—' }}</td>
                    <td>{{ $entry->toArea?->name ?? '—' }}</td>
                    <td>{{ $tank?->technicalStatus?->name ?? '—' }}</td>
                    <td>{{ $entry->reference_document ?? $entry->batch?->document_number ?? '—' }}</td>
                    <td>{{ $entry->performed_by_user_email ?? '—' }}</td>
                    <td>{{ $entry->notes ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">No existen entradas para el período seleccionado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
