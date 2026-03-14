<x-app-layout>
    @php
        $inputSm = 'mt-1 block w-full rounded-md border-gray-300 text-sm py-1.5 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500';
        $selectSm = $inputSm;
        $labelSm = 'block text-[11px] font-medium text-gray-600';
    @endphp

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
                            <label class="{{ $labelSm }}">Serial</label>
                            <input name="serial" value="{{ request('serial') }}"
                                   class="{{ $inputSm }}" placeholder="OXI-000001">
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Lote</label>
                            <input name="batch_number" value="{{ request('batch_number') }}"
                                class="{{ $inputSm }}" placeholder="Ej: LOTE-001">
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Gas</label>
                            <select name="gas_type_id" class="{{ $selectSm }}">
                                <option value="">Todos</option>
                                @foreach($gasTypes as $g)
                                    <option value="{{ $g->id }}" @selected(request('gas_type_id') == $g->id)>{{ $g->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Capacidad</label>
                            <select name="capacity_id" class="{{ $selectSm }}">
                                <option value="">Todas</option>
                                @foreach($capacities as $c)
                                    <option value="{{ $c->id }}" @selected(request('capacity_id') == $c->id)>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="{{ $labelSm }}">Área</label>
                            <select name="warehouse_area_id" class="{{ $selectSm }}">
                                <option value="">Todas</option>
                                @foreach($areas as $a)
                                    <option value="{{ $a->id }}" @selected(request('warehouse_area_id') == $a->id)>{{ $a->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="{{ $labelSm }}">Estado técnico</label>
                            <select name="technical_status_id" class="{{ $selectSm }}">
                                <option value="">Todos</option>
                                @foreach($techStatuses as $t)
                                    <option value="{{ $t->id }}" @selected(request('technical_status_id') == $t->id)>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Estado</label>
                            <select name="status" class="{{ $selectSm }}">
                                <option value="">Todos</option>
                                {{-- Si tu status es enum/byte, aquí van los valores --}}
                                <option value="1" @selected(request('status') === '1')>Disponible</option>
                                <option value="2" @selected(request('status') === '2')>Despachado</option>
                                <option value="3" @selected(request('status') === '3')>Baja</option>
                            </select>
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
                                    <th class="py-2 pr-4">Lote</th>
                                    <th class="py-2 pr-4">Serial</th>
                                    <th class="py-2 pr-4">Gas</th>
                                    <th class="py-2 pr-4">Capacidad</th>
                                    <th class="py-2 pr-4">Registro sanitario</th>
                                    <th class="py-2 pr-4">Área</th>
                                    <th class="py-2 pr-4">Estado técnico</th>
                                    <th class="py-2 pr-4">Estado</th>

                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @forelse($tanks as $tank)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->batch?->batch_number ?? '—' }}</td>
                                        <td class="py-3 pr-4 font-semibold text-gray-900">{{ $tank->serial }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->gasType?->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->capacity?->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->sanitary_registry ?? $tank->product?->sanitary_registry ?? '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->warehouseArea?->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->technicalStatus?->name }}</td>

                                        <td class="py-3 pr-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] bg-gray-100 text-gray-700">
                                                {{ $tank->status?->label() ?? $tank->status }}
                                            </span>
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
