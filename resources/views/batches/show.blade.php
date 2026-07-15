<x-app-layout>
    @php
        $inputSm = 'mt-1 block w-full rounded-md border-gray-300 text-sm py-1.5 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500';
        $selectSm = $inputSm;
        $labelSm = 'block text-[11px] font-medium text-gray-600';
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    Detalle de lote:
                    <span class="text-indigo-700">
                        {{ $batch->batch_number }}
                    </span>
                </h2>

                <p class="mt-0.5 text-xs text-gray-500">
                    Aquí puedes generar tanques de diferentes productos y capacidades dentro del mismo lote.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                @if($batch->document_number)
                    <a href="{{ route('technical-receptions.index', ['q' => $batch->document_number]) }}"
                       class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                        Recepción técnica
                    </a>
                @endif

                <a href="{{ route('batches.index') }}"
                   class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Mensajes --}}
            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

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

            {{-- Info del lote --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-5">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">
                                Información del lote
                            </h3>

                            <p class="mt-0.5 text-xs text-gray-500">
                                Datos generales registrados para esta recepción.
                            </p>
                        </div>

                        @if($batch->document_number)
                            <span class="inline-flex w-fit items-center rounded-full border border-indigo-200 bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                Orden: {{ $batch->document_number }}
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500 text-xs">
                                Recibido
                            </div>

                            <div class="font-semibold text-gray-900 mt-0.5">
                                {{ optional($batch->received_at)->format('Y-m-d H:i') ?: '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-gray-500 text-xs">
                                Documento
                            </div>

                            <div class="font-semibold text-gray-900 mt-0.5">
                                {{ $batch->document_number ?: '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-gray-500 text-xs">
                                Gas (ref)
                            </div>

                            <div class="font-semibold text-gray-900 mt-0.5">
                                {{ $batch->gasType?->name ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-gray-500 text-xs">
                                Capacidad (ref)
                            </div>

                            <div class="font-semibold text-gray-900 mt-0.5">
                                {{ $batch->capacity?->name ?? '—' }}
                            </div>
                        </div>

                        @if($batch->supplier_name)
                            <div class="sm:col-span-2">
                                <div class="text-gray-500 text-xs">
                                    Proveedor
                                </div>

                                <div class="font-semibold text-gray-900 mt-0.5">
                                    {{ $batch->supplier_name }}
                                </div>
                            </div>
                        @endif

                        @if($batch->voucher_number)
                            <div>
                                <div class="text-gray-500 text-xs">
                                    Comprobante
                                </div>

                                <div class="font-semibold text-gray-900 mt-0.5">
                                    {{ $batch->voucher_number }}
                                </div>
                            </div>
                        @endif

                        @if($batch->sanitary_registry)
                            <div>
                                <div class="text-gray-500 text-xs">
                                    Registro sanitario referencial
                                </div>

                                <div class="font-semibold text-gray-900 mt-0.5">
                                    {{ $batch->sanitary_registry }}
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($batch->notes)
                        <div class="mt-4 border-t border-gray-100 pt-4 text-sm">
                            <div class="text-gray-500 text-xs">
                                Notas
                            </div>

                            <div class="mt-1 text-gray-700 whitespace-pre-line">
                                {{ $batch->notes }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Generar tanques --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">
                            Generar tanques
                        </h3>

                        <p class="mt-0.5 text-xs text-gray-500">
                            Selecciona un producto. El gas, capacidad y registro sanitario salen automáticamente del producto.
                        </p>
                    </div>

                    {{-- Aviso revisión técnica obligatoria --}}
                    <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3">
                        <div class="flex items-start gap-3">
                            <div class="shrink-0 mt-0.5">
                                <svg class="h-5 w-5 text-amber-600"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.667 1.73-3L13.73 4c-.77-1.333-2.69-1.333-3.46 0L3.34 16c-.77 1.333.19 3 1.73 3z" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-amber-900">
                                    Revisión técnica obligatoria
                                </p>

                                <p class="mt-1 text-xs text-amber-800">
                                    Todo tanque nuevo ingresará automáticamente al área
                                    <strong>Recepción</strong>
                                    con estado técnico
                                    <strong>Pendiente</strong>.
                                    No podrá ser despachado hasta ser aprobado técnicamente.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST"
                          action="{{ route('batches.generate-tanks', $batch) }}"
                          class="mt-4 grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                        @csrf

                        {{-- Producto --}}
                        <div class="md:col-span-6">
                            <label class="{{ $labelSm }}">
                                Producto
                            </label>

                            <select name="product_id"
                                    class="{{ $selectSm }}"
                                    required>
                                <option value="">
                                    -- Seleccione --
                                </option>

                                @foreach($products as $p)
                                    <option value="{{ $p->id }}"
                                            @selected(old('product_id') == $p->id)>
                                        {{ $p->code }} — {{ $p->detail }}
                                    </option>
                                @endforeach
                            </select>

                            @error('product_id')
                                <p class="text-xs text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Cantidad --}}
                        <div class="md:col-span-3">
                            <label class="{{ $labelSm }}">
                                Cantidad
                            </label>

                            <input type="number"
                                   name="quantity"
                                   min="1"
                                   max="5000"
                                   value="{{ old('quantity', 10) }}"
                                   class="{{ $inputSm }}"
                                   required>

                            @error('quantity')
                                <p class="text-xs text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Prefijo --}}
                        <div class="md:col-span-3">
                            <label class="{{ $labelSm }}">
                                Prefijo serial
                            </label>

                            <input type="text"
                                   name="serial_prefix"
                                   maxlength="10"
                                   value="{{ old('serial_prefix', 'OXI') }}"
                                   class="{{ $inputSm }}"
                                   placeholder="OXI">

                            @error('serial_prefix')
                                <p class="text-xs text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Resumen automático --}}
                        <div class="md:col-span-12">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 rounded-lg border border-gray-200 bg-gray-50 px-4 py-3">
                                <div>
                                    <span class="text-[11px] uppercase font-semibold tracking-wide text-gray-500">
                                        Área inicial automática
                                    </span>

                                    <div class="mt-1">
                                        <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                            Recepción
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <span class="text-[11px] uppercase font-semibold tracking-wide text-gray-500">
                                        Estado técnico inicial
                                    </span>

                                    <div class="mt-1">
                                        <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                            Pendiente
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Botón --}}
                        <div class="md:col-span-12 flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Generar tanques
                            </button>
                        </div>
                    </form>

                    <p class="mt-3 text-xs text-gray-500">
                        Se registra automáticamente un movimiento de
                        <strong>Entrada</strong>
                        por cada tanque generado.
                    </p>
                </div>
            </div>

            {{-- Tanques del lote --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">
                                Tanques del lote
                            </h3>

                            <p class="text-xs text-gray-500">
                                Total: {{ $batch->tankUnits->count() }}
                            </p>
                        </div>

                        <a href="{{ route('tanks.index', ['batch_id' => $batch->id]) }}"
                           class="text-xs font-medium text-indigo-600 hover:text-indigo-800 hover:underline">
                            Ver en módulo Tanques →
                        </a>
                    </div>

                    {{-- Resumen técnico --}}
                    @php
                        $pendingCount = $batch->tankUnits->filter(function ($tank) {
                            return mb_strtolower(
                                trim($tank->technicalStatus?->name ?? '')
                            ) === 'pendiente';
                        })->count();

                        $approvedCount = $batch->tankUnits->filter(function ($tank) {
                            return mb_strtolower(
                                trim($tank->technicalStatus?->name ?? '')
                            ) === 'aprobado';
                        })->count();

                        $rejectedCount = $batch->tankUnits->filter(function ($tank) {
                            return mb_strtolower(
                                trim($tank->technicalStatus?->name ?? '')
                            ) === 'rechazado';
                        })->count();
                    @endphp

                    @if($batch->tankUnits->isNotEmpty())
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3">
                                <div class="text-[11px] uppercase font-semibold tracking-wide text-amber-700">
                                    Pendientes
                                </div>

                                <div class="mt-1 text-2xl font-bold text-amber-900">
                                    {{ $pendingCount }}
                                </div>
                            </div>

                            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3">
                                <div class="text-[11px] uppercase font-semibold tracking-wide text-emerald-700">
                                    Aprobados
                                </div>

                                <div class="mt-1 text-2xl font-bold text-emerald-900">
                                    {{ $approvedCount }}
                                </div>
                            </div>

                            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3">
                                <div class="text-[11px] uppercase font-semibold tracking-wide text-red-700">
                                    Rechazados
                                </div>

                                <div class="mt-1 text-2xl font-bold text-red-900">
                                    {{ $rejectedCount }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs text-gray-500 border-b bg-gray-50">
                                <tr>
                                    <th class="py-3 px-3">
                                        Serial
                                    </th>

                                    <th class="py-3 px-3">
                                        Producto
                                    </th>

                                    <th class="py-3 px-3">
                                        Capacidad
                                    </th>

                                    <th class="py-3 px-3">
                                        Registro sanitario
                                    </th>

                                    <th class="py-3 px-3">
                                        Área
                                    </th>

                                    <th class="py-3 px-3 text-center">
                                        Estado técnico
                                    </th>

                                    <th class="py-3 px-3 text-center">
                                        Despachable
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @forelse($batch->tankUnits as $tank)
                                    @php
                                        $technicalStatusName = mb_strtolower(
                                            trim($tank->technicalStatus?->name ?? '')
                                        );

                                        $areaName = mb_strtolower(
                                            trim($tank->warehouseArea?->name ?? '')
                                        );

                                        $statusBadge = match($technicalStatusName) {
                                            'aprobado' =>
                                                'bg-emerald-50 text-emerald-700 border-emerald-200',

                                            'rechazado' =>
                                                'bg-red-50 text-red-700 border-red-200',

                                            default =>
                                                'bg-amber-50 text-amber-700 border-amber-200',
                                        };

                                        $isDispatchable =
                                            $technicalStatusName === 'aprobado'
                                            && $areaName === 'productos aprobados';
                                    @endphp

                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-3 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $tank->serial }}
                                        </td>

                                        <td class="py-3 px-3">
                                            <div class="font-semibold text-gray-900 leading-5">
                                                {{ $tank->product?->code ?? '—' }}
                                            </div>

                                            <div class="text-[11px] text-gray-500">
                                                {{ $tank->product?->detail ?? '—' }}
                                            </div>
                                        </td>

                                        <td class="py-3 px-3 text-gray-700 whitespace-nowrap">
                                            {{ $tank->product?->capacity?->name ?? $tank->capacity?->name ?? '—' }}
                                        </td>

                                        <td class="py-3 px-3 text-gray-700">
                                            {{ $tank->sanitary_registry ?? $tank->product?->sanitary_registry ?? '—' }}
                                        </td>

                                        <td class="py-3 px-3 text-gray-700">
                                            {{ $tank->warehouseArea?->name ?? '—' }}
                                        </td>

                                        <td class="py-3 px-3 text-center">
                                            <span class="inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusBadge }}">
                                                {{ $tank->technicalStatus?->name ?? '—' }}
                                            </span>
                                        </td>

                                        <td class="py-3 px-3 text-center">
                                            @if($isDispatchable)
                                                <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                    Sí
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-2.5 py-1 text-xs font-semibold text-gray-600">
                                                    No
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="py-10 px-4 text-center text-gray-500">
                                            Aún no hay tanques en este lote. Usa
                                            <strong>Generar tanques</strong>.
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
