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
               class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                + Nuevo
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Filtros --}}
<div class="bg-white shadow-sm sm:rounded-lg">
    <div class="p-4">
        <form method="GET" action="{{ route('clients.index') }}" class="space-y-3">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                <div class="md:col-span-4">
                    <label for="document" class="block text-xs text-gray-600 mb-1">
                        Buscar por cédula
                    </label>
                    
                    <input
                        type="text"
                        name="document"
                        id="document"
                        value="{{ $document }}"
                        class="block w-full rounded-md border-gray-300 text-sm py-2 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ej: 1311111111"
                        autocomplete="off"
                    >
                </div>

                <div class="md:col-span-4">
                    <label for="name" class="block text-xs text-gray-600 mb-1">
                        Buscar por nombre
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ $name }}"
                        class="block w-full rounded-md border-gray-300 text-sm py-2 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Ej: Juan Perez"
                        autocomplete="off"
                    >
                </div>

                <div class="md:col-span-3">
                    <label for="entity_type" class="block text-xs text-gray-600 mb-1">
                        Tipo de cliente
                    </label>
                    <select
                        name="entity_type"
                        id="entity_type"
                        class="block w-full rounded-md border-gray-300 text-sm py-2 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="">Todos</option>
                        @foreach (\App\Enums\EntityType::cases() as $type)
                            <option value="{{ $type->value }}" {{ (string) $entityType === (string) $type->value ? 'selected' : '' }}>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-1">
                    <button
                        type="submit"
                        class="inline-flex w-full justify-center items-center px-3 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800"
                    >
                        Filtrar
                    </button>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('clients.index') }}"
                   class="text-xs text-gray-500 hover:text-gray-700">
                    Limpiar filtros
                </a>
            </div>
        </form>
    </div>
</div>

            @if ($searchMessage)
                <div class="px-4 py-3 rounded-md text-sm {{ $searchStatus === 'success' ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700' }}">
                    {{ $searchMessage }}
                </div>
            @endif

            {{-- Tabla --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="mb-3">
                        <h3 class="text-sm font-semibold text-gray-900">Lista de Clientes</h3>
                        <p class="text-sm text-gray-500">Total: {{ $clients->total() }}</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs text-gray-500 border-b">
                                <tr>
                                    <th class="py-2 pr-4">Nombre</th>
                                    <th class="py-2 pr-4">Documento</th>
                                    <th class="py-2 pr-4">Tipo</th>
                                    <th class="py-2 pr-4">Teléfono</th>
                                    <th class="py-2 pr-4">Email</th>
                                    <th class="py-2 pr-4">Dirección</th>
                                    <th class="py-2 text-right">Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @forelse($clients as $c)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 pr-4 font-medium text-gray-900">{{ $c->name }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $c->document ?? '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $c->entity_type?->label() ?? '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $c->phone ?? '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $c->email ?? '—' }}</td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $c->address ?? '—' }}</td>
                                        <td class="py-3 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('clients.edit', $c) }}"
                                                   class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-gray-100 hover:bg-gray-200">
                                                    Editar
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('clients.destroy', $c) }}"
                                                      onsubmit="return confirm('¿Eliminar este cliente?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-red-50 text-red-700 hover:bg-red-100">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 text-center text-gray-500">
                                            @if($document || $name || $entityType)
                                                No se encontraron clientes con esos filtros.
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
