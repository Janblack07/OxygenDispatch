<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CylinderCapacity;
use App\Models\Dispatch;
use App\Models\GasType;
use App\Models\TankUnit;
use App\Models\TechnicalStatus;
use App\Models\WarehouseArea;
use App\Services\DispatchService;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    public function __construct(
        private readonly DispatchService $dispatchService
    ) {}

    public function index()
    {
        $dispatches = Dispatch::with(['client'])
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('dispatches.index', compact('dispatches'));
    }

    public function create(Request $request)
    {
        $clients = Client::query()
            ->select(['id', 'name', 'document'])
            ->whereNotNull('document')
            ->orderBy('document')
            ->get();

        $capacities = CylinderCapacity::query()
            ->orderBy('name')
            ->get();

        $tanks = TankUnit::query()
            ->with([
                'batch:id,batch_number,document_number',
                'gasType',
                'capacity',
                'warehouseArea',
                'technicalStatus',
            ])
            ->dispatchable()
            ->when($request->filled('batch'), function ($query) use ($request) {
                $batch = trim((string) $request->input('batch'));

                $query->whereHas('batch', function ($batchQuery) use ($batch) {
                    $batchQuery
                        ->where('batch_number', 'like', "%{$batch}%")
                        ->orWhere('document_number', 'like', "%{$batch}%");
                });
            })
            ->when($request->filled('serial'), function ($query) use ($request) {
                $serial = trim((string) $request->input('serial'));

                $query->where('serial', 'like', "%{$serial}%");
            })
            ->when($request->filled('capacity_id'), function ($query) use ($request) {
                $query->where(
                    'capacity_id',
                    $request->integer('capacity_id')
                );
            })
            ->orderBy('created_at', 'asc')
            ->paginate(15)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('dispatches.partials.tanks_table', compact('tanks'))->render(),
                'total' => $tanks->total(),
            ]);
        }

        return view(
            'dispatches.create',
            compact(
                'clients',
                'tanks',
                'capacities'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => [
                'nullable',
                'integer',
                'exists:clients,id',
            ],

            'dispatched_at' => [
                'required',
                'date',
            ],

            /*
             * Este campo ya no se toma desde el formulario.
             * Se calcula automáticamente desde los lotes de los tanques.
             */
            'document_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'remission_plate' => [
                'nullable',
                'string',
                'max:50',
            ],

            'voucher_type' => [
                'nullable',
                'string',
                'max:50',
            ],

            'voucher_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'remission_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'tank_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'tank_ids.*' => [
                'required',
                'string',
                'exists:tank_units,id',
            ],
        ]);

        $tankIds = array_values(
            array_unique($data['tank_ids'])
        );

        /*
         * Documento automático:
         *
         * Toma todas las órdenes / notas de entrega
         * desde los lotes asociados a los tanques seleccionados.
         *
         * Si todos los tanques vienen de la misma orden:
         * 42974328-HY
         *
         * Si vienen de varias:
         * 42974328-HY, 42974329-HY
         */
        $data['document_number'] = $this->buildDocumentNumberFromTankIds($tankIds);

        $client = ! empty($data['client_id'])
            ? Client::find($data['client_id'])
            : null;

        $data['entity_type'] = $client?->entity_type?->value;

        $dispatch = $this->dispatchService->createDispatch(
            collect($data)->except(['tank_ids'])->toArray(),
            $tankIds,
            $request->user()->email
        );

        return redirect()
            ->route('dispatches.show', $dispatch)
            ->with('success', 'Despacho creado.');
    }

    public function createByQuantity()
    {
        return view('dispatches.create_by_quantity', [
            'clients' => Client::query()
                ->select(['id', 'name', 'document'])
                ->whereNotNull('document')
                ->orderBy('document')
                ->get(),

            'gasTypes' => GasType::orderBy('name')->get(),

            'capacities' => CylinderCapacity::orderBy('name')->get(),

            'areas' => WarehouseArea::orderBy('name')->get(),

            'techStatuses' => TechnicalStatus::orderBy('name')->get(),
        ]);
    }

    public function storeByQuantity(Request $request)
    {
        $data = $request->validate([
            'client_id' => [
                'nullable',
                'integer',
                'exists:clients,id',
            ],

            'dispatched_at' => [
                'required',
                'date',
            ],

            /*
             * En despacho por cantidad también se ignora el valor manual
             * y se sincroniza después de crear el despacho.
             */
            'document_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'remission_plate' => [
                'nullable',
                'string',
                'max:50',
            ],

            'voucher_type' => [
                'nullable',
                'string',
                'max:50',
            ],

            'voucher_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'remission_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],

            'gas_type_id' => [
                'nullable',
                'integer',
                'exists:gas_types,id',
            ],

            'capacity_id' => [
                'nullable',
                'integer',
                'exists:cylinder_capacities,id',
            ],

            'warehouse_area_id' => [
                'nullable',
                'integer',
                'exists:warehouse_areas,id',
            ],

            'technical_status_id' => [
                'nullable',
                'integer',
                'exists:technical_statuses,id',
            ],
        ]);

        $client = ! empty($data['client_id'])
            ? Client::find($data['client_id'])
            : null;

        $data['entity_type'] = $client?->entity_type?->value;

        /*
         * Valor temporal. Después de crear el despacho se recalcula
         * usando los tanques realmente asignados por el servicio.
         */
        $data['document_number'] = 'N/S';

        $filters = [
            'gas_type_id' => $data['gas_type_id'] ?? null,
            'capacity_id' => $data['capacity_id'] ?? null,
            'warehouse_area_id' => $data['warehouse_area_id'] ?? null,
            'technical_status_id' => $data['technical_status_id'] ?? null,
        ];

        $dispatch = $this->dispatchService->createDispatchByQuantity(
            collect($data)->except([
                'quantity',
                'gas_type_id',
                'capacity_id',
                'warehouse_area_id',
                'technical_status_id',
            ])->toArray(),
            (int) $data['quantity'],
            $filters,
            $request->user()->email
        );

        $this->syncDocumentNumberFromDispatchTanks($dispatch);

        return redirect()
            ->route('dispatches.show', $dispatch)
            ->with('success', 'Despacho creado por cantidad.');
    }

    public function show(Dispatch $dispatch)
    {
        $dispatch->load([
            'client',
            'lines.tankUnit.gasType',
            'lines.tankUnit.capacity',
            'lines.tankUnit.batch',
        ]);

        return view('dispatches.show', compact('dispatch'));
    }

    private function buildDocumentNumberFromTankIds(array $tankIds): string
    {
        $documentNumbers = TankUnit::query()
            ->with('batch:id,batch_number,document_number')
            ->whereIn('id', $tankIds)
            ->get()
            ->pluck('batch.document_number')
            ->filter(fn($documentNumber) => filled($documentNumber))
            ->map(fn($documentNumber) => trim((string) $documentNumber))
            ->filter()
            ->unique()
            ->values();

        if ($documentNumbers->isEmpty()) {
            return 'N/S';
        }

        return $documentNumbers->implode(', ');
    }

    private function syncDocumentNumberFromDispatchTanks(Dispatch $dispatch): void
    {
        $dispatch->loadMissing([
            'lines.tankUnit.batch',
        ]);

        $documentNumbers = $dispatch->lines
            ->pluck('tankUnit.batch.document_number')
            ->filter(fn($documentNumber) => filled($documentNumber))
            ->map(fn($documentNumber) => trim((string) $documentNumber))
            ->filter()
            ->unique()
            ->values();

        $dispatch->forceFill([
            'document_number' => $documentNumbers->isNotEmpty()
                ? $documentNumbers->implode(', ')
                : 'N/S',
        ])->save();
    }
}
