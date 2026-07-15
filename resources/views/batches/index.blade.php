<x-app-layout>
    <x-slot name="header">
        <div class="batch-header-layout">
            <div>
                <h2 class="batch-page-title">
                    Lotes
                </h2>

                <p class="batch-page-subtitle">
                    Registra lotes y genera tanques de diferentes productos y capacidades desde el detalle.
                </p>
            </div>

            <a
                href="{{ route('batches.create') }}"
                class="batch-primary-button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="batch-button-icon"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

                Nuevo lote
            </a>
        </div>
    </x-slot>

    <style>
        .batch-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .batch-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .batch-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .batch-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .batch-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .batch-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .batch-card + .batch-card {
            margin-top: 18px;
        }

        .batch-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .batch-card-body {
            padding: 18px 20px;
        }

        .batch-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .batch-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .batch-primary-button,
        .batch-filter-button,
        .batch-view-button,
        .batch-empty-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: 0;
            text-decoration: none;
            cursor: pointer;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease,
                box-shadow .15s ease,
                transform .15s ease;
        }

        .batch-primary-button {
            flex-shrink: 0;
            min-height: 40px;
            padding: 0 14px;
            border-radius: 10px;
            background: #4f46e5;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.16);
        }

        .batch-primary-button:hover {
            background: #4338ca;
            transform: translateY(-1px);
        }

        .batch-button-icon {
            width: 17px;
            height: 17px;
        }

        .batch-filter-grid {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 3fr) minmax(0, 3fr) auto;
            gap: 12px;
            align-items: end;
        }

        .batch-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            line-height: 1;
            font-weight: 600;
        }

        .batch-control {
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

        .batch-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .batch-control::placeholder {
            color: #94a3b8;
        }

        .batch-filter-button {
            min-height: 40px;
            padding: 0 14px;
            border-radius: 10px;
            background: #0f172a;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
        }

        .batch-filter-button:hover {
            background: #1e293b;
        }

        .batch-filter-footer {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        .batch-clear-link {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
        }

        .batch-clear-link:hover {
            color: #0f172a;
            text-decoration: underline;
        }

        .batch-total-badge {
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

        .batch-table-wrapper {
            overflow-x: auto;
        }

        .batch-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .batch-table thead {
            background: #f8fafc;
        }

        .batch-table th {
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

        .batch-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 13px;
            vertical-align: middle;
        }

        .batch-table tbody tr {
            transition: background-color .15s ease;
        }

        .batch-table tbody tr:hover {
            background: #f8fafc;
        }

        .batch-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .batch-number {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .batch-document {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 11px;
        }

        .batch-count-badge {
            min-width: 31px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 8px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
        }

        .batch-date {
            color: #334155;
            font-size: 12px;
            font-weight: 600;
        }

        .batch-time {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .batch-email {
            max-width: 220px;
            overflow: hidden;
            color: #64748b;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .batch-view-button {
            min-height: 32px;
            padding: 0 11px;
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .batch-view-button:hover {
            background: #e0e7ff;
        }

        .batch-empty-state {
            padding: 42px 18px;
            text-align: center;
        }

        .batch-empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #eef2ff;
            color: #4f46e5;
        }

        .batch-empty-icon svg {
            width: 24px;
            height: 24px;
        }

        .batch-empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .batch-empty-text {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .batch-empty-button {
            min-height: 38px;
            margin-top: 16px;
            padding: 0 13px;
            border-radius: 10px;
            background: #4f46e5;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
        }

        .batch-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        @media (max-width: 900px) {
            .batch-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .batch-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .batch-header-layout {
                flex-direction: column;
            }

            .batch-primary-button {
                width: 100%;
            }

            .batch-filter-grid {
                grid-template-columns: 1fr;
            }

            .batch-filter-button {
                width: 100%;
            }
        }
    </style>

    <div class="batch-page">
        <div class="batch-container">

            {{-- Filtros --}}
            <section class="batch-card">
                <div class="batch-card-header">
                    <div>
                        <h3 class="batch-section-title">
                            Buscar lotes
                        </h3>

                        <p class="batch-section-subtitle">
                            Filtra por número de lote, documento, gas o capacidad referencial.
                        </p>
                    </div>
                </div>

                <div class="batch-card-body">
                    <form
                        method="GET"
                        action="{{ route('batches.index') }}"
                    >
                        <div class="batch-filter-grid">

                            <div>
                                <label
                                    for="q"
                                    class="batch-field-label"
                                >
                                    Buscar
                                </label>

                                <input
                                    id="q"
                                    name="q"
                                    value="{{ request('q') }}"
                                    class="batch-control"
                                    placeholder="Lote o documento..."
                                >
                            </div>

                            <div>
                                <label
                                    for="gas_type_id"
                                    class="batch-field-label"
                                >
                                    Gas referencial
                                </label>

                                <select
                                    id="gas_type_id"
                                    name="gas_type_id"
                                    class="batch-control"
                                >
                                    <option value="">
                                        Todos
                                    </option>

                                    @foreach($gasTypes ?? [] as $g)
                                        <option
                                            value="{{ $g->id }}"
                                            @selected(request('gas_type_id') == $g->id)
                                        >
                                            {{ $g->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label
                                    for="capacity_id"
                                    class="batch-field-label"
                                >
                                    Capacidad referencial
                                </label>

                                <select
                                    id="capacity_id"
                                    name="capacity_id"
                                    class="batch-control"
                                >
                                    <option value="">
                                        Todas
                                    </option>

                                    @foreach($capacities ?? [] as $c)
                                        <option
                                            value="{{ $c->id }}"
                                            @selected(request('capacity_id') == $c->id)
                                        >
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    class="batch-filter-button"
                                >
                                    Filtrar
                                </button>
                            </div>

                        </div>

                        @if(
                            request()->filled('q')
                            || request()->filled('gas_type_id')
                            || request()->filled('capacity_id')
                        )
                            <div class="batch-filter-footer">
                                <a
                                    href="{{ route('batches.index') }}"
                                    class="batch-clear-link"
                                >
                                    Limpiar filtros
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </section>

            {{-- Listado --}}
            <section class="batch-card">
                <div class="batch-card-header">
                    <div>
                        <h3 class="batch-section-title">
                            Listado de lotes
                        </h3>

                        <p class="batch-section-subtitle">
                            Consulta los lotes registrados y accede a su detalle.
                        </p>
                    </div>

                    <span class="batch-total-badge">
                        Total:
                        <strong>{{ $batches->total() }}</strong>
                    </span>
                </div>

                <div class="batch-table-wrapper">
                    <table class="batch-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Lote</th>
                                <th>Gas ref.</th>
                                <th>Capacidad ref.</th>
                                <th>Tanques</th>
                                <th>Recibido</th>
                                <th>Creador</th>
                                <th style="text-align: right;">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($batches as $batch)
                                <tr>
                                    <td>
                                        {{ $batch->id }}
                                    </td>

                                    <td>
                                        <div class="batch-number">
                                            {{ $batch->batch_number }}
                                        </div>

                                        <div class="batch-document">
                                            Orden:
                                            {{ $batch->document_number ?: '—' }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $batch->gasType?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $batch->capacity?->name ?? '—' }}
                                    </td>

                                    <td>
                                        <span class="batch-count-badge">
                                            {{ $batch->tank_units_count ?? $batch->tankUnits?->count() ?? 0 }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="batch-date">
                                            {{ optional($batch->received_at)->format('Y-m-d') ?: '—' }}
                                        </div>

                                        @if($batch->received_at)
                                            <div class="batch-time">
                                                {{ optional($batch->received_at)->format('H:i') }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="batch-email">
                                            {{ $batch->created_by_user_email ?: '—' }}
                                        </div>
                                    </td>

                                    <td style="text-align: right;">
                                        <a
                                            href="{{ route('batches.show', $batch) }}"
                                            class="batch-view-button"
                                        >
                                            Ver detalle
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="batch-empty-state">
                                            <div class="batch-empty-icon">
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
                                                        d="M20 7l-8-4-8 4m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"
                                                    />
                                                </svg>
                                            </div>

                                            <h4 class="batch-empty-title">
                                                Aún no hay lotes
                                            </h4>

                                            <p class="batch-empty-text">
                                                Crea tu primer lote para poder generar tanques.
                                            </p>

                                            <a
                                                href="{{ route('batches.create') }}"
                                                class="batch-empty-button"
                                            >
                                                Crear lote
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($batches->hasPages())
                    <div class="batch-pagination">
                        {{ $batches->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
