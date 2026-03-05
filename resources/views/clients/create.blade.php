<x-app-layout>
    @php
        $inputSm  = 'mt-1 block w-full rounded-md border-gray-300 text-sm py-2 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500';
        $selectSm = $inputSm;
        $labelSm  = 'block text-[11px] font-medium text-gray-600';
    @endphp

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
               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <form method="POST" action="{{ route('clients.store') }}" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="{{ $labelSm }}">Nombre <span class="text-red-500">*</span></label>
                                <input name="name" value="{{ old('name') }}" class="{{ $inputSm }}" required>
                            </div>

                            <div>
                                <label class="{{ $labelSm }}">Documento</label>
                                <input name="document" value="{{ old('document') }}" class="{{ $inputSm }}" placeholder="RUC/Cédula">
                            </div>

                            <div>
                                <label class="{{ $labelSm }}">Teléfono</label>
                                <input name="phone" value="{{ old('phone') }}" class="{{ $inputSm }}" placeholder="Ej: 0999999999">
                            </div>

                            <div>
                                <label class="{{ $labelSm }}">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="{{ $inputSm }}" placeholder="Ej: cliente@correo.com">
                            </div>

                            <div class="md:col-span-2">
                                <label class="{{ $labelSm }}">Dirección</label>
                                <input name="address" value="{{ old('address') }}" class="{{ $inputSm }}" placeholder="Ej: Av. Principal y Calle 2">
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <a href="{{ route('clients.index') }}"
                               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                Cancelar
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
