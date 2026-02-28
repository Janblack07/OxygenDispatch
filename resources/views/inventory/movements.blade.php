<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Movimientos de inventario') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Entradas, traslados, salidas y cambios de estado técnico.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Filtros --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="GET" action="{{ route('inventory.movements') }}"
                          class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">

                        <div class="md:col-span-3">
                            <label class="form-label-sm">Tipo</label>
                            <select name="type" class="form-select-sm">
                                <option value="">— Todos —</option>
                                <option value="1" @selected(request('type')=='1')>Entrada</option>
                                <option value="2" @selected(request('type')=='2')>Traslado</option>
                                <option value="3" @selected(request('type')=='3')>Salida</option>
                                <option value="4" @selected(request('type')=='4')>Cambio estado técnico</option>
                            </select>
                        </div>

                        <div class="md:col-span-4">
                            <label class="form-label-sm">Área (origen/destino)</label>
                            <select name="area_id" class="form-select-sm">
                                <option value="">— Todas —</option>
                                @foreach($areas as $a)
                                    <option value="{{ $a->id }}" @selected((string)$a->id===request('area_id'))>
                                        {{ $a->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="form-label-sm">Serial tanque</label>
                            <input name="serial" value="{{ request('serial') }}"
                                   class="form-input-sm" placeholder="OXI-000001">
                        </div>

                        <div class="md:col-span-2 flex gap-2">
                            <button class="w-full inline-flex justify-center items-center px-3 py-2 bg-indigo-600 text-white rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-indigo-500">
                                Filtrar
                            </button>
                            <a href="{{ route('inventory.movements') }}"
                               class="w-full inline-flex justify-center items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-gray-200">
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left">Fecha</th>
                                    <th class="px-3 py-2 text-left">Tipo</th>
                                    <th class="px-3 py-2 text-left">Tanque</th>
                                    <th class="px-3 py-2 text-left">Desde</th>
                                    <th class="px-3 py-2 text-left">Hacia</th>
                                    <th class="px-3 py-2 text-left">Lote</th>
                                    <th class="px-3 py-2 text-left">Documento</th>
                                    <th class="px-3 py-2 text-left">Usuario</th>
                                    <th class="px-3 py-2 text-left">Notas</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($movements as $m)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 text-gray-600">{{ optional($m->occurred_at)->format('Y-m-d H:i') }}</td>
                                        <td class="px-3 py-2">
                                            <span class="inline-flex px-2 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-semibold">
                                                {{ $m->type->label() }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 font-medium text-gray-800">{{ $m->tankUnit?->serial ?? $m->tank_unit_id }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $m->fromArea?->name ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $m->toArea?->name ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $m->batch?->code ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $m->reference_document ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $m->performed_by_user_email }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $m->notes ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-3 py-6 text-center text-gray-500">
                                            No hay movimientos para los filtros aplicados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $movements->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
