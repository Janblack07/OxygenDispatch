{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('OxygenDispatch - Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- KPIs --}}

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    {{-- Disponibles --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex items-center gap-4">
            <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                {{-- Icono: Inventory --}}
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

    {{-- Despachados --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex items-center gap-4">
            <div class="h-12 w-12 rounded-xl bg-sky-100 flex items-center justify-center">
                {{-- Icono: Truck --}}
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
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex items-center gap-4">
            <div class="h-12 w-12 rounded-xl bg-rose-100 flex items-center justify-center">
                {{-- Icono: Warning --}}
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

</div>

            {{-- Accesos rápidos --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Accesos rápidos</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <a href="{{ route('batches.index') }}"
                           class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">📦 Lotes</div>
                            <div class="text-sm text-gray-500">Crear y generar tanques</div>
                        </a>

                        <a href="{{ route('tanks.index') }}"
                           class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">🧯 Tanques</div>
                            <div class="text-sm text-gray-500">Ver stock y acciones</div>
                        </a>

                        <a href="{{ route('dispatches.index') }}"
                           class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">🚚 Despachos</div>
                            <div class="text-sm text-gray-500">Crear y consultar despachos</div>
                        </a>

                        <a href="{{ route('clients.index') }}"
                           class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">👤 Clientes</div>
                            <div class="text-sm text-gray-500">Gestionar clientes</div>
                        </a>

                        <a href="{{ route('inventory.movements') }}"
                           class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="font-semibold">📑 Movimientos</div>
                            <div class="text-sm text-gray-500">Historial/Kardex</div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
