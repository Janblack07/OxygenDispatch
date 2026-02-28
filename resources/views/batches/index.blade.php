<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Lotes') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Registra lotes y genera tanques (de diferentes productos/capacidades) desde el detalle.
                </p>
            </div>

            <a href="{{ route('batches.create') }}"
               class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="text-base leading-none">+</span>
                <span>Nuevo</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Filtros (pueden quedarse, pero recuerda que gas/capacidad en lote son referenciales) --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="GET" action="{{ route('batches.index') }}"
                          class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">

                        <div class="md:col-span-5">
                            <label class="form-label-sm">Buscar</label>
                            <input name="q" value="{{ request('q') }}"
                                   class="form-input-sm"
                                   placeholder="Lote o documento (LOT-2026-001 / DOC-123)">
                        </div>

                        <div class="md:col-span-3">
                            <label class="form-label-sm">Gas (referencial)</label>
                            <select name="gas_type_id" class="form-select-sm">
                                <option value="">Todos</option>
                                @foreach($gasTypes ?? [] as $g)
                                    <option value="{{ $g->id }}" @selected(request('gas_type_id') == $g->id)>{{ $g->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="form-label-sm">Capacidad (referencial)</label>
                            <select name="capacity_id" class="form-select-sm">
                                <option value="">Todas</option>
                                @foreach($capacities ?? [] as $c)
                                    <option value="{{ $c->id }}" @selected(request('capacity_id') == $c->id)>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-1 flex gap-2">
                            <button type="submit"
                                    class="inline-flex w-full justify-center items-center px-3 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Filtrar
                            </button>
                        </div>

                        <div class="md:col-span-12 flex justify-end">
                            <a href="{{ route('batches.index') }}"
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
                                Total: <span class="font-medium text-gray-700">{{ $batches->total() }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-3 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs text-gray-500 border-b">
                                <tr>
                                    <th class="py-2 pr-3">#</th>
                                    <th class="py-2 pr-4">Lote</th>
                                    <th class="py-2 pr-4">Gas (ref)</th>
                                    <th class="py-2 pr-4">Capacidad (ref)</th>
                                    <th class="py-2 pr-4">Tanques</th>
                                    <th class="py-2 pr-4">Recibido</th>
                                    <th class="py-2 pr-4">Creador</th>
                                    <th class="py-2 pr-2 text-right">Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @forelse($batches as $batch)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 pr-3 text-gray-500">{{ $batch->id }}</td>

                                        <td class="py-3 pr-4">
                                            <div class="font-semibold text-gray-900 leading-5">{{ $batch->batch_number }}</div>
                                            <div class="text-[11px] text-gray-500">
                                                Doc: {{ $batch->document_number ?: '—' }}
                                            </div>
                                        </td>

                                        <td class="py-3 pr-4 text-gray-700">{{ $batch->gasType?->name ?? '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $batch->capacity?->name ?? '—' }}</td>

                                        <td class="py-3 pr-4 text-gray-700">
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-700">
                                                {{ $batch->tank_units_count ?? $batch->tankUnits?->count() ?? 0 }}
                                            </span>
                                        </td>

                                        <td class="py-3 pr-4 text-gray-700">
                                            <div class="leading-5">{{ optional($batch->received_at)->format('Y-m-d') }}</div>
                                            <div class="text-[11px] text-gray-500">{{ optional($batch->received_at)->format('H:i') }}</div>
                                        </td>

                                        <td class="py-3 pr-4 text-gray-600">{{ $batch->created_by_user_email }}</td>

                                        <td class="py-3 pr-2 text-right whitespace-nowrap">
                                            <a href="{{ route('batches.show', $batch) }}"
                                               class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold rounded-md bg-indigo-50 text-indigo-700 hover:bg-indigo-100">
                                                Ver
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-10">
                                            <div class="text-center">
                                                <h4 class="text-sm font-semibold text-gray-900">Aún no hay lotes</h4>
                                                <p class="mt-1 text-xs text-gray-500">Crea tu primer lote para poder generar tanques.</p>
                                                <div class="mt-4">
                                                    <a href="{{ route('batches.create') }}"
                                                       class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                                        Crear lote
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $batches->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
