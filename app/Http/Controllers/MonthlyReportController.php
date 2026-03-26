<?php

namespace App\Http\Controllers;

use App\Enums\EntityType;
use App\Enums\MovementType;
use App\Models\Dispatch;
use App\Models\InventoryMovement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class MonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        [$month, $year] = $this->resolveMonthYear($request);

        $entries = InventoryMovement::query()
            ->where('type', MovementType::ENTRADA)
            ->whereYear('occurred_at', $year)
            ->whereMonth('occurred_at', $month)
            ->with([
                'tankUnit:id,serial,gas_type_id,capacity_id,technical_status_id,sanitary_registry,product_id',
                'tankUnit.gasType:id,name',
                'tankUnit.capacity:id,name,m3',
                'batch:id,batch_number,document_number',
                'toArea:id,name',
            ])
            ->orderBy('occurred_at')
            ->get();

        $dispatches = Dispatch::query()
            ->whereYear('dispatched_at', $year)
            ->whereMonth('dispatched_at', $month)
            ->with([
                'client:id,name,document,entity_type',
                'lines:id,dispatch_id,tank_unit_id',
                'lines.tankUnit:id,serial,batch_id,gas_type_id,capacity_id',
                'lines.tankUnit.batch:id,batch_number',
                'lines.tankUnit.gasType:id,name',
                'lines.tankUnit.capacity:id,name,m3',
            ])
            ->orderBy('dispatched_at')
            ->get();

        $entriesSummary = $this->buildEntriesSummary($entries);
        $exitsSummary = $this->buildExitsSummary($dispatches);

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
                'tankUnit.capacity:id,name,m3',
                'tankUnit.technicalStatus:id,name',
                'tankUnit.product:id,sanitary_registry',
                'batch:id,batch_number,document_number',
                'toArea:id,name',
            ])
            ->orderBy('occurred_at')
            ->get();

        $summary = $this->buildEntriesSummary($entries);

        $data = [
            'month' => $month,
            'year' => $year,
            'title' => 'Reporte mensual de entradas',
            'generatedAt' => now(),
            'generatedBy' => Auth::user()?->email ?? 'Sistema',
            'entries' => $entries,
            'summary' => $summary,
            'logoBase64' => $this->resolveLogoForPdf(),
        ];

        $pdf = Pdf::loadView('reports.monthly.pdf_entries', $data)->setPaper('a4', 'landscape');

        return $pdf->download('reporte-entradas-' . $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '.pdf');
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
                'lines.tankUnit.capacity:id,name,m3',
            ])
            ->orderBy('dispatched_at');

        if ($entityType !== null && $entityType !== '') {
            $query->where('entity_type', (int) $entityType);
        }

        $dispatches = $query->get();

        $entityEnum = $entityType !== null && $entityType !== ''
            ? EntityType::tryFrom((int) $entityType)
            : null;

        $summary = $this->buildExitsSummary($dispatches, $entityEnum);

        $data = [
            'month' => $month,
            'year' => $year,
            'title' => 'Reporte mensual de salidas',
            'generatedAt' => now(),
            'generatedBy' => Auth::user()?->email ?? 'Sistema',
            'dispatches' => $dispatches,
            'summary' => $summary,
            'entityFilterLabel' => $summary['filter_label'],
            'logoBase64' => $this->resolveLogoForPdf(),
        ];

        $suffix = $entityEnum
            ? str($entityEnum->label())->lower()->replace(' ', '-')->replace('/', '-')->toString()
            : 'general';

        $pdf = Pdf::loadView('reports.monthly.pdf_exits', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->download('reporte-salidas-' . $suffix . '-' . $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '.pdf');
    }

    private function buildEntriesSummary(Collection $entries): array
    {
        $totalM3 = $entries->sum(fn ($entry) => (float) ($entry->tankUnit?->capacity?->m3 ?? 0));

        $byArea = $entries
            ->groupBy(fn ($entry) => $entry->to_area_id ?: 'sin-area')
            ->map(function (Collection $items) {
                $first = $items->first();

                return (object) [
                    'label' => $first?->toArea?->name ?? 'Sin área destino',
                    'total_movements' => $items->count(),
                    'total_tanks' => $items->count(),
                    'total_m3' => $items->sum(fn ($entry) => (float) ($entry->tankUnit?->capacity?->m3 ?? 0)),
                ];
            })
            ->sortByDesc('total_m3')
            ->values();

        $byGas = $entries
            ->groupBy(fn ($entry) => $entry->tankUnit?->gas_type_id ?: 'sin-gas')
            ->map(function (Collection $items) {
                $first = $items->first();

                return (object) [
                    'label' => $first?->tankUnit?->gasType?->name ?? 'Sin tipo de gas',
                    'total_tanks' => $items->count(),
                    'total_m3' => $items->sum(fn ($entry) => (float) ($entry->tankUnit?->capacity?->m3 ?? 0)),
                ];
            })
            ->sortByDesc('total_m3')
            ->values();

        $byCapacity = $entries
            ->groupBy(fn ($entry) => $entry->tankUnit?->capacity_id ?: 'sin-capacidad')
            ->map(function (Collection $items) {
                $first = $items->first();

                return (object) [
                    'label' => $first?->tankUnit?->capacity?->name ?? 'Sin capacidad',
                    'total_tanks' => $items->count(),
                    'total_m3' => $items->sum(fn ($entry) => (float) ($entry->tankUnit?->capacity?->m3 ?? 0)),
                ];
            })
            ->sortByDesc('total_m3')
            ->values();

        $mainArea = $byArea->first();

        return [
            'total_movements' => $entries->count(),
            'total_tanks' => $entries->count(),
            'total_m3' => $totalM3,
            'distinct_batches' => $entries->pluck('batch_id')->filter()->unique()->count(),
            'main_area_label' => $mainArea?->label ?? '—',
            'main_area_m3' => (float) ($mainArea?->total_m3 ?? 0),
            'by_area' => $byArea,
            'by_gas' => $byGas,
            'by_capacity' => $byCapacity,
        ];
    }

    private function buildExitsSummary(Collection $dispatches, ?EntityType $entityEnum = null): array
    {
        $allLines = $dispatches->flatMap(fn ($dispatch) => $dispatch->lines);
        $totalM3 = $allLines->sum(fn ($line) => (float) ($line->tankUnit?->capacity?->m3 ?? 0));

        $byEntityType = $dispatches
            ->groupBy(fn ($dispatch) => (string) $this->resolveDispatchEntityTypeValue($dispatch))
            ->map(function (Collection $groupedDispatches, string $entityValue) use ($totalM3) {
                $groupLines = $groupedDispatches->flatMap(fn ($dispatch) => $dispatch->lines);
                $groupM3 = (float) $groupLines->sum(fn ($line) => (float) ($line->tankUnit?->capacity?->m3 ?? 0));

                return (object) [
                    'entity_type' => $entityValue,
                    'label' => $this->resolveEntityTypeLabel($entityValue),
                    'total_dispatches' => $groupedDispatches->count(),
                    'total_tanks' => $groupLines->count(),
                    'total_m3' => $groupM3,
                    'percentage_m3' => $totalM3 > 0 ? ($groupM3 / $totalM3) * 100 : 0,
                ];
            })
            ->sortByDesc('total_m3')
            ->values();

        return [
            'total_dispatches' => $dispatches->count(),
            'total_tanks' => $allLines->count(),
            'total_m3' => $totalM3,
            'total_clients' => $dispatches->pluck('client_id')->filter()->unique()->count(),
            'filter_label' => $entityEnum?->label() ?? 'General',
            'by_entity_type' => $byEntityType,
        ];
    }

    private function resolveDispatchEntityTypeValue($dispatch): int
    {
        $enum = $dispatch->entity_type ?: $dispatch->client?->entity_type;

        if ($enum instanceof EntityType) {
            return $enum->value;
        }

        return (int) ($enum ?: EntityType::NO_AFILIADO_APOYO->value);
    }

    private function resolveEntityTypeLabel(string|int|null $value): string
    {
        $enum = EntityType::tryFrom((int) $value);

        return $enum?->label() ?? 'No definido';
    }

    private function resolveMonthYear(Request $request): array
    {
        $month = (int) ($request->input('month') ?: now()->month);
        $year = (int) ($request->input('year') ?: now()->year);

        $month = max(1, min(12, $month));

        return [$month, $year];
    }
    private function resolveLogoForPdf(): ?string
{
    $logoUrl = 'https://res.cloudinary.com/dv2gulc60/image/upload/v1772404076/OxigenDispatch/Logo_Distribuidora_tmn7yp.png';

    try {
        $image = @file_get_contents($logoUrl);

        if ($image === false) {
            return null;
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->buffer($image) ?: 'image/png';

        return 'data:' . $mime . ';base64,' . base64_encode($image);
    } catch (\Throwable $e) {
        return null;
    }
}
}
