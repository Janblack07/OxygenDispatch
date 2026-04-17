<x-app-layout>
    @php
        $inputSm  = 'mt-1 block w-full rounded-md border-gray-300 text-sm py-2 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500';
        $selectSm = $inputSm;
        $labelSm  = 'block text-[11px] font-medium text-gray-600';
    @endphp

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
                            <label class="{{ $labelSm }}">Tipo</label>
                            <select name="type" class="{{ $selectSm }}">
                                <option value="">— Todos —</option>
                                <option value="1" @selected(request('type')=='1')>Entrada</option>
                                <option value="2" @selected(request('type')=='2')>Traslado</option>
                                <option value="3" @selected(request('type')=='3')>Salida</option>
                                <option value="4" @selected(request('type')=='4')>Cambio estado técnico</option>
                            </select>
                        </div>

                        <div class="md:col-span-5">
                            <label class="{{ $labelSm }}">Área (origen/destino)</label>
                            <select name="area_id" class="{{ $selectSm }}">
                                <option value="">— Todas —</option>
                                @foreach($areas as $a)
                                    <option value="{{ $a->id }}" @selected((string)$a->id===request('area_id'))>
                                        {{ $a->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="{{ $labelSm }}">Serial tanque</label>
                            <input name="serial" value="{{ request('serial') }}"
                                   class="{{ $inputSm }}" placeholder="OXI-000001">
                        </div>

                        <div class="md:col-span-1 flex gap-2">
                            <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-3 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Filtrar
                            </button>
                        </div>

                        <div class="md:col-span-12 flex justify-end">
                            <a href="{{ route('inventory.movements') }}"
                               class="text-xs text-gray-500 hover:text-gray-800 hover:underline">
                                Limpiar filtros
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Listado</h3>
                            <p class="text-xs text-gray-500">
                                Total: <span class="font-medium text-gray-700">{{ $movements->total() }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-xs text-gray-500 border-b">
                            <tr>
                                <th class="py-2 pr-4">Fecha</th>
                                <th class="py-2 pr-4">Tipo</th>
                                <th class="py-2 pr-4">Tanque</th>
                                <th class="py-2 pr-4">Lote</th>
                                <th class="py-2 pr-4">Desde</th>
                                <th class="py-2 pr-4">Hacia</th>
                                <th class="py-2 pr-4">Documento</th>
                                <th class="py-2 pr-4">Usuario</th>
                                <th class="py-2 pr-2">Notas</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($movements as $m)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 pr-4 text-gray-600 whitespace-nowrap">
                                        {{ optional($m->occurred_at)->format('Y-m-d') }}
                                        <div class="text-[11px] text-gray-500">
                                            {{ optional($m->occurred_at)->format('H:i') }}
                                        </div>
                                    </td>

                                    <td class="py-3 pr-4">
                                        @php
                                            $typeClasses = match($m->type?->value) {
                                                1 => 'bg-green-100 text-green-700',
                                                2 => 'bg-blue-100 text-blue-700',
                                                3 => 'bg-orange-100 text-orange-700',
                                                4 => 'bg-purple-100 text-purple-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp

                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-semibold whitespace-nowrap {{ $typeClasses }}">
                                            {{ $m->type?->label() ?? '—' }}
                                        </span>
                                    </td>

                                    <td class="py-3 pr-4 font-medium text-gray-800 whitespace-nowrap">
                                        {{ $m->tankUnit?->serial ?? $m->tank_unit_id }}
                                    </td>

                                    <td class="py-3 pr-4 text-gray-600 whitespace-nowrap">
                                        {{ $m->batch?->batch_number ?? '—' }}
                                    </td>

                                    <td class="py-3 pr-4 text-gray-600 whitespace-nowrap">
                                        @switch($m->type?->value)
                                            @case(1)
                                                Proveedor / Recepción
                                                @break
                                            @case(2)
                                                {{ $m->fromArea?->name ?? '—' }}
                                                @break
                                            @case(3)
                                                {{ $m->fromArea?->name ?? '—' }}
                                                @break
                                            @case(4)
                                                —
                                                @break
                                            @default
                                                {{ $m->fromArea?->name ?? '—' }}
                                        @endswitch
                                    </td>

                                    <td class="py-3 pr-4 text-gray-600 whitespace-nowrap">
                                        @switch($m->type?->value)
                                            @case(1)
                                                {{ $m->toArea?->name ?? '—' }}
                                                @break
                                            @case(2)
                                                {{ $m->toArea?->name ?? '—' }}
                                                @break
                                            @case(3)
                                                Salida
                                                @break
                                            @case(4)
                                                —
                                                @break
                                            @default
                                                {{ $m->toArea?->name ?? '—' }}
                                        @endswitch
                                    </td>

                                    <td class="py-3 pr-4 text-gray-600 whitespace-nowrap">
                                        @if(($m->type?->value) === 1)
                                            {{ $m->batch?->document_number ?? $m->reference_document ?? '—' }}
                                        @else
                                            {{ $m->reference_document ?? '—' }}
                                        @endif
                                    </td>

                                    <td class="py-3 pr-4 text-gray-600 whitespace-nowrap">
                                        {{ $m->performed_by_user_email ?? '—' }}
                                    </td>

                                    <td class="py-3 pr-2 text-gray-600">
                                        {{ $m->notes ?? '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-10 text-center text-gray-500">
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
