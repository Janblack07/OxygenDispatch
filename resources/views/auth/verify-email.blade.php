<x-guest-layout>
    <div
        class="w-full max-w-md"
        style="width: 100%; max-width: 448px;"
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
                                d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.659 5.197a2.25 2.25 0 0 1-2.182 0L2.25 6.75"
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
                            Verifica tu correo
                        </h1>

                        <p
                            style="
                                margin: 2px 0 0;
                                font-size: 14px;
                                color: #64748b;
                            "
                        >
                            Confirma tu dirección antes de continuar
                        </p>
                    </div>
                </div>
            </div>

            <div style="padding: 20px 24px;">
                <p
                    style="
                        margin: 0;
                        font-size: 14px;
                        line-height: 1.65;
                        color: #475569;
                    "
                >
                    Gracias por registrarte. Antes de continuar, verifica tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte.
                </p>

                @if(session('status') == 'verification-link-sent')
                    <div
                        style="
                            margin-top: 16px;
                            padding: 12px 14px;
                            border: 1px solid #a7f3d0;
                            border-radius: 12px;
                            background: #ecfdf5;
                            font-size: 13px;
                            line-height: 1.55;
                            color: #065f46;
                        "
                    >
                        Se ha enviado un nuevo enlace de verificación a la dirección de correo proporcionada.
                    </div>
                @endif

                <div
                    style="
                        margin-top: 18px;
                        display: flex;
                        flex-direction: column;
                        gap: 10px;
                    "
                >
                    <form
                        method="POST"
                        action="{{ route('verification.send') }}"
                    >
                        @csrf

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
                            Reenviar correo de verificación
                        </button>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            style="
                                width: 100%;
                                border: 1px solid #cbd5e1;
                                border-radius: 12px;
                                background: #ffffff;
                                padding: 10px 16px;
                                font-size: 14px;
                                font-weight: 600;
                                color: #475569;
                                cursor: pointer;
                            "
                        >
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
