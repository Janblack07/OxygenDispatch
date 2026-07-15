<x-app-layout>
    <x-slot name="header">
        <div class="catalog-header-layout">
            <div>
                <h2 class="catalog-page-title">
                    Tipos de gas
                </h2>

                <p class="catalog-page-subtitle">
                    Administra los gases disponibles para los productos y tanques.
                </p>
            </div>

            <a
                href="{{ route('gas-types.create') }}"
                class="catalog-primary-button"
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
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

                Nuevo tipo de gas
            </a>
        </div>
    </x-slot>

    <style>
        .catalog-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .catalog-container {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
        }

        .catalog-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .catalog-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .catalog-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .catalog-primary-button {
            flex-shrink: 0;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 14px;
            border: 0;
            border-radius: 10px;
            background: #4f46e5;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .catalog-primary-button:hover {
            background: #4338ca;
        }

        .catalog-primary-button svg {
            width: 16px;
            height: 16px;
        }

        .catalog-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #a7f3d0;
            border-radius: 12px;
            background: #ecfdf5;
            color: #065f46;
            font-size: 13px;
        }

        .catalog-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, .04);
        }

        .catalog-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .catalog-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .catalog-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .catalog-total-badge {
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

        .catalog-table-wrapper {
            overflow-x: auto;
        }

        .catalog-table {
            width: 100%;
            min-width: 580px;
            border-collapse: collapse;
        }

        .catalog-table thead {
            background: #f8fafc;
        }

        .catalog-table th {
            padding: 11px 14px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
        }

        .catalog-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
        }

        .catalog-table tbody tr:hover {
            background: #f8fafc;
        }

        .catalog-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .catalog-name {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .catalog-name-badge {
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

        .catalog-actions {
            display: flex;
            justify-content: flex-end;
            gap: 7px;
        }

        .catalog-edit-button,
        .catalog-delete-button {
            min-height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 11px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .catalog-edit-button {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .catalog-delete-button {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        .catalog-empty {
            padding: 44px 18px;
            color: #64748b;
            font-size: 12px;
            text-align: center;
        }

        .catalog-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        @media (max-width: 640px) {
            .catalog-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .catalog-header-layout {
                flex-direction: column;
            }

            .catalog-primary-button {
                width: 100%;
            }
        }
    </style>

    <div class="catalog-page">
        <div class="catalog-container">

            @if(session('success'))
                <div class="catalog-alert">
                    {{ session('success') }}
                </div>
            @endif

            <section class="catalog-card">
                <div class="catalog-card-header">
                    <div>
                        <h3 class="catalog-section-title">
                            Lista de tipos de gas
                        </h3>

                        <p class="catalog-section-subtitle">
                            Gases configurados actualmente en el sistema.
                        </p>
                    </div>

                    <span class="catalog-total-badge">
                        Total:
                        <strong>{{ $items->total() }}</strong>
                    </span>
                </div>

                <div class="catalog-table-wrapper">
                    <table class="catalog-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th style="text-align: right;">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($items as $it)
                                <tr>
                                    <td>
                                        <span class="catalog-name-badge">
                                            {{ $it->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="catalog-actions">
                                            <a
                                                href="{{ route('gas-types.edit', $it) }}"
                                                class="catalog-edit-button"
                                            >
                                                Editar
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('gas-types.destroy', $it) }}"
                                                onsubmit="return confirm('¿Eliminar este registro?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="catalog-delete-button"
                                                >
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="2">
                                        <div class="catalog-empty">
                                            No hay tipos de gas registrados.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($items->hasPages())
                    <div class="catalog-pagination">
                        {{ $items->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
