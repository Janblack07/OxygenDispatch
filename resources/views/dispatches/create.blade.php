<x-app-layout>
    @php
        $selectedOldTankIds = collect(old('tank_ids', []))
            ->map(fn ($id) => (string) $id)
            ->values();
    @endphp

    <x-slot name="header">
        <div class="dispatch-create-header">
            <div>
                <h2 class="dispatch-create-page-title">
                    Nuevo despacho
                </h2>

                <p class="dispatch-create-page-subtitle">
                    Valida el cliente, completa los datos y selecciona uno o más tanques disponibles.
                </p>
            </div>

            <a
                href="{{ route('dispatches.index') }}"
                class="dispatch-create-back-button"
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
                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                    />
                </svg>

                Volver
            </a>
        </div>
    </x-slot>

    <style>
        /*
        |--------------------------------------------------------------------------
        | Página
        |--------------------------------------------------------------------------
        */

        .dispatch-create-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .dispatch-create-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .dispatch-create-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .dispatch-create-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .dispatch-create-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .dispatch-create-back-button {
            flex-shrink: 0;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease;
        }

        .dispatch-create-back-button:hover {
            border-color: #94a3b8;
            background: #f8fafc;
            color: #0f172a;
        }

        .dispatch-create-back-button svg {
            width: 16px;
            height: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Errores
        |--------------------------------------------------------------------------
        */

        .dispatch-create-errors {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #fecaca;
            border-radius: 12px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 12px;
        }

        .dispatch-create-errors-title {
            margin: 0;
            font-weight: 700;
        }

        .dispatch-create-errors ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        /*
        |--------------------------------------------------------------------------
        | Cards
        |--------------------------------------------------------------------------
        */

        .dispatch-create-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .dispatch-create-card + .dispatch-create-card {
            margin-top: 18px;
        }

        .dispatch-create-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .dispatch-create-card-body {
            padding: 20px;
        }

        .dispatch-create-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .dispatch-create-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Grid formulario
        |--------------------------------------------------------------------------
        */

        .dispatch-create-form-grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 14px;
        }

        .dispatch-col-3 {
            grid-column: span 3;
        }

        .dispatch-col-4 {
            grid-column: span 4;
        }

        .dispatch-col-12 {
            grid-column: span 12;
        }

        /*
        |--------------------------------------------------------------------------
        | Inputs
        |--------------------------------------------------------------------------
        */

        .dispatch-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            line-height: 1.2;
            font-weight: 600;
        }

        .dispatch-control {
            width: 100%;
            min-height: 42px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            padding: 9px 12px;
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

        .dispatch-control::placeholder {
            color: #94a3b8;
        }

        .dispatch-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        textarea.dispatch-control {
            min-height: 78px;
            resize: vertical;
        }

        .dispatch-control.readonly {
            background: #f8fafc;
            color: #475569;
        }

        /*
        |--------------------------------------------------------------------------
        | Validación cliente
        |--------------------------------------------------------------------------
        */

        .dispatch-client-lookup-row {
            display: flex;
            align-items: stretch;
            gap: 8px;
        }

        .dispatch-client-lookup-row .dispatch-control {
            min-width: 0;
            flex: 1;
        }

        .dispatch-validate-button {
            flex-shrink: 0;
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 14px;
            border: 0;
            border-radius: 10px;
            background: #4f46e5;
            color: #ffffff;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition:
                background-color .15s ease,
                opacity .15s ease;
        }

        .dispatch-validate-button:hover {
            background: #4338ca;
        }

        .dispatch-validate-button:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .dispatch-client-success,
        .dispatch-client-error {
            margin-top: 6px;
            font-size: 11px;
            line-height: 1.45;
        }

        .dispatch-client-success {
            color: #047857;
        }

        .dispatch-client-error {
            color: #dc2626;
        }

        .hidden {
            display: none !important;
        }

        /*
        |--------------------------------------------------------------------------
        | Contadores
        |--------------------------------------------------------------------------
        */

        .dispatch-tanks-counters {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .dispatch-counter {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            background: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .dispatch-counter.selected {
            border-color: #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        /*
        |--------------------------------------------------------------------------
        | Filtros de tanques
        |--------------------------------------------------------------------------
        */

        .dispatch-tank-filter-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .dispatch-filter-actions {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        /*
        |--------------------------------------------------------------------------
        | Botones
        |--------------------------------------------------------------------------
        */

        .dispatch-secondary-button,
        .dispatch-cancel-button,
        .dispatch-submit-button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            box-sizing: border-box;
            padding: 0 13px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease,
                box-shadow .15s ease;
        }

        .dispatch-secondary-button,
        .dispatch-cancel-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .dispatch-secondary-button:hover,
        .dispatch-cancel-button:hover {
            border-color: #94a3b8;
            background: #f8fafc;
            color: #0f172a;
        }

        .dispatch-submit-button {
            border: 0;
            background: #4f46e5;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
        }

        .dispatch-submit-button:hover {
            background: #4338ca;
        }

        /*
        |--------------------------------------------------------------------------
        | Tabla de tanques
        |--------------------------------------------------------------------------
        */

        .dispatch-tanks-table-box {
            margin-top: 14px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
        }

        .dispatch-tanks-table-scroll {
            overflow-x: auto;
        }

        .dispatch-tanks-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .dispatch-tanks-table thead {
            background: #f8fafc;
        }

        .dispatch-tanks-table th {
            padding: 11px 13px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 10px;
            line-height: 1.2;
            font-weight: 700;
            letter-spacing: .05em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .dispatch-tanks-table td {
            padding: 12px 13px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .dispatch-tanks-table tbody tr {
            transition: background-color .15s ease;
        }

        .dispatch-tanks-table tbody tr:hover {
            background: #f8fafc;
        }

        .dispatch-tanks-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .dispatch-tank-checkbox {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #4f46e5;
            cursor: pointer;
        }

        .dispatch-tank-batch,
        .dispatch-tank-serial {
            color: #0f172a;
            font-weight: 700;
        }

        .dispatch-tank-secondary {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .dispatch-tank-area {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            background: #f8fafc;
            color: #475569;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .dispatch-tank-tech-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .dispatch-tanks-empty {
            padding: 38px 18px;
            color: #64748b;
            font-size: 12px;
            text-align: center;
        }

        /*
        |--------------------------------------------------------------------------
        | Wrapper dinámico / estado de carga
        |--------------------------------------------------------------------------
        */

        #tanks-table-wrapper {
            position: relative;
            transition: opacity .15s ease;
        }

        .dispatch-table-loading {
            opacity: .45;
            pointer-events: none;
        }

        /*
        |--------------------------------------------------------------------------
        | Paginador
        |--------------------------------------------------------------------------
        */

        .dispatch-tanks-pagination-wrapper {
            margin-top: 14px;
            padding: 14px 2px 0;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .dispatch-tanks-pagination-info {
            flex-shrink: 0;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        .dispatch-tanks-pagination-info strong {
            color: #334155;
            font-weight: 700;
        }

        .dispatch-tanks-pagination {
            margin-left: auto;
        }

        .dispatch-tanks-pagination nav {
            width: auto;
        }

        /*
        | Laravel normalmente genera una versión móvil y otra desktop.
        | Ocultamos la primera porque usamos nuestra información personalizada.
        */

        .dispatch-tanks-pagination nav > div:first-child {
            display: none !important;
        }

        .dispatch-tanks-pagination nav > div:last-child {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .dispatch-tanks-pagination nav > div:last-child > div:first-child {
            display: none !important;
        }

        .dispatch-tanks-pagination nav > div:last-child > div:last-child {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            flex-wrap: wrap;
        }

        .dispatch-tanks-pagination a,
        .dispatch-tanks-pagination span[aria-current="page"] > span,
        .dispatch-tanks-pagination span[aria-disabled="true"] > span {
            min-width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            padding: 0 9px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #ffffff;
            color: #475569;
            font-size: 12px;
            line-height: 1;
            font-weight: 600;
            text-decoration: none;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease,
                box-shadow .15s ease;
        }

        .dispatch-tanks-pagination a:hover {
            border-color: #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .dispatch-tanks-pagination span[aria-current="page"] > span {
            border-color: #4f46e5;
            background: #4f46e5;
            color: #ffffff;
            box-shadow: 0 2px 5px rgba(79, 70, 229, 0.18);
        }

        .dispatch-tanks-pagination span[aria-disabled="true"] > span {
            border-color: #e2e8f0;
            background: #f8fafc;
            color: #cbd5e1;
            cursor: not-allowed;
        }

        .dispatch-tanks-pagination svg {
            width: 16px;
            height: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Footer
        |--------------------------------------------------------------------------
        */

        .dispatch-create-footer {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .dispatch-create-footer-right {
            display: flex;
            gap: 8px;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 900px) {
            .dispatch-col-3,
            .dispatch-col-4 {
                grid-column: span 6;
            }

            .dispatch-tank-filter-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .dispatch-create-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .dispatch-create-header {
                flex-direction: column;
            }

            .dispatch-create-back-button {
                width: 100%;
            }

            .dispatch-col-3,
            .dispatch-col-4,
            .dispatch-col-12 {
                grid-column: span 12;
            }

            .dispatch-client-lookup-row {
                flex-direction: column;
            }

            .dispatch-validate-button {
                width: 100%;
            }

            .dispatch-create-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .dispatch-tanks-counters {
                width: 100%;
                justify-content: flex-start;
            }

            .dispatch-tanks-pagination-wrapper {
                flex-direction: column;
                align-items: stretch;
            }

            .dispatch-tanks-pagination-info {
                text-align: center;
            }

            .dispatch-tanks-pagination {
                margin-left: 0;
            }

            .dispatch-tanks-pagination nav > div:last-child {
                justify-content: center;
            }

            .dispatch-tanks-pagination nav > div:last-child > div:last-child {
                justify-content: center;
                flex-wrap: wrap;
            }

            .dispatch-create-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .dispatch-create-footer-right {
                flex-direction: column;
            }

            .dispatch-secondary-button,
            .dispatch-cancel-button,
            .dispatch-submit-button {
                width: 100%;
            }
        }
    </style>

    <div class="dispatch-create-page">
        <div class="dispatch-create-container">

            {{-- Errores --}}
            @if($errors->any())
                <div class="dispatch-create-errors">
                    <p class="dispatch-create-errors-title">
                        Revisa los siguientes campos:
                    </p>

                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('dispatches.store') }}"
                id="dispatch-form"
            >
                @csrf

                {{-- Información del despacho --}}
                <section class="dispatch-create-card">
                    <div class="dispatch-create-card-header">
                        <div>
                            <h3 class="dispatch-create-section-title">
                                Información del despacho
                            </h3>

                            <p class="dispatch-create-section-subtitle">
                                Valida el cliente y completa los datos generales de la operación.
                            </p>
                        </div>
                    </div>

                    <div class="dispatch-create-card-body">
                        <div class="dispatch-create-form-grid">

                            {{-- Cédula / RUC --}}
                            <div class="dispatch-col-4">
                                <label
                                    for="client_document_lookup"
                                    class="dispatch-field-label"
                                >
                                    Cédula / RUC
                                </label>

                                <div class="dispatch-client-lookup-row">
                                    <input
                                        type="text"
                                        id="client_document_lookup"
                                        class="dispatch-control"
                                        placeholder="Ej. 1311111111"
                                        autocomplete="off"
                                        data-lookup-url="{{ route('clients.findByDocument') }}"
                                    >

                                    <button
                                        type="button"
                                        id="btn_validate_client"
                                        class="dispatch-validate-button"
                                    >
                                        Validar
                                    </button>
                                </div>

                                <div
                                    id="client_lookup_ok"
                                    class="dispatch-client-success hidden"
                                ></div>

                                <div
                                    id="client_lookup_error"
                                    class="dispatch-client-error hidden"
                                >
                                    Ese cliente no existe, primero regístralo.
                                </div>
                            </div>

                            {{-- Cliente --}}
                            <div class="dispatch-col-4">
                                <label
                                    for="client_name_display"
                                    class="dispatch-field-label"
                                >
                                    Cliente
                                </label>

                                <input
                                    type="text"
                                    id="client_name_display"
                                    class="dispatch-control readonly"
                                    placeholder="Aquí aparecerá el cliente encontrado"
                                    readonly
                                >

                                <input
                                    type="hidden"
                                    name="client_id"
                                    id="client_id_hidden"
                                    value="{{ old('client_id') }}"
                                >
                            </div>

                            {{-- Fecha --}}
                            <div class="dispatch-col-4">
                                <label
                                    for="dispatched_at"
                                    class="dispatch-field-label"
                                >
                                    Fecha despacho
                                </label>

                                <input
                                    type="datetime-local"
                                    name="dispatched_at"
                                    id="dispatched_at"
                                    class="dispatch-control"
                                    value="{{ old('dispatched_at', now()->format('Y-m-d\TH:i')) }}"
                                    required
                                >
                            </div>


                            {{-- Documento automático --}}
<div class="dispatch-col-4">
    <label
        for="document_number_preview"
        class="dispatch-field-label"
    >
        Número de orden / nota de entrega
    </label>

    <input
        type="text"
        id="document_number_preview"
        class="dispatch-control readonly"
        value="Se tomará automáticamente de los tanques seleccionados"
        readonly
    >
</div>

                            {{-- Placa --}}
                            <div class="dispatch-col-3">
                                <label
                                    for="remission_plate"
                                    class="dispatch-field-label"
                                >
                                    Placa remisión
                                </label>

                                <input
                                    type="text"
                                    name="remission_plate"
                                    id="remission_plate"
                                    class="dispatch-control"
                                    value="{{ old('remission_plate') }}"
                                    placeholder="Ej. GAA-1234"
                                >
                            </div>

                            {{-- Tipo comprobante --}}
                            <div class="dispatch-col-3">
                                <label
                                    for="voucher_type"
                                    class="dispatch-field-label"
                                >
                                    Tipo comprobante
                                </label>

                                <input
                                    type="text"
                                    name="voucher_type"
                                    id="voucher_type"
                                    class="dispatch-control"
                                    value="{{ old('voucher_type') }}"
                                    placeholder="Factura / Nota / Guía"
                                >
                            </div>

                            {{-- Número comprobante --}}
                            <div class="dispatch-col-3">
                                <label
                                    for="voucher_number"
                                    class="dispatch-field-label"
                                >
                                    N.º comprobante
                                </label>

                                <input
                                    type="text"
                                    name="voucher_number"
                                    id="voucher_number"
                                    class="dispatch-control"
                                    value="{{ old('voucher_number') }}"
                                    placeholder="001-001-000000123"
                                >
                            </div>

                            {{-- Número remisión --}}
                            <div class="dispatch-col-3">
                                <label
                                    for="remission_number"
                                    class="dispatch-field-label"
                                >
                                    N.º remisión
                                </label>

                                <input
                                    type="text"
                                    name="remission_number"
                                    id="remission_number"
                                    class="dispatch-control"
                                    value="{{ old('remission_number') }}"
                                    placeholder="REM-0001"
                                >
                            </div>

                            {{-- Notas --}}
                            <div class="dispatch-col-12">
                                <label
                                    for="notes"
                                    class="dispatch-field-label"
                                >
                                    Notas
                                </label>

                                <textarea
                                    name="notes"
                                    id="notes"
                                    rows="2"
                                    class="dispatch-control"
                                    placeholder="Notas del despacho..."
                                >{{ old('notes') }}</textarea>
                            </div>

                        </div>
                    </div>
                </section>

                {{-- Tanques disponibles --}}
                <section class="dispatch-create-card">
                    <div class="dispatch-create-card-header">
                        <div>
                            <h3 class="dispatch-create-section-title">
                                Tanques disponibles
                            </h3>

                            <p class="dispatch-create-section-subtitle">
                                Filtra y selecciona las unidades que serán incluidas en el despacho.
                            </p>
                        </div>

                        <div class="dispatch-tanks-counters">
                            <span class="dispatch-counter">
                                Encontrados:

                                <strong id="tanks-total-count">
                                    {{ $tanks->total() }}
                                </strong>
                            </span>

                            <span class="dispatch-counter selected">
                                Seleccionados:

                                <strong id="selected-count">
                                    0
                                </strong>
                            </span>
                        </div>
                    </div>

                    <div class="dispatch-create-card-body">

                        {{-- Filtros --}}
                        <div
                            id="tank-filters-form"
                            data-base-url="{{ route('dispatches.create') }}"
                        >
                            <div class="dispatch-tank-filter-grid">

                                {{-- Lote --}}
                                <div>
                                    <label
                                        for="filter_batch"
                                        class="dispatch-field-label"
                                    >
                                        Lote
                                    </label>

                                    <input
                                        type="text"
                                        id="filter_batch"
                                        class="dispatch-control"
                                        value="{{ request('batch') }}"
                                        placeholder="Ej. LT-001"
                                    >
                                </div>

                                {{-- Serial --}}
                                <div>
                                    <label
                                        for="filter_serial"
                                        class="dispatch-field-label"
                                    >
                                        Serial
                                    </label>

                                    <input
                                        type="text"
                                        id="filter_serial"
                                        class="dispatch-control"
                                        value="{{ request('serial') }}"
                                        placeholder="Ej. OXI-000123"
                                    >
                                </div>

                                {{-- Capacidad --}}
                                <div>
                                    <label
                                        for="filter_capacity_id"
                                        class="dispatch-field-label"
                                    >
                                        Capacidad
                                    </label>

                                    <select
                                        id="filter_capacity_id"
                                        class="dispatch-control"
                                    >
                                        <option value="">
                                            Todas
                                        </option>

                                        @foreach($capacities as $capacity)
                                            <option
                                                value="{{ $capacity->id }}"
                                                @selected(
                                                    (string) request('capacity_id')
                                                    === (string) $capacity->id
                                                )
                                            >
                                                {{ $capacity->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="dispatch-filter-actions">
                                <button
                                    type="button"
                                    id="clear-tank-filters"
                                    class="dispatch-secondary-button"
                                >
                                    Limpiar filtros
                                </button>
                            </div>
                        </div>

                        {{-- Tabla + paginación --}}
                        <div id="tanks-table-wrapper">
                            @include('dispatches.partials.tanks_table', [
                                'tanks' => $tanks
                            ])
                        </div>

                        {{-- Inputs generados dinámicamente --}}
                        <div id="selected-hidden-inputs"></div>

                        {{-- Footer --}}
                        <div class="dispatch-create-footer">
                            <button
                                type="button"
                                id="clear-selected-tanks"
                                class="dispatch-secondary-button"
                            >
                                Limpiar selección
                            </button>

                            <div class="dispatch-create-footer-right">
                                <a
                                    href="{{ route('dispatches.index') }}"
                                    class="dispatch-cancel-button"
                                >
                                    Cancelar
                                </a>

                                <button
                                    type="submit"
                                    class="dispatch-submit-button"
                                >
                                    Crear despacho
                                </button>
                            </div>
                        </div>

                    </div>
                </section>

            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            /*
            |--------------------------------------------------------------------------
            | Referencias DOM
            |--------------------------------------------------------------------------
            */

            const docInput = document.getElementById('client_document_lookup');
            const validateBtn = document.getElementById('btn_validate_client');
            const nameInput = document.getElementById('client_name_display');
            const clientIdHidden = document.getElementById('client_id_hidden');
            const okBox = document.getElementById('client_lookup_ok');
            const errorBox = document.getElementById('client_lookup_error');

            const dispatchForm = document.getElementById('dispatch-form');
            const hiddenInputsContainer = document.getElementById('selected-hidden-inputs');

            const countBox = document.getElementById('selected-count');
            const totalCountBox = document.getElementById('tanks-total-count');

            const clearSelectedBtn = document.getElementById('clear-selected-tanks');

            const filtersContainer = document.getElementById('tank-filters-form');
            const clearFiltersBtn = document.getElementById('clear-tank-filters');

            const batchFilterInput = document.getElementById('filter_batch');
            const serialFilterInput = document.getElementById('filter_serial');
            const capacityFilterInput = document.getElementById('filter_capacity_id');

            const tableWrapper = document.getElementById('tanks-table-wrapper');

            const storageKey = 'dispatch_selected_tank_ids';

            const oldTankIds = @json($selectedOldTankIds);

            let filterDebounceTimer = null;

            /*
            |--------------------------------------------------------------------------
            | Obtener tanques seleccionados
            |--------------------------------------------------------------------------
            */

            const getSelectedIds = () => {
                try {
                    const raw = window.sessionStorage.getItem(storageKey);

                    const parsed = raw
                        ? JSON.parse(raw)
                        : [];

                    return Array.isArray(parsed)
                        ? parsed.map(String)
                        : [];
                } catch (error) {
                    console.error('No se pudo leer la selección guardada.', error);

                    return [];
                }
            };

            /*
            |--------------------------------------------------------------------------
            | Guardar selección
            |--------------------------------------------------------------------------
            */

            const setSelectedIds = (ids) => {
                const uniqueIds = Array.from(
                    new Set(ids.map(String))
                );

                window.sessionStorage.setItem(
                    storageKey,
                    JSON.stringify(uniqueIds)
                );

                return uniqueIds;
            };

            /*
            |--------------------------------------------------------------------------
            | Crear inputs ocultos para el POST
            |--------------------------------------------------------------------------
            */

            const renderHiddenInputs = (ids) => {
                if (!hiddenInputsContainer) {
                    return;
                }

                hiddenInputsContainer.innerHTML = '';

                ids.forEach((id) => {
                    const input = document.createElement('input');

                    input.type = 'hidden';
                    input.name = 'tank_ids[]';
                    input.value = id;

                    hiddenInputsContainer.appendChild(input);
                });
            };

            /*
            |--------------------------------------------------------------------------
            | Checkboxes visibles
            |--------------------------------------------------------------------------
            */

            const getTankCheckboxes = () => {
                return Array.from(
                    document.querySelectorAll('.tank-checkbox')
                );
            };

            /*
            |--------------------------------------------------------------------------
            | Sincronizar checkboxes con sessionStorage
            |--------------------------------------------------------------------------
            */

            const syncVisibleCheckboxes = (ids) => {
                const selected = new Set(ids);

                getTankCheckboxes().forEach((checkbox) => {
                    checkbox.checked = selected.has(
                        String(checkbox.value)
                    );
                });
            };

            /*
            |--------------------------------------------------------------------------
            | Refrescar contador, inputs y checkboxes
            |--------------------------------------------------------------------------
            */

            const refreshSelectionUi = () => {
                const ids = getSelectedIds();

                syncVisibleCheckboxes(ids);
                renderHiddenInputs(ids);

                if (countBox) {
                    countBox.textContent = ids.length;
                }
            };

            /*
            |--------------------------------------------------------------------------
            | Actualizar selección desde checkboxes visibles
            |--------------------------------------------------------------------------
            */

            const updateSelectionFromVisibleCheckboxes = () => {
                const currentIds = new Set(getSelectedIds());

                getTankCheckboxes().forEach((checkbox) => {
                    const id = String(checkbox.value);

                    if (checkbox.checked) {
                        currentIds.add(id);
                    } else {
                        currentIds.delete(id);
                    }
                });

                setSelectedIds(
                    Array.from(currentIds)
                );

                refreshSelectionUi();
            };

            /*
            |--------------------------------------------------------------------------
            | Eventos de checkboxes
            |--------------------------------------------------------------------------
            */

            const bindCheckboxEvents = () => {
                getTankCheckboxes().forEach((checkbox) => {
                    checkbox.addEventListener(
                        'change',
                        updateSelectionFromVisibleCheckboxes
                    );
                });
            };

            /*
            |--------------------------------------------------------------------------
            | Eventos del paginador AJAX
            |--------------------------------------------------------------------------
            */

            const bindPaginationEvents = () => {
                if (!tableWrapper) {
                    return;
                }

                const paginationLinks = tableWrapper.querySelectorAll(
                    '.dispatch-tanks-pagination a[href]'
                );

                paginationLinks.forEach((link) => {
                    link.addEventListener('click', function (event) {
                        const url = link.getAttribute('href');

                        if (!url) {
                            return;
                        }

                        event.preventDefault();

                        fetchFilteredTanks(url);
                    });
                });
            };

            /*
            |--------------------------------------------------------------------------
            | Construir URL de filtros
            |--------------------------------------------------------------------------
            */

            const buildFilterUrl = () => {
                if (!filtersContainer) {
                    return window.location.pathname;
                }

                const baseUrl =
                    filtersContainer.dataset.baseUrl
                    || window.location.pathname;

                const params = new URLSearchParams();

                if (
                    batchFilterInput
                    && batchFilterInput.value.trim() !== ''
                ) {
                    params.set(
                        'batch',
                        batchFilterInput.value.trim()
                    );
                }

                if (
                    serialFilterInput
                    && serialFilterInput.value.trim() !== ''
                ) {
                    params.set(
                        'serial',
                        serialFilterInput.value.trim()
                    );
                }

                if (
                    capacityFilterInput
                    && capacityFilterInput.value !== ''
                ) {
                    params.set(
                        'capacity_id',
                        capacityFilterInput.value
                    );
                }

                const query = params.toString();

                return query
                    ? `${baseUrl}?${query}`
                    : baseUrl;
            };

            /*
            |--------------------------------------------------------------------------
            | Obtener tanques por AJAX
            |--------------------------------------------------------------------------
            */

            const fetchFilteredTanks = async (url = null) => {
                if (!tableWrapper) {
                    return;
                }

                const requestUrl = url || buildFilterUrl();

                tableWrapper.classList.add('dispatch-table-loading');

                try {
                    const response = await fetch(requestUrl, {
                        method: 'GET',
                        credentials: 'same-origin',

                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error(
                            'No se pudo cargar la tabla de tanques.'
                        );
                    }

                    const data = await response.json();

                    tableWrapper.innerHTML = data.html ?? '';

                    if (
                        totalCountBox
                        && typeof data.total !== 'undefined'
                    ) {
                        totalCountBox.textContent = data.total;
                    }

                    window.history.replaceState(
                        {},
                        '',
                        requestUrl
                    );

                    bindCheckboxEvents();
                    bindPaginationEvents();
                    refreshSelectionUi();

                } catch (error) {
                    console.error(error);
                } finally {
                    tableWrapper.classList.remove('dispatch-table-loading');
                }
            };

            /*
            |--------------------------------------------------------------------------
            | Debounce
            |--------------------------------------------------------------------------
            */

            const applyFiltersWithDebounce = () => {
                window.clearTimeout(filterDebounceTimer);

                filterDebounceTimer = window.setTimeout(() => {
                    fetchFilteredTanks();
                }, 300);
            };

            /*
            |--------------------------------------------------------------------------
            | Inicializar selección anterior
            |--------------------------------------------------------------------------
            */

            if (oldTankIds.length > 0) {
                setSelectedIds(oldTankIds);
            }

            refreshSelectionUi();
            bindCheckboxEvents();
            bindPaginationEvents();

            /*
            |--------------------------------------------------------------------------
            | Filtro lote
            |--------------------------------------------------------------------------
            */

            if (batchFilterInput) {
                batchFilterInput.addEventListener(
                    'input',
                    applyFiltersWithDebounce
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Filtro serial
            |--------------------------------------------------------------------------
            */

            if (serialFilterInput) {
                serialFilterInput.addEventListener(
                    'input',
                    applyFiltersWithDebounce
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Filtro capacidad
            |--------------------------------------------------------------------------
            */

            if (capacityFilterInput) {
                capacityFilterInput.addEventListener(
                    'change',
                    function () {
                        fetchFilteredTanks();
                    }
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Limpiar filtros
            |--------------------------------------------------------------------------
            */

            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener(
                    'click',
                    function () {
                        if (batchFilterInput) {
                            batchFilterInput.value = '';
                        }

                        if (serialFilterInput) {
                            serialFilterInput.value = '';
                        }

                        if (capacityFilterInput) {
                            capacityFilterInput.value = '';
                        }

                        fetchFilteredTanks();
                    }
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Limpiar selección
            |--------------------------------------------------------------------------
            */

            if (clearSelectedBtn) {
                clearSelectedBtn.addEventListener(
                    'click',
                    function () {
                        window.sessionStorage.removeItem(storageKey);

                        refreshSelectionUi();
                    }
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Submit
            |--------------------------------------------------------------------------
            */

            if (dispatchForm) {
                dispatchForm.addEventListener(
                    'submit',
                    function () {
                        renderHiddenInputs(
                            getSelectedIds()
                        );
                    }
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Validación cliente
            |--------------------------------------------------------------------------
            */

            if (
                !docInput
                || !validateBtn
                || !nameInput
                || !clientIdHidden
                || !okBox
                || !errorBox
            ) {
                return;
            }

            const lookupUrl = docInput.dataset.lookupUrl;

            if (!lookupUrl) {
                console.error(
                    'No se encontró data-lookup-url en client_document_lookup'
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Resetear cliente
            |--------------------------------------------------------------------------
            */

            const resetClient = () => {
                nameInput.value = '';
                clientIdHidden.value = '';

                okBox.textContent = '';
                okBox.classList.add('hidden');

                errorBox.classList.add('hidden');
            };

            /*
            |--------------------------------------------------------------------------
            | Mostrar error cliente
            |--------------------------------------------------------------------------
            */

            const showError = () => {
                nameInput.value = '';
                clientIdHidden.value = '';

                okBox.textContent = '';
                okBox.classList.add('hidden');

                errorBox.classList.remove('hidden');
            };

            /*
            |--------------------------------------------------------------------------
            | Mostrar cliente encontrado
            |--------------------------------------------------------------------------
            */

            const showSuccess = (client) => {
                nameInput.value = client.name;
                clientIdHidden.value = client.id;

                okBox.textContent =
                    `Cliente encontrado: ${client.name} (${client.document})`;

                okBox.classList.remove('hidden');
                errorBox.classList.add('hidden');
            };

            /*
            |--------------------------------------------------------------------------
            | Buscar cliente
            |--------------------------------------------------------------------------
            */

            const searchClient = async () => {
                const value = (
                    docInput.value || ''
                ).trim();

                if (!value) {
                    resetClient();
                    return;
                }

                validateBtn.disabled = true;
                validateBtn.textContent = 'Validando...';

                try {
                    const response = await fetch(
                        `${lookupUrl}?document=${encodeURIComponent(value)}`,
                        {
                            method: 'GET',
                            credentials: 'same-origin',

                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                        }
                    );

                    if (!response.ok) {
                        showError();
                        return;
                    }

                    const result = await response.json();

                    if (
                        result?.found
                        && result?.client
                    ) {
                        showSuccess(result.client);
                    } else {
                        showError();
                    }

                } catch (error) {
                    console.error(error);

                    showError();

                } finally {
                    validateBtn.disabled = false;
                    validateBtn.textContent = 'Validar';
                }
            };

            /*
            |--------------------------------------------------------------------------
            | Botón validar
            |--------------------------------------------------------------------------
            */

            validateBtn.addEventListener(
                'click',
                searchClient
            );

            /*
            |--------------------------------------------------------------------------
            | Enter en documento
            |--------------------------------------------------------------------------
            */

            docInput.addEventListener(
                'keydown',
                function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();

                        searchClient();
                    }
                }
            );

            /*
            |--------------------------------------------------------------------------
            | Cambiar documento después de validar
            |--------------------------------------------------------------------------
            */

            docInput.addEventListener(
                'input',
                function () {
                    if (
                        clientIdHidden.value
                        || nameInput.value
                    ) {
                        resetClient();
                    }
                }
            );
        });
    </script>
</x-app-layout>
