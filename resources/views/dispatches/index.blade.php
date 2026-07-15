<x-app-layout>
    <x-slot name="header">
        <div class="dispatch-header-layout">
            <div>
                <h2 class="dispatch-page-title">
                    Despachos
                </h2>

                <p class="dispatch-page-subtitle">
                    Consulta los despachos realizados y crea nuevas salidas seleccionando tanques disponibles.
                </p>
            </div>

            <a
                href="{{ route('dispatches.create') }}"
                class="dispatch-primary-button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="dispatch-button-icon"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

                Nuevo despacho
            </a>
        </div>
    </x-slot>

    <style>
        .dispatch-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .dispatch-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .dispatch-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .dispatch-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .dispatch-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .dispatch-primary-button,
        .dispatch-view-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            text-decoration: none;
            cursor: pointer;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease,
                box-shadow .15s ease;
        }

        .dispatch-primary-button {
            flex-shrink: 0;
            min-height: 40px;
            padding: 0 14px;
            border: 0;
            border-radius: 10px;
            background: #4f46e5;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.15);
        }

        .dispatch-primary-button:hover {
            background: #4338ca;
        }

        .dispatch-button-icon {
            width: 17px;
            height: 17px;
        }

        .dispatch-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #a7f3d0;
            border-radius: 12px;
            background: #ecfdf5;
            color: #065f46;
            font-size: 13px;
        }

        .dispatch-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .dispatch-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .dispatch-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .dispatch-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .dispatch-total-badge {
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

        .dispatch-table-wrapper {
            overflow-x: auto;
        }

        .dispatch-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .dispatch-table thead {
            background: #f8fafc;
        }

        .dispatch-table th {
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

        .dispatch-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .dispatch-table tbody tr {
            transition: background-color .15s ease;
        }

        .dispatch-table tbody tr:hover {
            background: #f8fafc;
        }

        .dispatch-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .dispatch-id {
            color: #0f172a;
            font-weight: 700;
        }

        .dispatch-date {
            color: #334155;
            font-weight: 600;
            white-space: nowrap;
        }

        .dispatch-client {
            color: #0f172a;
            font-weight: 600;
        }

        .dispatch-document-badge {
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

        .dispatch-user-email {
            max-width: 230px;
            overflow: hidden;
            color: #64748b;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dispatch-view-button {
            min-height: 32px;
            padding: 0 11px;
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .dispatch-view-button:hover {
            background: #e0e7ff;
        }

        .dispatch-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        .dispatch-empty-state {
            padding: 44px 18px;
            text-align: center;
        }

        .dispatch-empty-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #eff6ff;
            color: #2563eb;
        }

        .dispatch-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .dispatch-empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .dispatch-empty-text {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        @media (max-width: 640px) {
            .dispatch-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .dispatch-header-layout {
                flex-direction: column;
            }

            .dispatch-primary-button {
                width: 100%;
            }
        }
    </style>

    <div class="dispatch-page">
        <div class="dispatch-container">

            @if(session('success'))
                <div class="dispatch-alert">
                    {{ session('success') }}
                </div>
            @endif

            <section class="dispatch-card">
                <div class="dispatch-card-header">
                    <div>
                        <h3 class="dispatch-section-title">
                            Historial de despachos
                        </h3>

                        <p class="dispatch-section-subtitle">
                            Registro de salidas realizadas y responsable de cada operación.
                        </p>
                    </div>

                    <span class="dispatch-total-badge">
                        Total:
                        <strong>{{ $dispatches->total() }}</strong>
                    </span>
                </div>

                <div class="dispatch-table-wrapper">
                    <table class="dispatch-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Documento</th>
                                <th>Realizado por</th>
                                <th style="text-align: right;">
                                    Acción
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($dispatches as $d)
                                <tr>
                                    <td>
                                        <span class="dispatch-id">
                                            #{{ $d->id }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="dispatch-date">
                                            {{ optional($d->dispatched_at)->format('Y-m-d H:i') ?: '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="dispatch-client">
                                            {{ $d->client?->name ?? '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="dispatch-document-badge">
                                            {{ $d->document_number ?? '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="dispatch-user-email">
                                            {{ $d->performed_by_user_email ?: '—' }}
                                        </div>
                                    </td>

                                    <td style="text-align: right;">
                                        <a
                                            href="{{ route('dispatches.show', $d) }}"
                                            class="dispatch-view-button"
                                        >
                                            Ver detalle
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="dispatch-empty-state">
                                            <div class="dispatch-empty-icon">
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
                                                        d="M9 17a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm10 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM3 17V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v11M14 7h4l3 4v6h-2M14 17H9"
                                                    />
                                                </svg>
                                            </div>

                                            <h4 class="dispatch-empty-title">
                                                No hay despachos registrados
                                            </h4>

                                            <p class="dispatch-empty-text">
                                                Crea el primer despacho seleccionando tanques disponibles.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($dispatches->hasPages())
                    <div class="dispatch-pagination">
                        {{ $dispatches->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
