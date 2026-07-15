<x-app-layout>
    <x-slot name="header">
        <div class="client-header-layout">
            <div>
                <h2 class="client-page-title">
                    Clientes
                </h2>

                <p class="client-page-subtitle">
                    Registro y administración de clientes utilizados en los despachos.
                </p>
            </div>

            <a
                href="{{ route('clients.create') }}"
                class="client-primary-button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="client-button-icon"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

                Nuevo cliente
            </a>
        </div>
    </x-slot>

    <style>
        .client-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .client-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .client-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .client-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .client-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .client-primary-button,
        .client-filter-button,
        .client-edit-button,
        .client-delete-button {
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

        .client-primary-button {
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

        .client-primary-button:hover {
            background: #4338ca;
        }

        .client-button-icon {
            width: 17px;
            height: 17px;
        }

        .client-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
        }

        .client-alert.success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .client-alert.error {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .client-alert ul {
            margin: 0;
            padding-left: 18px;
        }

        .client-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .client-card + .client-card,
        .client-card + .client-alert,
        .client-alert + .client-card {
            margin-top: 18px;
        }

        .client-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .client-card-body {
            padding: 18px 20px;
        }

        .client-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .client-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .client-filter-grid {
            display: grid;
            grid-template-columns: 4fr 4fr 3fr 1fr;
            gap: 12px;
            align-items: end;
        }

        .client-field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            line-height: 1.2;
            font-weight: 600;
        }

        .client-control {
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

        .client-control::placeholder {
            color: #94a3b8;
        }

        .client-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .client-filter-button {
            width: 100%;
            min-height: 40px;
            padding: 0 12px;
            border: 0;
            border-radius: 10px;
            background: #0f172a;
            color: #ffffff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
        }

        .client-filter-button:hover {
            background: #1e293b;
        }

        .client-filter-footer {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        .client-clear-link {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
        }

        .client-clear-link:hover {
            color: #0f172a;
            text-decoration: underline;
        }

        .client-total-badge {
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

        .client-table-wrapper {
            overflow-x: auto;
        }

        .client-table {
            width: 100%;
            min-width: 1100px;
            border-collapse: collapse;
        }

        .client-table thead {
            background: #f8fafc;
        }

        .client-table th {
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

        .client-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .client-table tbody tr {
            transition: background-color .15s ease;
        }

        .client-table tbody tr:hover {
            background: #f8fafc;
        }

        .client-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .client-name {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .client-document-badge,
        .client-type-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .client-document-badge {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
        }

        .client-type-badge {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .client-address {
            max-width: 240px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .client-actions {
            display: flex;
            justify-content: flex-end;
            gap: 7px;
            white-space: nowrap;
        }

        .client-edit-button {
            min-height: 32px;
            padding: 0 11px;
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .client-edit-button:hover {
            background: #e0e7ff;
        }

        .client-delete-button {
            min-height: 32px;
            padding: 0 11px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fef2f2;
            color: #b91c1c;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
        }

        .client-delete-button:hover {
            background: #fee2e2;
        }

        .client-empty-state {
            padding: 44px 18px;
            text-align: center;
        }

        .client-empty-icon {
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

        .client-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .client-empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .client-empty-text {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .client-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        @media (max-width: 900px) {
            .client-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .client-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .client-header-layout {
                flex-direction: column;
            }

            .client-primary-button {
                width: 100%;
            }

            .client-filter-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="client-page">
        <div class="client-container">

            @if(session('success'))
                <div class="client-alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="client-alert error">
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Filtros --}}
            <section class="client-card">
                <div class="client-card-header">
                    <div>
                        <h3 class="client-section-title">
                            Buscar clientes
                        </h3>

                        <p class="client-section-subtitle">
                            Filtra por documento, nombre o tipo de cliente.
                        </p>
                    </div>
                </div>

                <div class="client-card-body">
                    <form
                        method="GET"
                        action="{{ route('clients.index') }}"
                    >
                        <div class="client-filter-grid">

                            <div>
                                <label
                                    for="document"
                                    class="client-field-label"
                                >
                                    Cédula / RUC
                                </label>

                                <input
                                    type="text"
                                    name="document"
                                    id="document"
                                    value="{{ $document }}"
                                    class="client-control"
                                    placeholder="Ej. 1311111111"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label
                                    for="name"
                                    class="client-field-label"
                                >
                                    Nombre
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ $name }}"
                                    class="client-control"
                                    placeholder="Ej. Juan Pérez"
                                    autocomplete="off"
                                >
                            </div>

                            <div>
                                <label
                                    for="entity_type"
                                    class="client-field-label"
                                >
                                    Tipo de cliente
                                </label>

                                <select
                                    name="entity_type"
                                    id="entity_type"
                                    class="client-control"
                                >
                                    <option value="">
                                        Todos
                                    </option>

                                    @foreach(\App\Enums\EntityType::cases() as $type)
                                        <option
                                            value="{{ $type->value }}"
                                            @selected(
                                                (string) $entityType === (string) $type->value
                                            )
                                        >
                                            {{ $type->label() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    class="client-filter-button"
                                >
                                    Filtrar
                                </button>
                            </div>

                        </div>

                        @if($document || $name || $entityType)
                            <div class="client-filter-footer">
                                <a
                                    href="{{ route('clients.index') }}"
                                    class="client-clear-link"
                                >
                                    Limpiar filtros
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </section>

            @if($searchMessage)
                <div class="client-alert {{ $searchStatus === 'success' ? 'success' : 'error' }}">
                    {{ $searchMessage }}
                </div>
            @endif

            {{-- Tabla --}}
            <section class="client-card">
                <div class="client-card-header">
                    <div>
                        <h3 class="client-section-title">
                            Lista de clientes
                        </h3>

                        <p class="client-section-subtitle">
                            Consulta y administra los clientes registrados.
                        </p>
                    </div>

                    <span class="client-total-badge">
                        Total:
                        <strong>{{ $clients->total() }}</strong>
                    </span>
                </div>

                <div class="client-table-wrapper">
                    <table class="client-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Tipo</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Dirección</th>
                                <th style="text-align: right;">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($clients as $c)
                                <tr>
                                    <td>
                                        <span class="client-name">
                                            {{ $c->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="client-document-badge">
                                            {{ $c->document ?? '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="client-type-badge">
                                            {{ $c->entity_type?->label() ?? '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $c->phone ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $c->email ?? '—' }}
                                    </td>

                                    <td>
                                        <div
                                            class="client-address"
                                            title="{{ $c->address }}"
                                        >
                                            {{ $c->address ?? '—' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="client-actions">
                                            <a
                                                href="{{ route('clients.edit', $c) }}"
                                                class="client-edit-button"
                                            >
                                                Editar
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('clients.destroy', $c) }}"
                                                onsubmit="return confirm('¿Eliminar este cliente?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="client-delete-button"
                                                >
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="client-empty-state">
                                            <div class="client-empty-icon">
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
                                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                                    />
                                                </svg>
                                            </div>

                                            <h4 class="client-empty-title">
                                                @if($document || $name || $entityType)
                                                    No se encontraron clientes
                                                @else
                                                    No hay clientes registrados
                                                @endif
                                            </h4>

                                            <p class="client-empty-text">
                                                @if($document || $name || $entityType)
                                                    Ajusta los filtros para consultar otros resultados.
                                                @else
                                                    Registra el primer cliente para comenzar.
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($clients->hasPages())
                    <div class="client-pagination">
                        {{ $clients->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
