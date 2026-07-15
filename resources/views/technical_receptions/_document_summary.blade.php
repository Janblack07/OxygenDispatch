@if(($batches ?? collect())->isNotEmpty())
    <section class="technical-summary-card">
        <div class="technical-summary-header">
            <div>
                <h3 class="technical-summary-title">
                    Información encontrada para la orden
                </h3>

                <p class="technical-summary-subtitle">
                    Los datos provienen de los lotes registrados con el mismo número de documento.
                </p>
            </div>

            <span class="technical-summary-count">
                {{ $batches->count() }} lote(s)
            </span>
        </div>

        <div class="technical-summary-body">
            <div class="technical-summary-grid">

                <div class="technical-summary-item">
                    <div class="technical-summary-label">
                        Orden
                    </div>

                    <div class="technical-summary-value">
                        {{ $technicalReception->document_number ?? $documentNumber ?? '—' }}
                    </div>
                </div>

                <div class="technical-summary-item">
                    <div class="technical-summary-label">
                        Lotes
                    </div>

                    <div class="technical-summary-value">
                        {{ $summary['batch_numbers'] ?: '—' }}
                    </div>
                </div>

                <div class="technical-summary-item">
                    <div class="technical-summary-label">
                        Cantidad
                    </div>

                    <div class="technical-summary-value">
                        {{ $summary['quantity_received'] ?? 0 }}
                    </div>
                </div>

                <div class="technical-summary-item">
                    <div class="technical-summary-label">
                        Proveedor
                    </div>

                    <div class="technical-summary-value">
                        {{ $summary['supplier_name'] ?: '—' }}
                    </div>
                </div>

            </div>

            <div class="technical-summary-table-wrapper">
                <table class="technical-summary-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Gas</th>
                            <th>Capacidad</th>
                            <th>Registro sanitario</th>
                            <th style="text-align: right;">Cantidad</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($summary['products'] ?? [] as $product)
                            <tr>
                                <td>
                                    <div class="technical-summary-product-code">
                                        {{ $product['code'] ?: '—' }}
                                    </div>

                                    <div class="technical-summary-product-detail">
                                        {{ $product['detail'] ?: '—' }}
                                    </div>
                                </td>

                                <td>
                                    {{ $product['gas'] ?: '—' }}
                                </td>

                                <td>
                                    {{ $product['capacity'] ?: '—' }}
                                </td>

                                <td>
                                    {{ $product['sanitary_registry'] ?: '—' }}
                                </td>

                                <td style="text-align: right;">
                                    <span class="technical-summary-quantity">
                                        {{ $product['quantity'] }}
                                    </span>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="technical-summary-empty">
                                        Aún no hay tanques o productos generados para esta orden.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@else
    <div class="technical-summary-warning">
        No se encontraron lotes para este número de orden. Verifica que el documento exista en el módulo de lotes.
    </div>
@endif

<style>
    .technical-summary-card {
        overflow: hidden;
        border: 1px solid #c7d2fe;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .technical-summary-card + * {
        margin-top: 18px;
    }

    .technical-summary-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding: 17px 20px;
        border-bottom: 1px solid #e0e7ff;
        background: #eef2ff;
    }

    .technical-summary-title {
        margin: 0;
        color: #312e81;
        font-size: 15px;
        font-weight: 700;
    }

    .technical-summary-subtitle {
        margin: 3px 0 0;
        color: #6366f1;
        font-size: 12px;
        line-height: 1.5;
    }

    .technical-summary-count {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border: 1px solid #c7d2fe;
        border-radius: 999px;
        background: #ffffff;
        color: #4338ca;
        font-size: 11px;
        font-weight: 700;
    }

    .technical-summary-body {
        padding: 20px;
    }

    .technical-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
    }

    .technical-summary-item {
        min-width: 0;
        padding: 13px 14px;
        border: 1px solid #f1f5f9;
        border-radius: 11px;
        background: #f8fafc;
    }

    .technical-summary-label {
        color: #6366f1;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .technical-summary-value {
        margin-top: 5px;
        overflow-wrap: anywhere;
        color: #0f172a;
        font-size: 13px;
        font-weight: 700;
    }

    .technical-summary-table-wrapper {
        margin-top: 16px;
        overflow-x: auto;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }

    .technical-summary-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .technical-summary-table thead {
        background: #f8fafc;
    }

    .technical-summary-table th {
        padding: 11px 13px;
        border-bottom: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .05em;
        text-align: left;
        text-transform: uppercase;
    }

    .technical-summary-table td {
        padding: 12px 13px;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
        font-size: 12px;
        vertical-align: middle;
    }

    .technical-summary-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .technical-summary-product-code {
        color: #0f172a;
        font-weight: 700;
    }

    .technical-summary-product-detail {
        margin-top: 2px;
        color: #94a3b8;
        font-size: 10px;
    }

    .technical-summary-quantity {
        display: inline-flex;
        min-width: 30px;
        align-items: center;
        justify-content: center;
        padding: 5px 8px;
        border: 1px solid #c7d2fe;
        border-radius: 8px;
        background: #eef2ff;
        color: #4338ca;
        font-size: 11px;
        font-weight: 700;
    }

    .technical-summary-empty {
        padding: 34px 15px;
        color: #64748b;
        font-size: 12px;
        text-align: center;
    }

    .technical-summary-warning {
        padding: 14px 16px;
        border: 1px solid #fde68a;
        border-radius: 12px;
        background: #fffbeb;
        color: #92400e;
        font-size: 13px;
        line-height: 1.5;
    }

    @media (max-width: 800px) {
        .technical-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 540px) {
        .technical-summary-header {
            flex-direction: column;
        }

        .technical-summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
