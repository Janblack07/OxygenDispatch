<x-app-layout>
    <x-slot name="header">
        <div
            style="
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            "
        >
            <div>
                <h2
                    style="
                        margin: 0;
                        font-size: 18px;
                        line-height: 1.35;
                        font-weight: 700;
                        color: #0f172a;
                    "
                >
                    Distribuidora de Oxígeno
                </h2>

                <p
                    style="
                        margin: 3px 0 0;
                        font-size: 13px;
                        color: #64748b;
                    "
                >
                    Resumen operativo y estado actual del inventario.
                </p>
            </div>

            <span
                class="hidden sm:inline-flex"
                style="
                    align-items: center;
                    gap: 7px;
                    padding: 7px 10px;
                    border: 1px solid #e2e8f0;
                    border-radius: 999px;
                    background: #ffffff;
                    font-size: 12px;
                    font-weight: 500;
                    color: #475569;
                "
            >
                <span
                    style="
                        width: 7px;
                        height: 7px;
                        border-radius: 999px;
                        background: #10b981;
                    "
                ></span>

                Sistema operativo
            </span>
        </div>
    </x-slot>

    @php
        $tankCards = [
            [
                'label' => 'Disponibles',
                'value' => $counts['disponible'] ?? 0,
                'description' => 'Aprobados y listos para despacho',
                'iconBg' => '#ecfdf5',
                'iconColor' => '#059669',
                'accent' => '#10b981',
                'icon' => 'available',
            ],
            [
                'label' => 'Despachados',
                'value' => $counts['despachado'] ?? 0,
                'description' => 'Actualmente fuera de almacén',
                'iconBg' => '#eff6ff',
                'iconColor' => '#0284c7',
                'accent' => '#0ea5e9',
                'icon' => 'truck',
            ],
            [
                'label' => 'Baja',
                'value' => $counts['baja'] ?? 0,
                'description' => 'Retirados definitivamente',
                'iconBg' => '#fff1f2',
                'iconColor' => '#e11d48',
                'accent' => '#f43f5e',
                'icon' => 'warning',
            ],
            [
                'label' => 'Cuarentena',
                'value' => $counts['tanques_cuarentena'] ?? 0,
                'description' => 'Unidades temporalmente aisladas',
                'iconBg' => '#fffbeb',
                'iconColor' => '#d97706',
                'accent' => '#f59e0b',
                'icon' => 'quarantine',
            ],
            [
                'label' => 'Pendientes técnicos',
                'value' => $counts['tanques_pendientes_tecnicos'] ?? 0,
                'description' => 'Esperando revisión y aprobación',
                'iconBg' => '#f5f3ff',
                'iconColor' => '#7c3aed',
                'accent' => '#8b5cf6',
                'icon' => 'pending',
            ],
            [
                'label' => 'Rechazados / retiro',
                'value' => $counts['tanques_rechazados'] ?? 0,
                'description' => 'En devolución o retiro de mercado',
                'iconBg' => '#fef2f2',
                'iconColor' => '#dc2626',
                'accent' => '#ef4444',
                'icon' => 'rejected',
            ],
        ];

        $operationCards = [
            [
                'label' => 'Despachos realizados',
                'value' => $counts['despachos_realizados'] ?? 0,
                'description' => 'Total histórico de operaciones',
                'iconBg' => '#eff6ff',
                'iconColor' => '#2563eb',
                'icon' => 'calendar',
            ],
            [
                'label' => 'Tanques despachados total',
                'value' => $counts['tanques_despachados_total'] ?? 0,
                'description' => 'Unidades movilizadas históricamente',
                'iconBg' => '#ecfeff',
                'iconColor' => '#0891b2',
                'icon' => 'cylinder',
            ],
            [
                'label' => 'Despachos hoy',
                'value' => $counts['despachos_hoy'] ?? 0,
                'description' => 'Operaciones realizadas hoy',
                'iconBg' => '#ecfdf5',
                'iconColor' => '#059669',
                'icon' => 'clock',
            ],
            [
                'label' => 'Tanques despachados hoy',
                'value' => $counts['tanques_despachados_hoy'] ?? 0,
                'description' => 'Unidades movilizadas hoy',
                'iconBg' => '#ecfeff',
                'iconColor' => '#0891b2',
                'icon' => 'cylinder',
            ],
            [
                'label' => 'Clientes atendidos',
                'value' => $counts['clientes_atendidos'] ?? 0,
                'description' => 'Clientes con al menos un despacho',
                'iconBg' => '#fdf4ff',
                'iconColor' => '#c026d3',
                'icon' => 'users',
            ],
            [
                'label' => 'Movimientos total',
                'value' => $counts['movimientos_total'] ?? 0,
                'description' => 'Registros de trazabilidad',
                'iconBg' => '#f8fafc',
                'iconColor' => '#475569',
                'icon' => 'clipboard',
            ],
            [
                'label' => 'Lotes registrados',
                'value' => $counts['lotes_registrados'] ?? 0,
                'description' => 'Lotes existentes en el sistema',
                'iconBg' => '#fff7ed',
                'iconColor' => '#ea580c',
                'icon' => 'box',
            ],
        ];
    @endphp

    <div
        style="
            padding: 26px 16px 34px;
            background: #f8fafc;
            min-height: calc(100vh - 128px);
        "
    >
        <div
            style="
                width: 100%;
                max-width: 1180px;
                margin: 0 auto;
            "
        >
            {{-- Aviso pendientes técnicos --}}
            @if(($counts['tanques_pendientes_tecnicos'] ?? 0) > 0)
                <div
                    style="
                        margin-bottom: 18px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 16px;
                        padding: 14px 16px;
                        border: 1px solid #fde68a;
                        border-radius: 14px;
                        background: #fffbeb;
                    "
                >
                    <div
                        style="
                            display: flex;
                            align-items: flex-start;
                            gap: 12px;
                        "
                    >
                        <div
                            style="
                                width: 38px;
                                height: 38px;
                                flex-shrink: 0;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 11px;
                                background: #fef3c7;
                                color: #d97706;
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                style="width: 20px; height: 20px;"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                                />
                            </svg>
                        </div>

                        <div>
                            <div
                                style="
                                    font-size: 14px;
                                    font-weight: 700;
                                    color: #92400e;
                                "
                            >
                                Revisión técnica pendiente
                            </div>

                            <div
                                style="
                                    margin-top: 3px;
                                    font-size: 13px;
                                    line-height: 1.5;
                                    color: #a16207;
                                "
                            >
                                Hay
                                <strong>{{ $counts['tanques_pendientes_tecnicos'] }}</strong>
                                tanque(s) esperando revisión y aprobación técnica.
                            </div>
                        </div>
                    </div>

                    <a
                        href="{{ route('technical-receptions.index') }}"
                        style="
                            flex-shrink: 0;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            padding: 9px 13px;
                            border-radius: 10px;
                            background: #d97706;
                            color: #ffffff;
                            font-size: 12px;
                            font-weight: 700;
                            text-decoration: none;
                        "
                    >
                        Ir a recepción
                    </a>
                </div>
            @endif

            {{-- Estado actual --}}
            <section
                style="
                    overflow: hidden;
                    border: 1px solid #e2e8f0;
                    border-radius: 16px;
                    background: #ffffff;
                    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
                "
            >
                <div
                    style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 16px;
                        padding: 18px 20px;
                        border-bottom: 1px solid #f1f5f9;
                    "
                >
                    <div>
                        <h3
                            style="
                                margin: 0;
                                font-size: 16px;
                                font-weight: 700;
                                color: #0f172a;
                            "
                        >
                            Estado actual de tanques
                        </h3>

                        <p
                            style="
                                margin: 4px 0 0;
                                font-size: 12px;
                                color: #64748b;
                            "
                        >
                            Resumen de disponibilidad, revisión técnica y estado operativo.
                        </p>
                    </div>

                    <span
                        class="hidden sm:inline"
                        style="
                            font-size: 12px;
                            font-weight: 500;
                            color: #64748b;
                        "
                    >
                        Resumen operativo
                    </span>
                </div>

                <div style="padding: 18px;">
                    <div
                        style="
                            display: grid;
                            grid-template-columns: repeat(3, minmax(0, 1fr));
                            gap: 14px;
                        "
                        class="dashboard-grid"
                    >
                        @foreach($tankCards as $card)
                            <article
                                style="
                                    position: relative;
                                    overflow: hidden;
                                    min-height: 118px;
                                    padding: 18px;
                                    border: 1px solid #e2e8f0;
                                    border-radius: 14px;
                                    background: #ffffff;
                                    box-shadow: 0 1px 2px rgba(15, 23, 42, 0.03);
                                "
                            >
                                <div
                                    style="
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        width: 4px;
                                        height: 100%;
                                        background: {{ $card['accent'] }};
                                    "
                                ></div>

                                <div
                                    style="
                                        display: flex;
                                        align-items: center;
                                        gap: 14px;
                                    "
                                >
                                    <div
                                        style="
                                            width: 46px;
                                            height: 46px;
                                            flex-shrink: 0;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            border-radius: 13px;
                                            background: {{ $card['iconBg'] }};
                                            color: {{ $card['iconColor'] }};
                                        "
                                    >
                                        @switch($card['icon'])
                                            @case('available')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4m4-6h.01M12 7h.01M16 7h.01"/>
                                                </svg>
                                                @break

                                            @case('truck')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0zM3 17V6a1 1 0 011-1h11a1 1 0 011 1v11M14 7h4l3 4v6h-2M14 17H9"/>
                                                </svg>
                                                @break

                                            @case('warning')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                                </svg>
                                                @break

                                            @case('quarantine')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                @break

                                            @case('pending')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L15 12l-5.25-5"/>
                                                </svg>
                                                @break

                                            @default
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 24px; height: 24px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                        @endswitch
                                    </div>

                                    <div style="min-width: 0;">
                                        <div
                                            style="
                                                font-size: 12px;
                                                font-weight: 500;
                                                color: #64748b;
                                            "
                                        >
                                            {{ $card['label'] }}
                                        </div>

                                        <div
                                            style="
                                                margin-top: 2px;
                                                font-size: 30px;
                                                line-height: 1;
                                                font-weight: 750;
                                                color: #0f172a;
                                            "
                                        >
                                            {{ number_format((int) $card['value']) }}
                                        </div>
                                    </div>
                                </div>

                                <p
                                    style="
                                        margin: 13px 0 0;
                                        font-size: 11px;
                                        line-height: 1.45;
                                        color: #94a3b8;
                                    "
                                >
                                    {{ $card['description'] }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Operación y trazabilidad --}}
            <section
                style="
                    margin-top: 20px;
                    overflow: hidden;
                    border: 1px solid #e2e8f0;
                    border-radius: 16px;
                    background: #ffffff;
                    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
                "
            >
                <div
                    style="
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 16px;
                        padding: 18px 20px;
                        border-bottom: 1px solid #f1f5f9;
                    "
                >
                    <div>
                        <h3
                            style="
                                margin: 0;
                                font-size: 16px;
                                font-weight: 700;
                                color: #0f172a;
                            "
                        >
                            Operación y trazabilidad
                        </h3>

                        <p
                            style="
                                margin: 4px 0 0;
                                font-size: 12px;
                                color: #64748b;
                            "
                        >
                            Indicadores acumulados de despachos, clientes y movimientos.
                        </p>
                    </div>

                    <span
                        class="hidden sm:inline"
                        style="
                            font-size: 12px;
                            font-weight: 500;
                            color: #64748b;
                        "
                    >
                        Indicadores generales
                    </span>
                </div>

                <div style="padding: 18px;">
                    <div
                        class="dashboard-grid"
                        style="
                            display: grid;
                            grid-template-columns: repeat(3, minmax(0, 1fr));
                            gap: 14px;
                        "
                    >
                        @foreach($operationCards as $card)
                            <article
                                style="
                                    min-height: 105px;
                                    padding: 17px;
                                    border: 1px solid #e2e8f0;
                                    border-radius: 14px;
                                    background: #ffffff;
                                "
                            >
                                <div
                                    style="
                                        display: flex;
                                        align-items: center;
                                        gap: 13px;
                                    "
                                >
                                    <div
                                        style="
                                            width: 44px;
                                            height: 44px;
                                            flex-shrink: 0;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            border-radius: 12px;
                                            background: {{ $card['iconBg'] }};
                                            color: {{ $card['iconColor'] }};
                                        "
                                    >
                                        @switch($card['icon'])
                                            @case('calendar')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 23px; height: 23px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10m-11 8h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                @break

                                            @case('cylinder')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 23px; height: 23px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"/>
                                                </svg>
                                                @break

                                            @case('clock')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 23px; height: 23px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                                </svg>
                                                @break

                                            @case('users')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 23px; height: 23px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5V4H2v16h5m10 0v-5a3 3 0 00-3-3H10a3 3 0 00-3 3v5m10 0H7m8-12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                @break

                                            @case('clipboard')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 23px; height: 23px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 3h6v4H9V3z"/>
                                                </svg>
                                                @break

                                            @default
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 23px; height: 23px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                                </svg>
                                        @endswitch
                                    </div>

                                    <div style="min-width: 0;">
                                        <div
                                            style="
                                                font-size: 12px;
                                                font-weight: 500;
                                                color: #64748b;
                                            "
                                        >
                                            {{ $card['label'] }}
                                        </div>

                                        <div
                                            style="
                                                margin-top: 2px;
                                                font-size: 28px;
                                                line-height: 1;
                                                font-weight: 750;
                                                color: #0f172a;
                                            "
                                        >
                                            {{ number_format((int) $card['value']) }}
                                        </div>
                                    </div>
                                </div>

                                <p
                                    style="
                                        margin: 12px 0 0;
                                        font-size: 11px;
                                        color: #94a3b8;
                                    "
                                >
                                    {{ $card['description'] }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Responsive --}}
    <style>
        @media (max-width: 900px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
        }

        @media (max-width: 640px) {
            .dashboard-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-app-layout>
