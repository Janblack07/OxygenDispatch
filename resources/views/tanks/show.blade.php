<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Tanque') }}: <span class="text-indigo-700">{{ $tank->serial }}</span>
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Lote: {{ $tank->batch_id }} · {{ $tank->gasType?->name }} · {{ $tank->capacity?->name }}
                </p>
            </div>

            <a href="{{ url()->previous() }}"
               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Info --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-3 text-sm">
                        <s>
                        <div>
                            <div class="text-[11px] text-gray-500">Área</div>
                            <div class="font-semibold text-gray-900">{{ $tank->warehouseArea?->name }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] text-gray-500">Estado técnico</div>
                            <div class="font-semibold text-gray-900">{{ $tank->technicalStatus?->name }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] text-gray-500">Estado</div>
                            <div class="font-semibold text-gray-900">{{ $tank->status?->label() ?? $tank->status }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] text-gray-500">Creado</div>
                            <div class="font-semibold text-gray-900">{{ optional($tank->created_at)->format('Y-m-d H:i') }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] text-gray-500">Actualizado</div>
                            <div class="font-semibold text-gray-900">{{ optional($tank->updated_at)->format('Y-m-d H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                {{-- Transferir --}}
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900">Trasladar</h3>
                        <p class="text-xs text-gray-500 mt-1">Cambia el área del tanque (genera movimiento).</p>

                        <form method="POST" action="{{ route('tanks.transfer', $tank) }}" class="mt-3 space-y-3">
                            @csrf
                            <div>
                                <label class="form-label-sm">Nueva área</label>
                                <select name="warehouse_area_id" class="form-select-sm" required>
                                    @foreach($areas as $a)
                                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                    class="inline-flex w-full justify-center items-center px-3 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Trasladar
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Estado técnico --}}
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900">Estado técnico</h3>
                        <p class="text-xs text-gray-500 mt-1">Registra inspección/reparación (genera movimiento).</p>

                        <form method="POST" action="{{ route('tanks.technical-status', $tank) }}" class="mt-3 space-y-3">
                            @csrf
                            <div>
                                <label class="form-label-sm">Nuevo estado</label>
                                <select name="technical_status_id" class="form-select-sm" required>
                                    @foreach($techStatuses as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                    class="inline-flex w-full justify-center items-center px-3 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Actualizar
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Baja --}}
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900">Baja</h3>
                        <p class="text-xs text-gray-500 mt-1">Marca el tanque como dado de baja.</p>

                        <form method="POST" action="{{ route('tanks.decommission', $tank) }}" class="mt-3 space-y-3"
                              onsubmit="return confirm('¿Confirmas dar de baja este tanque?');">
                            @csrf
                            <div>
                                <label class="form-label-sm">Motivo (opcional)</label>
                                <input name="reason" class="form-input-sm" placeholder="Ej: Daño irreversible">
                            </div>

                            <button type="submit"
                                    class="inline-flex w-full justify-center items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">
                                Dar de baja
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            {{-- Movimientos del tanque (si los envías desde controller) --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-900">Historial de movimientos</h3>
                    </div>

                    <div class="mt-3 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs text-gray-500 border-b">
                                <tr>
                                    <th class="py-2 pr-4">Fecha</th>
                                    <th class="py-2 pr-4">Tipo</th>
                                    <th class="py-2 pr-4">Detalle</th>
                                    <th class="py-2 pr-4">Usuario</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse($movements ?? [] as $m)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 pr-4 text-gray-700">{{ optional($m->created_at)->format('Y-m-d H:i') }}</td>
                                        <td class="py-3 pr-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] bg-gray-100 text-gray-700">
                                                {{ $m->type }}
                                            </span>
                                        </td>
                                        <td class="py-3 pr-4 text-gray-700">{{ $m->description }}</td>
                                        <td class="py-3 pr-4 text-gray-600">{{ $m->created_by_user_email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-500">
                                            No hay movimientos para este tanque.
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
