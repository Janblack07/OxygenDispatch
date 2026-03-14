<x-app-layout>
    @php
        $inputSm = 'mt-1 block w-full rounded-md border-gray-300 text-sm py-1.5 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500';
        $selectSm = $inputSm;
        $labelSm = 'block text-[11px] font-medium text-gray-600';
    @endphp

    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    Detalle de lote: <span class="text-indigo-700">{{ $batch->batch_number }}</span>
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Aquí puedes generar tanques de diferentes productos/capacidades dentro del mismo lote.
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('batches.index') }}"
                   class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Info del lote --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500 text-xs">Recibido</div>
                            <div class="font-semibold">{{ optional($batch->received_at)->format('Y-m-d H:i') }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs">Documento</div>
                            <div class="font-semibold">{{ $batch->document_number ?: '—' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs">Gas (ref)</div>
                            <div class="font-semibold">{{ $batch->gasType?->name ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs">Capacidad (ref)</div>
                            <div class="font-semibold">{{ $batch->capacity?->name ?? '—' }}</div>
                        </div>
                    </div>

                    @if($batch->notes)
                        <div class="mt-4 text-sm">
                            <div class="text-gray-500 text-xs">Notas</div>
                            <div class="mt-1 text-gray-700">{{ $batch->notes }}</div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Generar tanques --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900">Generar tanques</h3>
                    <p class="mt-0.5 text-xs text-gray-500">
                        Selecciona un producto. El gas, capacidad y registro sanitario salen del producto.
                    </p>

                    <form method="POST" action="{{ route('batches.generate-tanks', $batch) }}"
                          class="mt-4 grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                        @csrf

                        <div class="md:col-span-4">
                            <label class="{{ $labelSm }}">Producto</label>
                            <select name="product_id" class="{{ $selectSm }}" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" @selected(old('product_id') == $p->id)>
                                        {{ $p->code }} — {{ $p->detail }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Cantidad</label>
                            <input type="number" name="quantity" min="1" max="5000"
                                   value="{{ old('quantity', 10) }}"
                                   class="{{ $inputSm }}" required>
                            @error('quantity') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Área</label>
                            <select name="warehouse_area_id" class="{{ $selectSm }}" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($areas as $a)
                                    <option value="{{ $a->id }}" @selected(old('warehouse_area_id') == $a->id)>{{ $a->name }}</option>
                                @endforeach
                            </select>
                            @error('warehouse_area_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Estado técnico</label>
                            <select name="technical_status_id" class="{{ $selectSm }}" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($techStatuses as $t)
                                    <option value="{{ $t->id }}" @selected(old('technical_status_id') == $t->id)>{{ $t->name }}</option>
                                @endforeach
                            </select>
                            @error('technical_status_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="{{ $labelSm }}">Prefijo serial</label>
                            <input name="serial_prefix" value="{{ old('serial_prefix', 'OXI') }}"
                                   class="{{ $inputSm }}" placeholder="OXI">
                            @error('serial_prefix') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-12 flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                Generar
                            </button>
                        </div>
                    </form>

                    <p class="mt-3 text-xs text-gray-500">
                        Nota: se registra un movimiento de <strong>Entrada</strong> por cada tanque generado.
                    </p>
                </div>
            </div>

            {{-- Tanques del lote --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Tanques del lote</h3>
                            <p class="text-xs text-gray-500">Total: {{ $batch->tankUnits->count() }}</p>
                        </div>

                        <a href="{{ route('tanks.index', ['batch_id' => $batch->id]) }}"
                           class="text-xs text-indigo-600 hover:underline">
                            Ver en módulo Tanques →
                        </a>
                    </div>

                    <div class="mt-3 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs text-gray-500 border-b">
                                <tr>
                                    <th class="py-2 pr-4">Serial</th>
                                    <th class="py-2 pr-4">Producto</th>
                                    <th class="py-2 pr-4">Capacidad</th>
                                    <th class="py-2 pr-4">Registro sanitario</th>
                                    <th class="py-2 pr-4">Área</th>
                                    <th class="py-2 pr-4">Estado técnico</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($batch->tankUnits as $tank)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 pr-4 font-medium text-gray-900">{{ $tank->serial }}</td>

                                        <td class="py-3 pr-4">
                                            <div class="font-semibold text-gray-900 leading-5">
                                                {{ $tank->product?->code ?? '—' }}
                                            </div>
                                            <div class="text-[11px] text-gray-500">
                                                {{ $tank->product?->detail ?? '—' }}
                                            </div>
                                        </td>

                                        <td class="py-3 pr-4 text-gray-700">
                                            {{ $tank->product?->capacity?->name ?? $tank->capacity?->name ?? '—' }}
                                        </td>

                                        <td class="py-3 pr-4 text-gray-700">
                                            {{ $tank->sanitary_registry ?? $tank->product?->sanitary_registry ?? '—' }}
                                        </td>

                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->warehouseArea?->name ?? '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $tank->technicalStatus?->name ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-10 text-center text-gray-500">
                                            Aún no hay tanques en este lote. Usa “Generar tanques”.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
