<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Clientes') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Registro y administración de clientes para despachos.
                </p>
            </div>

            <a href="{{ route('clients.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-sm transition">
                + Nuevo
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Filtro compacto --}}
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-3 sm:p-2">
                    <form method="GET" action="{{ route('clients.index') }}" class="space-y-2">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-end">
                            <div class="md:col-span-10">
                                <label for="document" class="block text-[11px] font-medium text-gray-600 mb-1">
                                    Buscar por cédula
                                </label>
                                <input
                                    type="text"
                                    name="document"
                                    id="document"
                                    value="{{ $document }}"
                                    class="block w-full rounded-md border-gray-300 text-sm py-2 px-3 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Ej: 1311111111"
                                    autocomplete="off"
                                >
                            </div>

                            <div class="md:col-span-2">
                                <button
                                    type="submit"
                                    class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-slate-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-700 focus:ring-offset-2 transition"
                                >
                                    Filtrar
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a
                                href="{{ route('clients.index') }}"
                                class="text-xs text-gray-500 hover:text-gray-700"
                            >
                                Limpiar filtros
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            @if ($searchMessage)
                <div class="rounded-lg border px-4 py-2.5 text-sm
                    {{ $searchStatus === 'success'
                        ? 'border-green-200 bg-green-50 text-green-700'
                        : 'border-red-200 bg-red-50 text-red-700' }}">
                    <div class="flex items-center justify-between gap-3">
                        <span class="font-medium">{{ $searchMessage }}</span>

                        @if ($document)
                            <span class="text-xs">
                                Cédula: <strong>{{ $document }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Listado --}}
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-4">
                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-900">Lista de Clientes</h3>
                        <p class="text-sm text-gray-500">
                            Total: {{ $clients->total() }}
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs text-gray-500 border-b bg-white">
                                <tr>
                                    <th class="px-3 py-3 text-left font-medium">Nombre</th>
                                    <th class="px-3 py-3 text-left font-medium">Documento</th>
                                    <th class="px-3 py-3 text-left font-medium">Tipo</th>
                                    <th class="px-3 py-3 text-left font-medium">Teléfono</th>
                                    <th class="px-3 py-3 text-left font-medium">Email</th>
                                    <th class="px-3 py-3 text-left font-medium">Dirección</th>
                                    <th class="px-3 py-3 text-right font-medium">Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @forelse($clients as $c)
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="px-3 py-3.5 font-medium text-gray-800">
                                            {{ $c->name }}
                                        </td>

                                        <td class="px-3 py-3.5 text-gray-700">
                                            {{ $c->document ?? '—' }}
                                        </td>

                                        <td class="px-3 py-3.5 text-gray-700">
                                            {{ $c->entity_type?->label() ?? '—' }}
                                        </td>

                                        <td class="px-3 py-3.5 text-gray-700">
                                            {{ $c->phone ?? '—' }}
                                        </td>

                                        <td class="px-3 py-3.5 text-gray-700">
                                            {{ $c->email ?? '—' }}
                                        </td>

                                        <td class="px-3 py-3.5 text-gray-700">
                                            {{ $c->address ?? '—' }}
                                        </td>

                                        <td class="px-3 py-3.5">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('clients.edit', $c) }}"
                                                   class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                                                    Editar
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('clients.destroy', $c) }}"
                                                      onsubmit="return confirm('¿Eliminar este cliente?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-red-50 text-red-700 hover:bg-red-100 transition">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-3 py-10 text-center text-gray-500">
                                            @if($document)
                                                Ese cliente no existe.
                                            @else
                                                No hay clientes registrados.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
