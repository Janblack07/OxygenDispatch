<x-app-layout>
    <x-slot name="header">
        <div class="technical-edit-header-layout">
            <div>
                <div class="technical-edit-title-row">
                    <h2 class="technical-edit-page-title">
                        Editar ficha técnica
                    </h2>

                    <span class="technical-edit-order-badge">
                        {{ $technicalReception->document_number }}
                    </span>
                </div>

                <p class="technical-edit-page-subtitle">
                    Actualiza los datos generales, checklist y resultado técnico de la recepción.
                </p>
            </div>

            <div class="technical-edit-actions">
                <a
                    href="{{ route('technical-receptions.show', $technicalReception) }}"
                    class="technical-edit-secondary-button"
                >
                    Ver ficha
                </a>

                <a
                    href="{{ route('technical-receptions.index') }}"
                    class="technical-edit-primary-button"
                >
                    Listado
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        .technical-edit-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .technical-edit-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .technical-edit-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .technical-edit-title-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
        }

        .technical-edit-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .technical-edit-order-badge {
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

        .technical-edit-page-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .technical-edit-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .technical-edit-secondary-button,
        .technical-edit-primary-button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 13px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .technical-edit-secondary-button {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
        }

        .technical-edit-secondary-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .technical-edit-primary-button {
            border: 0;
            background: #4f46e5;
            color: #ffffff;
        }

        .technical-edit-primary-button:hover {
            background: #4338ca;
        }

        @media (max-width: 640px) {
            .technical-edit-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .technical-edit-header-layout {
                flex-direction: column;
            }

            .technical-edit-actions {
                width: 100%;
            }

            .technical-edit-secondary-button,
            .technical-edit-primary-button {
                flex: 1;
            }
        }
    </style>

    <div class="technical-edit-page">
        <div class="technical-edit-container">
            @include('technical_receptions._form', [
                'method' => 'PUT',
                'action' => route('technical-receptions.update', $technicalReception),
                'technicalReception' => $technicalReception,
                'items' => $technicalReception->items,
                'batches' => $batches,
                'summary' => $summary,
                'documentNumber' => $technicalReception->document_number,
            ])
        </div>
    </div>
</x-app-layout>
