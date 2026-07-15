<x-guest-layout>
    <div class="w-full max-w-md">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">

            {{-- Encabezado --}}
            <div class="border-b border-slate-200 bg-slate-50/70 px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm shadow-indigo-200">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6.75V5.625a3.375 3.375 0 0 0-6.75 0V6.75m8.25 0h-10.5A2.25 2.25 0 0 0 4.5 9v8.25A2.25 2.25 0 0 0 6.75 19.5h10.5a2.25 2.25 0 0 0 2.25-2.25V9a2.25 2.25 0 0 0-2.25-2.25Z"
                            />
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <h1 class="text-lg font-bold tracking-tight text-slate-900">
                            Iniciar sesión
                        </h1>

                        <p class="mt-0.5 text-sm text-slate-500">
                            Ingresa tus credenciales para acceder al sistema interno.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Contenido --}}
            <div class="px-6 py-5">

                {{-- Estado de sesión --}}
                @if(session('status'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                        <div class="flex items-start gap-3">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m9 12.75 2.25 2.25L15 9.75"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                />
                            </svg>

                            <p class="text-sm font-medium text-emerald-800">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('login') }}"
                      class="space-y-4">

                    @csrf

                    {{-- Correo --}}
                    <div>
                        <label
                            for="email"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Correo electrónico
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5 text-slate-400"
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
                                class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-11 pr-4 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10
                                @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/10 @enderror"
                            >
                        </div>

                        @error('email')
                            <div class="mt-1.5 flex items-start gap-2 text-xs text-red-600">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="mt-0.5 h-4 w-4 shrink-0"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                                    />
                                </svg>

                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div x-data="{ showPassword: false }">
                        <div class="mb-1.5 flex items-center justify-between gap-3">
                            <label
                                for="password"
                                class="block text-sm font-semibold text-slate-700"
                            >
                                Contraseña
                            </label>

                            @if(Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-xs font-semibold text-indigo-600 transition hover:text-indigo-700 hover:underline"
                                >
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5 text-slate-400"
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
                                class="block w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-11 pr-12 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10
                                @error('password') border-red-300 focus:border-red-500 focus:ring-red-500/10 @enderror"
                            >

                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 transition hover:text-slate-600 focus:outline-none"
                                :aria-label="showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'"
                            >
                                <svg
                                    x-show="!showPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5"
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
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 2.036 11.68a1.012 1.012 0 0 0 0 .639C3.423 16.49 7.36 19.5 12 19.5c1.512 0 2.95-.319 4.25-.894M6.228 6.228A9.953 9.953 0 0 1 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.792 7.792L21 21m-3.33-3.33-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                                    />
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <div class="mt-1.5 flex items-start gap-2 text-xs text-red-600">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="mt-0.5 h-4 w-4 shrink-0"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                                    />
                                </svg>

                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Recordarme --}}
                    <label
                        for="remember_me"
                        class="flex cursor-pointer items-center gap-3"
                    >
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500/30"
                        >

                        <span class="text-sm text-slate-600">
                            Mantener mi sesión iniciada
                        </span>
                    </label>

                    {{-- Botón --}}
                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-200 transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 disabled:pointer-events-none disabled:opacity-50"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 9V5.625A3.375 3.375 0 0 0 12.375 2.25h-6.75A3.375 3.375 0 0 0 2.25 5.625v12.75a3.375 3.375 0 0 0 3.375 3.375h6.75a3.375 3.375 0 0 0 3.375-3.375V15m3 0 3-3m0 0-3-3m3 3H9"
                            />
                        </svg>

                        Iniciar sesión
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <div class="border-t border-slate-200 bg-slate-50/70 px-6 py-3 text-center">
                <p class="text-xs text-slate-500">
                    Sistema de gestión y trazabilidad de oxígeno medicinal
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
