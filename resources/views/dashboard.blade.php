{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Distribuidora de Oxigeno - Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6 space-y-4">

            {{-- KPIs: Estado actual --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-base font-semibold text-gray-900">Estado actual de tanques</h3>
                        <span class="text-xs text-gray-500">Resumen operativo</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-3">

                        {{-- Disponibles --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m4-6h.01M12 7h.01M16 7h.01"/>
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">Disponibles</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['disponible'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Actualmente despachados --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-sky-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none"
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
                                    <div class="text-xs text-gray-500">Despachados</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['despachado'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Baja --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-rose-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-rose-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 9v4m0 4h.01"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">Baja</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['baja'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Cuarentena --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-amber-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4m0 4h.01"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">Cuarentena</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['tanques_cuarentena'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Pendientes técnicos --}}
                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-violet-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-violet-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9.75 17L15 12l-5.25-5"/>
                                    </svg>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">Pend. técnicos</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['tanques_pendientes_tecnicos'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- KPIs: Operación --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-base font-semibold text-gray-900">Operación y trazabilidad</h3>
                        <span class="text-xs text-gray-500">Histórico y diario</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-3">

                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10m-11 8h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Despachos</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['despachos_realizados'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-cyan-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Tanques total</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['tanques_despachados_total'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-lime-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-lime-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Despachos hoy</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['despachos_hoy'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Tanques hoy</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['tanques_despachados_hoy'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border overflow-hidden shadow-sm sm:rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-fuchsia-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5V4H2v16h5m10 0v-5a3 3 0 00-3-3H10a3 3 0 00-3 3v5m10 0H7m8-12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Clientes</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $counts['clientes_atendidos'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
