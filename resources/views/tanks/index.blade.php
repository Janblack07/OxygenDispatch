<x-app-layout>
    <x-slot name="header">
        <div class="tank-header-layout">
            <div>
                <h2 class="tank-page-title">
                    Tanques
                </h2>

                <p class="tank-page-subtitle">
                    Consulta y filtra las unidades por serial, lote, gas, capacidad, área, vencimiento y estado técnico.
                </p>
            </div>
        </div>
    </x-slot>

    <style>
        .tank-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .tank-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .tank-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .tank-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .tank-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .tank-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .tank-card + .tank-card {
            margin-top: 18px;
        }

        .tank-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .tank-card-body {
            padding: 18px 20px;
        }

        .tank-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .tank-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .tank-filter-grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 12px;
            align-items: end;
        }

        .tank-filter-serial {
            grid-column: span 3;
        }

        .tank-filter-batch {
            grid-column: span 2;
        }

        .tank-filter-gas {
            grid-column: span 2;
        }

        .tank-filter-capacity {
            grid-column: span 2;
        }

        .tank-filter-area {
            grid-column: span 3;
        }

        .tank-filter-technical {
            grid-column: span 3;
        }

        .tank-filter-status {
            grid-column: span 2;
        }

        .tank-filter-action {
            grid-column: span 2;
        }

        .tank-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            line-height: 1;
            font-weight: 600;
        }

        .tank-control {
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

        .tank-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .tank-control::placeholder {
            color: #94a3b8;
        }

        .tank-filter-button {
            width: 100%;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 14px;
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

        .tank-filter-button:hover {
            background: #1e293b;
        }

        .tank-filter-button svg {
            width: 16px;
            height: 16px;
        }

        .tank-filter-footer {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        .tank-clear-link {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
        }

        .tank-clear-link:hover {
            color: #0f172a;
            text-decoration: underline;
        }

        .tank-total-badge {
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

        .tank-table-wrapper {
            overflow-x: auto;
        }

        .tank-table {
            width: 100%;
            min-width: 1220px;
            border-collapse: collapse;
        }

        .tank-table thead {
            background: #f8fafc;
        }

        .tank-table th {
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

        .tank-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .tank-table tbody tr {
            transition: background-color .15s ease;
        }

        .tank-table tbody tr:hover {
            background: #f8fafc;
        }

        .tank-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .tank-serial {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .tank-batch {
            color: #334155;
            font-weight: 600;
        }

        .tank-secondary-text {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .tank-area-badge,
        .tank-technical-badge,
        .tank-status-badge,
        .tank-expiration-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            line-height: 1;
            font-weight: 700;
            white-space: nowrap;
        }

        .tank-area-badge {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
        }

        .tank-expiration-badge.valid {
            border: 1px solid #bfdbfe;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .tank-expiration-badge.warning {
            border: 1px solid #fde68a;
            background: #fffbeb;
            color: #92400e;
        }

        .tank-expiration-badge.expired {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .tank-expiration-note {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 10px;
            white-space: nowrap;
        }

        .tank-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        .tank-empty-state {
            padding: 44px 18px;
            text-align: center;
        }

        .tank-empty-icon {
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

        .tank-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .tank-empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .tank-empty-text {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        @media (max-width: 1000px) {
            .tank-filter-serial,
            .tank-filter-batch,
            .tank-filter-gas,
            .tank-filter-capacity,
            .tank-filter-area,
            .tank-filter-technical,
            .tank-filter-status,
            .tank-filter-action {
                grid-column: span 6;
            }
        }

        @media (max-width: 640px) {
            .tank-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .tank-filter-serial,
            .tank-filter-batch,
            .tank-filter-gas,
            .tank-filter-capacity,
            .tank-filter-area,
            .tank-filter-technical,
            .tank-filter-status,
            .tank-filter-action {
                grid-column: span 12;
            }
        }
    </style>

    <div class="tank-page">
        <div class="tank-container">

            {{-- Filtros --}}
            <section class="tank-card">
                <div class="tank-card-header">
                    <div>
                        <h3 class="tank-section-title">
                            Buscar tanques
                        </h3>

                        <p class="tank-section-subtitle">
                            Usa uno o varios criterios para localizar unidades específicas.
                        </p>
                    </div>
                </div>

                <div class="tank-card-body">
                    <form
                        method="GET"
                        action="{{ route('tanks.index') }}"
                    >
                        <div class="tank-filter-grid">

                            <div class="tank-filter-serial">
                                <label
                                    for="serial"
                                    class="tank-field-label"
                                >
                                    Serial
                                </label>

                                <input
                                    id="serial"
                                    name="serial"
                                    value="{{ request('serial') }}"
                                    class="tank-control"
                                    placeholder="OXI-000001"
                                >
                            </div>

                            <div class="tank-filter-batch">
                                <label
                                    for="batch_number"
                                    class="tank-field-label"
                                >
                                    Lote
                                </label>

                                <input
                                    id="batch_number"
                                    name="batch_number"
                                    value="{{ request('batch_number') }}"
                                    class="tank-control"
                                    placeholder="LOTE-001"
                                >
                            </div>

                            <div class="tank-filter-gas">
                                <label
                                    for="gas_type_id"
                                    class="tank-field-label"
                                >
                                    Gas
                                </label>

                                <select
                                    id="gas_type_id"
                                    name="gas_type_id"
                                    class="tank-control"
                                >
                                    <option value="">
                                        Todos
                                    </option>

                                    @foreach($gasTypes as $g)
                                        <option
                                            value="{{ $g->id }}"
                                            @selected(request('gas_type_id') == $g->id)
                                        >
                                            {{ $g->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="tank-filter-capacity">
                                <label
                                    for="capacity_id"
                                    class="tank-field-label"
                                >
                                    Capacidad
                                </label>

                                <select
                                    id="capacity_id"
                                    name="capacity_id"
                                    class="tank-control"
                                >
                                    <option value="">
                                        Todas
                                    </option>

                                    @foreach($capacities as $c)
                                        <option
                                            value="{{ $c->id }}"
                                            @selected(request('capacity_id') == $c->id)
                                        >
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="tank-filter-area">
                                <label
                                    for="warehouse_area_id"
                                    class="tank-field-label"
                                >
                                    Área
                                </label>

                                <select
                                    id="warehouse_area_id"
                                    name="warehouse_area_id"
                                    class="tank-control"
                                >
                                    <option value="">
                                        Todas
                                    </option>

                                    @foreach($areas as $a)
                                        <option
                                            value="{{ $a->id }}"
                                            @selected(request('warehouse_area_id') == $a->id)
                                        >
                                            {{ $a->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="tank-filter-technical">
                                <label
                                    for="technical_status_id"
                                    class="tank-field-label"
                                >
                                    Estado técnico
                                </label>

                                <select
                                    id="technical_status_id"
                                    name="technical_status_id"
                                    class="tank-control"
                                >
                                    <option value="">
                                        Todos
                                    </option>

                                    @foreach($techStatuses as $t)
                                        <option
                                            value="{{ $t->id }}"
                                            @selected(request('technical_status_id') == $t->id)
                                        >
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="tank-filter-status">
                                <label
                                    for="status"
                                    class="tank-field-label"
                                >
                                    Estado operativo
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="tank-control"
                                >
                                    <option value="">
                                        Todos
                                    </option>

                                    <option
                                        value="1"
                                        @selected(request('status') === '1')
                                    >
                                        Disponible
                                    </option>

                                    <option
                                        value="2"
                                        @selected(request('status') === '2')
                                    >
                                        Despachado
                                    </option>

                                    <option
                                        value="3"
                                        @selected(request('status') === '3')
                                    >
                                        Baja
                                    </option>
                                </select>
                            </div>

                            <div class="tank-filter-action">
                                <button
                                    type="submit"
                                    class="tank-filter-button"
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
                                            d="M3 4.5h18M6.75 9.75h10.5M10.5 15h3"
                                        />
                                    </svg>

                                    Filtrar
                                </button>
                            </div>

                        </div>

                        @if(
                            request()->filled('serial') ||
                            request()->filled('batch_number') ||
                            request()->filled('gas_type_id') ||
                            request()->filled('capacity_id') ||
                            request()->filled('warehouse_area_id') ||
                            request()->filled('technical_status_id') ||
                            request()->filled('status')
                        )
                            <div class="tank-filter-footer">
                                <a
                                    href="{{ route('tanks.index') }}"
                                    class="tank-clear-link"
                                >
                                    Limpiar filtros
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </section>

            {{-- Listado --}}
            <section class="tank-card">
                <div class="tank-card-header">
                    <div>
                        <h3 class="tank-section-title">
                            Listado de tanques
                        </h3>

                        <p class="tank-section-subtitle">
                            Consulta la ubicación, vencimiento, estado técnico y estado operativo de cada unidad.
                        </p>
                    </div>

                    <span class="tank-total-badge">
                        Total:
                        <strong>{{ $tanks->total() }}</strong>
                    </span>
                </div>

                <div class="tank-table-wrapper">
                    <table class="tank-table">
                        <thead>
                            <tr>
                                <th>Lote</th>
                                <th>Serial</th>
                                <th>Gas</th>
                                <th>Capacidad</th>
                                <th>Registro sanitario</th>
                                <th>Vencimiento</th>
                                <th>Área</th>
                                <th>Estado técnico</th>
                                <th>Estado operativo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($tanks as $tank)
                                @php
                                    $technicalStatusName = mb_strtolower(
                                        trim($tank->technicalStatus?->name ?? '')
                                    );

                                    $technicalStyle = match($technicalStatusName) {
                                        'aprobado' => '
                                            border: 1px solid #a7f3d0;
                                            background: #ecfdf5;
                                            color: #065f46;
                                        ',

                                        'rechazado' => '
                                            border: 1px solid #fecaca;
                                            background: #fef2f2;
                                            color: #991b1b;
                                        ',

                                        default => '
                                            border: 1px solid #fde68a;
                                            background: #fffbeb;
                                            color: #92400e;
                                        ',
                                    };

                                    $statusLabel = $tank->status?->label() ?? $tank->status;

                                    $normalizedStatus = mb_strtolower(
                                        trim((string) $statusLabel)
                                    );

                                    $statusStyle = match($normalizedStatus) {
                                        'disponible' => '
                                            border: 1px solid #a7f3d0;
                                            background: #ecfdf5;
                                            color: #065f46;
                                        ',

                                        'despachado' => '
                                            border: 1px solid #bfdbfe;
                                            background: #eff6ff;
                                            color: #1d4ed8;
                                        ',

                                        'baja' => '
                                            border: 1px solid #fecaca;
                                            background: #fef2f2;
                                            color: #991b1b;
                                        ',

                                        default => '
                                            border: 1px solid #e2e8f0;
                                            background: #f8fafc;
                                            color: #475569;
                                        ',
                                    };

                                    $expirationClass = 'valid';
                                    $expirationNote = null;
                                    $expirationDate = null;

                                    if ($tank->expires_at) {
                                        $expirationDate = $tank->expires_at instanceof \Carbon\CarbonInterface
                                            ? $tank->expires_at
                                            : \Carbon\Carbon::parse($tank->expires_at);

                                        if ($expirationDate->isPast()) {
                                            $expirationClass = 'expired';
                                            $expirationNote = 'Vencido';
                                        } elseif ($expirationDate->lte(now()->addMonths(6))) {
                                            $expirationClass = 'warning';
                                            $expirationNote = 'Próximo a vencer';
                                        } else {
                                            $expirationClass = 'valid';
                                            $expirationNote = 'Vigente';
                                        }
                                    }
                                @endphp

                                <tr>
                                    <td>
                                        <div class="tank-batch">
                                            {{ $tank->batch?->batch_number ?? '—' }}
                                        </div>

                                        @if($tank->batch?->document_number)
                                            <div class="tank-secondary-text">
                                                Orden:
                                                {{ $tank->batch->document_number }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="tank-serial">
                                            {{ $tank->serial }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $tank->gasType?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $tank->capacity?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $tank->sanitary_registry
                                            ?? $tank->product?->sanitary_registry
                                            ?? '—' }}
                                    </td>

                                    <td>
                                        @if($expirationDate)
                                            <span
                                                class="tank-expiration-badge {{ $expirationClass }}"
                                                title="{{ $expirationDate->format('Y-m-d') }}"
                                            >
                                                {{ $expirationDate->format('d/m/Y') }}
                                            </span>

                                            <div class="tank-expiration-note">
                                                {{ $expirationNote }}
                                            </div>
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td>
                                        <span class="tank-area-badge">
                                            {{ $tank->warehouseArea?->name ?? '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="tank-technical-badge"
                                            style="{{ $technicalStyle }}"
                                        >
                                            {{ $tank->technicalStatus?->name ?? '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="tank-status-badge"
                                            style="{{ $statusStyle }}"
                                        >
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="tank-empty-state">
                                            <div class="tank-empty-icon">
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
                                                        d="M20 13V7a2 2 0 0 0-2-2h-3V3H9v2H6a2 2 0 0 0-2 2v6m16 0v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6m16 0H4"
                                                    />
                                                </svg>
                                            </div>

                                            <h4 class="tank-empty-title">
                                                No hay tanques con esos filtros
                                            </h4>

                                            <p class="tank-empty-text">
                                                Ajusta los filtros o limpia la búsqueda para consultar otras unidades.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($tanks->hasPages())
                    <div class="tank-pagination">
                        {{ $tanks->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
