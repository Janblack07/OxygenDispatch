<x-guest-layout>
    <div
        class="w-full"
        style="width: 100%; max-width: 500px;"
    >
        <div
            style="
                overflow: hidden;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                background: #ffffff;
                box-shadow:
                    0 20px 25px -5px rgba(15, 23, 42, 0.08),
                    0 8px 10px -6px rgba(15, 23, 42, 0.05);
            "
        >
            {{-- Encabezado --}}
            <div
                style="
                    border-bottom: 1px solid #e2e8f0;
                    background: rgba(248, 250, 252, 0.88);
                    padding: 14px 24px;
                "
            >
                <div
                    style="
                        display: flex;
                        align-items: center;
                        gap: 12px;
                    "
                >
                    <div
                        style="
                            width: 40px;
                            height: 40px;
                            flex-shrink: 0;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 12px;
                            background: #4f46e5;
                            color: #ffffff;
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            style="width: 20px; height: 20px;"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3M6.75 6.75A3.75 3.75 0 1 1 14.25 6.75a3.75 3.75 0 0 1-7.5 0ZM3 20.25a8.25 8.25 0 0 1 16.5 0"
                            />
                        </svg>
                    </div>

                    <div>
                        <h1
                            style="
                                margin: 0;
                                font-size: 18px;
                                font-weight: 700;
                                color: #0f172a;
                            "
                        >
                            Crear cuenta
                        </h1>

                        <p
                            style="
                                margin: 2px 0 0;
                                font-size: 14px;
                                color: #64748b;
                            "
                        >
                            Registra una nueva cuenta de acceso
                        </p>
                    </div>
                </div>
            </div>

            <div style="padding: 18px 24px;">
                <form
                    method="POST"
                    action="{{ route('register') }}"
                    style="
                        display: flex;
                        flex-direction: column;
                        gap: 13px;
                    "
                >
                    @csrf

                    {{-- Nombre --}}
                    <div>
                        <label
                            for="name"
                            style="
                                display: block;
                                margin-bottom: 5px;
                                font-size: 14px;
                                font-weight: 600;
                                color: #334155;
                            "
                        >
                            Nombre
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Nombre completo"
                            style="
                                width: 100%;
                                box-sizing: border-box;
                                border: 1px solid {{ $errors->has('name') ? '#fca5a5' : '#cbd5e1' }};
                                border-radius: 12px;
                                padding: 9px 14px;
                                font-size: 14px;
                                color: #0f172a;
                                outline: none;
                            "
                        >

                        @error('name')
                            <p style="margin: 5px 0 0; font-size: 12px; color: #dc2626;">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label
                            for="email"
                            style="
                                display: block;
                                margin-bottom: 5px;
                                font-size: 14px;
                                font-weight: 600;
                                color: #334155;
                            "
                        >
                            Correo electrónico
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="nombre@empresa.com"
                            style="
                                width: 100%;
                                box-sizing: border-box;
                                border: 1px solid {{ $errors->has('email') ? '#fca5a5' : '#cbd5e1' }};
                                border-radius: 12px;
                                padding: 9px 14px;
                                font-size: 14px;
                                color: #0f172a;
                                outline: none;
                            "
                        >

                        @error('email')
                            <p style="margin: 5px 0 0; font-size: 12px; color: #dc2626;">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div x-data="{ showPassword: false }">
                        <label
                            for="password"
                            style="
                                display: block;
                                margin-bottom: 5px;
                                font-size: 14px;
                                font-weight: 600;
                                color: #334155;
                            "
                        >
                            Contraseña
                        </label>

                        <div style="position: relative;">
                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Ingresa una contraseña"
                                style="
                                    width: 100%;
                                    box-sizing: border-box;
                                    border: 1px solid {{ $errors->has('password') ? '#fca5a5' : '#cbd5e1' }};
                                    border-radius: 12px;
                                    padding: 9px 48px 9px 14px;
                                    font-size: 14px;
                                    color: #0f172a;
                                    outline: none;
                                "
                            >

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                style="
                                    position: absolute;
                                    top: 0;
                                    right: 0;
                                    bottom: 0;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    padding: 0 14px;
                                    border: 0;
                                    background: transparent;
                                    color: #94a3b8;
                                    cursor: pointer;
                                "
                            >
                                <svg
                                    x-show="!showPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    style="width: 19px; height: 19px;"
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
                                    x-show="showPassword"
                                    x-cloak
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    style="width: 19px; height: 19px;"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 3l18 18"
                                    />
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p style="margin: 5px 0 0; font-size: 12px; color: #dc2626;">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Confirmación --}}
                    <div>
                        <label
                            for="password_confirmation"
                            style="
                                display: block;
                                margin-bottom: 5px;
                                font-size: 14px;
                                font-weight: 600;
                                color: #334155;
                            "
                        >
                            Confirmar contraseña
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Repite tu contraseña"
                            style="
                                width: 100%;
                                box-sizing: border-box;
                                border: 1px solid #cbd5e1;
                                border-radius: 12px;
                                padding: 9px 14px;
                                font-size: 14px;
                                color: #0f172a;
                                outline: none;
                            "
                        >

                        @error('password_confirmation')
                            <p style="margin: 5px 0 0; font-size: 12px; color: #dc2626;">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        style="
                            width: 100%;
                            border: 0;
                            border-radius: 12px;
                            background: #4f46e5;
                            padding: 10px 16px;
                            font-size: 14px;
                            font-weight: 600;
                            color: #ffffff;
                            cursor: pointer;
                        "
                    >
                        Registrarme
                    </button>

                    <a
                        href="{{ route('login') }}"
                        style="
                            text-align: center;
                            font-size: 13px;
                            font-weight: 600;
                            color: #4f46e5;
                            text-decoration: none;
                        "
                    >
                        ¿Ya tienes una cuenta? Iniciar sesión
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
