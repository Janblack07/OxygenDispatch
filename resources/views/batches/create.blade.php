<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Nuevo lote') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Crea el lote y luego genera tanques (de distintos productos/capacidades) desde el detalle.
                </p>
            </div>

            <a href="{{ route('batches.index') }}"
               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 p-3 text-sm text-red-700">
                            <div class="font-semibold">Revisa los campos:</div>
                            <ul class="list-disc ml-5 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('batches.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label-sm">Número de lote</label>
                                <input name="batch_number" value="{{ old('batch_number') }}" class="form-input-sm" required>
                                @error('batch_number') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label-sm">Fecha/hora recibido</label>
                                <input type="datetime-local" name="received_at" value="{{ old('received_at') }}" class="form-input-sm" required>
                                @error('received_at') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label-sm">Gas (opcional)</label>
                                <select name="gas_type_id" class="form-select-sm">
                                    <option value="">— No aplicar —</option>
                                    @foreach($gasTypes as $g)
                                        <option value="{{ $g->id }}" @selected(old('gas_type_id') == $g->id)>{{ $g->name }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-[11px] text-gray-500">
                                    Solo referencial. El gas real se define por el producto del tanque.
                                </p>
                                @error('gas_type_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label-sm">Capacidad (opcional)</label>
                                <select name="capacity_id" class="form-select-sm">
                                    <option value="">— No aplicar —</option>
                                    @foreach($capacities as $c)
                                        <option value="{{ $c->id }}" @selected(old('capacity_id') == $c->id)>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-[11px] text-gray-500">
                                    Solo referencial. La capacidad real se define por el producto del tanque.
                                </p>
                                @error('capacity_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label-sm">Documento</label>
                                <input name="document_number" value="{{ old('document_number') }}" class="form-input-sm">
                                @error('document_number') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label-sm">Proveedor</label>
                                <input name="supplier_name" value="{{ old('supplier_name') }}" class="form-input-sm">
                                @error('supplier_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="form-label-sm">Notas</label>
                            <textarea name="notes" rows="3" class="form-input-sm">{{ old('notes') }}</textarea>
                            @error('notes') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Guardar
                            </button>

                            <p class="text-xs text-gray-500">
                                Luego podrás generar tanques (varias capacidades) desde el detalle del lote.
                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
