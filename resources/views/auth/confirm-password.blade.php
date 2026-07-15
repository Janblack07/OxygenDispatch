<x-guest-layout>
    <div
        class="w-full max-w-md"
        style="width: 100%; max-width: 448px;"
    >
        <div
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
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
                    padding: 16px 24px;
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
                            box-shadow: 0 1px 3px rgba(79, 70, 229, 0.25);
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
                                d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z"
                            />
                        </svg>
                    </div>

                    <div style="min-width: 0;">
                        <h1
                            style="
                                margin: 0;
                                font-size: 18px;
                                line-height: 1.35;
                                font-weight: 700;
                                color: #0f172a;
                            "
                        >
                            Confirmar contraseña
                        </h1>

                        <p
                            style="
                                margin: 2px 0 0;
                                font-size: 14px;
                                line-height: 1.45;
                                color: #64748b;
                            "
                        >
                            Área segura del sistema
                        </p>
                    </div>
                </div>
            </div>

            {{-- Contenido --}}
            <div style="padding: 20px 24px;">
                <div
                    style="
                        margin-bottom: 16px;
                        padding: 12px 14px;
                        border: 1px solid #c7d2fe;
                        border-radius: 12px;
                        background: #eef2ff;
                        font-size: 13px;
                        line-height: 1.55;
                        color: #3730a3;
                    "
                >
                    Esta es un área segura de la aplicación. Confirma tu contraseña antes de continuar.
                </div>

                <form
                    method="POST"
                    action="{{ route('password.confirm') }}"
                    style="
                        display: flex;
                        flex-direction: column;
                        gap: 16px;
                    "
                >
                    @csrf

                    <div x-data="{ showPassword: false }">
                        <label
                            for="password"
                            style="
                                display: block;
                                margin-bottom: 6px;
                                font-size: 14px;
                                font-weight: 600;
                                color: #334155;
                            "
                        >
                            Contraseña
                        </label>

                        <div style="position: relative;">
                            <div
                                style="
                                    position: absolute;
                                    inset: 0 auto 0 0;
                                    display: flex;
                                    align-items: center;
                                    padding-left: 14px;
                                    pointer-events: none;
                                "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    style="
                                        width: 20px;
                                        height: 20px;
                                        color: #94a3b8;
                                    "
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z"
                                    />
                                </svg>
                            </div>

                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Ingresa tu contraseña"
                                style="
                                    width: 100%;
                                    box-sizing: border-box;
                                    border: 1px solid {{ $errors->has('password') ? '#fca5a5' : '#cbd5e1' }};
                                    border-radius: 12px;
                                    background: #ffffff;
                                    padding: 10px 48px 10px 44px;
                                    font-size: 14px;
                                    line-height: 1.5;
                                    color: #0f172a;
                                    outline: none;
                                    box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
                                "
                            >

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                :aria-label="showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'"
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
                                    style="width: 20px; height: 20px;"
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
                                    style="width: 20px; height: 20px;"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 2.036 11.68a1.012 1.012 0 0 0 0 .639C3.423 16.49 7.36 19.5 12 19.5c1.512 0 2.95-.319 4.25-.894M6.228 6.228A9.953 9.953 0 0 1 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639a10.523 10.523 0 0 1-4.293 5.774M3 3l18 18"
                                    />
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <p
                                style="
                                    margin: 6px 0 0;
                                    font-size: 12px;
                                    color: #dc2626;
                                "
                            >
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        style="
                            width: 100%;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            gap: 8px;
                            border: 0;
                            border-radius: 12px;
                            background: #4f46e5;
                            padding: 10px 16px;
                            font-size: 14px;
                            font-weight: 600;
                            color: #ffffff;
                            cursor: pointer;
                            box-shadow: 0 1px 3px rgba(79, 70, 229, 0.25);
                        "
                    >
                        Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
