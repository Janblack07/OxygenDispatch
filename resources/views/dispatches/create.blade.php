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
                    {{ __('Nuevo despacho (selección de tanques)') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Selecciona 1 o más tanques disponibles y genera el despacho.
                </p>
            </div>

            <a href="{{ route('dispatches.index') }}"
               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('dispatches.store') }}" class="space-y-4">
                @csrf

                {{-- Datos del despacho --}}
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">

                            <div class="md:col-span-4">
                                <label class="{{ $labelSm }}">Cliente</label>
                                <select name="client_id" class="{{ $selectSm }}">
                                    <option value="">— Sin cliente —</option>
                                    @foreach($clients as $c)
                                        <option value="{{ $c->id }}" @selected(old('client_id')==$c->id)>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-4">
                                <label class="{{ $labelSm }}">Fecha despacho <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="dispatched_at"
                                       value="{{ old('dispatched_at', now()->format('Y-m-d\TH:i')) }}"
                                       class="{{ $inputSm }}" required>
                            </div>

                            <div class="md:col-span-4">
                                <label class="{{ $labelSm }}">Nro Documento</label>
                                <input name="document_number" value="{{ old('document_number') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: DOC-123">
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Tipo entidad</label>
                                <select name="entity_type" class="{{ $selectSm }}">
                                    <option value="">—</option>
                                    <option value="1" @selected(old('entity_type')=='1')>1</option>
                                    <option value="2" @selected(old('entity_type')=='2')>2</option>
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Placa remisión</label>
                                <input name="remission_plate" value="{{ old('remission_plate') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: GAA-1234">
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Tipo comprobante</label>
                                <input name="voucher_type" value="{{ old('voucher_type') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: Factura / Nota / Guía">
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Nro comprobante</label>
                                <input name="voucher_number" value="{{ old('voucher_number') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: 001-001-000000123">
                            </div>

                            <div class="md:col-span-6">
                                <label class="{{ $labelSm }}">Nro remisión</label>
                                <input name="remission_number" value="{{ old('remission_number') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: REM-0001">
                            </div>

                            <div class="md:col-span-12">
                                <label class="{{ $labelSm }}">Notas</label>
                                <textarea name="notes" rows="2" class="{{ $inputSm }}"
                                          placeholder="Notas del despacho (opcional)">{{ old('notes') }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Selección de tanques --}}
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Tanques disponibles</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Marca los tanques a despachar (máx. 200 cargados).</p>
                            </div>

                            <div class="text-xs text-gray-500">
                                Total: <span class="font-medium text-gray-700">{{ $tanks->count() }}</span>
                            </div>
                        </div>

                        <div class="mt-3 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-left text-xs text-gray-500 border-b bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2">Sel.</th>
                                        <th class="px-3 py-2">Serial</th>
                                        <th class="px-3 py-2">Gas</th>
                                        <th class="px-3 py-2">Capacidad</th>
                                        <th class="px-3 py-2">Área</th>
                                        <th class="px-3 py-2">Estado técnico</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y">
                                    @forelse($tanks as $t)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-3 py-2">
                                                <input type="checkbox" name="tank_ids[]"
                                                       value="{{ $t->id }}"
                                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                       @checked(collect(old('tank_ids', []))->contains($t->id))>
                                            </td>

                                            <td class="px-3 py-2 font-semibold text-gray-900">
                                                {{ $t->serial }}
                                            </td>

                                            <td class="px-3 py-2 text-gray-700">{{ $t->gasType?->name ?? '—' }}</td>
                                            <td class="px-3 py-2 text-gray-700">{{ $t->capacity?->name ?? '—' }}</td>
                                            <td class="px-3 py-2 text-gray-700">{{ $t->warehouseArea?->name ?? '—' }}</td>
                                            <td class="px-3 py-2 text-gray-700">{{ $t->technicalStatus?->name ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-3 py-8 text-center text-gray-500">
                                                No hay tanques disponibles.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end gap-2 pt-4">
                            <a href="{{ route('dispatches.index') }}"
                               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Crear despacho
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
