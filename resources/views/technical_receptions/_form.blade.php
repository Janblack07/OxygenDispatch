@php
    $isEdit = ($method ?? 'POST') === 'PUT';
@endphp

<style>
    .technical-form-stack {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .technical-form-errors {
        padding: 13px 15px;
        border: 1px solid #fecaca;
        border-radius: 12px;
        background: #fef2f2;
        color: #991b1b;
        font-size: 12px;
    }

    .technical-form-errors-title {
        margin: 0;
        font-weight: 700;
    }

    .technical-form-errors ul {
        margin: 6px 0 0;
        padding-left: 18px;
    }

    .technical-form-card {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .technical-form-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .technical-form-card-title {
        margin: 0;
        color: #0f172a;
        font-size: 15px;
        font-weight: 700;
    }

    .technical-form-card-subtitle {
        margin: 3px 0 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .technical-form-card-body {
        padding: 20px;
    }

    .technical-form-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .technical-form-col-2 {
        grid-column: span 2;
    }

    .technical-form-col-4 {
        grid-column: span 4;
    }

    .technical-form-label {
        display: block;
        margin-bottom: 6px;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
    }

    .technical-form-control {
        width: 100%;
        min-height: 42px;
        box-sizing: border-box;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        background: #ffffff;
        padding: 9px 12px;
        color: #0f172a;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
        transition:
            border-color .15s ease,
            box-shadow .15s ease;
    }

    textarea.technical-form-control {
        min-height: 88px;
        resize: vertical;
    }

    .technical-form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
    }

    .technical-form-control[readonly] {
        background: #f8fafc;
        color: #475569;
        cursor: not-allowed;
    }

    .technical-checklist-sections {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .technical-checklist-section {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .technical-checklist-section-header {
        padding: 12px 15px;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .technical-checklist-section-title {
        margin: 0;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .technical-checklist-table-wrapper {
        overflow-x: auto;
    }

    .technical-checklist-table {
        width: 100%;
        min-width: 820px;
        border-collapse: collapse;
    }

    .technical-checklist-table thead {
        background: #ffffff;
    }

    .technical-checklist-table th {
        padding: 11px 13px;
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .05em;
        text-align: left;
        text-transform: uppercase;
    }

    .technical-checklist-table td {
        padding: 12px 13px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
        font-size: 12px;
        vertical-align: top;
    }

    .technical-checklist-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .technical-checklist-radio {
        width: 17px;
        height: 17px;
        margin: 1px 0 0;
        cursor: pointer;
    }

    .technical-checklist-radio.yes {
        accent-color: #059669;
    }

    .technical-checklist-radio.no {
        accent-color: #dc2626;
    }

    .technical-form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        padding-top: 4px;
    }

    .technical-form-cancel-button,
    .technical-form-submit-button {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .technical-form-cancel-button {
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
    }

    .technical-form-cancel-button:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .technical-form-submit-button {
        border: 0;
        background: #4f46e5;
        color: #ffffff;
        font-family: inherit;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.14);
    }

    .technical-form-submit-button:hover {
        background: #4338ca;
    }

    @media (max-width: 900px) {
        .technical-form-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .technical-form-col-2,
        .technical-form-col-4 {
            grid-column: span 2;
        }
    }

    @media (max-width: 640px) {
        .technical-form-grid {
            grid-template-columns: 1fr;
        }

        .technical-form-col-2,
        .technical-form-col-4 {
            grid-column: span 1;
        }

        .technical-form-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .technical-form-cancel-button,
        .technical-form-submit-button {
            width: 100%;
        }
    }
</style>

<form
    method="POST"
    action="{{ $action }}"
    class="technical-form-stack"
>
    @csrf

    @if($isEdit)
        @method('PUT')
    @endif

    @if($errors->any())
        <div class="technical-form-errors">
            <p class="technical-form-errors-title">
                Revisa los campos del formulario.
            </p>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Datos generales --}}
    <section class="technical-form-card">
        <div class="technical-form-card-header">
            <h3 class="technical-form-card-title">
                Datos generales de la recepción
            </h3>

            <p class="technical-form-card-subtitle">
                El número de orden corresponde al documento registrado en los lotes.
            </p>
        </div>

        <div class="technical-form-card-body">
            <div class="technical-form-grid">

                <div>
                    <label
                        for="document_number"
                        class="technical-form-label"
                    >
                        Número de orden
                    </label>

                    <input
                        type="text"
                        id="document_number"
                        name="document_number"
                        value="{{ old(
                            'document_number',
                            $technicalReception->document_number ?? $documentNumber
                        ) }}"
                        class="technical-form-control"
                        {{ $isEdit ? 'readonly' : '' }}
                        required
                    >
                </div>

                <div>
                    <label
                        for="reception_date"
                        class="technical-form-label"
                    >
                        Fecha de recepción
                    </label>

                    <input
                        type="date"
                        id="reception_date"
                        name="reception_date"
                        value="{{ old(
                            'reception_date',
                            optional($technicalReception->reception_date)->format('Y-m-d')
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div>
                    <label
                        for="invoice_number"
                        class="technical-form-label"
                    >
                        Factura / comprobante
                    </label>

                    <input
                        type="text"
                        id="invoice_number"
                        name="invoice_number"
                        value="{{ old(
                            'invoice_number',
                            $technicalReception->invoice_number
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div>
                    <label
                        for="remission_guide_number"
                        class="technical-form-label"
                    >
                        Guía de remisión
                    </label>

                    <input
                        type="text"
                        id="remission_guide_number"
                        name="remission_guide_number"
                        value="{{ old(
                            'remission_guide_number',
                            $technicalReception->remission_guide_number
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div class="technical-form-col-2">
                    <label
                        for="supplier_name"
                        class="technical-form-label"
                    >
                        Proveedor
                    </label>

                    <input
                        type="text"
                        id="supplier_name"
                        name="supplier_name"
                        value="{{ old(
                            'supplier_name',
                            $technicalReception->supplier_name
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div class="technical-form-col-2">
                    <label
                        for="manufacturer_name"
                        class="technical-form-label"
                    >
                        Fabricante / importador
                    </label>

                    <input
                        type="text"
                        id="manufacturer_name"
                        name="manufacturer_name"
                        value="{{ old(
                            'manufacturer_name',
                            $technicalReception->manufacturer_name
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div>
                    <label
                        for="delivered_by"
                        class="technical-form-label"
                    >
                        Entregado por
                    </label>

                    <input
                        type="text"
                        id="delivered_by"
                        name="delivered_by"
                        value="{{ old(
                            'delivered_by',
                            $technicalReception->delivered_by
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div>
                    <label
                        for="received_by"
                        class="technical-form-label"
                    >
                        Recibido por
                    </label>

                    <input
                        type="text"
                        id="received_by"
                        name="received_by"
                        value="{{ old(
                            'received_by',
                            $technicalReception->received_by
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div>
                    <label
                        for="quantity_received"
                        class="technical-form-label"
                    >
                        Cantidad recibida
                    </label>

                    <input
                        type="number"
                        min="0"
                        id="quantity_received"
                        name="quantity_received"
                        value="{{ old(
                            'quantity_received',
                            $technicalReception->quantity_received ?? 0
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div>
                    <label
                        for="final_result"
                        class="technical-form-label"
                    >
                        Resultado final
                    </label>

                    <select
                        id="final_result"
                        name="final_result"
                        class="technical-form-control"
                        required
                    >
                        <option
                            value="pendiente"
                            @selected(
                                old(
                                    'final_result',
                                    $technicalReception->final_result
                                ) === 'pendiente'
                            )
                        >
                            Pendiente
                        </option>

                        <option
                            value="aprobado"
                            @selected(
                                old(
                                    'final_result',
                                    $technicalReception->final_result
                                ) === 'aprobado'
                            )
                        >
                            Aprobado
                        </option>

                        <option
                            value="rechazado"
                            @selected(
                                old(
                                    'final_result',
                                    $technicalReception->final_result
                                ) === 'rechazado'
                            )
                        >
                            Rechazado
                        </option>
                    </select>
                </div>

                <div class="technical-form-col-4">
                    <label
                        for="storage_conditions"
                        class="technical-form-label"
                    >
                        Condiciones de almacenamiento
                    </label>

                    <textarea
                        id="storage_conditions"
                        name="storage_conditions"
                        rows="3"
                        class="technical-form-control"
                    >{{ old(
                        'storage_conditions',
                        $technicalReception->storage_conditions
                    ) }}</textarea>
                </div>

            </div>
        </div>
    </section>

    @include('technical_receptions._document_summary', [
        'batches' => $batches,
        'summary' => $summary,
        'technicalReception' => $technicalReception,
        'documentNumber' => $documentNumber ?? null,
    ])

    {{-- Checklist --}}
    <section class="technical-form-card">
        <div class="technical-form-card-header">
            <h3 class="technical-form-card-title">
                Checklist de recepción
            </h3>

            <p class="technical-form-card-subtitle">
                Marca Sí o No según la verificación realizada y registra observaciones cuando corresponda.
            </p>
        </div>

        <div class="technical-form-card-body">
            @php
                $groupedItems = collect(
                    old('items', $items->toArray() ?? [])
                )->groupBy('section');

                $index = 0;
            @endphp

            <div class="technical-checklist-sections">
                @foreach($groupedItems as $section => $sectionItems)
                    <div class="technical-checklist-section">
                        <div class="technical-checklist-section-header">
                            <h4 class="technical-checklist-section-title">
                                {{ $section }}
                            </h4>
                        </div>

                        <div class="technical-checklist-table-wrapper">
                            <table class="technical-checklist-table">
                                <thead>
                                    <tr>
                                        <th style="width: 45%;">
                                            Criterio
                                        </th>

                                        <th style="width: 10%; text-align: center;">
                                            Sí
                                        </th>

                                        <th style="width: 10%; text-align: center;">
                                            No
                                        </th>

                                        <th>
                                            Observación
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($sectionItems as $item)
                                        @php
                                            $itemArray = is_array($item)
                                                ? $item
                                                : (array) $item;

                                            $complies = old(
                                                "items.$index.complies",
                                                $itemArray['complies'] ?? null
                                            );
                                        @endphp

                                        <tr>
                                            <td>
                                                {{ $itemArray['label'] ?? '' }}

                                                <input
                                                    type="hidden"
                                                    name="items[{{ $index }}][section]"
                                                    value="{{ $section }}"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="items[{{ $index }}][label]"
                                                    value="{{ $itemArray['label'] ?? '' }}"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="items[{{ $index }}][sort_order]"
                                                    value="{{ $itemArray['sort_order'] ?? $index + 1 }}"
                                                >
                                            </td>

                                            <td style="text-align: center;">
                                                <input
                                                    type="radio"
                                                    name="items[{{ $index }}][complies]"
                                                    value="1"
                                                    @checked((string) $complies === '1')
                                                    class="technical-checklist-radio yes"
                                                >
                                            </td>

                                            <td style="text-align: center;">
                                                <input
                                                    type="radio"
                                                    name="items[{{ $index }}][complies]"
                                                    value="0"
                                                    @checked((string) $complies === '0')
                                                    class="technical-checklist-radio no"
                                                >
                                            </td>

                                            <td>
                                                <input
                                                    type="text"
                                                    name="items[{{ $index }}][observation]"
                                                    value="{{ old(
                                                        "items.$index.observation",
                                                        $itemArray['observation'] ?? ''
                                                    ) }}"
                                                    class="technical-form-control"
                                                    placeholder="Observación"
                                                >
                                            </td>
                                        </tr>

                                        @php
                                            $index++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Responsable técnico --}}
    <section class="technical-form-card">
        <div class="technical-form-card-header">
            <h3 class="technical-form-card-title">
                Responsable técnico
            </h3>

            <p class="technical-form-card-subtitle">
                Información del profesional responsable de la revisión.
            </p>
        </div>

        <div class="technical-form-card-body">
            <div class="technical-form-grid">

                <div class="technical-form-col-2">
                    <label
                        for="responsible_name"
                        class="technical-form-label"
                    >
                        Nombre del responsable
                    </label>

                    <input
                        type="text"
                        id="responsible_name"
                        name="responsible_name"
                        value="{{ old(
                            'responsible_name',
                            $technicalReception->responsible_name
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div class="technical-form-col-2">
                    <label
                        for="responsible_position"
                        class="technical-form-label"
                    >
                        Cargo
                    </label>

                    <input
                        type="text"
                        id="responsible_position"
                        name="responsible_position"
                        value="{{ old(
                            'responsible_position',
                            $technicalReception->responsible_position
                        ) }}"
                        class="technical-form-control"
                    >
                </div>

                <div class="technical-form-col-4">
                    <label
                        for="responsible_observation"
                        class="technical-form-label"
                    >
                        Observación / informe final
                    </label>

                    <textarea
                        id="responsible_observation"
                        name="responsible_observation"
                        rows="3"
                        class="technical-form-control"
                    >{{ old(
                        'responsible_observation',
                        $technicalReception->responsible_observation
                    ) }}</textarea>
                </div>

            </div>

            <div
                class="technical-form-footer"
                style="margin-top: 18px; padding-top: 18px; border-top: 1px solid #f1f5f9;"
            >
                <a
                    href="{{ route('technical-receptions.index') }}"
                    class="technical-form-cancel-button"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="technical-form-submit-button"
                >
                    Guardar ficha
                </button>
            </div>
        </div>
    </section>

</form>
