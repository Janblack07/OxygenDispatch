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
                            Recuperar contraseña
                        </h1>

                        <p
                            style="
                                margin: 2px 0 0;
                                font-size: 14px;
                                color: #64748b;
                            "
                        >
                            Te enviaremos un enlace de recuperación
                        </p>
                    </div>
                </div>
            </div>

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
                    Ingresa tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                </div>

                @if(session('status'))
                    <div
                        style="
                            margin-bottom: 16px;
                            padding: 12px 14px;
                            border: 1px solid #a7f3d0;
                            border-radius: 12px;
                            background: #ecfdf5;
                            font-size: 13px;
                            color: #065f46;
                        "
                    >
                        {{ session('status') }}
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('password.email') }}"
                    style="
                        display: flex;
                        flex-direction: column;
                        gap: 16px;
                    "
                >
                    @csrf

                    <div>
                        <label
                            for="email"
                            style="
                                display: block;
                                margin-bottom: 6px;
                                font-size: 14px;
                                font-weight: 600;
                                color: #334155;
                            "
                        >
                            Correo electrónico
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
                                        d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.659 5.197a2.25 2.25 0 0 1-2.182 0L2.25 6.75"
                                    />
                                </svg>
                            </div>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="nombre@empresa.com"
                                style="
                                    width: 100%;
                                    box-sizing: border-box;
                                    border: 1px solid {{ $errors->has('email') ? '#fca5a5' : '#cbd5e1' }};
                                    border-radius: 12px;
                                    background: #ffffff;
                                    padding: 10px 16px 10px 44px;
                                    font-size: 14px;
                                    color: #0f172a;
                                    outline: none;
                                "
                            >
                        </div>

                        @error('email')
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
                        "
                    >
                        Enviar enlace de recuperación
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
                        Volver a iniciar sesión
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
