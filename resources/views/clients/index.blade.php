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
               class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                + Nuevo
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Alerts --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left">Nombre</th>
                                    <th class="px-3 py-2 text-left">Documento</th>
                                    <th class="px-3 py-2 text-left">Teléfono</th>
                                    <th class="px-3 py-2 text-left">Email</th>
                                    <th class="px-3 py-2 text-left">Dirección</th>
                                    <th class="px-3 py-2 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($clients as $c)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 font-medium text-gray-800">
                                            {{ $c->name }}
                                        </td>
                                        <td class="px-3 py-2 text-gray-600">{{ $c->document ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $c->phone ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $c->email ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $c->address ?? '—' }}</td>
                                        <td class="px-3 py-2">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('clients.edit', $c) }}"
                                                   class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-gray-100 hover:bg-gray-200">
                                                    Editar
                                                </a>

                                                <form method="POST" action="{{ route('clients.destroy', $c) }}"
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
                                        <td colspan="6" class="px-3 py-6 text-center text-gray-500">
                                            No hay clientes registrados.
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
