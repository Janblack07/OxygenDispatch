<x-app-layout>
    @php
        $inputSm  = 'mt-1 block w-full rounded-md border-gray-300 text-sm py-2 px-3 leading-5 focus:border-indigo-500 focus:ring-indigo-500';
        $selectSm = $inputSm;
        $labelSm  = 'block text-[11px] font-medium text-gray-600';
        $selectedOldTankIds = collect(old('tank_ids', []))->map(fn ($id) => (string) $id)->values();
    @endphp

    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Nuevo despacho (selección de tanques)') }}
                </h2>
                <p class="mt-0.5 text-xs text-gray-500">
                    Selecciona 1 o más tanques disponibles y genera el despacho.
                </p>
            </div>

            <a href="{{ route('dispatches.index') }}"
               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    <ul class="list-disc ms-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('dispatches.store') }}" class="space-y-4" id="dispatch-form">
                @csrf

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                            <div class="md:col-span-4">
                                <label class="{{ $labelSm }}" for="client_document_lookup">Cédula / RUC</label>
                                <div class="mt-1 flex gap-2">
                                    <input
                                        type="text"
                                        id="client_document_lookup"
                                        class="{{ $inputSm }}"
                                        placeholder="Ej: 1311111111"
                                        autocomplete="off"
                                        data-lookup-url="{{ route('clients.findByDocument') }}"
                                    >

                                    <button
                                        type="button"
                                        id="btn_validate_client"
                                        class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 whitespace-nowrap"
                                    >
                                        Validar
                                    </button>
                                </div>

                                <div id="client_lookup_ok" class="mt-1 text-xs text-green-700 hidden"></div>
                                <div id="client_lookup_error" class="mt-1 text-xs text-red-600 hidden">
                                    Ese cliente no existe, primero regístralo.
                                </div>
                            </div>

                            <div class="md:col-span-4">
                                <label class="{{ $labelSm }}" for="client_name_display">Cliente</label>
                                <input
                                    type="text"
                                    id="client_name_display"
                                    class="{{ $inputSm }} bg-gray-50"
                                    placeholder="Aquí aparecerá el cliente encontrado"
                                    readonly
                                >
                                <input type="hidden" name="client_id" id="client_id_hidden" value="{{ old('client_id') }}">
                            </div>

                            <div class="md:col-span-4">
                                <label class="{{ $labelSm }}" for="dispatched_at">Fecha despacho *</label>
                                <input
                                    type="datetime-local"
                                    name="dispatched_at"
                                    id="dispatched_at"
                                    class="{{ $inputSm }}"
                                    value="{{ old('dispatched_at', now()->format('Y-m-d\TH:i')) }}"
                                    required
                                >
                            </div>

                            <div class="md:col-span-4">
                                <label class="{{ $labelSm }}" for="document_number">Nro Documento</label>
                                <input
                                    type="text"
                                    name="document_number"
                                    id="document_number"
                                    class="{{ $inputSm }}"
                                    value="{{ old('document_number') }}"
                                    placeholder="Ej: DOC-123"
                                >
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}" for="remission_plate">Placa remisión</label>
                                <input
                                    type="text"
                                    name="remission_plate"
                                    id="remission_plate"
                                    class="{{ $inputSm }}"
                                    value="{{ old('remission_plate') }}"
                                    placeholder="Ej: GAA-1234"
                                >
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}" for="voucher_type">Tipo comprobante</label>
                                <input
                                    type="text"
                                    name="voucher_type"
                                    id="voucher_type"
                                    class="{{ $inputSm }}"
                                    value="{{ old('voucher_type') }}"
                                    placeholder="Ej: Factura / Nota / Guía"
                                >
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}" for="voucher_number">Nro comprobante</label>
                                <input
                                    type="text"
                                    name="voucher_number"
                                    id="voucher_number"
                                    class="{{ $inputSm }}"
                                    value="{{ old('voucher_number') }}"
                                    placeholder="Ej: 001-001-000000123"
                                >
                            </div>

                            <div class="md:col-span-3">
                                <label class="{{ $labelSm }}" for="remission_number">Nro remisión</label>
                                <input
                                    type="text"
                                    name="remission_number"
                                    id="remission_number"
                                    class="{{ $inputSm }}"
                                    value="{{ old('remission_number') }}"
                                    placeholder="Ej: REM-0001"
                                >
                            </div>

                            <div class="md:col-span-12">
                                <label class="{{ $labelSm }}" for="notes">Notas</label>
                                <textarea
                                    name="notes"
                                    id="notes"
                                    rows="2"
                                    class="{{ $inputSm }}"
                                    placeholder="Notas del despacho (opcional)"
                                >{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4 space-y-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="font-semibold text-gray-900">Tanques disponibles</h3>
                                <p class="text-xs text-gray-500">
                                    Filtra y selecciona los tanques a despachar.
                                </p>
                            </div>

                            <div class="text-right text-xs text-gray-500 space-y-1">
                                <div>Total encontrados: {{ $tanks->total() }}</div>
                                <div>Seleccionados: <span id="selected-count">0</span></div>
                            </div>
                        </div>

                        <div
                            id="tank-filters-form"
                            data-base-url="{{ route('dispatches.create') }}"
                            class="grid grid-cols-1 md:grid-cols-12 gap-3"
                        >
                            <div class="md:col-span-4">
                                <label for="filter_batch" class="{{ $labelSm }}">Filtrar por lote</label>
                                <input
                                    type="text"
                                    id="filter_batch"
                                    class="{{ $inputSm }}"
                                    value="{{ request('batch') }}"
                                    placeholder="Ej: LT-001"
                                >
                            </div>

                            <div class="md:col-span-4">
                                <label for="filter_serial" class="{{ $labelSm }}">Filtrar por serial</label>
                                <input
                                    type="text"
                                    id="filter_serial"
                                    class="{{ $inputSm }}"
                                    value="{{ request('serial') }}"
                                    placeholder="Ej: OXI-000123"
                                >
                            </div>

                            <div class="md:col-span-4">
                                <label for="filter_capacity_id" class="{{ $labelSm }}">Filtrar por capacidad</label>
                                <select id="filter_capacity_id" class="{{ $selectSm }}">
                                    <option value="">Todas</option>
                                    @foreach($capacities as $capacity)
                                        <option value="{{ $capacity->id }}" @selected((string) request('capacity_id') === (string) $capacity->id)>
                                            {{ $capacity->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-12 flex flex-wrap justify-end gap-2">
                                <button
                                    type="button"
                                    id="clear-tank-filters"
                                    class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50"
                                >
                                    Limpiar filtros
                                </button>

                                <button
                                    type="button"
                                    id="apply-tank-filters"
                                    class="inline-flex items-center px-3 py-2 bg-slate-800 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2"
                                >
                                    Filtrar tanques
                                </button>
                            </div>
                        </div>

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
                            <div>
                                {{ $tanks->links() }}
                            </div>
                        @endif

                        <div id="selected-hidden-inputs"></div>

                        <div class="flex flex-wrap justify-between items-center gap-2 pt-1">
                            <button
                                type="button"
                                id="clear-selected-tanks"
                                class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50"
                            >
                                Limpiar selección
                            </button>

                            <div class="flex justify-end gap-2">
                                <a
                                    href="{{ route('dispatches.index') }}"
                                    class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50"
                                >
                                    Cancelar
                                </a>

                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    Crear despacho
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const docInput = document.getElementById('client_document_lookup');
            const validateBtn = document.getElementById('btn_validate_client');
            const nameInput = document.getElementById('client_name_display');
            const clientIdHidden = document.getElementById('client_id_hidden');
            const okBox = document.getElementById('client_lookup_ok');
            const errorBox = document.getElementById('client_lookup_error');
            const dispatchForm = document.getElementById('dispatch-form');
            const hiddenInputsContainer = document.getElementById('selected-hidden-inputs');
            const countBox = document.getElementById('selected-count');
            const clearSelectedBtn = document.getElementById('clear-selected-tanks');
            const tankCheckboxes = Array.from(document.querySelectorAll('.tank-checkbox'));
            const filtersContainer = document.getElementById('tank-filters-form');
            const applyFiltersBtn = document.getElementById('apply-tank-filters');
            const clearFiltersBtn = document.getElementById('clear-tank-filters');
            const batchFilterInput = document.getElementById('filter_batch');
            const serialFilterInput = document.getElementById('filter_serial');
            const capacityFilterInput = document.getElementById('filter_capacity_id');
            const storageKey = 'dispatch_selected_tank_ids';
            const oldTankIds = @json($selectedOldTankIds);

            const getSelectedIds = () => {
                try {
                    const raw = window.sessionStorage.getItem(storageKey);
                    const parsed = raw ? JSON.parse(raw) : [];
                    return Array.isArray(parsed) ? parsed.map(String) : [];
                } catch (error) {
                    return [];
                }
            };

            const setSelectedIds = (ids) => {
                const uniqueIds = Array.from(new Set(ids.map(String)));
                window.sessionStorage.setItem(storageKey, JSON.stringify(uniqueIds));
                return uniqueIds;
            };

            const renderHiddenInputs = (ids) => {
                hiddenInputsContainer.innerHTML = '';

                ids.forEach((id) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'tank_ids[]';
                    input.value = id;
                    hiddenInputsContainer.appendChild(input);
                });
            };

            const syncVisibleCheckboxes = (ids) => {
                const selected = new Set(ids);
                tankCheckboxes.forEach((checkbox) => {
                    checkbox.checked = selected.has(String(checkbox.value));
                });
            };

            const refreshSelectionUi = () => {
                const ids = getSelectedIds();
                syncVisibleCheckboxes(ids);
                renderHiddenInputs(ids);

                if (countBox) {
                    countBox.textContent = ids.length;
                }
            };

            const updateSelectionFromVisibleCheckboxes = () => {
                const currentIds = new Set(getSelectedIds());

                tankCheckboxes.forEach((checkbox) => {
                    const id = String(checkbox.value);

                    if (checkbox.checked) {
                        currentIds.add(id);
                    } else {
                        currentIds.delete(id);
                    }
                });

                setSelectedIds(Array.from(currentIds));
                refreshSelectionUi();
            };

            if (oldTankIds.length > 0) {
                setSelectedIds(oldTankIds);
            }

            const applyFilters = () => {
                if (!filtersContainer) {
                    return;
                }

                const baseUrl = filtersContainer.dataset.baseUrl || window.location.pathname;
                const params = new URLSearchParams();

                if (batchFilterInput && batchFilterInput.value.trim() !== '') {
                    params.set('batch', batchFilterInput.value.trim());
                }

                if (serialFilterInput && serialFilterInput.value.trim() !== '') {
                    params.set('serial', serialFilterInput.value.trim());
                }

                if (capacityFilterInput && capacityFilterInput.value !== '') {
                    params.set('capacity_id', capacityFilterInput.value);
                }

                const query = params.toString();
                window.location.href = query ? `${baseUrl}?${query}` : baseUrl;
            };

            refreshSelectionUi();

            if (applyFiltersBtn) {
                applyFiltersBtn.addEventListener('click', applyFilters);
            }

            if (clearFiltersBtn && filtersContainer) {
                clearFiltersBtn.addEventListener('click', function () {
                    const baseUrl = filtersContainer.dataset.baseUrl || window.location.pathname;
                    window.location.href = baseUrl;
                });
            }

            [batchFilterInput, serialFilterInput, capacityFilterInput].forEach((element) => {
                if (!element) {
                    return;
                }

                element.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        applyFilters();
                    }
                });
            });

            tankCheckboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', updateSelectionFromVisibleCheckboxes);
            });

            if (clearSelectedBtn) {
                clearSelectedBtn.addEventListener('click', function () {
                    window.sessionStorage.removeItem(storageKey);
                    refreshSelectionUi();
                });
            }

            if (dispatchForm) {
                dispatchForm.addEventListener('submit', function () {
                    renderHiddenInputs(getSelectedIds());
                });
            }

            if (!docInput || !validateBtn || !nameInput || !clientIdHidden || !okBox || !errorBox) {
                return;
            }

            const lookupUrl = docInput.dataset.lookupUrl;

            if (!lookupUrl) {
                console.error('No se encontró data-lookup-url en client_document_lookup');
                return;
            }

            const resetClient = () => {
                nameInput.value = '';
                clientIdHidden.value = '';
                okBox.textContent = '';
                okBox.classList.add('hidden');
                errorBox.classList.add('hidden');
            };

            const showError = () => {
                nameInput.value = '';
                clientIdHidden.value = '';
                okBox.textContent = '';
                okBox.classList.add('hidden');
                errorBox.classList.remove('hidden');
            };

            const showSuccess = (client) => {
                nameInput.value = client.name;
                clientIdHidden.value = client.id;
                okBox.textContent = `Cliente encontrado: ${client.name} (${client.document})`;
                okBox.classList.remove('hidden');
                errorBox.classList.add('hidden');
            };

            const searchClient = async () => {
                const value = (docInput.value || '').trim();

                if (!value) {
                    resetClient();
                    return;
                }

                validateBtn.disabled = true;
                validateBtn.textContent = 'Validando...';

                try {
                    const response = await fetch(`${lookupUrl}?document=${encodeURIComponent(value)}`, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        showError();
                        return;
                    }

                    const data = await response.json();

                    if (data.found && data.client) {
                        showSuccess(data.client);
                    } else {
                        showError();
                    }
                } catch (error) {
                    console.error('Error buscando cliente por documento:', error);
                    showError();
                } finally {
                    validateBtn.disabled = false;
                    validateBtn.textContent = 'Validar';
                }
            };

            validateBtn.addEventListener('click', searchClient);
            docInput.addEventListener('input', resetClient);
        });
    </script>
</x-app-layout>
