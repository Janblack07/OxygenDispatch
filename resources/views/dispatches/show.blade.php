<x-app-layout>
    <x-slot name="header">
        <div class="dispatch-show-header">
            <div>
                <div class="dispatch-show-title-row">
                    <h2 class="dispatch-show-page-title">
                        Despacho
                    </h2>

                    <span class="dispatch-show-id-badge">
                        #{{ $dispatch->id }}
                    </span>
                </div>

                <p class="dispatch-show-page-subtitle">
                    Consulta la información del despacho y los tanques asociados.
                </p>
            </div>

            <a
                href="{{ route('dispatches.index') }}"
                class="dispatch-show-back-button"
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
        .dispatch-show-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .dispatch-show-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .dispatch-show-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .dispatch-show-title-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 9px;
        }

        .dispatch-show-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .dispatch-show-id-badge {
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

        .dispatch-show-page-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .dispatch-show-back-button {
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

        .dispatch-show-back-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .dispatch-show-back-button svg {
            width: 16px;
            height: 16px;
        }

        .dispatch-show-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #a7f3d0;
            border-radius: 12px;
            background: #ecfdf5;
            color: #065f46;
            font-size: 13px;
        }

        .dispatch-show-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .dispatch-show-card + .dispatch-show-card {
            margin-top: 18px;
        }

        .dispatch-show-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .dispatch-show-card-body {
            padding: 20px;
        }

        .dispatch-show-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .dispatch-show-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .dispatch-show-info-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .dispatch-show-info-item {
            min-width: 0;
            padding: 13px 14px;
            border: 1px solid #f1f5f9;
            border-radius: 11px;
            background: #f8fafc;
        }

        .dispatch-show-info-item.wide {
            grid-column: span 2;
        }

        .dispatch-show-info-item.full {
            grid-column: 1 / -1;
        }

        .dispatch-show-info-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .dispatch-show-info-value {
            margin-top: 5px;
            overflow-wrap: anywhere;
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .dispatch-show-total-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 999px;
            background: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
        }

        .dispatch-show-table-wrapper {
            overflow-x: auto;
        }

        .dispatch-show-table {
            width: 100%;
            min-width: 940px;
            border-collapse: collapse;
        }

        .dispatch-show-table thead {
            background: #f8fafc;
        }

        .dispatch-show-table th {
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

        .dispatch-show-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .dispatch-show-table tbody tr:hover {
            background: #f8fafc;
        }

        .dispatch-show-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .dispatch-show-serial {
            color: #0f172a;
            font-weight: 700;
            white-space: nowrap;
        }

        .dispatch-show-batch {
            color: #334155;
            font-weight: 600;
        }

        .dispatch-show-order {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .dispatch-show-empty {
            padding: 38px 18px;
            color: #64748b;
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 900px) {
            .dispatch-show-info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dispatch-show-info-item.wide {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 640px) {
            .dispatch-show-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .dispatch-show-header {
                flex-direction: column;
            }

            .dispatch-show-back-button {
                width: 100%;
            }

            .dispatch-show-info-grid {
                grid-template-columns: 1fr;
            }

            .dispatch-show-info-item.wide,
            .dispatch-show-info-item.full {
                grid-column: auto;
            }
        }
    </style>

    <div class="dispatch-show-page">
        <div class="dispatch-show-container">

            @if(session('success'))
                <div class="dispatch-show-alert">
                    {{ session('success') }}
                </div>
            @endif

            <section class="dispatch-show-card">
                <div class="dispatch-show-card-header">
                    <div>
                        <h3 class="dispatch-show-section-title">
                            Información del despacho
                        </h3>

                        <p class="dispatch-show-section-subtitle">
                            Datos generales, cliente, comprobante y responsable de la operación.
                        </p>
                    </div>
                </div>

                <div class="dispatch-show-card-body">
                    <div class="dispatch-show-info-grid">

                        <div class="dispatch-show-info-item">
                            <div class="dispatch-show-info-label">
                                Cliente
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ $dispatch->client?->name ?? '—' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item">
                            <div class="dispatch-show-info-label">
                                Fecha
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ optional($dispatch->dispatched_at)->format('Y-m-d H:i') ?: '—' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item wide">
                            <div class="dispatch-show-info-label">
                                Orden / nota de entrega
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ $dispatch->document_number ?: '—' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item">
                            <div class="dispatch-show-info-label">
                                Tipo cliente
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ $dispatch->entity_type?->label()
                                    ?? $dispatch->client?->entity_type?->label()
                                    ?? '—' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item">
                            <div class="dispatch-show-info-label">
                                Placa remisión
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ $dispatch->remission_plate ?: '—' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item">
                            <div class="dispatch-show-info-label">
                                N.º remisión
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ $dispatch->remission_number ?: '—' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item">
                            <div class="dispatch-show-info-label">
                                Comprobante
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ $dispatch->voucher_type ?: '—' }}
                                {{ $dispatch->voucher_number ?: '' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item">
                            <div class="dispatch-show-info-label">
                                Realizado por
                            </div>

                            <div class="dispatch-show-info-value">
                                {{ $dispatch->performed_by_user_email ?: '—' }}
                            </div>
                        </div>

                        <div class="dispatch-show-info-item full">
                            <div class="dispatch-show-info-label">
                                Notas
                            </div>

                            <div class="dispatch-show-info-value" style="font-weight: 500;">
                                {{ $dispatch->notes ?: '—' }}
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="dispatch-show-card">
                <div class="dispatch-show-card-header">
                    <div>
                        <h3 class="dispatch-show-section-title">
                            Tanques despachados
                        </h3>

                        <p class="dispatch-show-section-subtitle">
                            Unidades asociadas a este despacho con su orden o nota de entrega.
                        </p>
                    </div>

                    <span class="dispatch-show-total-badge">
                        Total:
                        {{ $dispatch->lines->count() }}
                    </span>
                </div>

                <div class="dispatch-show-table-wrapper">
                    <table class="dispatch-show-table">
                        <thead>
                            <tr>
                                <th>Lote</th>
                                <th>Orden / nota</th>
                                <th>Serial</th>
                                <th>Gas</th>
                                <th>Capacidad</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($dispatch->lines as $ln)
                                @php($t = $ln->tankUnit)

                                <tr>
                                    <td>
                                        <span class="dispatch-show-batch">
                                            {{ $t?->batch?->batch_number ?? '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($t?->batch?->document_number)
                                            <span class="dispatch-show-order">
                                                {{ $t->batch->document_number }}
                                            </span>
                                        @else
                                            —
                                        @endif
                                    </td>

                                    <td>
                                        <span class="dispatch-show-serial">
                                            {{ $t?->serial ?? $ln->tank_unit_id }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $t?->gasType?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $t?->capacity?->name ?? '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="dispatch-show-empty">
                                            No hay líneas registradas en este despacho.
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.sessionStorage.removeItem('dispatch_selected_tank_ids');
        });
    </script>
</x-app-layout>
