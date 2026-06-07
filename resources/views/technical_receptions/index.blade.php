<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Recepción técnica
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Notas de entrega registradas en el sistema, listas para completar checklist.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-5 border-b border-gray-100">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">
                                Buscar nota de entrega
                            </label>
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Orden, proveedor, factura o lote"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">
                                Estado de ficha
                            </label>
                            <select name="final_result"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Todas</option>
                                <option value="sin_ficha" @selected(request('final_result') === 'sin_ficha')>Sin ficha</option>
                                <option value="pendiente" @selected(request('final_result') === 'pendiente')>Pendiente</option>
                                <option value="aprobado" @selected(request('final_result') === 'aprobado')>Aprobado</option>
                                <option value="rechazado" @selected(request('final_result') === 'rechazado')>Rechazado</option>
                            </select>
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Filtrar
                            </button>

                            <a href="{{ route('technical-receptions.index') }}"
                                class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b">
                            <tr>
                                <th class="px-5 py-3 text-left">Nota / Orden</th>
                                <th class="px-5 py-3 text-left">Proveedor</th>
                                <th class="px-5 py-3 text-left">Factura</th>
                                <th class="px-5 py-3 text-left">Recepción</th>
                                <th class="px-5 py-3 text-center">Lotes</th>
                                <th class="px-5 py-3 text-center">Cantidad</th>
                                <th class="px-5 py-3 text-center">Estado</th>
                                <th class="px-5 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($documents as $document)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-gray-900">
                                            {{ $document->document_number }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Documento del lote
                                        </div>
                                    </td>

                                    <td class="px-5 py-4 text-gray-700">
                                        {{ $document->supplier_name ?: '—' }}
                                    </td>

                                    <td class="px-5 py-4 text-gray-700">
                                        {{ $document->voucher_number ?: '—' }}
                                    </td>

                                    <td class="px-5 py-4 text-gray-700">
                                        {{ $document->received_at ? \Carbon\Carbon::parse($document->received_at)->format('Y-m-d') : '—' }}
                                    </td>

                                    <td class="px-5 py-4 text-center font-semibold text-gray-800">
                                        {{ $document->batches_count }}
                                    </td>

                                    <td class="px-5 py-4 text-center font-semibold text-gray-800">
                                        {{ $document->quantity_received }}
                                    </td>

                                    <td class="px-5 py-4 text-center">
                                        @if ($document->technical_reception_id)
                                            @php
                                                $badge = match ($document->final_result) {
                                                    'aprobado' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                    'rechazado' => 'bg-red-50 text-red-700 border-red-200',
                                                    default => 'bg-amber-50 text-amber-700 border-amber-200',
                                                };
                                            @endphp

                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $badge }}">
                                                {{ ucfirst($document->final_result ?? 'pendiente') }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-200">
                                                Sin ficha
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4">
                                        <div class="flex justify-end gap-2 whitespace-nowrap">
                                            @if ($document->technical_reception_id)
                                                <a href="{{ route('technical-receptions.show', $document->technical_reception_id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                                    Ver
                                                </a>

                                                <a href="{{ route('technical-receptions.edit', $document->technical_reception_id) }}"
                                                    class="text-gray-600 hover:text-gray-900 font-semibold">
                                                    Checklist
                                                </a>

                                                <a href="{{ route('technical-receptions.pdf', $document->technical_reception_id) }}"
                                                    target="_blank"
                                                    class="text-red-600 hover:text-red-900 font-semibold">
                                                    PDF
                                                </a>
                                                @php
                                                    $signedPath = \App\Models\TechnicalReception::find(
                                                        $document->technical_reception_id,
                                                    )?->signed_pdf_path;
                                                @endphp

                                                @if ($signedPath)
                                                    <a href="{{ asset('storage/' . $signedPath) }}" target="_blank"
                                                        class="text-emerald-600 hover:text-emerald-900 font-semibold">
                                                        Firmado
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('technical-receptions.create', ['document_number' => $document->document_number]) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                                                    Crear checklist
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-5 py-10 text-center text-gray-500">
                                        No existen notas de entrega registradas en lotes.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($documents->hasPages())
                    <div class="p-5 border-t border-gray-100">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
