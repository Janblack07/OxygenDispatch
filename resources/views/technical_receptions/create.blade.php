<x-app-layout>
    <x-slot name="header">
        <div class="technical-form-header-layout">
            <div>
                <h2 class="technical-form-page-title">
                    Nueva ficha técnica
                </h2>

                <p class="technical-form-page-subtitle">
                    La ficha se genera a partir del número de orden registrado en los lotes.
                </p>
            </div>

            <a
                href="{{ route('technical-receptions.index') }}"
                class="technical-form-back-button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                    />
                </svg>

                Volver
            </a>
        </div>
    </x-slot>

    <style>
        .technical-form-page {
            min-height: calc(100vh - 128px);
            padding: 26px 16px 36px;
            background: #f8fafc;
        }

        .technical-form-container {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
        }

        .technical-form-header-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .technical-form-page-title {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .technical-form-page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .technical-form-back-button {
            flex-shrink: 0;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #ffffff;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .technical-form-back-button:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .technical-form-back-button svg {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 640px) {
            .technical-form-page {
                padding-left: 12px;
                padding-right: 12px;
            }

            .technical-form-header-layout {
                flex-direction: column;
            }

            .technical-form-back-button {
                width: 100%;
            }
        }
    </style>

    <div class="technical-form-page">
        <div class="technical-form-container">
            @include('technical_receptions._form', [
                'method' => 'POST',
                'action' => route('technical-receptions.store'),
                'technicalReception' => $technicalReception,
                'items' => $items,
                'batches' => $batches,
                'summary' => $summary,
                'documentNumber' => $documentNumber,
            ])
        </div>
    </div>
</x-app-layout>
