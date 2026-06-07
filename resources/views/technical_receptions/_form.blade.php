@php
    $isEdit = ($method ?? 'POST') === 'PUT';
    $input = 'w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm';
    $label = 'block text-xs font-semibold text-gray-600 uppercase mb-1';
@endphp

<form method="POST" action="{{ $action }}" class="space-y-5">
    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
            <div class="font-semibold mb-1">Revisa los campos del formulario.</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-base font-semibold text-gray-900">
                Datos generales de la recepción
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                El número de orden corresponde a <strong>batches.document_number</strong>.
            </p>
        </div>

        <div class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="{{ $label }}">Número de orden</label>
                <input type="text" name="document_number"
                    value="{{ old('document_number', $technicalReception->document_number ?? $documentNumber) }}"
                    class="{{ $input }}" {{ $isEdit ? 'readonly' : '' }} required>
            </div>

            <div>
                <label class="{{ $label }}">Fecha de recepción</label>
                <input type="date" name="reception_date"
                    value="{{ old('reception_date', optional($technicalReception->reception_date)->format('Y-m-d')) }}"
                    class="{{ $input }}">
            </div>

            <div>
                <label class="{{ $label }}">Factura / comprobante</label>
                <input type="text" name="invoice_number"
                    value="{{ old('invoice_number', $technicalReception->invoice_number) }}"
                    class="{{ $input }}">
            </div>

            <div>
                <label class="{{ $label }}">Guía de remisión</label>
                <input type="text" name="remission_guide_number"
                    value="{{ old('remission_guide_number', $technicalReception->remission_guide_number) }}"
                    class="{{ $input }}">
            </div>

            <div class="md:col-span-2">
                <label class="{{ $label }}">Proveedor</label>
                <input type="text" name="supplier_name"
                    value="{{ old('supplier_name', $technicalReception->supplier_name) }}"
                    class="{{ $input }}">
            </div>

            <div class="md:col-span-2">
                <label class="{{ $label }}">Fabricante / importador</label>
                <input type="text" name="manufacturer_name"
                    value="{{ old('manufacturer_name', $technicalReception->manufacturer_name) }}"
                    class="{{ $input }}">
            </div>

            <div>
                <label class="{{ $label }}">Entregado por</label>
                <input type="text" name="delivered_by"
                    value="{{ old('delivered_by', $technicalReception->delivered_by) }}" class="{{ $input }}">
            </div>

            <div>
                <label class="{{ $label }}">Recibido por</label>
                <input type="text" name="received_by"
                    value="{{ old('received_by', $technicalReception->received_by) }}" class="{{ $input }}">
            </div>

            <div>
                <label class="{{ $label }}">Cantidad recibida</label>
                <input type="number" min="0" name="quantity_received"
                    value="{{ old('quantity_received', $technicalReception->quantity_received ?? 0) }}"
                    class="{{ $input }}">
            </div>

            <div>
                <label class="{{ $label }}">Resultado final</label>
                <select name="final_result" class="{{ $input }}" required>
                    <option value="pendiente" @selected(old('final_result', $technicalReception->final_result) === 'pendiente')>
                        Pendiente
                    </option>
                    <option value="aprobado" @selected(old('final_result', $technicalReception->final_result) === 'aprobado')>
                        Aprobado
                    </option>
                    <option value="rechazado" @selected(old('final_result', $technicalReception->final_result) === 'rechazado')>
                        Rechazado
                    </option>
                </select>
            </div>


            <div class="md:col-span-4">
                <label class="{{ $label }}">Condiciones de almacenamiento</label>
                <textarea name="storage_conditions" rows="3" class="{{ $input }}">{{ old('storage_conditions', $technicalReception->storage_conditions) }}</textarea>
            </div>
        </div>
    </div>

    @include('technical_receptions._document_summary', [
        'batches' => $batches,
        'summary' => $summary,
        'technicalReception' => $technicalReception,
        'documentNumber' => $documentNumber ?? null,
    ])

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-base font-semibold text-gray-900">
                Checklist de recepción
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Marca Sí o No según la verificación realizada. Puedes dejar observaciones por cada punto.
            </p>
        </div>

        <div class="p-5 space-y-6">
            @php
                $groupedItems = collect(old('items', $items->toArray() ?? []))->groupBy('section');
                $index = 0;
            @endphp

            @foreach ($groupedItems as $section => $sectionItems)
                <div class="border border-gray-100 rounded-lg overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-100">
                        <h4 class="font-semibold text-gray-800">
                            {{ $section }}
                        </h4>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-white text-xs uppercase text-gray-500 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-left w-[45%]">Criterio</th>
                                    <th class="px-4 py-3 text-center w-[10%]">Sí</th>
                                    <th class="px-4 py-3 text-center w-[10%]">No</th>
                                    <th class="px-4 py-3 text-left">Observación</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($sectionItems as $item)
                                    @php
                                        $itemArray = is_array($item) ? $item : (array) $item;
                                        $complies = old("items.$index.complies", $itemArray['complies'] ?? null);
                                    @endphp

                                    <tr>
                                        <td class="px-4 py-3 align-top text-gray-800">
                                            {{ $itemArray['label'] ?? '' }}

                                            <input type="hidden" name="items[{{ $index }}][section]"
                                                value="{{ $section }}">
                                            <input type="hidden" name="items[{{ $index }}][label]"
                                                value="{{ $itemArray['label'] ?? '' }}">
                                            <input type="hidden" name="items[{{ $index }}][sort_order]"
                                                value="{{ $itemArray['sort_order'] ?? $index + 1 }}">
                                        </td>

                                        <td class="px-4 py-3 text-center align-top">
                                            <input type="radio" name="items[{{ $index }}][complies]"
                                                value="1" @checked((string) $complies === '1')
                                                class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                        </td>

                                        <td class="px-4 py-3 text-center align-top">
                                            <input type="radio" name="items[{{ $index }}][complies]"
                                                value="0" @checked((string) $complies === '0')
                                                class="text-red-600 border-gray-300 focus:ring-red-500">
                                        </td>

                                        <td class="px-4 py-3 align-top">
                                            <input type="text" name="items[{{ $index }}][observation]"
                                                value="{{ old("items.$index.observation", $itemArray['observation'] ?? '') }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                                placeholder="Observación">
                                        </td>
                                    </tr>

                                    @php $index++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-base font-semibold text-gray-900">
                Responsable técnico
            </h3>
        </div>

        <div class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label class="{{ $label }}">Nombre del responsable</label>
                <input type="text" name="responsible_name"
                    value="{{ old('responsible_name', $technicalReception->responsible_name) }}"
                    class="{{ $input }}">
            </div>

            <div class="md:col-span-2">
                <label class="{{ $label }}">Cargo</label>
                <input type="text" name="responsible_position"
                    value="{{ old('responsible_position', $technicalReception->responsible_position) }}"
                    class="{{ $input }}">
            </div>

            <div class="md:col-span-4">
                <label class="{{ $label }}">Observación / informe final</label>
                <textarea name="responsible_observation" rows="3" class="{{ $input }}">{{ old('responsible_observation', $technicalReception->responsible_observation) }}</textarea>
            </div>

            <div class="md:col-span-4 flex items-center justify-end gap-2 pt-2">
                <a href="{{ route('technical-receptions.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                    Cancelar
                </a>

                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    Guardar ficha
                </button>
            </div>
        </div>
    </div>
</form>
