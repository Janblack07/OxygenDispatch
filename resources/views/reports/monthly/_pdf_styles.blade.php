<style>
    * {
        box-sizing: border-box;
    }

    @page {
        margin: 82px 18px 38px 18px;
    }

    body {
        margin: 0;
        font-family: DejaVu Sans, sans-serif;
        font-size: 8px;
        line-height: 1.25;
        color: #111827;
        background: #ffffff;
    }

    /*
    |--------------------------------------------------------------------------
    | Encabezado y pie
    |--------------------------------------------------------------------------
    */

    .pdf-header {
        position: fixed;
        top: -66px;
        left: 0;
        right: 0;
        height: 58px;
        padding-bottom: 7px;
        border-bottom: 1.5px solid #0f766e;
    }

    .pdf-footer {
        position: fixed;
        bottom: -27px;
        left: 0;
        right: 0;
        height: 22px;
        padding-top: 5px;
        border-top: 1px solid #d1d5db;
        color: #6b7280;
        font-size: 7px;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .header-left {
        float: left;
        width: 60%;
    }

    .header-right {
        float: right;
        width: 38%;
        text-align: right;
    }

    .brand-table,
    .meta-table,
    .report-table,
    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .brand-logo-cell {
        width: 78px;
        padding: 0 10px 0 0;
        vertical-align: middle;
    }

    .brand-text-cell {
        padding: 0;
        vertical-align: middle;
    }

    .logo-wrap {
        width: 68px;
        height: 42px;
        overflow: hidden;
    }

    .logo-wrap img {
        display: block;
        max-width: 82px;
        max-height: 50px;
        width: auto;
        height: auto;
    }

    .logo-fallback {
        width: 66px;
        height: 38px;
        border: 1px solid #d1d5db;
        color: #111827;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 38px;
    }

    .company-title {
        margin: 0;
        color: #111827;
        font-size: 16px;
        line-height: 1;
        font-weight: bold;
    }

    .report-title {
        margin: 4px 0 0;
        color: #0f766e;
        font-size: 9.5px;
        line-height: 1.15;
        font-weight: bold;
    }

    .report-note {
        margin: 3px 0 0;
        color: #6b7280;
        font-size: 6.8px;
        line-height: 1.25;
    }

    .meta-table td {
        padding: 1px 0 2px 8px;
        font-size: 7.2px;
        line-height: 1.3;
        vertical-align: top;
    }

    .meta-label {
        width: 42%;
        color: #6b7280;
    }

    .meta-value {
        color: #111827;
        font-weight: bold;
    }

    .footer-left {
        float: left;
    }

    .footer-right {
        float: right;
    }

    /*
    |--------------------------------------------------------------------------
    | Secciones
    |--------------------------------------------------------------------------
    */

    .section {
        margin-bottom: 9px;
        page-break-inside: avoid;
    }

    .section-title {
        margin: 0 0 5px;
        padding: 0 0 4px;
        border-bottom: 1px solid #d1d5db;
        color: #111827;
        font-size: 9px;
        line-height: 1.2;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: .18px;
    }

    .section-subtitle {
        margin: -2px 0 5px;
        color: #6b7280;
        font-size: 7px;
    }

    /*
    |--------------------------------------------------------------------------
    | Tablas formales
    |--------------------------------------------------------------------------
    */

    .report-table {
        border: 1px solid #d1d5db;
    }

    .report-table th {
        padding: 4px 6px;
        border-bottom: 1px solid #cbd5e1;
        background: #f3f4f6;
        color: #374151;
        font-size: 6.8px;
        font-weight: bold;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .15px;
    }

    .report-table td {
        padding: 5px 6px;
        border-bottom: 1px solid #e5e7eb;
        color: #111827;
        font-size: 7.5px;
        vertical-align: middle;
    }

    .report-table tr:last-child td {
        border-bottom: 0;
    }

    .label-cell {
        color: #6b7280;
        font-size: 6.8px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: .12px;
    }

    .value-cell {
        color: #111827;
        font-size: 8.8px;
        font-weight: bold;
    }

    .value-important {
        color: #0f766e;
        font-weight: bold;
    }

    .value-warning {
        color: #92400e;
        font-weight: bold;
    }

    .value-danger {
        color: #991b1b;
        font-weight: bold;
    }

    /*
    |--------------------------------------------------------------------------
    | Dos columnas
    |--------------------------------------------------------------------------
    */

    .two-columns {
        width: 100%;
    }

    .two-columns .column {
        float: left;
        width: 49%;
    }

    .two-columns .column + .column {
        margin-left: 2%;
    }

    /*
    |--------------------------------------------------------------------------
    | Tabla detalle
    |--------------------------------------------------------------------------
    */

    .detail-table {
        table-layout: fixed;
        border-top: 1px solid #cbd5e1;
        border-bottom: 1px solid #cbd5e1;
    }

    .detail-table thead {
        display: table-header-group;
    }

    .detail-table th {
        padding: 4px 3px;
        border-top: 1px solid #cbd5e1;
        border-bottom: 1px solid #cbd5e1;
        background: #f3f4f6;
        color: #111827;
        font-size: 6.25px;
        line-height: 1.1;
        font-weight: bold;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .1px;
        vertical-align: middle;
    }

    .detail-table td {
        padding: 4px 3px;
        border-bottom: 1px solid #e5e7eb;
        color: #1f2937;
        font-size: 6.55px;
        line-height: 1.15;
        vertical-align: top;
        word-wrap: break-word;
    }

    .detail-table tbody tr:nth-child(even) td {
        background: #fbfbfb;
    }

    .detail-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /*
    |--------------------------------------------------------------------------
    | Anchos
    |--------------------------------------------------------------------------
    */

    .w-date {
        width: 8%;
    }

    .w-lote {
        width: 9.2%;
    }

    .w-serial {
        width: 9.2%;
    }

    .w-gas {
        width: 11.5%;
    }

    .w-cap {
        width: 6%;
    }

    .w-m3 {
        width: 4.3%;
    }

    .w-exp {
        width: 7.2%;
    }

    .w-reg {
        width: 7.4%;
    }

    .w-area {
        width: 8.5%;
    }

    .w-status {
        width: 7.2%;
    }

    .w-order {
        width: 9.5%;
    }

    /*
    |--------------------------------------------------------------------------
    | Utilidades
    |--------------------------------------------------------------------------
    */

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .muted {
        color: #6b7280;
    }

    .strong {
        color: #111827;
        font-weight: bold;
    }

    .status-approved {
        color: #111827;
        font-weight: bold;
    }

    .status-pending {
        color: #111827;
        font-weight: bold;
    }

    .status-rejected {
        color: #111827;
        font-weight: bold;
    }

    .expiration-ok {
        color: #111827;
        font-weight: bold;
    }

    .expiration-warning {
        color: #92400e;
        font-weight: bold;
    }

    .expiration-expired {
        color: #991b1b;
        font-weight: bold;
    }

    .expiration-empty {
        color: #6b7280;
    }

    .totals-strip {
        margin-top: 6px;
        padding: 6px 8px;
        border: 1px solid #d1d5db;
        border-left: 3px solid #0f766e;
        background: #f9fafb;
        color: #1f2937;
        font-size: 7.3px;
        line-height: 1.35;
    }

    .criteria-note {
        margin-top: 5px;
        padding: 5px 7px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
        color: #374151;
        font-size: 7px;
        line-height: 1.35;
    }

    .document-note {
        margin-top: 6px;
        padding-top: 5px;
        border-top: 1px dashed #d1d5db;
        color: #6b7280;
        font-size: 6.8px;
        line-height: 1.35;
    }
</style>
