<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha técnica de recepción</title>

    <style>
        @page {
            margin: 16px 18px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8.5px;
            color: #111;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #111;
            padding: 3px 4px;
            vertical-align: middle;
        }

        .no-border {
            border: none !important;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .title {
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .section {
            background: #d9d9d9;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .subhead {
            background: #eeeeee;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .checkbox {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #111;
            text-align: center;
            line-height: 10px;
            font-size: 8px;
            font-weight: bold;
        }

        .small {
            font-size: 7.5px;
        }

        .row-h {
            height: 17px;
        }

        .signature-box {
            height: 38px;
        }

        .logo-box {
            height: 42px;
            text-align: center;
            font-size: 7px;
        }

        .mt-4 {
            margin-top: 4px;
        }

        .mt-6 {
            margin-top: 6px;
        }
    </style>
</head>

<body>
    @php
        $docItems = $technicalReception->items->where('section', 'Revisión documental')->values();
        $certItems = $technicalReception->items->where('section', 'Certificado de análisis según el tipo de producto')->values();
        $specItems = $technicalReception->items->where('section', 'Especificaciones técnicas según muestreo')->values();

        $firstProduct = ($summary['products'] ?? collect())->first();

        $check = function ($value, $expected) {
            if ($value === null) {
                return '';
            }

            return $value === $expected ? 'X' : '';
        };
    @endphp

    {{-- CABECERA --}}
    <table>
        <tr>
            <td rowspan="3" style="width: 18%;" class="logo-box">
                <strong>OXYGEN DISPATCH</strong><br>
                Sistema de gestión<br>
                de oxígeno medicinal
            </td>

            <td rowspan="3" style="width: 55%;" class="title">
                FICHA TÉCNICA DE RECEPCIÓN DE PRODUCTOS
            </td>

            <td style="width: 27%;" class="center small">
                Página 1 de 1
            </td>
        </tr>

        <tr>
            <td class="center small">
                <strong>CÓDIGO:</strong><br>
                REPRO-RGS-FIC-TEC
            </td>
        </tr>

        <tr>
            <td class="center small">
                <strong>VERSIÓN:</strong><br>
                02
            </td>
        </tr>
    </table>

    {{-- DATOS SUPERIORES --}}
    <table class="mt-4">
        <tr>
            <td style="width: 35%;">
                <strong>FACTURA N.º:</strong>
                {{ $technicalReception->invoice_number ?: '—' }}
            </td>

            <td style="width: 35%;">
                <strong>N.º Guía Remisión #:</strong>
                {{ $technicalReception->remission_guide_number ?: '—' }}
            </td>

            <td style="width: 30%;">
                <strong>Fecha de recepción:</strong>
                {{ $technicalReception->reception_date?->format('Y-m-d') ?: '—' }}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="5" class="section">DATOS GENERALES</td>
        </tr>

        <tr>
            <td style="width: 62%;">
                Verificación de la documentación presentada por el proveedor con la orden de compra/pedido:
                <strong>{{ $technicalReception->document_number }}</strong>
            </td>

            <td style="width: 10%;" class="center bold">CUMPLE:</td>

            <td style="width: 8%;" class="center">
                SI&nbsp;
                <span class="checkbox">{{ $check($technicalReception->documentation_complies, true) }}</span>
            </td>

            <td style="width: 8%;" class="center">
                NO&nbsp;
                <span class="checkbox">{{ $check($technicalReception->documentation_complies, false) }}</span>
            </td>

            <td style="width: 12%;" class="center">
                &nbsp;
            </td>
        </tr>
    </table>

    {{-- REVISION DOCUMENTAL --}}
    <table class="mt-4">
        <tr>
            <td colspan="4" class="section">REVISIÓN DOCUMENTAL</td>
        </tr>

        <tr class="subhead">
            <td style="width: 55%;">DETALLE</td>
            <td style="width: 10%;">SI</td>
            <td style="width: 10%;">NO</td>
            <td style="width: 25%;">OBSERVACIONES</td>
        </tr>

        @foreach($docItems as $item)
            <tr class="row-h">
                <td>{{ $item->label }}</td>
                <td class="center">{{ $item->complies === true ? 'X' : '' }}</td>
                <td class="center">{{ $item->complies === false ? 'X' : '' }}</td>
                <td>{{ $item->observation ?: '' }}</td>
            </tr>
        @endforeach
    </table>

    {{-- CERTIFICADOS --}}
    <table class="mt-4">
        <tr>
            <td colspan="4" class="section">CERTIFICADO DE ANÁLISIS SEGÚN EL TIPO DE PRODUCTO</td>
        </tr>

        <tr class="subhead">
            <td style="width: 55%;">DETALLE</td>
            <td style="width: 10%;">SI</td>
            <td style="width: 10%;">NO</td>
            <td style="width: 25%;">OBSERVACIONES</td>
        </tr>

        @foreach($certItems as $item)
            <tr class="row-h">
                <td>{{ $item->label }}</td>
                <td class="center">{{ $item->complies === true ? 'X' : '' }}</td>
                <td class="center">{{ $item->complies === false ? 'X' : '' }}</td>
                <td>{{ $item->observation ?: '' }}</td>
            </tr>
        @endforeach
    </table>

    {{-- ESPECIFICACIONES --}}
    <table class="mt-4">
        <tr>
            <td colspan="4" class="section">ESPECIFICACIONES TÉCNICAS SEGÚN MUESTREO</td>
        </tr>

        <tr class="subhead">
            <td style="width: 55%;">PARÁMETRO</td>
            <td style="width: 10%;">SI</td>
            <td style="width: 10%;">NO</td>
            <td style="width: 25%;">OBSERVACIONES</td>
        </tr>

        @foreach($specItems as $item)
            <tr class="row-h">
                <td>{{ $item->label }}</td>
                <td class="center">{{ $item->complies === true ? 'X' : '' }}</td>
                <td class="center">{{ $item->complies === false ? 'X' : '' }}</td>
                <td>{{ $item->observation ?: '' }}</td>
            </tr>
        @endforeach
    </table>

    {{-- RESUMEN DE PRODUCTOS --}}
    <table class="mt-4">
        <tr>
            <td colspan="5" class="section">INFORMACIÓN DEL PRODUCTO RECIBIDO SEGÚN SISTEMA</td>
        </tr>

        <tr class="subhead">
            <td>Producto</td>
            <td>Gas</td>
            <td>Capacidad</td>
            <td>Registro sanitario</td>
            <td>Cantidad</td>
        </tr>

        @forelse($summary['products'] ?? [] as $product)
            <tr>
                <td>
                    <strong>{{ $product['code'] ?: '—' }}</strong>
                    {{ $product['detail'] ? ' - '.$product['detail'] : '' }}
                </td>
                <td>{{ $product['gas'] ?: '—' }}</td>
                <td>{{ $product['capacity'] ?: '—' }}</td>
                <td>{{ $product['sanitary_registry'] ?: '—' }}</td>
                <td class="center">{{ $product['quantity'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="center">No hay productos asociados.</td>
            </tr>
        @endforelse

        <tr>
            <td><strong>LOTE/SERIE:</strong> {{ $summary['batch_numbers'] ?: '—' }}</td>
            <td colspan="2"><strong>Fecha elaboración:</strong> {{ $summary['manufactured_dates'] ?: '—' }}</td>
            <td colspan="2"><strong>Fecha expiración:</strong> {{ $summary['expires_dates'] ?: '—' }}</td>
        </tr>

        <tr>
            <td colspan="5">
                <strong>Proveedor:</strong> {{ $technicalReception->supplier_name ?: '—' }}
                &nbsp;&nbsp; | &nbsp;&nbsp;
                <strong>Fabricante/importador:</strong> {{ $technicalReception->manufacturer_name ?: '—' }}
                &nbsp;&nbsp; | &nbsp;&nbsp;
                <strong>Condiciones de almacenamiento:</strong> {{ $technicalReception->storage_conditions ?: '—' }}
            </td>
        </tr>
    </table>

    {{-- INFORME FINAL --}}
    <table class="mt-4">
        <tr>
            <td colspan="4" class="section">
                INFORME FINAL DEL RESPONSABLE TÉCNICO DE APROBACIÓN O RECHAZO
            </td>
        </tr>

        <tr>
            <td rowspan="2" style="width: 22%;" class="center bold">CONCLUSIÓN:</td>

            <td style="width: 20%;">
                Aprobado
            </td>

            <td style="width: 8%;" class="center">
                <span class="checkbox">{{ $technicalReception->final_result === 'aprobado' ? 'X' : '' }}</span>
            </td>

            <td rowspan="2" style="width: 50%;" class="center">
                Firma/sello del Responsable:
                <div class="signature-box"></div>
            </td>
        </tr>

        <tr>
            <td>Rechazado</td>
            <td class="center">
                <span class="checkbox">{{ $technicalReception->final_result === 'rechazado' ? 'X' : '' }}</span>
            </td>
        </tr>

        <tr>
            <td class="bold">Observación final:</td>
            <td colspan="3">
                {{ $technicalReception->responsible_observation ?: '—' }}
            </td>
        </tr>
    </table>

    <table class="mt-4">
        <tr>
            <td style="width: 50%;" class="center">
                <strong>REVISADO POR:</strong><br>
                {{ $technicalReception->responsible_position ?: 'RESPONSABLE TÉCNICO' }}<br>
                {{ $technicalReception->responsible_name ?: '—' }}
            </td>

            <td style="width: 50%;" class="center">
                <strong>Generado por:</strong><br>
                {{ $technicalReception->created_by_user_email ?: '—' }}<br>
                {{ now()->format('Y-m-d H:i') }}
            </td>
        </tr>
    </table>
</body>
</html>
