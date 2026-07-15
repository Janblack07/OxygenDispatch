<x-app-layout>
    @php
        $pendingCount = $batch->tankUnits->filter(function ($tank) {
            return mb_strtolower(
                trim($tank->technicalStatus?->name ?? '')
            ) === 'pendiente';
        })->count();

        $approvedCount = $batch->tankUnits->filter(function ($tank) {
            return mb_strtolower(
                trim($tank->technicalStatus?->name ?? '')
            ) === 'aprobado';
        })->count();

        $rejectedCount = $batch->tankUnits->filter(function ($tank) {
            return mb_strtolower(
                trim($tank->technicalStatus?->name ?? '')
            ) === 'rechazado';
        })->count();
    @endphp

    <x-slot name="header">
        <div class="batch-detail-header">
            <div>
                <div class="batch-detail-title-row">
                    <h2 class="batch-detail-page-title">
                        Detalle de lote
                    </h2>

                    <span class="batch-detail-code">
                        {{ $batch->batch_number }}
                    </span>
                </div>

                <p class="batch-detail-page-subtitle">
                    Consulta el lote, genera tanques y controla su estado técnico.
                </p>
            </div>

            <div class="batch-detail-actions">
                @if($batch->document_number)
                    <a
                        href="{{ route('technical-receptions.index', ['q' => $batch->document_number]) }}"
                        class="batch-detail-secondary-button"
                    >
                        Recepción técnica
                    </a>
                @endif

                <a
                    href="{{ route('batches.index') }}"
                    class="batch-detail-primary-button"
                >
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        .batch-detail-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .batch-detail-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .batch-detail-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .batch-detail-title-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 9px;
        }

        .batch-detail-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .batch-detail-code {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            padding: 0 9px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .batch-detail-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .batch-detail-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .batch-detail-primary-button,
        .batch-detail-secondary-button,
        .batch-generate-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease;
        }

        .batch-detail-primary-button {
            min-height: 40px;
            padding: 0 14px;
            border: 0;
            background: #4f46e5;
            color: #ffffff;
        }

        .batch-detail-primary-button:hover {
            background: #4338ca;
        }

        .batch-detail-secondary-button {
            min-height: 40px;
            padding: 0 14px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .batch-detail-secondary-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .batch-detail-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
        }

        .batch-detail-alert.success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .batch-detail-alert.error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .batch-detail-alert ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .batch-detail-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .batch-detail-card + .batch-detail-card {
            margin-top: 18px;
        }

        .batch-detail-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .batch-detail-card-body {
            padding: 20px;
        }

        .batch-detail-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .batch-detail-section-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .batch-order-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .batch-info-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .batch-info-item {
            min-width: 0;
            padding: 13px 14px;
            border: 1px solid #f1f5f9;
            border-radius: 11px;
            background: #f8fafc;
        }

        .batch-info-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .batch-info-value {
            margin-top: 5px;
            overflow-wrap: anywhere;
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .batch-notes-box {
            margin-top: 16px;
            padding: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            background: #ffffff;
        }

        .batch-warning {
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 14px;
            border: 1px solid #fde68a;
            border-radius: 12px;
            background: #fffbeb;
        }

        .batch-warning-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #fef3c7;
            color: #d97706;
        }

        .batch-warning-icon svg {
            width: 19px;
            height: 19px;
        }

        .batch-warning-title {
            margin: 0;
            color: #92400e;
            font-size: 13px;
            font-weight: 700;
        }

        .batch-warning-text {
            margin: 3px 0 0;
            color: #a16207;
            font-size: 12px;
            line-height: 1.55;
        }

        .batch-generate-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 12px;
            align-items: end;
        }

        .batch-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
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
            outline: none;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
        }

        .batch-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .batch-field-error {
            margin: 5px 0 0;
            color: #dc2626;
            font-size: 11px;
        }

        .batch-automatic-grid {
            margin-top: 14px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .batch-automatic-item {
            padding: 11px 13px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
        }

        .batch-automatic-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .batch-status-pill {
            margin-top: 6px;
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .batch-status-pill.blue {
            border: 1px solid #bfdbfe;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .batch-status-pill.amber {
            border: 1px solid #fde68a;
            background: #fffbeb;
            color: #b45309;
        }

        .batch-generate-footer {
            margin-top: 16px;
            display: flex;
            justify-content: flex-end;
        }

        .batch-generate-button {
            min-height: 40px;
            padding: 0 14px;
            border: 0;
            background: #4f46e5;
            color: #ffffff;
            font-family: inherit;
        }

        .batch-generate-button:hover {
            background: #4338ca;
        }

        .batch-movement-note {
            margin: 12px 0 0;
            color: #64748b;
            font-size: 11px;
        }

        .batch-summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .batch-summary-card {
            padding: 13px 14px;
            border-radius: 12px;
        }

        .batch-summary-card.pending {
            border: 1px solid #fde68a;
            background: #fffbeb;
        }

        .batch-summary-card.approved {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
        }

        .batch-summary-card.rejected {
            border: 1px solid #fecaca;
            background: #fef2f2;
        }

        .batch-summary-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .batch-summary-card.pending .batch-summary-label,
        .batch-summary-card.pending .batch-summary-number {
            color: #92400e;
        }

        .batch-summary-card.approved .batch-summary-label,
        .batch-summary-card.approved .batch-summary-number {
            color: #065f46;
        }

        .batch-summary-card.rejected .batch-summary-label,
        .batch-summary-card.rejected .batch-summary-number {
            color: #991b1b;
        }

        .batch-summary-number {
            margin-top: 4px;
            font-size: 24px;
            line-height: 1;
            font-weight: 750;
        }

        .batch-table-wrapper {
            margin-top: 16px;
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .batch-table {
            width: 100%;
            min-width: 980px;
            border-collapse: collapse;
        }

        .batch-table thead {
            background: #f8fafc;
        }

        .batch-table th {
            padding: 11px 13px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-align: left;
            text-transform: uppercase;
        }

        .batch-table td {
            padding: 12px 13px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .batch-table tbody tr:hover {
            background: #f8fafc;
        }

        .batch-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .batch-table-serial,
        .batch-product-code {
            color: #0f172a;
            font-weight: 700;
        }

        .batch-product-detail {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .batch-tech-badge,
        .batch-dispatchable-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
        }

        .batch-empty {
            padding: 38px 16px;
            color: #64748b;
            text-align: center;
            font-size: 12px;
        }

        .batch-module-link {
            color: #4f46e5;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .batch-module-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .batch-info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .batch-detail-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .batch-detail-header {
                flex-direction: column;
            }

            .batch-detail-actions {
                width: 100%;
            }

            .batch-detail-primary-button,
            .batch-detail-secondary-button {
                flex: 1;
            }

            .batch-generate-grid,
            .batch-info-grid,
            .batch-automatic-grid,
            .batch-summary-grid {
                grid-template-columns: 1fr;
            }

            .batch-detail-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .batch-generate-button {
                width: 100%;
            }
        }
    </style>

    <div class="batch-detail-page">
        <div class="batch-detail-container">

            {{-- Mensajes --}}
            @if(session('success'))
                <div class="batch-detail-alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="batch-detail-alert error">
                    <strong>No se pudo completar la operación.</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Información --}}
            <section class="batch-detail-card">
                <div class="batch-detail-card-header">
                    <div>
                        <h3 class="batch-detail-section-title">
                            Información del lote
                        </h3>

                        <p class="batch-detail-section-subtitle">
                            Datos generales registrados para esta recepción.
                        </p>
                    </div>

                    @if($batch->document_number)
                        <span class="batch-order-badge">
                            Orden: {{ $batch->document_number }}
                        </span>
                    @endif
                </div>

                <div class="batch-detail-card-body">
                    <div class="batch-info-grid">

                        <div class="batch-info-item">
                            <div class="batch-info-label">
                                Recibido
                            </div>

                            <div class="batch-info-value">
                                {{ optional($batch->received_at)->format('Y-m-d H:i') ?: '—' }}
                            </div>
                        </div>

                        <div class="batch-info-item">
                            <div class="batch-info-label">
                                Documento
                            </div>

                            <div class="batch-info-value">
                                {{ $batch->document_number ?: '—' }}
                            </div>
                        </div>

                        <div class="batch-info-item">
                            <div class="batch-info-label">
                                Gas referencial
                            </div>

                            <div class="batch-info-value">
                                {{ $batch->gasType?->name ?? '—' }}
                            </div>
                        </div>

                        <div class="batch-info-item">
                            <div class="batch-info-label">
                                Capacidad referencial
                            </div>

                            <div class="batch-info-value">
                                {{ $batch->capacity?->name ?? '—' }}
                            </div>
                        </div>

                        @if($batch->supplier_name)
                            <div class="batch-info-item">
                                <div class="batch-info-label">
                                    Proveedor
                                </div>

                                <div class="batch-info-value">
                                    {{ $batch->supplier_name }}
                                </div>
                            </div>
                        @endif

                        @if($batch->voucher_number)
                            <div class="batch-info-item">
                                <div class="batch-info-label">
                                    Comprobante
                                </div>

                                <div class="batch-info-value">
                                    {{ $batch->voucher_number }}
                                </div>
                            </div>
                        @endif

                        @if($batch->sanitary_registry)
                            <div class="batch-info-item">
                                <div class="batch-info-label">
                                    Registro sanitario
                                </div>

                                <div class="batch-info-value">
                                    {{ $batch->sanitary_registry }}
                                </div>
                            </div>
                        @endif

                    </div>

                    @if($batch->notes)
                        <div class="batch-notes-box">
                            <div class="batch-info-label">
                                Notas
                            </div>

                            <div class="batch-info-value" style="font-weight: 500;">
                                {!! nl2br(e($batch->notes)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            {{-- Generar tanques --}}
            <section class="batch-detail-card">
                <div class="batch-detail-card-header">
                    <div>
                        <h3 class="batch-detail-section-title">
                            Generar tanques
                        </h3>

                        <p class="batch-detail-section-subtitle">
                            Selecciona un producto. Gas, capacidad y registro sanitario se toman automáticamente del producto.
                        </p>
                    </div>
                </div>

                <div class="batch-detail-card-body">

                    <div class="batch-warning">
                        <div class="batch-warning-icon">
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
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="batch-warning-title">
                                Revisión técnica obligatoria
                            </p>

                            <p class="batch-warning-text">
                                Todo tanque nuevo ingresará al área
                                <strong>Recepción</strong>
                                con estado técnico
                                <strong>Pendiente</strong>.
                                No podrá ser despachado hasta ser aprobado técnicamente.
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('batches.generate-tanks', $batch) }}"
                    >
                        @csrf

                        <div class="batch-generate-grid">

                            <div>
                                <label
                                    for="product_id"
                                    class="batch-field-label"
                                >
                                    Producto
                                </label>

                                <select
                                    id="product_id"
                                    name="product_id"
                                    class="batch-control"
                                    required
                                >
                                    <option value="">
                                        Seleccione un producto
                                    </option>

                                    @foreach($products as $p)
                                        <option
                                            value="{{ $p->id }}"
                                            @selected(old('product_id') == $p->id)
                                        >
                                            {{ $p->code }} — {{ $p->detail }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('product_id')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="quantity"
                                    class="batch-field-label"
                                >
                                    Cantidad
                                </label>

                                <input
                                    id="quantity"
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="5000"
                                    value="{{ old('quantity', 10) }}"
                                    class="batch-control"
                                    required
                                >

                                @error('quantity')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="serial_prefix"
                                    class="batch-field-label"
                                >
                                    Prefijo serial
                                </label>

                                <input
                                    id="serial_prefix"
                                    type="text"
                                    name="serial_prefix"
                                    maxlength="10"
                                    value="{{ old('serial_prefix', 'OXI') }}"
                                    class="batch-control"
                                    placeholder="OXI"
                                >

                                @error('serial_prefix')
                                    <p class="batch-field-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div class="batch-automatic-grid">
                            <div class="batch-automatic-item">
                                <div class="batch-automatic-label">
                                    Área inicial automática
                                </div>

                                <span class="batch-status-pill blue">
                                    Recepción
                                </span>
                            </div>

                            <div class="batch-automatic-item">
                                <div class="batch-automatic-label">
                                    Estado técnico inicial
                                </div>

                                <span class="batch-status-pill amber">
                                    Pendiente
                                </span>
                            </div>
                        </div>

                        <div class="batch-generate-footer">
                            <button
                                type="submit"
                                class="batch-generate-button"
                            >
                                Generar tanques
                            </button>
                        </div>
                    </form>

                    <p class="batch-movement-note">
                        Se registra automáticamente un movimiento de
                        <strong>Entrada</strong>
                        por cada tanque generado.
                    </p>
                </div>
            </section>

            {{-- Tanques --}}
            <section class="batch-detail-card">
                <div class="batch-detail-card-header">
                    <div>
                        <h3 class="batch-detail-section-title">
                            Tanques del lote
                        </h3>

                        <p class="batch-detail-section-subtitle">
                            Total registrado:
                            <strong>{{ $batch->tankUnits->count() }}</strong>
                        </p>
                    </div>

                    <a
                        href="{{ route('tanks.index', ['batch_id' => $batch->id]) }}"
                        class="batch-module-link"
                    >
                        Ver en módulo Tanques →
                    </a>
                </div>

                <div class="batch-detail-card-body">

                    @if($batch->tankUnits->isNotEmpty())
                        <div class="batch-summary-grid">
                            <div class="batch-summary-card pending">
                                <div class="batch-summary-label">
                                    Pendientes
                                </div>

                                <div class="batch-summary-number">
                                    {{ $pendingCount }}
                                </div>
                            </div>

                            <div class="batch-summary-card approved">
                                <div class="batch-summary-label">
                                    Aprobados
                                </div>

                                <div class="batch-summary-number">
                                    {{ $approvedCount }}
                                </div>
                            </div>

                            <div class="batch-summary-card rejected">
                                <div class="batch-summary-label">
                                    Rechazados
                                </div>

                                <div class="batch-summary-number">
                                    {{ $rejectedCount }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="batch-table-wrapper">
                        <table class="batch-table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Producto</th>
                                    <th>Capacidad</th>
                                    <th>Registro sanitario</th>
                                    <th>Área</th>
                                    <th style="text-align: center;">
                                        Estado técnico
                                    </th>
                                    <th style="text-align: center;">
                                        Despachable
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($batch->tankUnits as $tank)
                                    @php
                                        $technicalStatusName = mb_strtolower(
                                            trim($tank->technicalStatus?->name ?? '')
                                        );

                                        $areaName = mb_strtolower(
                                            trim($tank->warehouseArea?->name ?? '')
                                        );

                                        $statusStyle = match($technicalStatusName) {
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

                                        $isDispatchable =
                                            $technicalStatusName === 'aprobado'
                                            && $areaName === 'productos aprobados';
                                    @endphp

                                    <tr>
                                        <td>
                                            <span class="batch-table-serial">
                                                {{ $tank->serial }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="batch-product-code">
                                                {{ $tank->product?->code ?? '—' }}
                                            </div>

                                            <div class="batch-product-detail">
                                                {{ $tank->product?->detail ?? '—' }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ $tank->product?->capacity?->name
                                                ?? $tank->capacity?->name
                                                ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $tank->sanitary_registry
                                                ?? $tank->product?->sanitary_registry
                                                ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $tank->warehouseArea?->name ?? '—' }}
                                        </td>

                                        <td style="text-align: center;">
                                            <span
                                                class="batch-tech-badge"
                                                style="{{ $statusStyle }}"
                                            >
                                                {{ $tank->technicalStatus?->name ?? '—' }}
                                            </span>
                                        </td>

                                        <td style="text-align: center;">
                                            @if($isDispatchable)
                                                <span
                                                    class="batch-dispatchable-badge"
                                                    style="
                                                        border: 1px solid #a7f3d0;
                                                        background: #ecfdf5;
                                                        color: #065f46;
                                                    "
                                                >
                                                    Sí
                                                </span>
                                            @else
                                                <span
                                                    class="batch-dispatchable-badge"
                                                    style="
                                                        border: 1px solid #e2e8f0;
                                                        background: #f8fafc;
                                                        color: #64748b;
                                                    "
                                                >
                                                    No
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="batch-empty">
                                                Aún no hay tanques en este lote. Usa
                                                <strong>Generar tanques</strong>
                                                para registrar las primeras unidades.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>

        </div>
    </div>
</x-app-layout>
