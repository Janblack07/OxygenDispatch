<x-app-layout>
    <x-slot name="header">
        <div class="reception-header-layout">
            <div>
                <h2 class="reception-page-title">
                    Recepción técnica
                </h2>

                <p class="reception-page-subtitle">
                    Notas de entrega registradas en el sistema y disponibles para completar su ficha técnica.
                </p>
            </div>
        </div>
    </x-slot>

    <style>
        .reception-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .reception-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .reception-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .reception-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .reception-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .reception-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
        }

        .reception-alert.success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .reception-alert.error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .reception-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .reception-card + .reception-card {
            margin-top: 18px;
        }

        .reception-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .reception-card-body {
            padding: 18px 20px;
        }

        .reception-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .reception-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .reception-filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .reception-filter-actions {
            display: flex;
            gap: 8px;
        }

        .reception-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .reception-control {
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

        .reception-control::placeholder {
            color: #94a3b8;
        }

        .reception-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .reception-filter-button,
        .reception-clear-button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 13px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .reception-filter-button {
            border: 0;
            background: #0f172a;
            color: #ffffff;
            font-family: inherit;
        }

        .reception-filter-button:hover {
            background: #1e293b;
        }

        .reception-clear-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .reception-clear-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .reception-table-wrapper {
            overflow-x: auto;
        }

        .reception-table {
            width: 100%;
            min-width: 1080px;
            border-collapse: collapse;
        }

        .reception-table thead {
            background: #f8fafc;
        }

        .reception-table th {
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

        .reception-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .reception-table tbody tr {
            transition: background-color .15s ease;
        }

        .reception-table tbody tr:hover {
            background: #f8fafc;
        }

        .reception-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .reception-document-number {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .reception-document-description {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .reception-count-badge {
            min-width: 30px;
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

        .reception-status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .reception-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .reception-action-button {
            min-height: 31px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease;
        }

        .reception-action-button.view {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .reception-action-button.view:hover {
            background: #e0e7ff;
        }

        .reception-action-button.checklist {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
        }

        .reception-action-button.checklist:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .reception-action-button.pdf {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        .reception-action-button.pdf:hover {
            background: #fee2e2;
        }

        .reception-action-button.signed {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #047857;
        }

        .reception-action-button.signed:hover {
            background: #d1fae5;
        }

        .reception-action-button.create {
            min-height: 34px;
            border: 0;
            background: #4f46e5;
            color: #ffffff;
            padding: 0 12px;
        }

        .reception-action-button.create:hover {
            background: #4338ca;
        }

        .reception-empty-state {
            padding: 44px 18px;
            text-align: center;
        }

        .reception-empty-icon {
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

        .reception-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .reception-empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .reception-empty-text {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .reception-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        @media (max-width: 800px) {
            .reception-filter-grid {
                grid-template-columns: 1fr;
            }

            .reception-filter-actions {
                width: 100%;
            }

            .reception-filter-button,
            .reception-clear-button {
                flex: 1;
            }
        }

        @media (max-width: 640px) {
            .reception-page {
                padding-left: 12px;
                padding-right: 12px;
            }
        }
    </style>

    <div class="reception-page">
        <div class="reception-container">

            @if(session('success'))
                <div class="reception-alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="reception-alert error">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Filtros --}}
            <section class="reception-card">
                <div class="reception-card-header">
                    <div>
                        <h3 class="reception-section-title">
                            Buscar notas de entrega
                        </h3>

                        <p class="reception-section-subtitle">
                            Filtra por orden, proveedor, factura, lote o estado de la ficha.
                        </p>
                    </div>
                </div>

                <div class="reception-card-body">
                    <form
                        method="GET"
                        action="{{ route('technical-receptions.index') }}"
                    >
                        <div class="reception-filter-grid">

                            <div>
                                <label
                                    for="q"
                                    class="reception-field-label"
                                >
                                    Buscar nota de entrega
                                </label>

                                <input
                                    type="text"
                                    id="q"
                                    name="q"
                                    value="{{ request('q') }}"
                                    placeholder="Orden, proveedor, factura o lote"
                                    class="reception-control"
                                >
                            </div>

                            <div>
                                <label
                                    for="final_result"
                                    class="reception-field-label"
                                >
                                    Estado de ficha
                                </label>

                                <select
                                    id="final_result"
                                    name="final_result"
                                    class="reception-control"
                                >
                                    <option value="">
                                        Todas
                                    </option>

                                    <option
                                        value="sin_ficha"
                                        @selected(request('final_result') === 'sin_ficha')
                                    >
                                        Sin ficha
                                    </option>

                                    <option
                                        value="pendiente"
                                        @selected(request('final_result') === 'pendiente')
                                    >
                                        Pendiente
                                    </option>

                                    <option
                                        value="aprobado"
                                        @selected(request('final_result') === 'aprobado')
                                    >
                                        Aprobado
                                    </option>

                                    <option
                                        value="rechazado"
                                        @selected(request('final_result') === 'rechazado')
                                    >
                                        Rechazado
                                    </option>
                                </select>
                            </div>

                            <div class="reception-filter-actions">
                                <button
                                    type="submit"
                                    class="reception-filter-button"
                                >
                                    Filtrar
                                </button>

                                <a
                                    href="{{ route('technical-receptions.index') }}"
                                    class="reception-clear-button"
                                >
                                    Limpiar
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </section>

            {{-- Listado --}}
            <section class="reception-card">
                <div class="reception-card-header">
                    <div>
                        <h3 class="reception-section-title">
                            Notas de entrega
                        </h3>

                        <p class="reception-section-subtitle">
                            Documentos registrados desde el módulo de lotes.
                        </p>
                    </div>

                    <span class="reception-count-badge">
                        {{ $documents->total() }}
                    </span>
                </div>

                <div class="reception-table-wrapper">
                    <table class="reception-table">
                        <thead>
                            <tr>
                                <th>Nota / Orden</th>
                                <th>Proveedor</th>
                                <th>Factura</th>
                                <th>Recepción</th>
                                <th style="text-align: center;">Lotes</th>
                                <th style="text-align: center;">Cantidad</th>
                                <th style="text-align: center;">Estado</th>
                                <th style="text-align: right;">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($documents as $document)
                                @php
                                    $statusStyle = match($document->final_result) {
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
                                @endphp

                                <tr>
                                    <td>
                                        <div class="reception-document-number">
                                            {{ $document->document_number }}
                                        </div>

                                        <div class="reception-document-description">
                                            Documento del lote
                                        </div>
                                    </td>

                                    <td>
                                        {{ $document->supplier_name ?: '—' }}
                                    </td>

                                    <td>
                                        {{ $document->voucher_number ?: '—' }}
                                    </td>

                                    <td>
                                        {{ $document->received_at
                                            ? \Carbon\Carbon::parse($document->received_at)->format('Y-m-d')
                                            : '—' }}
                                    </td>

                                    <td style="text-align: center;">
                                        <span class="reception-count-badge">
                                            {{ $document->batches_count }}
                                        </span>
                                    </td>

                                    <td style="text-align: center;">
                                        <span class="reception-count-badge">
                                            {{ $document->quantity_received }}
                                        </span>
                                    </td>

                                    <td style="text-align: center;">
                                        @if($document->technical_reception_id)
                                            <span
                                                class="reception-status-badge"
                                                style="{{ $statusStyle }}"
                                            >
                                                {{ ucfirst($document->final_result ?? 'pendiente') }}
                                            </span>
                                        @else
                                            <span
                                                class="reception-status-badge"
                                                style="
                                                    border: 1px solid #e2e8f0;
                                                    background: #f8fafc;
                                                    color: #64748b;
                                                "
                                            >
                                                Sin ficha
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="reception-actions">
                                            @if($document->technical_reception_id)
                                                <a
                                                    href="{{ route('technical-receptions.show', $document->technical_reception_id) }}"
                                                    class="reception-action-button view"
                                                >
                                                    Ver
                                                </a>

                                                <a
                                                    href="{{ route('technical-receptions.edit', $document->technical_reception_id) }}"
                                                    class="reception-action-button checklist"
                                                >
                                                    Checklist
                                                </a>

                                                <a
                                                    href="{{ route('technical-receptions.pdf', $document->technical_reception_id) }}"
                                                    target="_blank"
                                                    class="reception-action-button pdf"
                                                >
                                                    PDF
                                                </a>

                                                @php
                                                    $signedPath = \App\Models\TechnicalReception::find(
                                                        $document->technical_reception_id
                                                    )?->signed_pdf_path;
                                                @endphp

                                                @if($signedPath)
                                                    <a
                                                        href="{{ asset('storage/' . $signedPath) }}"
                                                        target="_blank"
                                                        class="reception-action-button signed"
                                                    >
                                                        Firmado
                                                    </a>
                                                @endif
                                            @else
                                                <a
                                                    href="{{ route('technical-receptions.create', [
                                                        'document_number' => $document->document_number
                                                    ]) }}"
                                                    class="reception-action-button create"
                                                >
                                                    Crear checklist
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="reception-empty-state">
                                            <div class="reception-empty-icon">
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
                                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                                    />
                                                </svg>
                                            </div>

                                            <h4 class="reception-empty-title">
                                                No existen notas de entrega
                                            </h4>

                                            <p class="reception-empty-text">
                                                No se encontraron documentos registrados en el módulo de lotes.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($documents->hasPages())
                    <div class="reception-pagination">
                        {{ $documents->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
