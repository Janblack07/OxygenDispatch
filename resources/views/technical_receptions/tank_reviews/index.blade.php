<x-app-layout>
    <x-slot name="header">
        <div class="tank-review-header-layout">
            <div>
                <div class="tank-review-title-row">
                    <h2 class="tank-review-page-title">
                        Revisión técnica de tanques
                    </h2>

                    <span class="tank-review-order-badge">
                        {{ $technicalReception->document_number }}
                    </span>
                </div>

                <p class="tank-review-page-subtitle">
                    Revisa, aprueba o reporta anomalías sobre los tanques asociados a esta orden.
                </p>
            </div>

            <a
                href="{{ route('technical-receptions.show', $technicalReception) }}"
                class="tank-review-back-button"
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

                Volver a ficha
            </a>
        </div>
    </x-slot>

    <style>
        .tank-review-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .tank-review-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .tank-review-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .tank-review-title-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
        }

        .tank-review-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .tank-review-order-badge {
            display: inline-flex;
            align-items: center;
            min-height: 27px;
            padding: 0 10px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .tank-review-page-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .tank-review-back-button {
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
        }

        .tank-review-back-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .tank-review-back-button svg {
            width: 16px;
            height: 16px;
        }

        .tank-review-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
        }

        .tank-review-alert.success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .tank-review-alert.error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .tank-review-alert ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .tank-review-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .tank-review-summary-card {
            padding: 15px 16px;
            border-radius: 14px;
        }

        .tank-review-summary-card.total {
            border: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .tank-review-summary-card.pending {
            border: 1px solid #fde68a;
            background: #fffbeb;
        }

        .tank-review-summary-card.approved {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
        }

        .tank-review-summary-card.rejected {
            border: 1px solid #fecaca;
            background: #fef2f2;
        }

        .tank-review-summary-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .tank-review-summary-card.total .tank-review-summary-label,
        .tank-review-summary-card.total .tank-review-summary-value {
            color: #334155;
        }

        .tank-review-summary-card.pending .tank-review-summary-label,
        .tank-review-summary-card.pending .tank-review-summary-value {
            color: #92400e;
        }

        .tank-review-summary-card.approved .tank-review-summary-label,
        .tank-review-summary-card.approved .tank-review-summary-value {
            color: #065f46;
        }

        .tank-review-summary-card.rejected .tank-review-summary-label,
        .tank-review-summary-card.rejected .tank-review-summary-value {
            color: #991b1b;
        }

        .tank-review-summary-value {
            margin-top: 5px;
            font-size: 26px;
            line-height: 1;
            font-weight: 750;
        }

        .tank-review-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .tank-review-card + .tank-review-card {
            margin-top: 18px;
        }

        .tank-review-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .tank-review-card-body {
            padding: 20px;
        }

        .tank-review-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .tank-review-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .tank-review-progress-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .tank-review-progress-value {
            color: #0f172a;
            font-size: 22px;
            font-weight: 750;
        }

        .tank-review-progress-track {
            height: 9px;
            margin-top: 14px;
            overflow: hidden;
            border-radius: 999px;
            background: #f1f5f9;
        }

        .tank-review-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: #4f46e5;
            transition: width .2s ease;
        }

        .tank-review-progress-message {
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 11px;
            font-size: 12px;
            line-height: 1.5;
        }

        .tank-review-progress-message.success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .tank-review-progress-message.pending {
            border: 1px solid #fde68a;
            background: #fffbeb;
            color: #92400e;
        }

        .tank-review-filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .tank-review-filter-actions {
            display: flex;
            gap: 8px;
        }

        .tank-review-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .tank-review-control {
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
        }

        .tank-review-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .tank-review-filter-button,
        .tank-review-clear-button {
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

        .tank-review-filter-button {
            border: 0;
            background: #0f172a;
            color: #ffffff;
            font-family: inherit;
        }

        .tank-review-clear-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .tank-review-action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .tank-review-action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tank-review-approve-all-button,
        .tank-review-approve-button {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .tank-review-approve-all-button {
            border: 1px solid #a7f3d0;
            background: #ffffff;
            color: #047857;
        }

        .tank-review-approve-all-button:hover {
            background: #ecfdf5;
        }

        .tank-review-approve-button {
            border: 0;
            background: #059669;
            color: #ffffff;
        }

        .tank-review-approve-button:hover {
            background: #047857;
        }

        .tank-review-table-wrapper {
            overflow-x: auto;
        }

        .tank-review-table {
            width: 100%;
            min-width: 1040px;
            border-collapse: collapse;
        }

        .tank-review-table thead {
            background: #f8fafc;
        }

        .tank-review-table th {
            padding: 11px 13px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-align: left;
            text-transform: uppercase;
        }

        .tank-review-table td {
            padding: 12px 13px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .tank-review-table tbody tr:hover {
            background: #f8fafc;
        }

        .tank-review-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .tank-review-checkbox {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #4f46e5;
            cursor: pointer;
        }

        .tank-review-serial,
        .tank-review-product {
            color: #0f172a;
            font-weight: 700;
        }

        .tank-review-secondary {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .tank-review-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
        }

        .tank-review-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        .tank-review-anomaly-card {
            margin-top: 18px;
            overflow: hidden;
            border: 1px solid #fecaca;
            border-radius: 16px;
            background: #ffffff;
        }

        .tank-review-anomaly-header {
            padding: 16px 20px;
            border-bottom: 1px solid #fecaca;
            background: #fef2f2;
        }

        .tank-review-anomaly-title {
            margin: 0;
            color: #991b1b;
            font-size: 14px;
            font-weight: 700;
        }

        .tank-review-anomaly-subtitle {
            margin: 4px 0 0;
            color: #b91c1c;
            font-size: 12px;
            line-height: 1.5;
        }

        .tank-review-anomaly-body {
            padding: 20px;
        }

        .tank-review-anomaly-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 14px;
        }

        .tank-review-anomaly-observation {
            min-height: 84px;
            resize: vertical;
        }

        .tank-review-anomaly-footer {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
        }

        .tank-review-reject-button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 14px;
            border: 0;
            border-radius: 10px;
            background: #dc2626;
            color: #ffffff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .tank-review-reject-button:hover {
            background: #b91c1c;
        }

        @media (max-width: 900px) {
            .tank-review-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .tank-review-filter-grid {
                grid-template-columns: 1fr;
            }

            .tank-review-anomaly-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .tank-review-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .tank-review-header-layout {
                flex-direction: column;
            }

            .tank-review-back-button {
                width: 100%;
            }

            .tank-review-summary-grid {
                grid-template-columns: 1fr;
            }

            .tank-review-action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .tank-review-action-buttons {
                flex-direction: column;
            }

            .tank-review-approve-all-button,
            .tank-review-approve-button,
            .tank-review-reject-button {
                width: 100%;
            }
        }
    </style>

    <div class="tank-review-page">
        <div class="tank-review-container">

            @if(session('success'))
                <div class="tank-review-alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="tank-review-alert error">
                    <strong>No se pudo completar la operación.</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Resumen --}}
            <div class="tank-review-summary-grid">
                <div class="tank-review-summary-card total">
                    <div class="tank-review-summary-label">
                        Total
                    </div>

                    <div class="tank-review-summary-value">
                        {{ $summary['total'] }}
                    </div>
                </div>

                <div class="tank-review-summary-card pending">
                    <div class="tank-review-summary-label">
                        Pendientes
                    </div>

                    <div class="tank-review-summary-value">
                        {{ $summary['pending'] }}
                    </div>
                </div>

                <div class="tank-review-summary-card approved">
                    <div class="tank-review-summary-label">
                        Aprobados
                    </div>

                    <div class="tank-review-summary-value">
                        {{ $summary['approved'] }}
                    </div>
                </div>

                <div class="tank-review-summary-card rejected">
                    <div class="tank-review-summary-label">
                        Con anomalía
                    </div>

                    <div class="tank-review-summary-value">
                        {{ $summary['rejected'] }}
                    </div>
                </div>
            </div>

            {{-- Progreso --}}
            <section class="tank-review-card">
                <div class="tank-review-card-body">
                    <div class="tank-review-progress-row">
                        <div>
                            <h3 class="tank-review-section-title">
                                Progreso de revisión
                            </h3>

                            <p class="tank-review-section-subtitle">
                                {{ $summary['reviewed'] }}
                                de
                                {{ $summary['total'] }}
                                tanque(s) revisado(s).
                            </p>
                        </div>

                        <div class="tank-review-progress-value">
                            {{ $summary['progress'] }}%
                        </div>
                    </div>

                    <div class="tank-review-progress-track">
                        <div
                            class="tank-review-progress-bar"
                            style="width: {{ $summary['progress'] }}%;"
                        ></div>
                    </div>

                    @if($summary['total'] > 0 && $summary['pending'] === 0)
                        <div class="tank-review-progress-message success">
                            <strong>Revisión técnica completada.</strong>
                            Todos los tanques de esta orden fueron revisados.
                        </div>
                    @elseif($summary['pending'] > 0)
                        <div class="tank-review-progress-message pending">
                            Quedan
                            <strong>{{ $summary['pending'] }}</strong>
                            tanque(s) pendientes de revisión.
                        </div>
                    @endif
                </div>
            </section>

            {{-- Filtros --}}
            <section class="tank-review-card">
                <div class="tank-review-card-header">
                    <div>
                        <h3 class="tank-review-section-title">
                            Buscar tanques
                        </h3>

                        <p class="tank-review-section-subtitle">
                            Filtra por serial o estado técnico.
                        </p>
                    </div>
                </div>

                <div class="tank-review-card-body">
                    <form
                        method="GET"
                        action="{{ route(
                            'technical-receptions.tank-reviews.index',
                            $technicalReception
                        ) }}"
                    >
                        <div class="tank-review-filter-grid">

                            <div>
                                <label
                                    for="serial"
                                    class="tank-review-label"
                                >
                                    Serial
                                </label>

                                <input
                                    type="text"
                                    id="serial"
                                    name="serial"
                                    value="{{ request('serial') }}"
                                    placeholder="Ej. OXI-000001"
                                    class="tank-review-control"
                                >
                            </div>

                            <div>
                                <label
                                    for="status"
                                    class="tank-review-label"
                                >
                                    Estado técnico
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="tank-review-control"
                                >
                                    <option value="">
                                        Todos
                                    </option>

                                    <option
                                        value="Pendiente"
                                        @selected(request('status') === 'Pendiente')
                                    >
                                        Pendiente
                                    </option>

                                    <option
                                        value="Aprobado"
                                        @selected(request('status') === 'Aprobado')
                                    >
                                        Aprobado
                                    </option>

                                    <option
                                        value="Rechazado"
                                        @selected(request('status') === 'Rechazado')
                                    >
                                        Rechazado
                                    </option>
                                </select>
                            </div>

                            <div class="tank-review-filter-actions">
                                <button
                                    type="submit"
                                    class="tank-review-filter-button"
                                >
                                    Filtrar
                                </button>

                                <a
                                    href="{{ route(
                                        'technical-receptions.tank-reviews.index',
                                        $technicalReception
                                    ) }}"
                                    class="tank-review-clear-button"
                                >
                                    Limpiar
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </section>

            {{-- Formulario general --}}
            <form
                method="POST"
                action="{{ route(
                    'technical-receptions.tank-reviews.process',
                    $technicalReception
                ) }}"
                id="technical-review-form"
            >
                @csrf

                {{-- Acciones --}}
                <section class="tank-review-card">
                    <div class="tank-review-card-body">
                        <div class="tank-review-action-bar">
                            <div>
                                <h3 class="tank-review-section-title">
                                    Acciones de revisión
                                </h3>

                                <p class="tank-review-section-subtitle">
                                    Selecciona únicamente los tanques pendientes que deseas procesar.
                                </p>
                            </div>

                            <div class="tank-review-action-buttons">
                                @if($summary['pending'] > 0)
                                    <button
                                        type="submit"
                                        name="action"
                                        value="approve_all_pending"
                                        onclick="return confirm(
                                            '¿Seguro que deseas aprobar todos los tanques pendientes de esta orden?'
                                        );"
                                        class="tank-review-approve-all-button"
                                    >
                                        Aprobar todos los pendientes
                                    </button>
                                @endif

                                <button
                                    type="submit"
                                    name="action"
                                    value="approve"
                                    class="tank-review-approve-button"
                                >
                                    Aprobar seleccionados
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Tabla --}}
                <section
                    class="tank-review-card"
                    style="margin-top: 18px;"
                >
                    <div class="tank-review-table-wrapper">
                        <table class="tank-review-table">
                            <thead>
                                <tr>
                                    <th style="width: 52px; text-align: center;">
                                        <input
                                            type="checkbox"
                                            id="select-all"
                                            class="tank-review-checkbox"
                                        >
                                    </th>

                                    <th>Serial</th>
                                    <th>Producto</th>
                                    <th>Capacidad</th>
                                    <th>Área</th>
                                    <th style="text-align: center;">
                                        Estado técnico
                                    </th>
                                    <th>Última revisión</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($tanks as $tank)
                                    @php
                                        $technicalStatusName = mb_strtolower(
                                            trim($tank->technicalStatus?->name ?? '')
                                        );

                                        $isPending = $technicalStatusName === 'pendiente';

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
                                    @endphp

                                    <tr>
                                        <td style="text-align: center;">
                                            @if($isPending)
                                                <input
                                                    type="checkbox"
                                                    name="tank_ids[]"
                                                    value="{{ $tank->id }}"
                                                    class="tank-checkbox tank-review-checkbox"
                                                >
                                            @else
                                                <span style="color: #cbd5e1;">
                                                    —
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="tank-review-serial">
                                                {{ $tank->serial }}
                                            </div>

                                            <div class="tank-review-secondary">
                                                Lote:
                                                {{ $tank->batch?->batch_number ?: '—' }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="tank-review-product">
                                                {{ $tank->product?->code ?: '—' }}
                                            </div>

                                            <div class="tank-review-secondary">
                                                {{ $tank->product?->detail ?: '—' }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ $tank->product?->capacity?->name
                                                ?? $tank->capacity?->name
                                                ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $tank->warehouseArea?->name ?: '—' }}
                                        </td>

                                        <td style="text-align: center;">
                                            <span
                                                class="tank-review-status-badge"
                                                style="{{ $statusStyle }}"
                                            >
                                                {{ $tank->technicalStatus?->name ?: '—' }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($tank->latestTechnicalReview)
                                                <div
                                                    style="
                                                        color: #0f172a;
                                                        font-weight: 600;
                                                    "
                                                >
                                                    {{ $tank->latestTechnicalReview->result === 'approved'
                                                        ? 'Aprobado'
                                                        : 'Rechazado' }}
                                                </div>

                                                <div class="tank-review-secondary">
                                                    {{ $tank->latestTechnicalReview
                                                        ->reviewed_at
                                                        ?->format('Y-m-d H:i') }}
                                                </div>

                                                @if($tank->latestTechnicalReview->anomaly_type)
                                                    <div
                                                        style="
                                                            margin-top: 4px;
                                                            color: #dc2626;
                                                            font-size: 11px;
                                                            font-weight: 600;
                                                        "
                                                    >
                                                        {{ $tank->latestTechnicalReview->anomaly_type }}
                                                    </div>
                                                @endif

                                                @if($tank->latestTechnicalReview->observation)
                                                    <div
                                                        style="
                                                            margin-top: 4px;
                                                            max-width: 320px;
                                                            color: #64748b;
                                                            font-size: 10px;
                                                            line-height: 1.45;
                                                        "
                                                    >
                                                        {{ $tank->latestTechnicalReview->observation }}
                                                    </div>
                                                @endif
                                            @else
                                                <span style="color: #94a3b8;">
                                                    Sin revisión
                                                </span>
                                            @endif
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div
                                                style="
                                                    padding: 40px 16px;
                                                    color: #64748b;
                                                    text-align: center;
                                                    font-size: 12px;
                                                "
                                            >
                                                No existen tanques asociados a esta orden.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($tanks->hasPages())
                        <div class="tank-review-pagination">
                            {{ $tanks->links() }}
                        </div>
                    @endif
                </section>

                {{-- Anomalía --}}
                <section class="tank-review-anomaly-card">
                    <div class="tank-review-anomaly-header">
                        <h3 class="tank-review-anomaly-title">
                            Reportar anomalía y enviar a devolución
                        </h3>

                        <p class="tank-review-anomaly-subtitle">
                            Los tanques seleccionados quedarán con estado técnico
                            <strong>Rechazado</strong>
                            y serán enviados automáticamente al área de rechazos, devoluciones y retiro del mercado.
                        </p>
                    </div>

                    <div class="tank-review-anomaly-body">
                        <div class="tank-review-anomaly-grid">

                            <div>
                                <label
                                    for="anomaly_type"
                                    class="tank-review-label"
                                >
                                    Tipo de anomalía
                                </label>

                                <select
                                    id="anomaly_type"
                                    name="anomaly_type"
                                    class="tank-review-control"
                                >
                                    <option value="">
                                        Seleccione
                                    </option>

                                    @foreach([
                                        'Golpe',
                                        'Abolladura o deformación',
                                        'Grieta o fisura',
                                        'Presencia de grasa o aceite',
                                        'Problema de válvula',
                                        'Fuga',
                                        'Corrosión',
                                        'Etiquetado incorrecto',
                                        'Fecha vencida',
                                        'Otro',
                                    ] as $anomaly)
                                        <option
                                            value="{{ $anomaly }}"
                                            @selected(old('anomaly_type') === $anomaly)
                                        >
                                            {{ $anomaly }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('anomaly_type')
                                    <p
                                        style="
                                            margin: 5px 0 0;
                                            color: #dc2626;
                                            font-size: 11px;
                                        "
                                    >
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="observation"
                                    class="tank-review-label"
                                >
                                    Observación
                                </label>

                                <textarea
                                    id="observation"
                                    name="observation"
                                    rows="3"
                                    maxlength="2000"
                                    placeholder="Describe la anomalía encontrada..."
                                    class="tank-review-control tank-review-anomaly-observation"
                                >{{ old('observation') }}</textarea>
                            </div>

                        </div>

                        <div class="tank-review-anomaly-footer">
                            <button
                                type="submit"
                                name="action"
                                value="reject"
                                onclick="return confirm(
                                    '¿Seguro que deseas rechazar los tanques seleccionados y enviarlos al área de devoluciones?'
                                );"
                                class="tank-review-reject-button"
                            >
                                Rechazar seleccionados
                            </button>
                        </div>
                    </div>
                </section>

            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all');

            if (!selectAll) {
                return;
            }

            selectAll.addEventListener('change', function () {
                document
                    .querySelectorAll('.tank-checkbox')
                    .forEach(function (checkbox) {
                        checkbox.checked = selectAll.checked;
                    });
            });
        });
    </script>
</x-app-layout>
