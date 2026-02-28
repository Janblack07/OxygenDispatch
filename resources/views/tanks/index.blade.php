<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Tanques') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Filtra por lote, estado, gas, capacidad, área y estado técnico.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Filtros --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="GET" action="{{ route('tanks.index') }}"
                          class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">

                        <div class="md:col-span-3">
                            <label class="form-label-sm">Serial</label>
                            <input name="serial" value="{{ request('serial') }}"
                                   class="form-input-sm" placeholder="OXI-000001">
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label-sm">Lote (ID)</label>
                            <input name="batch_id" value="{{ request('batch_id') }}"
                                   class="form-input-sm" placeholder="Ej: 5">
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label-sm">Gas</label>
                            <select name="gas_type_id" class="form-select-sm">
                                <option value="">Todos</option>
                                @foreach($gasTypes as $g)
                                    <option value="{{ $g->id }}" @selected(request('gas_type_id') == $g->id)>{{ $g->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label-sm">Capacidad</label>
                            <select name="capacity_id" class="form-select-sm">
                                <option value="">Todas</option>
                                @foreach($capacities as $c)
                                    <option value="{{ $c->id }}" @selected(request('capacity_id') == $c->id)>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="form-label-sm">Área</label>
                            <select name="warehouse_area_id" class="form-select-sm">
                                <option value="">Todas</option>
                                @foreach($areas as $a)
                                    <option value="{{ $a->id }}" @selected(request('warehouse_area_id') == $a->id)>{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="form-label-sm">Estado técnico</label>
                            <select name="technical_status_id" class="form-select-sm">
                                <option value="">Todos</option>
                                @foreach($techStatuses as $t)
                                    <option value="{{ $t->id }}" @selected(request('technical_status_id') == $t->id)>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label-sm">Estado</label>
                            <select name="status" class="form-select-sm">
                                <option value="">Todos</option>
                                {{-- Si tu status es enum/byte, aquí van los valores --}}
                                <option value="1" @selected(request('status')==='1')>Disponible</option>
                                <option value="2" @selected(request('status')==='2')>Despachado</option>
                                <option value="3" @selected(request('status')==='3')>Baja</option>
                            </select>
                            <p class="mt-1 text-[11px] text-gray-400">Ajusta labels/valores a tu enum real.</p>
                        </div>

                        <div class="md:col-span-1">
                            <button type="submit"
                                    class="inline-flex w-full justify-center items-center px-3 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Filtrar
                            </button>
                        </div>

                        <div class="md:col-span-12 flex justify-end">
                            <a href="{{ route('tanks.index') }}"
                               class="text-xs text-gray-500 hover:text-gray-800 hover:underline">
                                Limpiar filtros
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Listado --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Listado</h3>
                            <p class="text-xs text-gray-500">
                                Total: <span class="font-medium text-gray-700">{{ $tanks->total() }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-3 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs text-gray-500 border-b">
                                <tr>
                                    <th class="py-2 pr-4">Serial</th>
                                    <th class="py-2 pr-4">Lote</th>
                                    <th class="py-2 pr-4">Gas</th>
                                    <th class="py-2 pr-4">Capacidad</th>
                                    <th class="py-2 pr-4">Área</th>
                                    <th class="py-2 pr-4">Estado técnico</th>
                                    <th class="py-2 pr-4">Estado</th>
                                    <th class="py-2 pr-2 text-right">Acción</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @forelse($tanks as $tank)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 pr-4 font-semibold text-gray-900">{{ $tank->serial }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->batch_id }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->gasType?->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->capacity?->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->warehouseArea?->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->technicalStatus?->name }}</td>

                                        <td class="py-3 pr-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] bg-gray-100 text-gray-700">
                                                {{ $tank->status?->label() ?? $tank->status }}
                                            </span>
                                        </td>

                                        <td class="py-3 pr-2 text-right">
                                            <a href="{{ route('tanks.show', $tank) }}"
                                               class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold rounded-md bg-indigo-50 text-indigo-700 hover:bg-indigo-100">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-10 text-center text-gray-500">
                                            No hay tanques con esos filtros.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $tanks->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
