<x-app-layout>
    <x-slot name="header">
        <div class="user-header-layout">
            <div>
                <h2 class="user-page-title">
                    Usuarios
                </h2>

                <p class="user-page-subtitle">
                    Gestión de usuarios del sistema, roles, estado de acceso y credenciales.
                </p>
            </div>

            <a
                href="{{ route('users.create') }}"
                class="user-primary-button"
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

                Nuevo usuario
            </a>
        </div>
    </x-slot>

    <style>
        /*
        |--------------------------------------------------------------------------
        | Página
        |--------------------------------------------------------------------------
        */

        .user-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .user-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .user-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .user-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .user-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Botón principal
        |--------------------------------------------------------------------------
        */

        .user-primary-button {
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
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
            transition:
                background-color .15s ease,
                box-shadow .15s ease,
                transform .15s ease;
        }

        .user-primary-button:hover {
            background: #4338ca;
        }

        .user-primary-button svg {
            width: 16px;
            height: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Alertas
        |--------------------------------------------------------------------------
        */

        .user-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
        }

        .user-alert.success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        /*
        |--------------------------------------------------------------------------
        | Card
        |--------------------------------------------------------------------------
        */

        .user-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .user-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .user-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .user-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .user-total-badge {
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
            white-space: nowrap;
        }

        /*
        |--------------------------------------------------------------------------
        | Tabla
        |--------------------------------------------------------------------------
        */

        .user-table-wrapper {
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            min-width: 1020px;
            border-collapse: collapse;
        }

        .user-table thead {
            background: #f8fafc;
        }

        .user-table th {
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

        .user-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .user-table tbody tr {
            transition: background-color .15s ease;
        }

        .user-table tbody tr:hover {
            background: #f8fafc;
        }

        .user-table tbody tr:last-child td {
            border-bottom: 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Usuario
        |--------------------------------------------------------------------------
        */

        .user-identity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #c7d2fe;
            border-radius: 10px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .user-name {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .user-email {
            color: #64748b;
            font-size: 12px;
        }

        /*
        |--------------------------------------------------------------------------
        | Badges
        |--------------------------------------------------------------------------
        */

        .user-role-badge,
        .user-status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .user-role-badge {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .user-status-badge.active {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .user-status-badge.inactive {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .user-status-dot {
            width: 6px;
            height: 6px;
            margin-right: 5px;
            border-radius: 999px;
            background: currentColor;
        }

        /*
        |--------------------------------------------------------------------------
        | Acciones
        |--------------------------------------------------------------------------
        */

        .user-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 6px;
        }

        .user-action-button {
            min-height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease;
        }

        .user-action-button.edit {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .user-action-button.edit:hover {
            background: #e0e7ff;
        }

        .user-action-button.toggle {
            border: 1px solid #fde68a;
            background: #fffbeb;
            color: #92400e;
        }

        .user-action-button.toggle:hover {
            background: #fef3c7;
        }

        .user-action-button.activate {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #047857;
        }

        .user-action-button.activate:hover {
            background: #d1fae5;
        }

        .user-action-button.password {
            border: 1px solid #bfdbfe;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .user-action-button.password:hover {
            background: #dbeafe;
        }

        .user-action-button.delete {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        .user-action-button.delete:hover {
            background: #fee2e2;
        }

        /*
        |--------------------------------------------------------------------------
        | Estado vacío
        |--------------------------------------------------------------------------
        */

        .user-empty-state {
            padding: 44px 18px;
            text-align: center;
        }

        .user-empty-icon {
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

        .user-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .user-empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .user-empty-text {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        /*
        |--------------------------------------------------------------------------
        | Paginación
        |--------------------------------------------------------------------------
        */

        .user-pagination {
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 640px) {
            .user-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .user-header-layout {
                flex-direction: column;
            }

            .user-primary-button {
                width: 100%;
            }

            .user-card-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="user-page">
        <div class="user-container">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="user-alert success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Listado --}}
            <section class="user-card">
                <div class="user-card-header">
                    <div>
                        <h3 class="user-section-title">
                            Usuarios registrados
                        </h3>

                        <p class="user-section-subtitle">
                            Administra datos personales, roles, acceso y credenciales.
                        </p>
                    </div>

                    <span class="user-total-badge">
                        Total:
                        <strong>{{ $users->total() }}</strong>
                    </span>
                </div>

                <div class="user-table-wrapper">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>

                                <th style="text-align: right;">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $u)
                                <tr>
                                    {{-- Nombre --}}
                                    <td>
                                        <div class="user-identity">
                                            <div class="user-avatar">
                                                {{ mb_substr($u->name, 0, 1) }}
                                            </div>

                                            <div>
                                                <div class="user-name">
                                                    {{ $u->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Email --}}
                                    <td>
                                        <span class="user-email">
                                            {{ $u->email }}
                                        </span>
                                    </td>

                                    {{-- Rol --}}
                                    <td>
                                        <span class="user-role-badge">
                                            {{ $u->role }}
                                        </span>
                                    </td>

                                    {{-- Estado --}}
                                    <td>
                                        @if($u->is_active)
                                            <span class="user-status-badge active">
                                                <span class="user-status-dot"></span>
                                                Activo
                                            </span>
                                        @else
                                            <span class="user-status-badge inactive">
                                                <span class="user-status-dot"></span>
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Acciones --}}
                                    <td>
                                        <div class="user-actions">

                                            {{-- Editar --}}
                                            <a
                                                href="{{ route('users.edit', $u) }}"
                                                class="user-action-button edit"
                                            >
                                                Editar
                                            </a>

                                            {{-- Activar / desactivar --}}
                                            <form
                                                method="POST"
                                                action="{{ route('users.toggle-active', $u) }}"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="user-action-button {{ $u->is_active ? 'toggle' : 'activate' }}"
                                                >
                                                    {{ $u->is_active ? 'Desactivar' : 'Activar' }}
                                                </button>
                                            </form>

                                            {{-- Reset contraseña --}}
                                            <form
                                                method="POST"
                                                action="{{ route('users.reset-password', $u) }}"
                                                onsubmit="return confirm('¿Resetear la contraseña de este usuario y mostrar la nueva contraseña en el mensaje de confirmación?')"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="user-action-button password"
                                                >
                                                    Restablecer contraseña
                                                </button>
                                            </form>

                                            {{-- Eliminar --}}
                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $u) }}"
                                                onsubmit="return confirm('¿Eliminar este usuario? Esta acción no se puede deshacer.')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="user-action-button delete"
                                                >
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="user-empty-state">
                                            <div class="user-empty-icon">
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
                                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                                    />
                                                </svg>
                                            </div>

                                            <h4 class="user-empty-title">
                                                No hay usuarios registrados
                                            </h4>

                                            <p class="user-empty-text">
                                                Registra el primer usuario para comenzar.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="user-pagination">
                        {{ $users->links() }}
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
