<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    Reportes mensuales
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Consulta y exportación PDF de entradas y salidas por mes.
                </p>
            </div>
        </div>
    </x-slot>

    @php
        $labelSm = 'block text-xs font-medium text-gray-700 mb-1';
        $inputSm = 'w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2';
        $card = 'bg-white shadow-sm sm:rounded-lg';
    @endphp

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="{{ $card }}">
                <div class="p-4">
                    <form method="GET" action="{{ route('reports.monthly.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                        <div class="md:col-span-4">
                            <label for="month" class="{{ $labelSm }}">Mes</label>
                            <select id="month" name="month" class="{{ $inputSm }}">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" @selected($month == $m)>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label for="year" class="{{ $labelSm }}">Año</label>
                            <input
                                id="year"
                                type="number"
                                name="year"
                                value="{{ $year }}"
                                class="{{ $inputSm }}"
                                min="2020"
                                max="2100"
                            >
                        </div>

                        <div class="md:col-span-2">
                            <button
                                type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Consultar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <div class="{{ $card }}">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Entradas del mes</h3>
                        <p class="text-xs text-gray-500 mt-1">
                            Movimientos de entrada registrados durante el período seleccionado.
                        </p>
                    </div>

                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="rounded-xl bg-indigo-50 border border-indigo-100 p-4">
                                <div class="text-xs text-indigo-700">Total entradas</div>
                                <div class="text-2xl font-bold text-indigo-900">{{ $entriesSummary['total_movements'] }}</div>
                            </div>

                            <div class="rounded-xl bg-green-50 border border-green-100 p-4">
                                <div class="text-xs text-green-700">Total tanques</div>
                                <div class="text-2xl font-bold text-green-900">{{ $entriesSummary['total_tanks'] }}</div>
                            </div>

                            <div class="rounded-xl bg-cyan-50 border border-cyan-100 p-4">
                                <div class="text-xs text-cyan-700">Volumen total</div>
                                <div class="text-2xl font-bold text-cyan-900">{{ number_format($entriesSummary['total_m3'], 2) }} <span class="text-sm">m³</span></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-medium text-sm text-gray-800 mb-2">Entradas por área destino</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full text-sm">
                                        <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-3 py-2 text-left">Área</th>
                                                <th scope="col" class="px-3 py-2 text-right">Tanques</th>
                                                <th scope="col" class="px-3 py-2 text-right">m³</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @forelse($entriesSummary['by_area'] as $row)
                                                <tr>
                                                    <td class="px-3 py-2">{{ $row->label }}</td>
                                                    <td class="px-3 py-2 text-right">{{ $row->total_tanks }}</td>
                                                    <td class="px-3 py-2 text-right">{{ number_format($row->total_m3, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="px-3 py-4 text-center text-gray-500">Sin datos</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-medium text-sm text-gray-800 mb-2">Entradas por capacidad</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full text-sm">
                                        <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-3 py-2 text-left">Capacidad</th>
                                                <th scope="col" class="px-3 py-2 text-right">Tanques</th>
                                                <th scope="col" class="px-3 py-2 text-right">m³</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @forelse($entriesSummary['by_capacity'] as $row)
                                                <tr>
                                                    <td class="px-3 py-2">{{ $row->label }}</td>
                                                    <td class="px-3 py-2 text-right">{{ $row->total_tanks }}</td>
                                                    <td class="px-3 py-2 text-right">{{ number_format($row->total_m3, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="px-3 py-4 text-center text-gray-500">Sin datos</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a
                                href="{{ route('reports.monthly.entries.pdf', ['month' => $month, 'year' => $year]) }}"
                                class="inline-flex justify-center items-center px-4 py-2 bg-red-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            >
                                PDF Entradas del mes
                            </a>
                        </div>
                    </div>
                </div>

                <div class="{{ $card }}">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Salidas del mes</h3>
                        <p class="text-xs text-gray-500 mt-1">
                            Despachos registrados durante el período seleccionado.
                        </p>
                    </div>

                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="rounded-xl bg-indigo-50 border border-indigo-100 p-4">
                                <div class="text-xs text-blue-700">Total despachos</div>
                                <div class="text-2xl font-bold text-blue-900">{{ $exitsSummary['total_dispatches'] }}</div>
                            </div>

                            <div class="rounded-xl bg-red-50 border border-red-100 p-4">
                                <div class="text-xs text-orange-700">Total tanques</div>
                                <div class="text-2xl font-bold text-orange-900">{{ $exitsSummary['total_tanks'] }}</div>
                            </div>

                            <div class="rounded-xl bg-cyan-50 border border-cyan-100 p-4">
                                <div class="text-xs text-cyan-700">Volumen total</div>
                                <div class="text-2xl font-bold text-cyan-900">{{ number_format($exitsSummary['total_m3'], 2) }} <span class="text-sm">m³</span></div>
                            </div>

                            <div class="rounded-xl bg-emerald-50 border border-emerald-100 p-4">
                                <div class="text-xs text-emerald-700">Clientes atendidos</div>
                                <div class="text-2xl font-bold text-emerald-900">{{ $exitsSummary['total_clients'] }}</div>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-sm text-gray-800 mb-2">Volumen por tipo de cliente</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-3 py-2 text-left">Tipo</th>
                                            <th scope="col" class="px-3 py-2 text-right">Despachos</th>
                                            <th scope="col" class="px-3 py-2 text-right">Tanques</th>
                                            <th scope="col" class="px-3 py-2 text-right">m³</th>
                                            <th scope="col" class="px-3 py-2 text-right">%</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @forelse($exitsSummary['by_entity_type'] as $row)
                                            <tr>
                                                <td class="px-3 py-2">{{ $row->label }}</td>
                                                <td class="px-3 py-2 text-right">{{ $row->total_dispatches }}</td>
                                                <td class="px-3 py-2 text-right">{{ $row->total_tanks }}</td>
                                                <td class="px-3 py-2 text-right">{{ number_format($row->total_m3, 2) }}</td>
                                                <td class="px-3 py-2 text-right">{{ number_format($row->percentage_m3, 2) }}%</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-3 py-4 text-center text-gray-500">Sin datos</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pt-2 space-y-3">
                            <div class="text-sm font-medium text-gray-800">
                                Exportar reportes de salida
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <a
                                    href="{{ route('reports.monthly.exits.pdf', ['month' => $month, 'year' => $year]) }}"
                                    class="inline-flex justify-center items-center px-4 py-2 bg-red-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                >
                                    PDF Salidas general
                                </a>

                                <a
                                    href="{{ route('reports.monthly.exits.pdf', ['month' => $month, 'year' => $year, 'entity_type' => 1]) }}"
                                    class="inline-flex justify-center items-center px-4 py-2 bg-red-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                >
                                    PDF Entidades
                                </a>

                                <a
                                    href="{{ route('reports.monthly.exits.pdf', ['month' => $month, 'year' => $year, 'entity_type' => 2]) }}"
                                    class="inline-flex justify-center items-center px-4 py-2 bg-red-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                >
                                    PDF Intradomiciliario IESS
                                </a>

                                <a
                                    href="{{ route('reports.monthly.exits.pdf', ['month' => $month, 'year' => $year, 'entity_type' => 3]) }}"
                                    class="inline-flex justify-center items-center px-4 py-2 bg-red-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                >
                                    PDF No afiliado / Apoyo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
