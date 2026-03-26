<style>
    * {
        box-sizing: border-box;
    }

    @page {
        margin: 110px 24px 56px 24px;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
        color: #1f2937;
        margin: 0;
    }

    .page-header {
        position: fixed;
        top: -90px;
        left: 0;
        right: 0;
        height: 84px;
        border-bottom: 1px solid #d1d5db;
        padding-bottom: 10px;
    }

    .page-footer {
        position: fixed;
        bottom: -38px;
        left: 0;
        right: 0;
        height: 28px;
        border-top: 1px solid #d1d5db;
        font-size: 9px;
        color: #6b7280;
        padding-top: 6px;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .brand-left {
        float: left;
        width: 55%;
    }

    .brand-right {
        float: right;
        width: 43%;
        text-align: right;
    }

    .brand-table {
        width: 100%;
        border-collapse: collapse;
    }

    .brand-logo-cell {
        width: 110px;
        vertical-align: middle;
        padding: 0 12px 0 0;
    }

    .brand-copy-cell {
        vertical-align: middle;
        padding: 0;
    }

    .logo-wrap {
        width: 100px;
        height: 50px;
        display: block;
        overflow: hidden;
    }

    .logo-wrap img {
        max-width: 120px;
        max-height: 70px;
        width: auto;
        height: auto;
        display: block;
    }

    .logo-fallback {
        width: 100px;
        height: 50px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        text-align: center;
        font-weight: bold;
        color: #0f766e;
        font-size: 14px;
        line-height: 50px;
        background: #ecfeff;
    }

    .brand-copy {
        padding-top: 0;
    }

    .system-name {
        font-size: 18px;
        font-weight: bold;
        color: #0f172a;
        margin: 0 0 3px 0;
        line-height: 1.05;
    }

    .report-name {
        font-size: 11px;
        color: #0f766e;
        font-weight: bold;
        margin: 0;
        line-height: 1.1;
    }

    .meta-table,
    .summary-table,
    .mini-table,
    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .meta-table td {
        font-size: 9px;
        padding: 2px 0 2px 8px;
    }

    .meta-label {
        color: #6b7280;
        width: 38%;
    }

    .meta-value {
        color: #111827;
        font-weight: bold;
    }

    .section {
        margin-bottom: 14px;
    }

    .section-title {
        font-size: 11px;
        font-weight: bold;
        color: #0f172a;
        margin: 0 0 6px 0;
        padding-bottom: 4px;
        border-bottom: 1px solid #e5e7eb;
    }

    .summary-table th,
    .summary-table td,
    .mini-table th,
    .mini-table td,
    .detail-table th,
    .detail-table td {
        padding: 6px 7px;
        vertical-align: top;
    }

    .summary-table th,
    .mini-table th,
    .detail-table th {
        background: #f3f4f6;
        color: #111827;
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: .2px;
        border-bottom: 1px solid #d1d5db;
    }

    .summary-table td,
    .mini-table td,
    .detail-table td {
        border-bottom: 1px solid #e5e7eb;
        font-size: 9px;
    }

    .summary-table td.value-strong {
        font-size: 12px;
        font-weight: bold;
        color: #0f172a;
    }

    .summary-table td.value-soft {
        font-weight: bold;
        color: #0f766e;
    }

    .mini-grid {
        width: 100%;
    }

    .mini-grid .col {
        float: left;
        width: 49%;
    }

    .mini-grid .col + .col {
        margin-left: 2%;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .muted {
        color: #6b7280;
    }

    .badge {
        display: inline-block;
        padding: 2px 6px;
        border: 1px solid #cbd5e1;
        border-radius: 999px;
        font-size: 8px;
        color: #334155;
        background: #f8fafc;
    }

    .totals-strip {
        margin-top: 8px;
        padding: 8px 10px;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 9px;
    }

    .footer-left {
        float: left;
    }

    .footer-right {
        float: right;
    }
</style>
