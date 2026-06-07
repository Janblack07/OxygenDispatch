<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Nueva ficha técnica
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    La ficha se genera por número de orden/documento del lote.
                </p>
            </div>

            <a href="{{ route('technical-receptions.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('technical_receptions._form', [
                'method' => 'POST',
                'action' => route('technical-receptions.store'),
                'technicalReception' => $technicalReception,
                'items' => $items,
                'batches' => $batches,
                'summary' => $summary,
                'documentNumber' => $documentNumber,
            ])
        </div>
    </div>
</x-app-layout>
