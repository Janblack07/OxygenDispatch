<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">{{ __('Capacidades') }}</h2>
                <p class="mt-0.5 text-xs text-gray-500">Catálogo de capacidades (m3 opcional).</p>
            </div>

            <a href="{{ route('capacities.create') }}"
               class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                + Nuevo
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left">Nombre</th>
                                    <th class="px-3 py-2 text-left">m3</th>
                                    <th class="px-3 py-2 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($items as $it)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 font-medium text-gray-800">{{ $it->name }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $it->m3 ?? '—' }}</td>
                                        <td class="px-3 py-2">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('capacities.edit', $it) }}"
                                                   class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-gray-100 hover:bg-gray-200">
                                                    Editar
                                                </a>

                                                <form method="POST" action="{{ route('capacities.destroy', $it) }}"
                                                      onsubmit="return confirm('¿Eliminar este registro?')">
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
                                    <tr><td colspan="3" class="px-3 py-6 text-center text-gray-500">Sin registros.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $items->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
