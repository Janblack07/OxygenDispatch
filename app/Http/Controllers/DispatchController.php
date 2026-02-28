<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Dispatch;
use App\Models\TankUnit;
use App\Models\GasType;
use App\Models\CylinderCapacity;
use App\Models\WarehouseArea;
use App\Models\TechnicalStatus;
use App\Services\DispatchService;

class DispatchController extends Controller
{
    public function __construct(private readonly DispatchService $dispatchService) {}

    public function index()
    {
        $dispatches = Dispatch::with(['client'])->orderBy('id','desc')->paginate(15);
        return view('dispatches.index', compact('dispatches'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();

        $tanks = TankUnit::with(['gasType','capacity','warehouseArea','technicalStatus'])
            ->where('status', 1)
            ->orderBy('created_at','asc')
            ->limit(200)
            ->get();

        return view('dispatches.create', compact('clients','tanks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => ['nullable','integer','exists:clients,id'],
            'dispatched_at' => ['required','date'],
            'document_number' => ['nullable','string','max:100'],
            'entity_type' => ['nullable','integer','in:1,2'],
            'remission_plate' => ['nullable','string','max:50'],
            'voucher_type' => ['nullable','string','max:50'],
            'voucher_number' => ['nullable','string','max:100'],
            'remission_number' => ['nullable','string','max:100'],
            'notes' => ['nullable','string'],
            'tank_ids' => ['required','array','min:1'],
            'tank_ids.*' => ['required','string','exists:tank_units,id'],
        ]);

        $dispatch = $this->dispatchService->createDispatch(
            collect($data)->except(['tank_ids'])->toArray(),
            $data['tank_ids'],
            $request->user()->email
        );

        return redirect()->route('dispatches.show', $dispatch)->with('success','Despacho creado.');
    }

    public function createByQuantity()
    {
        return view('dispatches.create_by_quantity', [
            'clients' => Client::orderBy('name')->get(),
            'gasTypes' => GasType::orderBy('name')->get(),
            'capacities' => CylinderCapacity::orderBy('name')->get(),
            'areas' => WarehouseArea::orderBy('name')->get(),
            'techStatuses' => TechnicalStatus::orderBy('name')->get(),
        ]);
    }

    public function storeByQuantity(Request $request)
    {
        $data = $request->validate([
            'client_id' => ['nullable','integer','exists:clients,id'],
            'dispatched_at' => ['required','date'],
            'document_number' => ['nullable','string','max:100'],
            'entity_type' => ['nullable','integer','in:1,2'],
            'remission_plate' => ['nullable','string','max:50'],
            'voucher_type' => ['nullable','string','max:50'],
            'voucher_number' => ['nullable','string','max:100'],
            'remission_number' => ['nullable','string','max:100'],
            'notes' => ['nullable','string'],
            'quantity' => ['required','integer','min:1','max:5000'],
            'gas_type_id' => ['nullable','integer','exists:gas_types,id'],
            'capacity_id' => ['nullable','integer','exists:cylinder_capacities,id'],
            'warehouse_area_id' => ['nullable','integer','exists:warehouse_areas,id'],
            'technical_status_id' => ['nullable','integer','exists:technical_statuses,id'],
        ]);

        $filters = [
            'gas_type_id' => $data['gas_type_id'] ?? null,
            'capacity_id' => $data['capacity_id'] ?? null,
            'warehouse_area_id' => $data['warehouse_area_id'] ?? null,
            'technical_status_id' => $data['technical_status_id'] ?? null,
        ];

        $dispatch = $this->dispatchService->createDispatchByQuantity(
            collect($data)->except(['quantity','gas_type_id','capacity_id','warehouse_area_id','technical_status_id'])->toArray(),
            (int)$data['quantity'],
            $filters,
            $request->user()->email
        );

        return redirect()->route('dispatches.show', $dispatch)->with('success','Despacho creado por cantidad.');
    }

    public function show(Dispatch $dispatch)
    {
        $dispatch->load(['client','lines.tankUnit.gasType','lines.tankUnit.capacity']);
        return view('dispatches.show', compact('dispatch'));
    }
}
