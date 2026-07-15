<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    Revisión técnica de tanques
                </h2>

                <p class="mt-0.5 text-xs text-gray-500">
                    Orden:
                    <span class="font-semibold text-indigo-700">
                        {{ $technicalReception->document_number }}
                    </span>
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('technical-receptions.show', $technicalReception) }}"
                   class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Volver a ficha
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Errores --}}
            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    <div class="font-semibold">
                        No se pudo completar la operación.
                    </div>

                    <ul class="mt-1 list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Resumen --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">

                <div class="bg-white border border-gray-100 shadow-sm rounded-lg p-5">
                    <div class="text-[11px] uppercase font-semibold tracking-wide text-gray-500">
                        Total
                    </div>

                    <div class="mt-1 text-3xl font-bold text-gray-900">
                        {{ $summary['total'] }}
                    </div>
                </div>

                <div class="bg-amber-50 border border-amber-200 shadow-sm rounded-lg p-5">
                    <div class="text-[11px] uppercase font-semibold tracking-wide text-amber-700">
                        Pendientes
                    </div>

                    <div class="mt-1 text-3xl font-bold text-amber-900">
                        {{ $summary['pending'] }}
                    </div>
                </div>

                <div class="bg-emerald-50 border border-emerald-200 shadow-sm rounded-lg p-5">
                    <div class="text-[11px] uppercase font-semibold tracking-wide text-emerald-700">
                        Aprobados
                    </div>

                    <div class="mt-1 text-3xl font-bold text-emerald-900">
                        {{ $summary['approved'] }}
                    </div>
                </div>

                <div class="bg-red-50 border border-red-200 shadow-sm rounded-lg p-5">
                    <div class="text-[11px] uppercase font-semibold tracking-wide text-red-700">
                        Con anomalía
                    </div>

                    <div class="mt-1 text-3xl font-bold text-red-900">
                        {{ $summary['rejected'] }}
                    </div>
                </div>

            </div>

            {{-- Progreso --}}
            <div class="bg-white border border-gray-100 shadow-sm rounded-lg p-5">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">
                            Progreso de revisión
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ $summary['reviewed'] }}
                            de
                            {{ $summary['total'] }}
                            tanque(s) revisado(s).
                        </p>
                    </div>

                    <div class="text-xl font-bold text-gray-900">
                        {{ $summary['progress'] }}%
                    </div>
                </div>

                <div class="mt-4 h-2.5 w-full overflow-hidden rounded-full bg-gray-100">
                    <div class="h-full rounded-full bg-indigo-600 transition-all"
                         style="width: {{ $summary['progress'] }}%">
                    </div>
                </div>

                @if($summary['total'] > 0 && $summary['pending'] === 0)
                    <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        <strong>Revisión técnica completada.</strong>
                        Todos los tanques de esta orden fueron revisados.
                    </div>
                @elseif($summary['pending'] > 0)
                    <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                        Quedan
                        <strong>{{ $summary['pending'] }}</strong>
                        tanque(s) pendientes de revisión.
                    </div>
                @endif
            </div>

            {{-- Filtros --}}
            <div class="bg-white border border-gray-100 shadow-sm rounded-lg p-5">
                <form method="GET"
                      action="{{ route('technical-receptions.tank-reviews.index', $technicalReception) }}"
                      class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">

                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-medium text-gray-600">
                            Serial
                        </label>

                        <input type="text"
                               name="serial"
                               value="{{ request('serial') }}"
                               placeholder="Ejemplo: OXI-000001"
                               class="mt-1 block w-full rounded-md border-gray-300 text-sm py-1.5 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-gray-600">
                            Estado técnico
                        </label>

                        <select name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 text-sm py-1.5 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">
                                Todos
                            </option>

                            <option value="Pendiente"
                                    @selected(request('status') === 'Pendiente')>
                                Pendiente
                            </option>

                            <option value="Aprobado"
                                    @selected(request('status') === 'Aprobado')>
                                Aprobado
                            </option>

                            <option value="Rechazado"
                                    @selected(request('status') === 'Rechazado')>
                                Rechazado
                            </option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Filtrar
                        </button>

                        <a href="{{ route('technical-receptions.tank-reviews.index', $technicalReception) }}"
                           class="inline-flex items-center justify-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                            Limpiar
                        </a>
                    </div>

                </form>
            </div>

            {{-- Formulario general de revisión --}}
            <form method="POST"
                  action="{{ route('technical-receptions.tank-reviews.process', $technicalReception) }}"
                  id="technical-review-form"
                  class="space-y-4">

                @csrf

                {{-- Acciones --}}
                <div class="bg-white border border-gray-100 shadow-sm rounded-lg p-5">
                    <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">
                                Acciones de revisión
                            </h3>

                            <p class="mt-1 text-xs text-gray-500">
                                Selecciona únicamente los tanques pendientes que deseas procesar.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">

                            @if($summary['pending'] > 0)
                                <button type="submit"
                                        name="action"
                                        value="approve_all_pending"
                                        onclick="return confirm('¿Seguro que deseas aprobar todos los tanques pendientes de esta orden?');"
                                        class="inline-flex items-center px-3 py-2 bg-white border border-emerald-300 rounded-md font-semibold text-xs text-emerald-700 uppercase tracking-widest hover:bg-emerald-50">
                                    Aprobar todos los pendientes
                                </button>
                            @endif

                            <button type="submit"
                                    name="action"
                                    value="approve"
                                    class="inline-flex items-center px-3 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-500">
                                Aprobar seleccionados
                            </button>

                        </div>
                    </div>
                </div>

                {{-- Tabla --}}
                <div class="bg-white border border-gray-100 shadow-sm rounded-lg overflow-hidden">

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">

                            <thead class="bg-gray-50 border-b text-left text-xs text-gray-500">
                                <tr>
                                    <th class="py-3 px-4 text-center w-12">
                                        <input type="checkbox"
                                               id="select-all"
                                               class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </th>

                                    <th class="py-3 px-4">
                                        Serial
                                    </th>

                                    <th class="py-3 px-4">
                                        Producto
                                    </th>

                                    <th class="py-3 px-4">
                                        Capacidad
                                    </th>

                                    <th class="py-3 px-4">
                                        Área
                                    </th>

                                    <th class="py-3 px-4 text-center">
                                        Estado técnico
                                    </th>

                                    <th class="py-3 px-4">
                                        Última revisión
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @forelse($tanks as $tank)
                                    @php
                                        $technicalStatusName = mb_strtolower(
                                            trim($tank->technicalStatus?->name ?? '')
                                        );

                                        $isPending = $technicalStatusName === 'pendiente';

                                        $badge = match($technicalStatusName) {
                                            'aprobado' =>
                                                'bg-emerald-50 text-emerald-700 border-emerald-200',

                                            'rechazado' =>
                                                'bg-red-50 text-red-700 border-red-200',

                                            default =>
                                                'bg-amber-50 text-amber-700 border-amber-200',
                                        };
                                    @endphp

                                    <tr class="hover:bg-gray-50">

                                        {{-- Checkbox --}}
                                        <td class="py-3 px-4 text-center">
                                            @if($isPending)
                                                <input type="checkbox"
                                                       name="tank_ids[]"
                                                       value="{{ $tank->id }}"
                                                       class="tank-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            @else
                                                <span class="text-gray-300">
                                                    —
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Serial --}}
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-900 whitespace-nowrap">
                                                {{ $tank->serial }}
                                            </div>

                                            <div class="mt-0.5 text-[11px] text-gray-500">
                                                Lote:
                                                {{ $tank->batch?->batch_number ?: '—' }}
                                            </div>
                                        </td>

                                        {{-- Producto --}}
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-900">
                                                {{ $tank->product?->code ?: '—' }}
                                            </div>

                                            <div class="text-[11px] text-gray-500">
                                                {{ $tank->product?->detail ?: '—' }}
                                            </div>
                                        </td>

                                        {{-- Capacidad --}}
                                        <td class="py-3 px-4 text-gray-700 whitespace-nowrap">
                                            {{ $tank->product?->capacity?->name
                                                ?? $tank->capacity?->name
                                                ?? '—' }}
                                        </td>

                                        {{-- Área --}}
                                        <td class="py-3 px-4 text-gray-700">
                                            {{ $tank->warehouseArea?->name ?: '—' }}
                                        </td>

                                        {{-- Estado --}}
                                        <td class="py-3 px-4 text-center">
                                            <span class="inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-semibold {{ $badge }}">
                                                {{ $tank->technicalStatus?->name ?: '—' }}
                                            </span>
                                        </td>

                                        {{-- Última revisión --}}
                                        <td class="py-3 px-4">
                                            @if($tank->latestTechnicalReview)
                                                <div class="font-medium text-gray-900">
                                                    {{ $tank->latestTechnicalReview->result === 'approved'
                                                        ? 'Aprobado'
                                                        : 'Rechazado' }}
                                                </div>

                                                <div class="mt-0.5 text-[11px] text-gray-500">
                                                    {{ $tank->latestTechnicalReview->reviewed_at?->format('Y-m-d H:i') }}
                                                </div>

                                                @if($tank->latestTechnicalReview->anomaly_type)
                                                    <div class="mt-1 text-xs font-medium text-red-600">
                                                        {{ $tank->latestTechnicalReview->anomaly_type }}
                                                    </div>
                                                @endif

                                                @if($tank->latestTechnicalReview->observation)
                                                    <div class="mt-1 max-w-xs text-[11px] text-gray-500">
                                                        {{ $tank->latestTechnicalReview->observation }}
                                                    </div>
                                                @endif
                                            @else
                                                <span class="text-gray-400">
                                                    Sin revisión
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="py-10 px-4 text-center text-gray-500">
                                            No existen tanques asociados a esta orden.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    @if($tanks->hasPages())
                        <div class="border-t border-gray-100 p-5">
                            {{ $tanks->links() }}
                        </div>
                    @endif
                </div>

                {{-- Reportar anomalía --}}
                <div class="bg-white border border-red-100 shadow-sm rounded-lg overflow-hidden">

                    <div class="border-b border-red-100 bg-red-50 px-5 py-4">
                        <h3 class="text-sm font-semibold text-red-900">
                            Reportar anomalía y enviar a devolución
                        </h3>

                        <p class="mt-1 text-xs text-red-700">
                            Los tanques seleccionados quedarán con estado técnico
                            <strong>Rechazado</strong>
                            y serán trasladados automáticamente al área de rechazos, devoluciones y retiro del mercado.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- Tipo de anomalía --}}
                        <div>
                            <label class="block text-[11px] font-medium text-gray-600">
                                Tipo de anomalía
                            </label>

                            <select name="anomaly_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 text-sm py-1.5 px-3 leading-5 focus:border-red-500 focus:ring-red-500">

                                <option value="">
                                    -- Seleccione --
                                </option>

                                @foreach([
                                    'Golpe',
                                    'Abolladura o deformación',
                                    'Grieta o fisura',
                                    'Presencia de grasa o aceite',
                                    'Problema de válvula',
                                    'Fuga',
                                    'Corrosión',
                                    'Etiquetado incorrecto',
                                    'Fecha vencida',
                                    'Otro',
                                ] as $anomaly)
                                    <option value="{{ $anomaly }}"
                                            @selected(old('anomaly_type') === $anomaly)>
                                        {{ $anomaly }}
                                    </option>
                                @endforeach

                            </select>

                            @error('anomaly_type')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Observación --}}
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-medium text-gray-600">
                                Observación
                            </label>

                            <textarea name="observation"
                                      rows="3"
                                      maxlength="2000"
                                      placeholder="Describe la anomalía encontrada..."
                                      class="mt-1 block w-full rounded-md border-gray-300 text-sm py-1.5 px-3 leading-5 focus:border-red-500 focus:ring-red-500">{{ old('observation') }}</textarea>
                        </div>

                        {{-- Botón rechazo --}}
                        <div class="md:col-span-3 flex justify-end">
                            <button type="submit"
                                    name="action"
                                    value="reject"
                                    onclick="return confirm('¿Seguro que deseas rechazar los tanques seleccionados y enviarlos al área de devoluciones?');"
                                    class="inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">
                                Rechazar seleccionados
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all');

            if (!selectAll) {
                return;
            }

            selectAll.addEventListener('change', function () {
                document
                    .querySelectorAll('.tank-checkbox')
                    .forEach(function (checkbox) {
                        checkbox.checked = selectAll.checked;
                    });
            });
        });
    </script>
</x-app-layout>
