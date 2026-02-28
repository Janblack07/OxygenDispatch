<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Despacho') }} #{{ $dispatch->id }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Detalle del despacho y tanques asociados.
                </p>
            </div>

            <a href="{{ route('dispatches.index') }}"
               class="inline-flex items-center px-3 py-2 bg-gray-100 rounded-md text-xs font-semibold hover:bg-gray-200">
                ← Volver
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

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 text-sm">
                        <div class="md:col-span-4">
                            <div class="text-xs text-gray-500">Cliente</div>
                            <div class="font-medium text-gray-800">{{ $dispatch->client?->name ?? '—' }}</div>
                        </div>

                        <div class="md:col-span-3">
                            <div class="text-xs text-gray-500">Fecha</div>
                            <div class="font-medium text-gray-800">
                                {{ optional($dispatch->dispatched_at)->format('Y-m-d H:i') }}
                            </div>
                        </div>

                        <div class="md:col-span-5">
                            <div class="text-xs text-gray-500">Realizado por</div>
                            <div class="font-medium text-gray-800">{{ $dispatch->performed_by_user_email }}</div>
                        </div>

                        <div class="md:col-span-4">
                            <div class="text-xs text-gray-500">Documento</div>
                            <div class="font-medium text-gray-800">{{ $dispatch->document_number ?? '—' }}</div>
                        </div>

                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">Tipo entidad</div>
                            <div class="font-medium text-gray-800">{{ $dispatch->entity_type ?? '—' }}</div>
                        </div>

                        <div class="md:col-span-3">
                            <div class="text-xs text-gray-500">Placa remisión</div>
                            <div class="font-medium text-gray-800">{{ $dispatch->remission_plate ?? '—' }}</div>
                        </div>

                        <div class="md:col-span-3">
                            <div class="text-xs text-gray-500">Comprobante</div>
                            <div class="font-medium text-gray-800">
                                {{ $dispatch->voucher_type ?? '—' }} {{ $dispatch->voucher_number ?? '' }}
                            </div>
                        </div>

                        <div class="md:col-span-12">
                            <div class="text-xs text-gray-500">Nro remisión</div>
                            <div class="font-medium text-gray-800">{{ $dispatch->remission_number ?? '—' }}</div>
                        </div>

                        <div class="md:col-span-12">
                            <div class="text-xs text-gray-500">Notas</div>
                            <div class="text-gray-800">{{ $dispatch->notes ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-gray-800">Líneas</h3>
                        <div class="text-xs text-gray-500">
                            Total: {{ $dispatch->lines->count() }}
                        </div>
                    </div>

                    <div class="mt-3 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left">Serial</th>
                                    <th class="px-3 py-2 text-left">Gas</th>
                                    <th class="px-3 py-2 text-left">Capacidad</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($dispatch->lines as $ln)
                                    @php($t = $ln->tankUnit)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-3 py-2 font-medium text-gray-800">
                                            {{ $t?->serial ?? $ln->tank_unit_id }}
                                        </td>
                                        <td class="px-3 py-2 text-gray-600">{{ $t?->gasType?->name ?? '—' }}</td>
                                        <td class="px-3 py-2 text-gray-600">{{ $t?->capacity?->name ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-3 py-6 text-center text-gray-500">
                                            No hay líneas en este despacho.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
