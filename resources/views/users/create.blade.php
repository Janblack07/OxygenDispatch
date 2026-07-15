<x-app-layout>
    <x-slot name="header">
        <div class="user-form-header">
            <div>
                <h2 class="user-form-page-title">
                    Nuevo usuario
                </h2>

                <p class="user-form-page-subtitle">
                    Crea un nuevo usuario, asigna su rol y define sus credenciales de acceso.
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

        .user-form-control::placeholder {
            color: #94a3b8;
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
            line-height: 1.45;
        }

        .user-form-help {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.45;
        }

        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        .user-password-wrapper {
            position: relative;
        }

        .user-password-wrapper .user-form-control {
            padding-right: 42px;
        }

        .user-password-toggle {
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

        .user-password-toggle:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .user-password-toggle svg {
            width: 16px;
            height: 16px;
        }

        /*
        |--------------------------------------------------------------------------
        | Información
        |--------------------------------------------------------------------------
        */

        .user-form-info {
            margin-top: 18px;
            padding: 12px 14px;
            border: 1px solid #c7d2fe;
            border-radius: 11px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            line-height: 1.5;
        }

        .user-form-info-title {
            margin: 0;
            font-weight: 700;
        }

        .user-form-info-text {
            margin: 3px 0 0;
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
                    <h3 class="user-form-card-title">
                        Información del usuario
                    </h3>

                    <p class="user-form-card-subtitle">
                        Registra los datos personales, asigna un rol y configura las credenciales iniciales.
                    </p>
                </div>

                <div class="user-form-card-body">
                    <form
                        method="POST"
                        action="{{ route('users.store') }}"
                    >
                        @csrf

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
                                    value="{{ old('name') }}"
                                    class="user-form-control {{ $errors->has('name') ? 'has-error' : '' }}"
                                    placeholder="Nombre completo"
                                    autocomplete="name"
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
                                    value="{{ old('email') }}"
                                    class="user-form-control {{ $errors->has('email') ? 'has-error' : '' }}"
                                    placeholder="usuario@correo.com"
                                    autocomplete="email"
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
                                        @selected(old('role') === null)
                                    >
                                        Selecciona un rol
                                    </option>

                                    @foreach($roles as $r)
                                        <option
                                            value="{{ $r->value }}"
                                            @selected(old('role') == $r->value)
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

                            {{-- Password --}}
                            <div>
                                <label
                                    for="password"
                                    class="user-form-label"
                                >
                                    Contraseña
                                    <span style="color: #94a3b8; font-weight: 500;">
                                        (opcional)
                                    </span>
                                </label>

                                <div class="user-password-wrapper">
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        value="{{ old('password') }}"
                                        class="user-form-control {{ $errors->has('password') ? 'has-error' : '' }}"
                                        placeholder="Se genera automáticamente si queda vacío"
                                        autocomplete="new-password"
                                    >

                                    <button
                                        type="button"
                                        id="toggle-password"
                                        class="user-password-toggle"
                                        aria-label="Mostrar contraseña"
                                        title="Mostrar contraseña"
                                    >
                                        <svg
                                            id="password-eye-open"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                            />
                                        </svg>

                                        <svg
                                            id="password-eye-closed"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            style="display: none;"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                                            />
                                        </svg>
                                    </button>
                                </div>

                                <p class="user-form-help">
                                    Al dejar este campo vacío, el sistema generará automáticamente una contraseña segura.
                                </p>

                                @error('password')
                                    <p class="user-form-error">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <div class="user-form-info">
                            <p class="user-form-info-title">
                                Credenciales iniciales
                            </p>

                            <p class="user-form-info-text">
                                Cuando la contraseña se genera automáticamente, el sistema la mostrará en el mensaje de éxito después de crear el usuario.
                            </p>
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
                                Crear usuario
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('toggle-password');
            const eyeOpen = document.getElementById('password-eye-open');
            const eyeClosed = document.getElementById('password-eye-closed');

            if (
                !passwordInput
                || !togglePassword
                || !eyeOpen
                || !eyeClosed
            ) {
                return;
            }

            togglePassword.addEventListener('click', function () {
                const isHidden = passwordInput.type === 'password';

                passwordInput.type = isHidden
                    ? 'text'
                    : 'password';

                eyeOpen.style.display = isHidden
                    ? 'none'
                    : 'block';

                eyeClosed.style.display = isHidden
                    ? 'block'
                    : 'none';

                togglePassword.setAttribute(
                    'aria-label',
                    isHidden
                        ? 'Ocultar contraseña'
                        : 'Mostrar contraseña'
                );

                togglePassword.setAttribute(
                    'title',
                    isHidden
                        ? 'Ocultar contraseña'
                        : 'Mostrar contraseña'
                );
            });
        });
    </script>
</x-app-layout>
