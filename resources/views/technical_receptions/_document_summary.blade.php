@if(($batches ?? collect())->isNotEmpty())
    <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-4">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-indigo-950">
                    Información encontrada para la orden
                </h3>
                <p class="text-xs text-indigo-700 mt-0.5">
                    Los datos provienen de los lotes registrados con el mismo número de documento.
                </p>
            </div>

            <span class="inline-flex items-center rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-indigo-700 border border-indigo-100">
                {{ $batches->count() }} lote(s)
            </span>
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-3 text-sm">
            <div>
                <div class="text-[11px] uppercase tracking-wide text-indigo-700">Orden</div>
                <div class="font-semibold text-gray-900">
                    {{ $technicalReception->document_number ?? $documentNumber ?? '—' }}
                </div>
            </div>

            <div>
                <div class="text-[11px] uppercase tracking-wide text-indigo-700">Lotes</div>
                <div class="font-semibold text-gray-900">
                    {{ $summary['batch_numbers'] ?: '—' }}
                </div>
            </div>

            <div>
                <div class="text-[11px] uppercase tracking-wide text-indigo-700">Cantidad</div>
                <div class="font-semibold text-gray-900">
                    {{ $summary['quantity_received'] ?? 0 }}
                </div>
            </div>

            <div>
                <div class="text-[11px] uppercase tracking-wide text-indigo-700">Proveedor</div>
                <div class="font-semibold text-gray-900">
                    {{ $summary['supplier_name'] ?: '—' }}
                </div>
            </div>
        </div>

        <div class="mt-4 overflow-x-auto bg-white rounded-lg border border-indigo-100">
            <table class="min-w-full text-sm">
                <thead class="text-left text-xs text-gray-500 border-b bg-gray-50">
                    <tr>
                        <th class="py-2 px-3">Producto</th>
                        <th class="py-2 px-3">Gas</th>
                        <th class="py-2 px-3">Capacidad</th>
                        <th class="py-2 px-3">Registro sanitario</th>
                        <th class="py-2 px-3 text-right">Cantidad</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($summary['products'] ?? [] as $product)
                        <tr>
                            <td class="py-2 px-3">
                                <div class="font-semibold text-gray-900">
                                    {{ $product['code'] ?: '—' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $product['detail'] ?: '—' }}
                                </div>
                            </td>

                            <td class="py-2 px-3 text-gray-700">
                                {{ $product['gas'] ?: '—' }}
                            </td>

                            <td class="py-2 px-3 text-gray-700">
                                {{ $product['capacity'] ?: '—' }}
                            </td>

                            <td class="py-2 px-3 text-gray-700">
                                {{ $product['sanitary_registry'] ?: '—' }}
                            </td>

                            <td class="py-2 px-3 text-right font-semibold text-gray-900">
                                {{ $product['quantity'] }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-3 text-center text-gray-500">
                                Aún no hay tanques/productos generados para esta orden.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 text-sm text-amber-800">
        No se encontraron lotes para este número de orden. Verifica que el documento exista en el módulo de lotes.
    </div>
@endif
