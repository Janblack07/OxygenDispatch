<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Ficha técnica de recepción
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Orden: {{ $technicalReception->document_number }}
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('technical-receptions.pdf', $technicalReception) }}" target="_blank"
                    class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">
                    PDF generado
                </a>

                @if ($technicalReception->signed_pdf_path)
                    <a href="{{ asset('storage/' . $technicalReception->signed_pdf_path) }}" target="_blank"
                        class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-500">
                        PDF firmado
                    </a>
                @endif

                <a href="{{ route('technical-receptions.edit', $technicalReception) }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    Editar
                </a>
                <a href="{{ route('technical-receptions.tank-reviews.index', $technicalReception) }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500">
                    Revisar tanques
                </a>

                <a href="{{ route('technical-receptions.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-5 border-b border-gray-100 flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">
                            Datos generales
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Información registrada para la recepción técnica.
                        </p>
                    </div>

                    @php
                        $badge = match ($technicalReception->final_result) {
                            'aprobado' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'rechazado' => 'bg-red-50 text-red-700 border-red-200',
                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                        };
                    @endphp

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $badge }}">
                        {{ ucfirst($technicalReception->final_result) }}
                    </span>
                </div>

                <div class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Orden</div>
                        <div class="font-semibold text-gray-900">{{ $technicalReception->document_number }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Fecha recepción</div>
                        <div class="text-gray-900">{{ $technicalReception->reception_date?->format('Y-m-d') ?: '—' }}
                        </div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Factura</div>
                        <div class="text-gray-900">{{ $technicalReception->invoice_number ?: '—' }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Guía remisión</div>
                        <div class="text-gray-900">{{ $technicalReception->remission_guide_number ?: '—' }}</div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="text-xs uppercase text-gray-500 font-semibold">Proveedor</div>
                        <div class="text-gray-900">{{ $technicalReception->supplier_name ?: '—' }}</div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="text-xs uppercase text-gray-500 font-semibold">Fabricante / importador</div>
                        <div class="text-gray-900">{{ $technicalReception->manufacturer_name ?: '—' }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Entregado por</div>
                        <div class="text-gray-900">{{ $technicalReception->delivered_by ?: '—' }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Recibido por</div>
                        <div class="text-gray-900">{{ $technicalReception->received_by ?: '—' }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Cantidad recibida</div>
                        <div class="text-gray-900">{{ $technicalReception->quantity_received }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Creado por</div>
                        <div class="text-gray-900">{{ $technicalReception->created_by_user_email ?: '—' }}</div>
                    </div>

                    <div class="md:col-span-4">
                        <div class="text-xs uppercase text-gray-500 font-semibold">Condiciones de almacenamiento</div>
                        <div class="text-gray-900 whitespace-pre-line">
                            {{ $technicalReception->storage_conditions ?: '—' }}</div>
                    </div>
                </div>
            </div>

            @include('technical_receptions._document_summary', [
                'batches' => $batches,
                'summary' => $summary,
                'technicalReception' => $technicalReception,
            ])

            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-5 border-b border-gray-100">
                    <h3 class="text-base font-semibold text-gray-900">
                        Checklist
                    </h3>
                </div>

                <div class="p-5 space-y-6">
                    @foreach ($technicalReception->items->groupBy('section') as $section => $sectionItems)
                        <div class="border border-gray-100 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-100">
                                <h4 class="font-semibold text-gray-800">{{ $section }}</h4>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-white text-xs uppercase text-gray-500 border-b">
                                        <tr>
                                            <th class="px-4 py-3 text-left">Criterio</th>
                                            <th class="px-4 py-3 text-center">Cumple</th>
                                            <th class="px-4 py-3 text-left">Observación</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-100">
                                        @foreach ($sectionItems as $item)
                                            <tr>
                                                <td class="px-4 py-3 text-gray-800">
                                                    {{ $item->label }}
                                                </td>

                                                <td class="px-4 py-3 text-center">
                                                    @if ($item->complies === true)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                            Sí
                                                        </span>
                                                    @elseif($item->complies === false)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                                            No
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-200">
                                                            —
                                                        </span>
                                                    @endif
                                                </td>

                                                <td class="px-4 py-3 text-gray-700">
                                                    {{ $item->observation ?: '—' }}
                                                </td>
                                            </tr>
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
                        PDF firmado y sellado
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Sube aquí el PDF final firmado y sellado por el responsable técnico.
                    </p>
                </div>

                <div class="p-5 space-y-4">
                    @if ($technicalReception->signed_pdf_path)
                        <div
                            class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
                            <div class="font-semibold">PDF firmado cargado correctamente.</div>
                            <div class="mt-1">
                                Subido por: {{ $technicalReception->signed_pdf_uploaded_by ?: '—' }}
                            </div>
                            <div>
                                Fecha: {{ $technicalReception->signed_pdf_uploaded_at?->format('Y-m-d H:i') ?: '—' }}
                            </div>

                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $technicalReception->signed_pdf_path) }}"
                                    target="_blank"
                                    class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-500">
                                    Ver PDF firmado
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-lg text-sm">
                            Todavía no se ha subido el PDF firmado.
                        </div>
                    @endif

                    <form method="POST"
                        action="{{ route('technical-receptions.upload-signed-pdf', $technicalReception) }}"
                        enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        @csrf

                        <div class="md:col-span-3">
                            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">
                                PDF firmado
                            </label>
                            <input type="file" name="signed_pdf" accept="application/pdf" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            <p class="text-xs text-gray-500 mt-1">
                                Formato permitido: PDF. Tamaño máximo: 10 MB.
                            </p>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Subir PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-5 border-b border-gray-100">
                    <h3 class="text-base font-semibold text-gray-900">
                        Responsable técnico
                    </h3>
                </div>

                <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Nombre</div>
                        <div class="text-gray-900">{{ $technicalReception->responsible_name ?: '—' }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Cargo</div>
                        <div class="text-gray-900">{{ $technicalReception->responsible_position ?: '—' }}</div>
                    </div>

                    <div>
                        <div class="text-xs uppercase text-gray-500 font-semibold">Fecha</div>
                        <div class="text-gray-900">{{ $technicalReception->updated_at?->format('Y-m-d H:i') }}</div>
                    </div>

                    <div class="md:col-span-3">
                        <div class="text-xs uppercase text-gray-500 font-semibold">Observación final</div>
                        <div class="text-gray-900 whitespace-pre-line">
                            {{ $technicalReception->responsible_observation ?: '—' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
