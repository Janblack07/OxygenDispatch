{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Distribuidora de Oxigeno - Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Estado actual --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Estado actual de tanques</h3>
                        <span class="text-sm text-gray-500">Resumen operativo</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- Disponibles --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m4-6h.01M12 7h.01M16 7h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Disponibles</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['disponible'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Despachados actuales --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-sky-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 17a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 17V6a1 1 0 011-1h11a1 1 0 011 1v11M14 7h4l3 4v6h-2"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M14 17H9"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Despachados</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['despachado'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Baja --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-rose-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-rose-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 9v4m0 4h.01"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Baja</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['baja'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Cuarentena --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-amber-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4m0 4h.01"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Cuarentena</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['tanques_cuarentena'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Pendientes técnicos --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-violet-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-violet-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9.75 17L15 12l-5.25-5"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Pend. técnicos</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['tanques_pendientes_tecnicos'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Rechazados / retiro --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-red-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Rechazados / retiro</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['tanques_rechazados'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Operación --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Operación y trazabilidad</h3>
                        <span class="text-sm text-gray-500">Indicadores generales</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- Despachos realizados --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10m-11 8h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Despachos realizados</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['despachos_realizados'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Tanques despachados total --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-cyan-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Tanques despachados total</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['tanques_despachados_total'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Despachos hoy --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-lime-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-lime-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Despachos hoy</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['despachos_hoy'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Tanques hoy --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-indigo-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 7h18M5 7l1 12h12l1-12M10 11v4m4-4v4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Tanques despachados hoy</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['tanques_despachados_hoy'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Clientes --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-fuchsia-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5V4H2v16h5m10 0v-5a3 3 0 00-3-3H10a3 3 0 00-3 3v5m10 0H7m8-12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Clientes atendidos</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['clientes_atendidos'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Movimientos --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-slate-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-slate-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 3h6v4H9V3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Movimientos total</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['movimientos_total'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Lotes --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-orange-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Lotes registrados</div>
                                    <div class="text-3xl font-bold text-gray-900">{{ $counts['lotes_registrados'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Accesos rápidos --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Accesos rápidos</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <a href="{{ route('batches.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">📦 Lotes</div>
                            <div class="text-sm text-gray-500">Crear y generar tanques</div>
                        </a>

                        <a href="{{ route('tanks.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">🧯 Tanques</div>
                            <div class="text-sm text-gray-500">Ver stock y acciones</div>
                        </a>

                        <a href="{{ route('dispatches.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">🚚 Despachos</div>
                            <div class="text-sm text-gray-500">Crear y consultar despachos</div>
                        </a>

                        <a href="{{ route('clients.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">👤 Clientes</div>
                            <div class="text-sm text-gray-500">Gestionar clientes</div>
                        </a>

                        <a href="{{ route('inventory.movements') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">📑 Movimientos</div>
                            <div class="text-sm text-gray-500">Historial / Kardex</div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
