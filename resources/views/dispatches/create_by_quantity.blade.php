<x-app-layout>
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
               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="POST" action="{{ route('dispatches.store-by-quantity') }}" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">

                            <div class="md:col-span-6">
                                <label class="form-label-sm">Cliente</label>
                                <select name="client_id" class="form-select-sm">
                                    <option value="">— Sin cliente —</option>
                                    @foreach($clients as $c)
                                        <option value="{{ $c->id }}" @selected(old('client_id')==$c->id)>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-6">
                                <label class="form-label-sm">Fecha despacho *</label>
                                <input type="datetime-local" name="dispatched_at"
                                       value="{{ old('dispatched_at', now()->format('Y-m-d\TH:i')) }}"
                                       class="form-input-sm" required>
                            </div>

                            <div class="md:col-span-6">
                                <label class="form-label-sm">Nro Documento</label>
                                <input name="document_number" value="{{ old('document_number') }}" class="form-input-sm">
                            </div>

                            <div class="md:col-span-6">
                                <label class="form-label-sm">Cantidad *</label>
                                <input type="number" min="1" max="5000" name="quantity"
                                       value="{{ old('quantity', 1) }}" class="form-input-sm" required>
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Gas</label>
                                <select name="gas_type_id" class="form-select-sm">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($gasTypes as $g)
                                        <option value="{{ $g->id }}" @selected(old('gas_type_id')==$g->id)>
                                            {{ $g->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Capacidad</label>
                                <select name="capacity_id" class="form-select-sm">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($capacities as $cap)
                                        <option value="{{ $cap->id }}" @selected(old('capacity_id')==$cap->id)>
                                            {{ $cap->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Área</label>
                                <select name="warehouse_area_id" class="form-select-sm">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($areas as $a)
                                        <option value="{{ $a->id }}" @selected(old('warehouse_area_id')==$a->id)>
                                            {{ $a->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Estado técnico</label>
                                <select name="technical_status_id" class="form-select-sm">
                                    <option value="">— Cualquiera —</option>
                                    @foreach($techStatuses as $t)
                                        <option value="{{ $t->id }}" @selected(old('technical_status_id')==$t->id)>
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Tipo entidad</label>
                                <select name="entity_type" class="form-select-sm">
                                    <option value="">—</option>
                                    <option value="1" @selected(old('entity_type')=='1')>1</option>
                                    <option value="2" @selected(old('entity_type')=='2')>2</option>
                                </select>
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Placa remisión</label>
                                <input name="remission_plate" value="{{ old('remission_plate') }}" class="form-input-sm">
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Tipo comprobante</label>
                                <input name="voucher_type" value="{{ old('voucher_type') }}" class="form-input-sm">
                            </div>

                            <div class="md:col-span-3">
                                <label class="form-label-sm">Nro comprobante</label>
                                <input name="voucher_number" value="{{ old('voucher_number') }}" class="form-input-sm">
                            </div>

                            <div class="md:col-span-6">
                                <label class="form-label-sm">Nro remisión</label>
                                <input name="remission_number" value="{{ old('remission_number') }}" class="form-input-sm">
                            </div>

                            <div class="md:col-span-12">
                                <label class="form-label-sm">Notas</label>
                                <textarea name="notes" rows="2" class="form-input-sm">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <a href="{{ route('dispatches.index') }}"
                               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-indigo-500">
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
