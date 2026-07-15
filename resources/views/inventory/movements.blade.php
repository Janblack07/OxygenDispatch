<x-app-layout>
    <x-slot name="header">
        <div class="movement-header-layout">
            <div>
                <h2 class="movement-page-title">
                    Movimientos de inventario
                </h2>

                <p class="movement-page-subtitle">
                    Consulta entradas, traslados, salidas y cambios de estado técnico.
                </p>
            </div>
        </div>
    </x-slot>

    <style>
        .movement-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .movement-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .movement-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .movement-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .movement-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .movement-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .movement-card + .movement-card {
            margin-top: 18px;
        }

        .movement-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .movement-card-body {
            padding: 18px 20px;
        }

        .movement-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .movement-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .movement-filter-grid {
            display: grid;
            grid-template-columns: 3fr 5fr 3fr 1fr;
            gap: 12px;
            align-items: end;
        }

        .movement-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            line-height: 1.2;
            font-weight: 600;
        }

        .movement-control {
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
            line-height: 1.4;
            outline: none;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
            transition:
                border-color .15s ease,
                box-shadow .15s ease;
        }

        .movement-control::placeholder {
            color: #94a3b8;
        }

        .movement-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .movement-filter-button {
            width: 100%;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border: 0;
            border-radius: 10px;
            background: #0f172a;
            color: #ffffff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color .15s ease;
        }

        .movement-filter-button:hover {
            background: #1e293b;
        }

        .movement-filter-footer {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        .movement-clear-link {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
        }

        .movement-clear-link:hover {
            color: #0f172a;
            text-decoration: underline;
        }

        .movement-total-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            background: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .movement-table-wrapper {
            overflow-x: auto;
        }

        .movement-table {
            width: 100%;
            min-width: 1280px;
            border-collapse: collapse;
        }

        .movement-table thead {
            background: #f8fafc;
        }

        .movement-table th {
            padding: 11px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .movement-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .movement-table tbody tr {
            transition: background-color .15s ease;
        }

        .movement-table tbody tr:hover {
            background: #f8fafc;
        }

        .movement-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .movement-date {
            color: #334155;
            font-weight: 600;
            white-space: nowrap;
        }

        .movement-time {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .movement-type-badge,
        .movement-area-badge,
        .movement-document-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .movement-type-badge.entry {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .movement-type-badge.transfer {
            border: 1px solid #bfdbfe;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .movement-type-badge.exit {
            border: 1px solid #fed7aa;
            background: #fff7ed;
            color: #c2410c;
        }

        .movement-type-badge.technical {
            border: 1px solid #ddd6fe;
            background: #f5f3ff;
            color: #6d28d9;
        }

        .movement-type-badge.default {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
        }

        .movement-tank-serial {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .movement-batch-number {
            color: #334155;
            font-weight: 600;
            white-space: nowrap;
        }

        .movement-area-badge {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
        }

        .movement-document-badge {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .movement-user {
            max-width: 220px;
            overflow: hidden;
            color: #64748b;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .movement-notes {
            max-width: 300px;
            color: #64748b;
            line-height: 1.45;
        }

        .movement-empty-state {
            padding: 44px 18px;
            text-align: center;
        }

        .movement-empty-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #eef2ff;
            color: #4f46e5;
        }

        .movement-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .movement-empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .movement-empty-text {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .movement-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        @media (max-width: 900px) {
            .movement-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .movement-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .movement-filter-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="movement-page">
        <div class="movement-container">

            {{-- Filtros --}}
            <section class="movement-card">
                <div class="movement-card-header">
                    <div>
                        <h3 class="movement-section-title">
                            Buscar movimientos
                        </h3>

                        <p class="movement-section-subtitle">
                            Filtra por tipo de movimiento, área relacionada o serial del tanque.
                        </p>
                    </div>
                </div>

                <div class="movement-card-body">
                    <form
                        method="GET"
                        action="{{ route('inventory.movements') }}"
                    >
                        <div class="movement-filter-grid">

                            {{-- Tipo --}}
                            <div>
                                <label
                                    for="type"
                                    class="movement-field-label"
                                >
                                    Tipo
                                </label>

                                <select
                                    id="type"
                                    name="type"
                                    class="movement-control"
                                >
                                    <option value="">
                                        Todos
                                    </option>

                                    <option
                                        value="1"
                                        @selected(request('type') == '1')
                                    >
                                        Entrada
                                    </option>

                                    <option
                                        value="2"
                                        @selected(request('type') == '2')
                                    >
                                        Traslado
                                    </option>

                                    <option
                                        value="3"
                                        @selected(request('type') == '3')
                                    >
                                        Salida
                                    </option>

                                    <option
                                        value="4"
                                        @selected(request('type') == '4')
                                    >
                                        Cambio estado técnico
                                    </option>
                                </select>
                            </div>

                            {{-- Área --}}
                            <div>
                                <label
                                    for="area_id"
                                    class="movement-field-label"
                                >
                                    Área de origen o destino
                                </label>

                                <select
                                    id="area_id"
                                    name="area_id"
                                    class="movement-control"
                                >
                                    <option value="">
                                        Todas
                                    </option>

                                    @foreach($areas as $a)
                                        <option
                                            value="{{ $a->id }}"
                                            @selected(
                                                (string) $a->id === request('area_id')
                                            )
                                        >
                                            {{ $a->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Serial --}}
                            <div>
                                <label
                                    for="serial"
                                    class="movement-field-label"
                                >
                                    Serial del tanque
                                </label>

                                <input
                                    id="serial"
                                    name="serial"
                                    value="{{ request('serial') }}"
                                    class="movement-control"
                                    placeholder="OXI-000001"
                                >
                            </div>

                            {{-- Botón --}}
                            <div>
                                <button
                                    type="submit"
                                    class="movement-filter-button"
                                >
                                    Filtrar
                                </button>
                            </div>

                        </div>

                        @if(
                            request()->filled('type')
                            || request()->filled('area_id')
                            || request()->filled('serial')
                        )
                            <div class="movement-filter-footer">
                                <a
                                    href="{{ route('inventory.movements') }}"
                                    class="movement-clear-link"
                                >
                                    Limpiar filtros
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </section>

            {{-- Tabla --}}
            <section class="movement-card">
                <div class="movement-card-header">
                    <div>
                        <h3 class="movement-section-title">
                            Historial de movimientos
                        </h3>

                        <p class="movement-section-subtitle">
                            Registro cronológico de entradas, traslados, salidas y cambios técnicos.
                        </p>
                    </div>

                    <span class="movement-total-badge">
                        Total:
                        <strong>{{ $movements->total() }}</strong>
                    </span>
                </div>

                <div class="movement-table-wrapper">
                    <table class="movement-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Tanque</th>
                                <th>Lote</th>
                                <th>Desde</th>
                                <th>Hacia</th>
                                <th>Documento</th>
                                <th>Usuario</th>
                                <th>Notas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($movements as $m)
                                @php
                                    $movementTypeValue = $m->type?->value;

                                    $movementTypeClass = match($movementTypeValue) {
                                        1 => 'entry',
                                        2 => 'transfer',
                                        3 => 'exit',
                                        4 => 'technical',
                                        default => 'default',
                                    };

                                    $fromText = match($movementTypeValue) {
                                        1 => 'Proveedor / Recepción',
                                        2 => $m->fromArea?->name ?? '—',
                                        3 => $m->fromArea?->name ?? '—',
                                        4 => '—',
                                        default => $m->fromArea?->name ?? '—',
                                    };

                                    $toText = match($movementTypeValue) {
                                        1 => $m->toArea?->name ?? '—',
                                        2 => $m->toArea?->name ?? '—',
                                        3 => 'Salida',
                                        4 => '—',
                                        default => $m->toArea?->name ?? '—',
                                    };

                                    $documentText = $movementTypeValue === 1
                                        ? (
                                            $m->batch?->document_number
                                            ?? $m->reference_document
                                            ?? '—'
                                        )
                                        : (
                                            $m->reference_document
                                            ?? '—'
                                        );
                                @endphp

                                <tr>
                                    {{-- Fecha --}}
                                    <td>
                                        <div class="movement-date">
                                            {{ optional($m->occurred_at)->format('Y-m-d') ?: '—' }}
                                        </div>

                                        @if($m->occurred_at)
                                            <div class="movement-time">
                                                {{ optional($m->occurred_at)->format('H:i') }}
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Tipo --}}
                                    <td>
                                        <span class="movement-type-badge {{ $movementTypeClass }}">
                                            {{ $m->type?->label() ?? '—' }}
                                        </span>
                                    </td>

                                    {{-- Tanque --}}
                                    <td>
                                        <span class="movement-tank-serial">
                                            {{ $m->tankUnit?->serial ?? $m->tank_unit_id ?? '—' }}
                                        </span>
                                    </td>

                                    {{-- Lote --}}
                                    <td>
                                        <span class="movement-batch-number">
                                            {{ $m->batch?->batch_number ?? '—' }}
                                        </span>
                                    </td>

                                    {{-- Desde --}}
                                    <td>
                                        <span class="movement-area-badge">
                                            {{ $fromText }}
                                        </span>
                                    </td>

                                    {{-- Hacia --}}
                                    <td>
                                        <span class="movement-area-badge">
                                            {{ $toText }}
                                        </span>
                                    </td>

                                    {{-- Documento --}}
                                    <td>
                                        <span class="movement-document-badge">
                                            {{ $documentText }}
                                        </span>
                                    </td>

                                    {{-- Usuario --}}
                                    <td>
                                        <div
                                            class="movement-user"
                                            title="{{ $m->performed_by_user_email ?? '' }}"
                                        >
                                            {{ $m->performed_by_user_email ?? '—' }}
                                        </div>
                                    </td>

                                    {{-- Notas --}}
                                    <td>
                                        <div class="movement-notes">
                                            {{ $m->notes ?? '—' }}
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="movement-empty-state">
                                            <div class="movement-empty-icon">
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

                                            <h4 class="movement-empty-title">
                                                No hay movimientos
                                            </h4>

                                            <p class="movement-empty-text">
                                                No se encontraron movimientos para los filtros aplicados.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($movements->hasPages())
                    <div class="movement-pagination">
                        {{ $movements->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
