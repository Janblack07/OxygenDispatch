<x-app-layout>
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
               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('dispatches.store') }}" class="space-y-4">
                @csrf

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                            <div class="md:col-span-4">
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

                            <div class="md:col-span-4">
                                <label class="form-label-sm">Fecha despacho *</label>
                                <input type="datetime-local" name="dispatched_at"
                                       value="{{ old('dispatched_at', now()->format('Y-m-d\TH:i')) }}"
                                       class="form-input-sm" required>
                            </div>

                            <div class="md:col-span-4">
                                <label class="form-label-sm">Nro Documento</label>
                                <input name="document_number" value="{{ old('document_number') }}" class="form-input-sm">
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
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-800">Tanques disponibles</h3>
                                <p class="text-xs text-gray-500">Marca los tanques a despachar (máx. 200 cargados).</p>
                            </div>

                            <div class="text-xs text-gray-500">
                                Total: {{ $tanks->count() }}
                            </div>
                        </div>

                        <div class="mt-3 overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2 text-left">Sel.</th>
                                        <th class="px-3 py-2 text-left">Serial</th>
                                        <th class="px-3 py-2 text-left">Gas</th>
                                        <th class="px-3 py-2 text-left">Capacidad</th>
                                        <th class="px-3 py-2 text-left">Área</th>
                                        <th class="px-3 py-2 text-left">Estado técnico</th>
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
                                            <td class="px-3 py-2 font-medium text-gray-800">
                                                {{ $t->serial }}
                                            </td>
                                            <td class="px-3 py-2 text-gray-600">{{ $t->gasType?->name ?? '—' }}</td>
                                            <td class="px-3 py-2 text-gray-600">{{ $t->capacity?->name ?? '—' }}</td>
                                            <td class="px-3 py-2 text-gray-600">{{ $t->warehouseArea?->name ?? '—' }}</td>
                                            <td class="px-3 py-2 text-gray-600">{{ $t->technicalStatus?->name ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-3 py-6 text-center text-gray-500">
                                                No hay tanques disponibles.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end gap-2 pt-4">
                            <a href="{{ route('dispatches.index') }}"
                               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-indigo-500">
                                Crear despacho
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
