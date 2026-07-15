<x-app-layout>
    @php
        $finalResultStyle = match($technicalReception->final_result) {
            'aprobado' => '
                border: 1px solid #a7f3d0;
                background: #ecfdf5;
                color: #065f46;
            ',

            'rechazado' => '
                border: 1px solid #fecaca;
                background: #fef2f2;
                color: #991b1b;
            ',

            default => '
                border: 1px solid #fde68a;
                background: #fffbeb;
                color: #92400e;
            ',
        };
    @endphp

    <x-slot name="header">
        <div class="technical-show-header">
            <div>
                <div class="technical-show-title-row">
                    <h2 class="technical-show-page-title">
                        Ficha técnica de recepción
                    </h2>

                    <span class="technical-show-order-badge">
                        {{ $technicalReception->document_number }}
                    </span>
                </div>

                <p class="technical-show-page-subtitle">
                    Información documental, checklist, revisión técnica y PDF firmado.
                </p>
            </div>

            <div class="technical-show-actions">
                <a
                    href="{{ route('technical-receptions.pdf', $technicalReception) }}"
                    target="_blank"
                    class="technical-show-button pdf"
                >
                    PDF generado
                </a>

                @if($technicalReception->signed_pdf_path)
                    <a
                        href="{{ asset('storage/' . $technicalReception->signed_pdf_path) }}"
                        target="_blank"
                        class="technical-show-button signed"
                    >
                        PDF firmado
                    </a>
                @endif

                <a
                    href="{{ route('technical-receptions.edit', $technicalReception) }}"
                    class="technical-show-button edit"
                >
                    Editar
                </a>

                <a
                    href="{{ route('technical-receptions.tank-reviews.index', $technicalReception) }}"
                    class="technical-show-button review"
                >
                    Revisar tanques
                </a>

                <a
                    href="{{ route('technical-receptions.index') }}"
                    class="technical-show-button back"
                >
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        .technical-show-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .technical-show-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .technical-show-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .technical-show-title-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
        }

        .technical-show-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .technical-show-order-badge {
            display: inline-flex;
            align-items: center;
            min-height: 27px;
            padding: 0 10px;
            border: 1px solid #c7d2fe;
            border-radius: 999px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 11px;
            font-weight: 700;
        }

        .technical-show-page-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .technical-show-actions {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 7px;
        }

        .technical-show-button {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
        }

        .technical-show-button.pdf {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        .technical-show-button.signed {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #047857;
        }

        .technical-show-button.edit {
            border: 1px solid #c7d2fe;
            background: #eef2ff;
            color: #4338ca;
        }

        .technical-show-button.review {
            border: 1px solid #fde68a;
            background: #fffbeb;
            color: #b45309;
        }

        .technical-show-button.back {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .technical-show-alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #a7f3d0;
            border-radius: 12px;
            background: #ecfdf5;
            color: #065f46;
            font-size: 13px;
        }

        .technical-show-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .technical-show-card + .technical-show-card,
        .technical-show-card + .technical-summary-card,
        .technical-summary-card + .technical-show-card {
            margin-top: 18px;
        }

        .technical-show-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .technical-show-card-body {
            padding: 20px;
        }

        .technical-show-section-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .technical-show-section-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .technical-show-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .technical-show-info-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .technical-show-info-item {
            min-width: 0;
            padding: 13px 14px;
            border: 1px solid #f1f5f9;
            border-radius: 11px;
            background: #f8fafc;
        }

        .technical-show-info-item.span-2 {
            grid-column: span 2;
        }

        .technical-show-info-item.span-4 {
            grid-column: span 4;
        }

        .technical-show-info-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .technical-show-info-value {
            margin-top: 5px;
            overflow-wrap: anywhere;
            color: #0f172a;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }

        .technical-show-checklist-section {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .technical-show-checklist-section + .technical-show-checklist-section {
            margin-top: 15px;
        }

        .technical-show-checklist-header {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .technical-show-checklist-title {
            margin: 0;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .technical-show-table-wrapper {
            overflow-x: auto;
        }

        .technical-show-table {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse;
        }

        .technical-show-table th {
            padding: 11px 13px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            text-align: left;
            text-transform: uppercase;
        }

        .technical-show-table td {
            padding: 12px 13px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 12px;
            vertical-align: middle;
        }

        .technical-show-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .technical-show-compliance-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
        }

        .technical-signed-status {
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.55;
        }

        .technical-signed-status.success {
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }

        .technical-signed-status.pending {
            border: 1px solid #fde68a;
            background: #fffbeb;
            color: #92400e;
        }

        .technical-signed-view-button {
            margin-top: 10px;
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border: 0;
            border-radius: 9px;
            background: #059669;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
        }

        .technical-upload-grid {
            margin-top: 16px;
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 12px;
            align-items: end;
        }

        .technical-upload-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .technical-upload-control {
            width: 100%;
            min-height: 42px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            padding: 7px 10px;
            color: #475569;
            font-family: inherit;
            font-size: 12px;
        }

        .technical-upload-help {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 10px;
        }

        .technical-upload-button {
            width: 100%;
            min-height: 42px;
            border: 0;
            border-radius: 10px;
            background: #0f172a;
            color: #ffffff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        @media (max-width: 900px) {
            .technical-show-header {
                flex-direction: column;
            }

            .technical-show-actions {
                justify-content: flex-start;
            }

            .technical-show-info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .technical-show-info-item.span-4 {
                grid-column: span 2;
            }
        }

        @media (max-width: 640px) {
            .technical-show-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .technical-show-actions {
                width: 100%;
            }

            .technical-show-button {
                flex: 1;
            }

            .technical-show-info-grid {
                grid-template-columns: 1fr;
            }

            .technical-show-info-item.span-2,
            .technical-show-info-item.span-4 {
                grid-column: span 1;
            }

            .technical-upload-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="technical-show-page">
        <div class="technical-show-container">

            @if(session('success'))
                <div class="technical-show-alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Datos generales --}}
            <section class="technical-show-card">
                <div class="technical-show-card-header">
                    <div>
                        <h3 class="technical-show-section-title">
                            Datos generales
                        </h3>

                        <p class="technical-show-section-subtitle">
                            Información registrada para la recepción técnica.
                        </p>
                    </div>

                    <span
                        class="technical-show-status-badge"
                        style="{{ $finalResultStyle }}"
                    >
                        {{ ucfirst($technicalReception->final_result) }}
                    </span>
                </div>

                <div class="technical-show-card-body">
                    <div class="technical-show-info-grid">

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Orden</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->document_number }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Fecha recepción</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->reception_date?->format('Y-m-d') ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Factura</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->invoice_number ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Guía remisión</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->remission_guide_number ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item span-2">
                            <div class="technical-show-info-label">Proveedor</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->supplier_name ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item span-2">
                            <div class="technical-show-info-label">Fabricante / importador</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->manufacturer_name ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Entregado por</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->delivered_by ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Recibido por</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->received_by ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Cantidad recibida</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->quantity_received }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">Creado por</div>
                            <div class="technical-show-info-value">
                                {{ $technicalReception->created_by_user_email ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item span-4">
                            <div class="technical-show-info-label">
                                Condiciones de almacenamiento
                            </div>

                            <div class="technical-show-info-value">
                                {!! nl2br(e($technicalReception->storage_conditions ?: '—')) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            @include('technical_receptions._document_summary', [
                'batches' => $batches,
                'summary' => $summary,
                'technicalReception' => $technicalReception,
            ])

            {{-- Checklist --}}
            <section class="technical-show-card">
                <div class="technical-show-card-header">
                    <div>
                        <h3 class="technical-show-section-title">
                            Checklist
                        </h3>

                        <p class="technical-show-section-subtitle">
                            Resultado de los criterios verificados durante la recepción.
                        </p>
                    </div>
                </div>

                <div class="technical-show-card-body">
                    @foreach($technicalReception->items->groupBy('section') as $section => $sectionItems)
                        <div class="technical-show-checklist-section">
                            <div class="technical-show-checklist-header">
                                <h4 class="technical-show-checklist-title">
                                    {{ $section }}
                                </h4>
                            </div>

                            <div class="technical-show-table-wrapper">
                                <table class="technical-show-table">
                                    <thead>
                                        <tr>
                                            <th>Criterio</th>
                                            <th style="text-align: center;">Cumple</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($sectionItems as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->label }}
                                                </td>

                                                <td style="text-align: center;">
                                                    @if($item->complies === true)
                                                        <span
                                                            class="technical-show-compliance-badge"
                                                            style="
                                                                border: 1px solid #a7f3d0;
                                                                background: #ecfdf5;
                                                                color: #065f46;
                                                            "
                                                        >
                                                            Sí
                                                        </span>
                                                    @elseif($item->complies === false)
                                                        <span
                                                            class="technical-show-compliance-badge"
                                                            style="
                                                                border: 1px solid #fecaca;
                                                                background: #fef2f2;
                                                                color: #991b1b;
                                                            "
                                                        >
                                                            No
                                                        </span>
                                                    @else
                                                        <span
                                                            class="technical-show-compliance-badge"
                                                            style="
                                                                border: 1px solid #e2e8f0;
                                                                background: #f8fafc;
                                                                color: #64748b;
                                                            "
                                                        >
                                                            —
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $item->observation ?: '—' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- PDF firmado --}}
            <section class="technical-show-card">
                <div class="technical-show-card-header">
                    <div>
                        <h3 class="technical-show-section-title">
                            PDF firmado y sellado
                        </h3>

                        <p class="technical-show-section-subtitle">
                            Documento final firmado y sellado por el responsable técnico.
                        </p>
                    </div>
                </div>

                <div class="technical-show-card-body">
                    @if($technicalReception->signed_pdf_path)
                        <div class="technical-signed-status success">
                            <strong>PDF firmado cargado correctamente.</strong>

                            <div style="margin-top: 4px;">
                                Subido por:
                                {{ $technicalReception->signed_pdf_uploaded_by ?: '—' }}
                            </div>

                            <div>
                                Fecha:
                                {{ $technicalReception->signed_pdf_uploaded_at?->format('Y-m-d H:i') ?: '—' }}
                            </div>

                            <a
                                href="{{ asset('storage/' . $technicalReception->signed_pdf_path) }}"
                                target="_blank"
                                class="technical-signed-view-button"
                            >
                                Ver PDF firmado
                            </a>
                        </div>
                    @else
                        <div class="technical-signed-status pending">
                            Todavía no se ha subido el PDF firmado.
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('technical-receptions.upload-signed-pdf', $technicalReception) }}"
                        enctype="multipart/form-data"
                        class="technical-upload-grid"
                    >
                        @csrf

                        <div>
                            <label class="technical-upload-label">
                                PDF firmado
                            </label>

                            <input
                                type="file"
                                name="signed_pdf"
                                accept="application/pdf"
                                required
                                class="technical-upload-control"
                            >

                            <p class="technical-upload-help">
                                Formato permitido: PDF. Tamaño máximo: 10 MB.
                            </p>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="technical-upload-button"
                            >
                                Subir PDF
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            {{-- Responsable --}}
            <section class="technical-show-card">
                <div class="technical-show-card-header">
                    <div>
                        <h3 class="technical-show-section-title">
                            Responsable técnico
                        </h3>

                        <p class="technical-show-section-subtitle">
                            Profesional responsable de la revisión y resultado final.
                        </p>
                    </div>
                </div>

                <div class="technical-show-card-body">
                    <div class="technical-show-info-grid">

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">
                                Nombre
                            </div>

                            <div class="technical-show-info-value">
                                {{ $technicalReception->responsible_name ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">
                                Cargo
                            </div>

                            <div class="technical-show-info-value">
                                {{ $technicalReception->responsible_position ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item">
                            <div class="technical-show-info-label">
                                Fecha
                            </div>

                            <div class="technical-show-info-value">
                                {{ $technicalReception->updated_at?->format('Y-m-d H:i') ?: '—' }}
                            </div>
                        </div>

                        <div class="technical-show-info-item span-4">
                            <div class="technical-show-info-label">
                                Observación final
                            </div>

                            <div class="technical-show-info-value">
                                {!! nl2br(e($technicalReception->responsible_observation ?: '—')) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
