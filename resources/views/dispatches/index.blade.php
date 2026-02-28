<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Despachos') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Despachos creados por selección de tanques o por cantidad.
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('dispatches.create') }}"
                   class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    + Nuevo (tanques)
                </a>

                <a href="{{ route('dispatches.create-by-quantity') }}"
                   class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200">
                    + Nuevo (cantidad)
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

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
                                    <th class="px-3 py-2 text-left">#</th>
                                    <th class="px-3 py-2 text-left">Fecha</th>
                                    <th class="px-3 py-2 text-left">Cliente</th>
                                    <th class="px-3 py-2 text-left">Doc.</th>
                                    <th class="px-3 py-2 text-left">Realizado por</th>
                                    <th class="px-3 py-2 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($dispatches as $d)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 font-medium text-gray-800">#{{ $d->id }}</td>
                                        <td class="px-3 py-2 text-gray-600">
                                            {{ optional($d->dispatched_at)->format('Y-m-d H:i') }}
                                        </td>
                                        <td class="px-3 py-2 text-gray-600">{{ $d->client?->name ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $d->document_number ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $d->performed_by_user_email }}</td>
                                        <td class="px-3 py-2 text-right">
                                            <a href="{{ route('dispatches.show', $d) }}"
                                               class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold bg-gray-100 hover:bg-gray-200">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-3 py-6 text-center text-gray-500">
                                            No hay despachos registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $dispatches->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
