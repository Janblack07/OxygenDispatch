<?php

namespace App\Http\Controllers;

use App\Enums\EntityType;
use App\Enums\MovementType;
use App\Models\Dispatch;
use App\Models\InventoryMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $month = (int) ($request->input('month') ?: now()->month);
        $year = (int) ($request->input('year') ?: now()->year);

        $entryQuery = InventoryMovement::query()
            ->where('type', MovementType::ENTRADA)
            ->whereYear('occurred_at', $year)
            ->whereMonth('occurred_at', $month);

        $entriesSummary = [
            'total_movements' => (clone $entryQuery)->count(),
            'total_tanks' => (clone $entryQuery)->count(),
            'by_area' => (clone $entryQuery)
                ->selectRaw('to_area_id, COUNT(*) as total')
                ->with('toArea:id,name')
                ->groupBy('to_area_id')
                ->get(),
            'by_batch' => (clone $entryQuery)
                ->selectRaw('batch_id, COUNT(*) as total')
                ->with('batch:id,batch_number')
                ->groupBy('batch_id')
                ->get(),
        ];

        $exitBaseQuery = Dispatch::query()
            ->with(['client:id,name,document,entity_type'])
            ->whereYear('dispatched_at', $year)
            ->whereMonth('dispatched_at', $month);

        $exitsSummary = [
            'total_dispatches' => (clone $exitBaseQuery)->count(),
            'total_tanks' => (clone $exitBaseQuery)->withCount('lines')->get()->sum('lines_count'),
            'by_entity_type' => (clone $exitBaseQuery)
                ->selectRaw('entity_type, COUNT(*) as total_dispatches')
                ->groupBy('entity_type')
                ->get()
                ->map(function ($row) {
                    $enum = $row->entity_type instanceof EntityType
                        ? $row->entity_type
                        : ($row->entity_type ? EntityType::tryFrom((int) $row->entity_type) : null);

                    return (object) [
                        'entity_type' => $row->entity_type,
                        'label' => $enum?->label() ?? '—',
                        'total_dispatches' => $row->total_dispatches,
                    ];
                }),
        ];

        return view('reports.monthly.index', compact(
            'month',
            'year',
            'entriesSummary',
            'exitsSummary'
        ));
    }

    public function entriesPdf(Request $request)
    {
        [$month, $year] = $this->resolveMonthYear($request);

        $entries = InventoryMovement::query()
            ->where('type', MovementType::ENTRADA)
            ->whereYear('occurred_at', $year)
            ->whereMonth('occurred_at', $month)
            ->with([
                'tankUnit:id,serial,gas_type_id,capacity_id,technical_status_id,sanitary_registry,product_id',
                'tankUnit.gasType:id,name',
                'tankUnit.capacity:id,name',
                'tankUnit.technicalStatus:id,name',
                'tankUnit.product:id,sanitary_registry',
                'batch:id,batch_number,document_number',
                'toArea:id,name',
            ])
            ->orderBy('occurred_at')
            ->get();

        $summary = [
            'total_movements' => $entries->count(),
            'total_tanks' => $entries->count(),
        ];

        $data = [
            'month' => $month,
            'year' => $year,
            'title' => 'Reporte mensual de entradas',
            'generatedAt' => now(),
            'generatedBy' => Auth::user()?->email ?? 'Sistema',
            'entries' => $entries,
            'summary' => $summary,
        ];

        $pdf = Pdf::loadView('reports.monthly.pdf_entries', $data)->setPaper('a4', 'landscape');

        return $pdf->download("reporte-entradas-{$year}-" . str_pad($month, 2, '0', STR_PAD_LEFT) . ".pdf");
    }

    public function exitsPdf(Request $request)
{
    [$month, $year] = $this->resolveMonthYear($request);
    $entityType = $request->input('entity_type');

    $query = Dispatch::query()
        ->whereYear('dispatched_at', $year)
        ->whereMonth('dispatched_at', $month)
        ->with([
            'client:id,name,document,entity_type',
            'lines:id,dispatch_id,tank_unit_id',
            'lines.tankUnit:id,serial,batch_id,gas_type_id,capacity_id',
            'lines.tankUnit.batch:id,batch_number',
            'lines.tankUnit.gasType:id,name',
            'lines.tankUnit.capacity:id,name',
        ])
        ->orderBy('dispatched_at');

    if ($entityType !== null && $entityType !== '') {
        $query->where('entity_type', (int) $entityType);
    }

    $dispatches = $query->get();

    $entityEnum = $entityType !== null && $entityType !== ''
        ? \App\Enums\EntityType::tryFrom((int) $entityType)
        : null;

    $summary = [
        'total_dispatches' => $dispatches->count(),
        'total_tanks' => $dispatches->sum(fn ($d) => $d->lines->count()),
        'filter_label' => $entityEnum?->label() ?? 'General',
    ];

    $data = [
        'month' => $month,
        'year' => $year,
        'title' => 'Reporte mensual de salidas',
        'generatedAt' => now(),
        'generatedBy' => Auth::user()?->email ?? 'Sistema',
        'dispatches' => $dispatches,
        'summary' => $summary,
        'entityFilterLabel' => $entityEnum?->label() ?? 'General',
    ];

    $suffix = $entityEnum
        ? str($entityEnum->label())->lower()->replace(' ', '-')->replace('/', '-')->toString()
        : 'general';

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.monthly.pdf_exits', $data)
        ->setPaper('a4', 'landscape');

    return $pdf->download("reporte-salidas-{$suffix}-{$year}-" . str_pad($month, 2, '0', STR_PAD_LEFT) . ".pdf");
}

    private function resolveMonthYear(Request $request): array
    {
        $month = (int) ($request->input('month') ?: now()->month);
        $year = (int) ($request->input('year') ?: now()->year);

        $month = max(1, min(12, $month));

        return [$month, $year];
    }
}
