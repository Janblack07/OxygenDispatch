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
                    {{ __('Nuevo despacho (por cantidad)') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Indica la cantidad y filtros para escoger automáticamente tanques disponibles.
                </p>
            </div>

            <a href="{{ route('dispatches.index') }}"
               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="POST" action="{{ route('dispatches.store-by-quantity') }}" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">

                            {{-- Cliente --}}
                            <div class="md:col-span-6">
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

                            {{-- Fecha despacho --}}
                            <div class="md:col-span-6">
                                <label class="{{ $labelSm }}">Fecha despacho <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="dispatched_at"
                                       value="{{ old('dispatched_at', now()->format('Y-m-d\TH:i')) }}"
                                       class="{{ $inputSm }}" required>
                            </div>

                            {{-- Nro Documento --}}
                            <div class="md:col-span-6">
                                <label class="{{ $labelSm }}">Nro Documento</label>
                                <input name="document_number" value="{{ old('document_number') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: DOC-123">
                            </div>

                            {{-- Cantidad --}}
                            <div class="md:col-span-6">
                                <label class="{{ $labelSm }}">Cantidad <span class="text-red-500">*</span></label>
                                <input type="number" min="1" max="5000" name="quantity"
                                       value="{{ old('quantity', 1) }}"
                                       class="{{ $inputSm }}" required>
                            </div>

                            {{-- Gas --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Gas</label>
                                <select name="gas_type_id" class="{{ $selectSm }}">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($gasTypes as $g)
                                        <option value="{{ $g->id }}" @selected(old('gas_type_id')==$g->id)>
                                            {{ $g->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Capacidad --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Capacidad</label>
                                <select name="capacity_id" class="{{ $selectSm }}">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($capacities as $cap)
                                        <option value="{{ $cap->id }}" @selected(old('capacity_id')==$cap->id)>
                                            {{ $cap->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Área --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Área</label>
                                <select name="warehouse_area_id" class="{{ $selectSm }}">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($areas as $a)
                                        <option value="{{ $a->id }}" @selected(old('warehouse_area_id')==$a->id)>
                                            {{ $a->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Estado técnico --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Estado técnico</label>
                                <select name="technical_status_id" class="{{ $selectSm }}">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($techStatuses as $t)
                                        <option value="{{ $t->id }}" @selected(old('technical_status_id')==$t->id)>
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tipo entidad --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Tipo entidad</label>
                                <select name="entity_type" class="{{ $selectSm }}">
                                    <option value="">—</option>
                                    <option value="1" @selected(old('entity_type')=='1')>1</option>
                                    <option value="2" @selected(old('entity_type')=='2')>2</option>
                                </select>
                            </div>

                            {{-- Placa remisión --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Placa remisión</label>
                                <input name="remission_plate" value="{{ old('remission_plate') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: GAA-1234">
                            </div>

                            {{-- Tipo comprobante --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Tipo comprobante</label>
                                <input name="voucher_type" value="{{ old('voucher_type') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: Factura / Nota / Guía">
                            </div>

                            {{-- Nro comprobante --}}
                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}">Nro comprobante</label>
                                <input name="voucher_number" value="{{ old('voucher_number') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: 001-001-000000123">
                            </div>

                            {{-- Nro remisión --}}
                            <div class="md:col-span-6">
                                <label class="{{ $labelSm }}">Nro remisión</label>
                                <input name="remission_number" value="{{ old('remission_number') }}"
                                       class="{{ $inputSm }}" placeholder="Ej: REM-0001">
                            </div>

                            {{-- Notas --}}
                            <div class="md:col-span-12">
                                <label class="{{ $labelSm }}">Notas</label>
                                <textarea name="notes" rows="2" class="{{ $inputSm }}"
                                          placeholder="Notas del despacho (opcional)">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <a href="{{ route('dispatches.index') }}"
                               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Crear despacho
                            </button>
                        </div>

                        <p class="text-xs text-gray-500">
                            Nota: el sistema tomará tanques disponibles (status=1) según filtros.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
