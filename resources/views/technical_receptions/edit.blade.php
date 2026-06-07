<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Editar ficha técnica
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Orden: {{ $technicalReception->document_number }}
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('technical-receptions.show', $technicalReception) }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                    Ver ficha
                </a>

                <a href="{{ route('technical-receptions.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('technical_receptions._form', [
                'method' => 'PUT',
                'action' => route('technical-receptions.update', $technicalReception),
                'technicalReception' => $technicalReception,
                'items' => $technicalReception->items,
                'batches' => $batches,
                'summary' => $summary,
                'documentNumber' => $technicalReception->document_number,
            ])
        </div>
    </div>
</x-app-layout>
