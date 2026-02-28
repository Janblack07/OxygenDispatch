<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">{{ __('Nueva capacidad') }}</h2>
                <p class="mt-0.5 text-xs text-gray-500">Crea un elemento del catálogo.</p>
            </div>

            <a href="{{ route('capacities.index') }}"
               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="POST" action="{{ route('capacities.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="form-label-sm">Nombre *</label>
                            <input name="name" value="{{ old('name') }}" class="form-input-sm" required>
                        </div>

                        <div>
                            <label class="form-label-sm">m3 (opcional)</label>
                            <input type="number" step="0.01" name="m3" value="{{ old('m3') }}" class="form-input-sm">
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('capacities.index') }}"
                               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                                Cancelar
                            </a>
                            <button class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-indigo-500">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
