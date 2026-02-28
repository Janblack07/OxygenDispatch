<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Nuevo cliente') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Completa los datos para registrar un cliente.
                </p>
            </div>

            <a href="{{ route('clients.index') }}"
               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="POST" action="{{ route('clients.store') }}" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label-sm">Nombre *</label>
                                <input name="name" value="{{ old('name') }}" class="form-input-sm" required>
                            </div>

                            <div>
                                <label class="form-label-sm">Documento</label>
                                <input name="document" value="{{ old('document') }}" class="form-input-sm" placeholder="RUC/Cédula">
                            </div>

                            <div>
                                <label class="form-label-sm">Teléfono</label>
                                <input name="phone" value="{{ old('phone') }}" class="form-input-sm">
                            </div>

                            <div>
                                <label class="form-label-sm">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-input-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="form-label-sm">Dirección</label>
                                <input name="address" value="{{ old('address') }}" class="form-input-sm">
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <a href="{{ route('clients.index') }}"
                               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-indigo-500">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
