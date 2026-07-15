<x-guest-layout>
    <div
        class="w-full"
        style="width: 100%; max-width: 480px;"
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
            <div
                style="
                    border-bottom: 1px solid #e2e8f0;
                    background: rgba(248, 250, 252, 0.88);
                    padding: 16px 24px;
                "
            >
                <h1
                    style="
                        margin: 0;
                        font-size: 18px;
                        font-weight: 700;
                        color: #0f172a;
                    "
                >
                    Restablecer contraseña
                </h1>

                <p
                    style="
                        margin: 3px 0 0;
                        font-size: 14px;
                        color: #64748b;
                    "
                >
                    Define una nueva contraseña para tu cuenta.
                </p>
            </div>

            <div style="padding: 20px 24px;">
                <form
                    method="POST"
                    action="{{ route('password.store') }}"
                    style="
                        display: flex;
                        flex-direction: column;
                        gap: 14px;
                    "
                >
                    @csrf

                    <input
                        type="hidden"
                        name="token"
                        value="{{ $request->route('token') }}"
                    >

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
                            value="{{ old('email', $request->email) }}"
                            required
                            autofocus
                            autocomplete="username"
                            style="
                                width: 100%;
                                box-sizing: border-box;
                                border: 1px solid {{ $errors->has('email') ? '#fca5a5' : '#cbd5e1' }};
                                border-radius: 12px;
                                padding: 10px 14px;
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

                    {{-- Password --}}
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
                            Nueva contraseña
                        </label>

                        <div style="position: relative;">
                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Nueva contraseña"
                                style="
                                    width: 100%;
                                    box-sizing: border-box;
                                    border: 1px solid {{ $errors->has('password') ? '#fca5a5' : '#cbd5e1' }};
                                    border-radius: 12px;
                                    padding: 10px 48px 10px 14px;
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
                                    padding: 0 14px;
                                    border: 0;
                                    background: transparent;
                                    color: #94a3b8;
                                    cursor: pointer;
                                "
                            >
                                <span x-text="showPassword ? 'Ocultar' : 'Ver'"></span>
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
                            placeholder="Repite la nueva contraseña"
                            style="
                                width: 100%;
                                box-sizing: border-box;
                                border: 1px solid #cbd5e1;
                                border-radius: 12px;
                                padding: 10px 14px;
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
                        Restablecer contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
