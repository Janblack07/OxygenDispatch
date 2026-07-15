<x-app-layout>
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
    @endphp

    <x-slot name="header">
        <div class="tank-detail-header">
            <div>
                <div class="tank-detail-title-row">
                    <h2 class="tank-detail-page-title">
                        Tanque
                    </h2>

                    <span class="tank-detail-serial-badge">
                        {{ $tank->serial }}
                    </span>
                </div>

                <p class="tank-detail-page-subtitle">
                    Lote:
                    <strong>{{ $tank->batch?->batch_number ?? $tank->batch_id }}</strong>
                    ·
                    {{ $tank->gasType?->name ?? 'Sin gas' }}
                    ·
                    {{ $tank->capacity?->name ?? 'Sin capacidad' }}
                </p>
            </div>

            <a
                href="{{ url()->previous() }}"
                class="tank-detail-back-button"
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
        .tank-detail-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .tank-detail-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .tank-detail-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .tank-detail-title-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 9px;
        }

        .tank-detail-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .tank-detail-serial-badge {
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

        .tank-detail-page-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .tank-detail-back-button {
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
                border-color .15s ease,
                background-color .15s ease,
                color .15s ease;
        }

        .tank-detail-back-button:hover {
            border-color: #94a3b8;
            background: #f8fafc;
            color: #0f172a;
        }

        .tank-detail-back-button svg {
            width: 16px;
            height: 16px;
        }

        .tank-detail-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .tank-detail-card + .tank-detail-card {
            margin-top: 18px;
        }

        .tank-detail-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .tank-detail-card-body {
            padding: 20px;
        }

        .tank-detail-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .tank-detail-section-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .tank-info-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
        }

        .tank-info-item {
            min-width: 0;
            padding: 13px 14px;
            border: 1px solid #f1f5f9;
            border-radius: 11px;
            background: #f8fafc;
        }

        .tank-info-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .tank-info-value {
            margin-top: 5px;
            overflow-wrap: anywhere;
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .tank-detail-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
        }

        .tank-actions-grid {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .tank-action-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .tank-action-card-header {
            min-height: 88px;
            padding: 16px 18px;
            border-bottom: 1px solid #f1f5f9;
        }

        .tank-action-title-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tank-action-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .tank-action-icon svg {
            width: 19px;
            height: 19px;
        }

        .tank-action-icon.transfer {
            background: #eff6ff;
            color: #2563eb;
        }

        .tank-action-icon.technical {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .tank-action-icon.decommission {
            background: #fef2f2;
            color: #dc2626;
        }

        .tank-action-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .tank-action-description {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 11px;
            line-height: 1.45;
        }

        .tank-action-body {
            padding: 16px 18px 18px;
        }

        .tank-action-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .tank-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
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
            outline: none;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
        }

        .tank-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .tank-action-button {
            width: 100%;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 14px;
            border: 0;
            border-radius: 10px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            color: #ffffff;
            cursor: pointer;
            transition: background-color .15s ease;
        }

        .tank-action-button.transfer {
            background: #2563eb;
        }

        .tank-action-button.transfer:hover {
            background: #1d4ed8;
        }

        .tank-action-button.technical {
            background: #7c3aed;
        }

        .tank-action-button.technical:hover {
            background: #6d28d9;
        }

        .tank-action-button.decommission {
            background: #dc2626;
        }

        .tank-action-button.decommission:hover {
            background: #b91c1c;
        }

        .tank-movement-table-wrapper {
            overflow-x: auto;
        }

        .tank-movement-table {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse;
        }

        .tank-movement-table thead {
            background: #f8fafc;
        }

        .tank-movement-table th {
            padding: 11px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
        }

        .tank-movement-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .tank-movement-table tbody tr:hover {
            background: #f8fafc;
        }

        .tank-movement-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .tank-movement-type {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            background: #f8fafc;
            color: #475569;
            font-size: 10px;
            font-weight: 700;
        }

        .tank-empty-movement {
            padding: 38px 18px;
            color: #64748b;
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 1000px) {
            .tank-info-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .tank-actions-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .tank-detail-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .tank-detail-header {
                flex-direction: column;
            }

            .tank-detail-back-button {
                width: 100%;
            }

            .tank-info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="tank-detail-page">
        <div class="tank-detail-container">

            {{-- Información general --}}
            <section class="tank-detail-card">
                <div class="tank-detail-card-header">
                    <div>
                        <h3 class="tank-detail-section-title">
                            Información del tanque
                        </h3>

                        <p class="tank-detail-section-subtitle">
                            Estado actual, ubicación y trazabilidad de la unidad.
                        </p>
                    </div>
                </div>

                <div class="tank-detail-card-body">
                    <div class="tank-info-grid">

                        <div class="tank-info-item">
                            <div class="tank-info-label">
                                Área
                            </div>

                            <div class="tank-info-value">
                                {{ $tank->warehouseArea?->name ?? '—' }}
                            </div>
                        </div>

                        <div class="tank-info-item">
                            <div class="tank-info-label">
                                Estado técnico
                            </div>

                            <div class="tank-info-value">
                                <span
                                    class="tank-detail-badge"
                                    style="{{ $technicalStyle }}"
                                >
                                    {{ $tank->technicalStatus?->name ?? '—' }}
                                </span>
                            </div>
                        </div>

                        <div class="tank-info-item">
                            <div class="tank-info-label">
                                Estado operativo
                            </div>

                            <div class="tank-info-value">
                                <span
                                    class="tank-detail-badge"
                                    style="{{ $statusStyle }}"
                                >
                                    {{ $statusLabel }}
                                </span>
                            </div>
                        </div>

                        <div class="tank-info-item">
                            <div class="tank-info-label">
                                Creado
                            </div>

                            <div class="tank-info-value">
                                {{ optional($tank->created_at)->format('Y-m-d H:i') ?: '—' }}
                            </div>
                        </div>

                        <div class="tank-info-item">
                            <div class="tank-info-label">
                                Actualizado
                            </div>

                            <div class="tank-info-value">
                                {{ optional($tank->updated_at)->format('Y-m-d H:i') ?: '—' }}
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- Acciones --}}
            <div class="tank-actions-grid">

                {{-- Transferir --}}
                <section class="tank-action-card">
                    <div class="tank-action-card-header">
                        <div class="tank-action-title-row">
                            <div class="tank-action-icon transfer">
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
                                        d="M7.5 3.75 3.75 7.5 7.5 11.25M3.75 7.5h16.5M16.5 12.75l3.75 3.75-3.75 3.75M20.25 16.5H3.75"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="tank-action-title">
                                    Trasladar
                                </h3>
                            </div>
                        </div>

                        <p class="tank-action-description">
                            Cambia el área física del tanque y registra automáticamente el movimiento.
                        </p>
                    </div>

                    <div class="tank-action-body">
                        <form
                            method="POST"
                            action="{{ route('tanks.transfer', $tank) }}"
                            class="tank-action-form"
                        >
                            @csrf

                            <div>
                                <label
                                    for="warehouse_area_id"
                                    class="tank-field-label"
                                >
                                    Nueva área
                                </label>

                                <select
                                    id="warehouse_area_id"
                                    name="warehouse_area_id"
                                    class="tank-control"
                                    required
                                >
                                    @foreach($areas as $a)
                                        <option
                                            value="{{ $a->id }}"
                                            @selected($tank->warehouse_area_id == $a->id)
                                        >
                                            {{ $a->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button
                                type="submit"
                                class="tank-action-button transfer"
                            >
                                Trasladar tanque
                            </button>
                        </form>
                    </div>
                </section>

                {{-- Estado técnico --}}
                <section class="tank-action-card">
                    <div class="tank-action-card-header">
                        <div class="tank-action-title-row">
                            <div class="tank-action-icon technical">
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
                                        d="M11.42 15.17 17.25 21l3.75-3.75-5.83-5.83M11.42 15.17l2.71-2.71a3.38 3.38 0 0 0 0-4.78L12 5.55 5.55 12l2.13 2.13a3.38 3.38 0 0 0 3.74 1.04Z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="tank-action-title">
                                    Estado técnico
                                </h3>
                            </div>
                        </div>

                        <p class="tank-action-description">
                            Registra cambios por inspección, reparación o revisión técnica.
                        </p>
                    </div>

                    <div class="tank-action-body">
                        <form
                            method="POST"
                            action="{{ route('tanks.technical-status', $tank) }}"
                            class="tank-action-form"
                        >
                            @csrf

                            <div>
                                <label
                                    for="technical_status_id"
                                    class="tank-field-label"
                                >
                                    Nuevo estado
                                </label>

                                <select
                                    id="technical_status_id"
                                    name="technical_status_id"
                                    class="tank-control"
                                    required
                                >
                                    @foreach($techStatuses as $t)
                                        <option
                                            value="{{ $t->id }}"
                                            @selected($tank->technical_status_id == $t->id)
                                        >
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button
                                type="submit"
                                class="tank-action-button technical"
                            >
                                Actualizar estado
                            </button>
                        </form>
                    </div>
                </section>

                {{-- Baja --}}
                <section class="tank-action-card">
                    <div class="tank-action-card-header">
                        <div class="tank-action-title-row">
                            <div class="tank-action-icon decommission">
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
                                        d="M6 18 18 6M6 6l12 12"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="tank-action-title">
                                    Dar de baja
                                </h3>
                            </div>
                        </div>

                        <p class="tank-action-description">
                            Retira permanentemente el tanque de la operación.
                        </p>
                    </div>

                    <div class="tank-action-body">
                        <form
                            method="POST"
                            action="{{ route('tanks.decommission', $tank) }}"
                            class="tank-action-form"
                            onsubmit="return confirm('¿Confirmas dar de baja este tanque?');"
                        >
                            @csrf

                            <div>
                                <label
                                    for="reason"
                                    class="tank-field-label"
                                >
                                    Motivo
                                </label>

                                <input
                                    id="reason"
                                    name="reason"
                                    class="tank-control"
                                    placeholder="Ej. Daño irreversible"
                                >
                            </div>

                            <button
                                type="submit"
                                class="tank-action-button decommission"
                            >
                                Dar de baja
                            </button>
                        </form>
                    </div>
                </section>

            </div>

            {{-- Historial --}}
            <section
                class="tank-detail-card"
                style="margin-top: 18px;"
            >
                <div class="tank-detail-card-header">
                    <div>
                        <h3 class="tank-detail-section-title">
                            Historial de movimientos
                        </h3>

                        <p class="tank-detail-section-subtitle">
                            Registro cronológico de los movimientos y cambios realizados sobre este tanque.
                        </p>
                    </div>
                </div>

                <div class="tank-movement-table-wrapper">
                    <table class="tank-movement-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Detalle</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($movements ?? [] as $m)
                                <tr>
                                    <td>
                                        {{ optional($m->created_at)->format('Y-m-d H:i') ?: '—' }}
                                    </td>

                                    <td>
                                        <span class="tank-movement-type">
                                            {{ $m->type }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $m->description ?: '—' }}
                                    </td>

                                    <td>
                                        {{ $m->created_by_user_email ?: '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="tank-empty-movement">
                                            No hay movimientos registrados para este tanque.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
