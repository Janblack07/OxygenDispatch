<x-app-layout>
    <x-slot name="header">
        <div class="profile-header-layout">
            <div>
                <h2 class="profile-page-title">
                    Mi perfil
                </h2>

                <p class="profile-page-subtitle">
                    Administra tu información personal, credenciales de acceso y configuración de cuenta.
                </p>
            </div>
        </div>
    </x-slot>

    <style>
        /*
        |--------------------------------------------------------------------------
        | Página
        |--------------------------------------------------------------------------
        */

        .profile-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .profile-container {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
        }

        /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

        .profile-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .profile-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            line-height: 1.35;
            font-weight: 700;
        }

        .profile-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Cabecera del perfil
        |--------------------------------------------------------------------------
        */

        .profile-summary-card {
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .profile-avatar {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #c7d2fe;
            border-radius: 14px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 19px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .profile-summary-content {
            min-width: 0;
            flex: 1;
        }

        .profile-summary-name {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .profile-summary-email {
            margin: 3px 0 0;
            overflow: hidden;
            color: #64748b;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .profile-summary-role {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 10px;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | Stack
        |--------------------------------------------------------------------------
        */

        .profile-sections {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        /*
        |--------------------------------------------------------------------------
        | Cards
        |--------------------------------------------------------------------------
        */

        .profile-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .profile-card-danger {
            border-color: #fecaca;
        }

        .profile-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .profile-card-danger .profile-card-header {
            border-bottom-color: #fee2e2;
            background: #fef2f2;
        }

        .profile-card-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .profile-card-danger .profile-card-title {
            color: #991b1b;
        }

        .profile-card-subtitle {
            margin: 4px 0 0;
            max-width: 680px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.55;
        }

        .profile-card-danger .profile-card-subtitle {
            color: #b91c1c;
        }

        .profile-card-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .profile-card-icon.indigo {
            background: #eef2ff;
            color: #4f46e5;
        }

        .profile-card-icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .profile-card-icon.red {
            background: #fee2e2;
            color: #dc2626;
        }

        .profile-card-icon svg {
            width: 19px;
            height: 19px;
        }

        .profile-card-body {
            padding: 20px;
        }

        /*
        |--------------------------------------------------------------------------
        | Formularios
        |--------------------------------------------------------------------------
        */

        .profile-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .profile-form-full {
            grid-column: 1 / -1;
        }

        .profile-form-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .profile-required {
            color: #dc2626;
        }

        .profile-form-control {
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

        .profile-form-control::placeholder {
            color: #94a3b8;
        }

        .profile-form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        .profile-form-control.has-error {
            border-color: #fca5a5;
        }

        .profile-form-error {
            margin: 5px 0 0;
            color: #dc2626;
            font-size: 11px;
            line-height: 1.45;
        }

        .profile-form-help {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        .profile-password-wrapper {
            position: relative;
        }

        .profile-password-wrapper .profile-form-control {
            padding-right: 42px;
        }

        .profile-password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 7px;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            transform: translateY(-50%);
            transition:
                background-color .15s ease,
                color .15s ease;
        }

        .profile-password-toggle:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .profile-password-toggle svg {
            width: 16px;
            height: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Email no verificado
        |--------------------------------------------------------------------------
        */

        .profile-verification-box {
            margin-top: 10px;
            padding: 12px 14px;
            border: 1px solid #fde68a;
            border-radius: 11px;
            background: #fffbeb;
            color: #92400e;
            font-size: 11px;
            line-height: 1.5;
        }

        .profile-verification-button {
            padding: 0;
            border: 0;
            background: transparent;
            color: #4338ca;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            text-decoration: underline;
            cursor: pointer;
        }

        .profile-verification-success {
            margin-top: 8px;
            color: #047857;
            font-size: 11px;
            font-weight: 600;
        }

        /*
        |--------------------------------------------------------------------------
        | Footer
        |--------------------------------------------------------------------------
        */

        .profile-form-footer {
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .profile-save-button,
        .profile-danger-button,
        .profile-cancel-button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 14px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition:
                background-color .15s ease,
                border-color .15s ease,
                color .15s ease,
                box-shadow .15s ease;
        }

        .profile-save-button {
            border: 0;
            background: #4f46e5;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
        }

        .profile-save-button:hover {
            background: #4338ca;
        }

        .profile-danger-button {
            border: 1px solid #fecaca;
            background: #dc2626;
            color: #ffffff;
        }

        .profile-danger-button:hover {
            background: #b91c1c;
        }

        .profile-cancel-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .profile-cancel-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .profile-saved-message {
            color: #047857;
            font-size: 11px;
            font-weight: 600;
        }

        /*
        |--------------------------------------------------------------------------
        | Zona peligrosa
        |--------------------------------------------------------------------------
        */

        .profile-danger-notice {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
        }

        .profile-danger-notice-content {
            flex: 1;
        }

        .profile-danger-notice-title {
            margin: 0;
            color: #991b1b;
            font-size: 13px;
            font-weight: 700;
        }

        .profile-danger-notice-text {
            margin: 4px 0 0;
            max-width: 680px;
            color: #b91c1c;
            font-size: 11px;
            line-height: 1.55;
        }

        /*
        |--------------------------------------------------------------------------
        | Modal
        |--------------------------------------------------------------------------
        */

        .profile-modal-form {
            padding: 24px;
        }

        .profile-modal-title {
            margin: 0;
            color: #0f172a;
            font-size: 17px;
            font-weight: 700;
        }

        .profile-modal-text {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.55;
        }

        .profile-modal-field {
            margin-top: 20px;
        }

        .profile-modal-actions {
            margin-top: 20px;
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
            .profile-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .profile-summary-card {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .profile-summary-role {
                width: 100%;
                justify-content: center;
            }

            .profile-form-grid {
                grid-template-columns: 1fr;
            }

            .profile-form-full {
                grid-column: auto;
            }

            .profile-form-footer {
                align-items: stretch;
                flex-direction: column-reverse;
            }

            .profile-save-button,
            .profile-danger-button,
            .profile-cancel-button {
                width: 100%;
            }

            .profile-danger-notice {
                flex-direction: column;
            }

            .profile-danger-notice .profile-danger-button {
                width: 100%;
            }

            .profile-modal-actions {
                flex-direction: column-reverse;
            }
        }
    </style>

    <div class="profile-page">
        <div class="profile-container">

            {{-- Resumen del usuario --}}
            <section class="profile-summary-card">
                <div class="profile-avatar">
                    {{ mb_substr($user->name, 0, 1) }}
                </div>

                <div class="profile-summary-content">
                    <h3 class="profile-summary-name">
                        {{ $user->name }}
                    </h3>

                    <p class="profile-summary-email">
                        {{ $user->email }}
                    </p>
                </div>

                @if(isset($user->role))
                    <span class="profile-summary-role">
                        {{ $user->role }}
                    </span>
                @endif
            </section>

            <div class="profile-sections">

                {{-- Información personal --}}
                <section class="profile-card">
                    <div class="profile-card-header">
                        <div>
                            <h3 class="profile-card-title">
                                Información del perfil
                            </h3>

                            <p class="profile-card-subtitle">
                                Actualiza tu nombre y dirección de correo electrónico.
                            </p>
                        </div>

                        <div class="profile-card-icon indigo">
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
                    </div>

                    <div class="profile-card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </section>

                {{-- Contraseña --}}
                <section class="profile-card">
                    <div class="profile-card-header">
                        <div>
                            <h3 class="profile-card-title">
                                Seguridad y contraseña
                            </h3>

                            <p class="profile-card-subtitle">
                                Cambia tu contraseña actual para mantener segura tu cuenta.
                            </p>
                        </div>

                        <div class="profile-card-icon blue">
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
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75v-6a2.25 2.25 0 0 1 2.25-2.25Z"
                                />
                            </svg>
                        </div>
                    </div>

                    <div class="profile-card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </section>

                {{-- Eliminar cuenta --}}
                <section class="profile-card profile-card-danger">
                    <div class="profile-card-header">
                        <div>
                            <h3 class="profile-card-title">
                                Eliminar cuenta
                            </h3>

                            <p class="profile-card-subtitle">
                                Esta acción elimina permanentemente tu cuenta y sus datos asociados.
                            </p>
                        </div>

                        <div class="profile-card-icon red">
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
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0V4.477c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </div>
                    </div>

                    <div class="profile-card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
