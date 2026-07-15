<x-app-layout>
    <x-slot name="header">
        <div class="user-form-header">
            <div>
                <h2 class="user-form-page-title">
                    Editar usuario
                </h2>

                <p class="user-form-page-subtitle">
                    Actualiza los datos personales y el rol asignado al usuario.
                </p>
            </div>

            <a
                href="{{ route('users.index') }}"
                class="user-form-back-button"
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

        .user-form-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .user-form-container {
            width: 100%;
            max-width: 860px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .user-form-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .user-form-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .user-form-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Botones
        |--------------------------------------------------------------------------
        */

        .user-form-back-button,
        .user-form-cancel-button,
        .user-form-submit-button {
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

        .user-form-back-button,
        .user-form-cancel-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .user-form-back-button:hover,
        .user-form-cancel-button:hover {
            border-color: #94a3b8;
            background: #f8fafc;
            color: #0f172a;
        }

        .user-form-back-button svg {
            width: 16px;
            height: 16px;
        }

        .user-form-submit-button {
            border: 0;
            background: #4f46e5;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
        }

        .user-form-submit-button:hover {
            background: #4338ca;
        }

        /*
        |--------------------------------------------------------------------------
        | Errores
        |--------------------------------------------------------------------------
        */

        .user-form-errors {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #fecaca;
            border-radius: 12px;
            background: #fef2f2;
            color: #991b1b;
            font-size: 12px;
            line-height: 1.5;
        }

        .user-form-errors-title {
            margin: 0;
            font-weight: 700;
        }

        .user-form-errors ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        /*
        |--------------------------------------------------------------------------
        | Card
        |--------------------------------------------------------------------------
        */

        .user-form-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .user-form-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .user-form-card-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .user-form-card-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .user-form-card-body {
            padding: 20px;
        }

        /*
        |--------------------------------------------------------------------------
        | Identidad del usuario
        |--------------------------------------------------------------------------
        */

        .user-form-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-form-avatar {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #c7d2fe;
            border-radius: 11px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 15px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .user-form-profile-name {
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
        }

        .user-form-profile-email {
            margin-top: 1px;
            color: #64748b;
            font-size: 11px;
        }

        /*
        |--------------------------------------------------------------------------
        | Grid
        |--------------------------------------------------------------------------
        */

        .user-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Campos
        |--------------------------------------------------------------------------
        */

        .user-form-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .user-form-required {
            color: #dc2626;
        }

        .user-form-control {
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

        .user-form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .user-form-control.has-error {
            border-color: #fca5a5;
        }

        .user-form-error {
            margin: 5px 0 0;
            color: #dc2626;
            font-size: 11px;
        }

        /*
        |--------------------------------------------------------------------------
        | Estado
        |--------------------------------------------------------------------------
        */

        .user-form-status-box {
            min-height: 42px;
            display: flex;
            align-items: center;
            padding: 0 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
        }

        .user-form-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
        }

        .user-form-status-badge.active {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .user-form-status-badge.inactive {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #64748b;
        }

        .user-form-status-dot {
            width: 6px;
            height: 6px;
            margin-right: 5px;
            border-radius: 999px;
            background: currentColor;
        }

        .user-form-help {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.45;
        }

        /*
        |--------------------------------------------------------------------------
        | Footer
        |--------------------------------------------------------------------------
        */

        .user-form-footer {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 640px) {
            .user-form-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .user-form-header {
                flex-direction: column;
            }

            .user-form-back-button {
                width: 100%;
            }

            .user-form-grid {
                grid-template-columns: 1fr;
            }

            .user-form-card-header {
                flex-direction: column;
            }

            .user-form-footer {
                flex-direction: column-reverse;
            }

            .user-form-cancel-button,
            .user-form-submit-button {
                width: 100%;
            }
        }
    </style>

    <div class="user-form-page">
        <div class="user-form-container">

            {{-- Errores --}}
            @if($errors->any())
                <div class="user-form-errors">
                    <p class="user-form-errors-title">
                        Revisa los siguientes campos:
                    </p>

                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="user-form-card">
                <div class="user-form-card-header">
                    <div>
                        <h3 class="user-form-card-title">
                            Información del usuario
                        </h3>

                        <p class="user-form-card-subtitle">
                            Modifica los datos personales y el nivel de acceso asignado.
                        </p>
                    </div>

                    <div class="user-form-profile">
                        <div class="user-form-avatar">
                            {{ mb_substr($user->name, 0, 1) }}
                        </div>

                        <div>
                            <div class="user-form-profile-name">
                                {{ $user->name }}
                            </div>

                            <div class="user-form-profile-email">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-form-card-body">
                    <form
                        method="POST"
                        action="{{ route('users.update', $user) }}"
                    >
                        @csrf
                        @method('PUT')

                        <div class="user-form-grid">

                            {{-- Nombre --}}
                            <div>
                                <label
                                    for="name"
                                    class="user-form-label"
                                >
                                    Nombre
                                    <span class="user-form-required">*</span>
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="user-form-control {{ $errors->has('name') ? 'has-error' : '' }}"
                                    required
                                >

                                @error('name')
                                    <p class="user-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label
                                    for="email"
                                    class="user-form-label"
                                >
                                    Email
                                    <span class="user-form-required">*</span>
                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="user-form-control {{ $errors->has('email') ? 'has-error' : '' }}"
                                    required
                                >

                                @error('email')
                                    <p class="user-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Rol --}}
                            <div>
                                <label
                                    for="role"
                                    class="user-form-label"
                                >
                                    Rol
                                    <span class="user-form-required">*</span>
                                </label>

                                <select
                                    id="role"
                                    name="role"
                                    class="user-form-control {{ $errors->has('role') ? 'has-error' : '' }}"
                                    required
                                >
                                    <option
                                        value=""
                                        disabled
                                    >
                                        Selecciona un rol
                                    </option>

                                    @foreach($roles as $r)
                                        <option
                                            value="{{ $r->value }}"
                                            @selected(
                                                old('role', $user->role) == $r->value
                                            )
                                        >
                                            {{ $r->value }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <p class="user-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Estado --}}
                            <div>
                                <label class="user-form-label">
                                    Estado de acceso
                                </label>

                                <div class="user-form-status-box">
                                    @if($user->is_active)
                                        <span class="user-form-status-badge active">
                                            <span class="user-form-status-dot"></span>
                                            Activo
                                        </span>
                                    @else
                                        <span class="user-form-status-badge inactive">
                                            <span class="user-form-status-dot"></span>
                                            Inactivo
                                        </span>
                                    @endif
                                </div>

                                <p class="user-form-help">
                                    El estado de acceso se administra desde el listado de usuarios mediante la acción Activar o Desactivar.
                                </p>
                            </div>

                        </div>

                        <div class="user-form-footer">
                            <a
                                href="{{ route('users.index') }}"
                                class="user-form-cancel-button"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="user-form-submit-button"
                            >
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
