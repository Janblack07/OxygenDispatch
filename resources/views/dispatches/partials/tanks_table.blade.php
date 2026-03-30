<div class="rounded-md border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="text-left text-xs text-gray-500 border-b bg-gray-50">
                <tr>
                    <th class="px-3 py-2">Sel.</th>
                    <th class="px-3 py-2">Lote</th>
                    <th class="px-3 py-2">Serial</th>
                    <th class="px-3 py-2">Gas</th>
                    <th class="px-3 py-2">Capacidad</th>
                    <th class="px-3 py-2">Área</th>
                    <th class="px-3 py-2">Estado técnico</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($tanks as $t)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 align-middle">
                            <input
                                type="checkbox"
                                value="{{ $t->id }}"
                                class="tank-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            >
                        </td>

                        <td class="px-3 py-2 text-gray-700">
                            {{ $t->batch?->batch_number ?? '—' }}
                        </td>

                        <td class="px-3 py-2 font-semibold text-gray-900">
                            {{ $t->serial }}
                        </td>

                        <td class="px-3 py-2 text-gray-700">
                            {{ $t->gasType?->name ?? '—' }}
                        </td>

                        <td class="px-3 py-2 text-gray-700">
                            {{ $t->capacity?->name ?? '—' }}
                        </td>

                        <td class="px-3 py-2 text-gray-700">
                            {{ $t->warehouseArea?->name ?? '—' }}
                        </td>

                        <td class="px-3 py-2 text-gray-700">
                            {{ $t->technicalStatus?->name ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-3 py-8 text-center text-gray-500">
                            No hay tanques disponibles con esos filtros.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($tanks->hasPages())
    <div class="mt-3">
        {{ $tanks->links() }}
    </div>
@endif
