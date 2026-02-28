<?php

namespace App\Http\Controllers;

use App\Models\TankUnit;
use App\Models\GasType;
use App\Models\CylinderCapacity;
use App\Models\WarehouseArea;
use App\Models\TechnicalStatus;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class TankUnitController extends Controller
{
    public function __construct(private readonly InventoryService $inventoryService) {}

    public function index(Request $request)
    {
        $q = TankUnit::with(['batch','gasType','capacity','warehouseArea','technicalStatus'])
            ->orderBy('created_at','desc');

             if ($request->filled('batch_id')) $q->where('batch_id', (int)$request->input('batch_id'));

        if ($request->filled('status')) $q->where('status', (int)$request->input('status'));
        if ($request->filled('gas_type_id')) $q->where('gas_type_id', (int)$request->input('gas_type_id'));
        if ($request->filled('capacity_id')) $q->where('capacity_id', (int)$request->input('capacity_id'));
        if ($request->filled('warehouse_area_id')) $q->where('warehouse_area_id', (int)$request->input('warehouse_area_id'));
        if ($request->filled('technical_status_id')) $q->where('technical_status_id', (int)$request->input('technical_status_id'));
        if ($request->filled('serial')) $q->where('serial','like','%'.$request->input('serial').'%');

        $tanks = $q->paginate(20)->withQueryString();

        return view('tanks.index', [
            'tanks' => $tanks,
            'gasTypes' => GasType::orderBy('name')->get(),
            'capacities' => CylinderCapacity::orderBy('name')->get(),
            'areas' => WarehouseArea::orderBy('name')->get(),
            'techStatuses' => TechnicalStatus::orderBy('name')->get(),
        ]);
    }

    public function show(TankUnit $tank)
    {
        $tank->load(['batch','gasType','capacity','warehouseArea','technicalStatus','movements.fromArea','movements.toArea']);
        return view('tanks.show', [
            'tank' => $tank,
            'areas' => WarehouseArea::orderBy('name')->get(),
            'techStatuses' => TechnicalStatus::orderBy('name')->get(),
            'movements' => $tank->inventoryMovements()->latest()->take(50)->get(),
        ]);
    }

    public function transfer(Request $request, TankUnit $tank)
    {
        $data = $request->validate([
            'to_area_id' => ['required','integer','exists:warehouse_areas,id'],
            'notes' => ['nullable','string','max:500'],
        ]);

        $this->inventoryService->transfer($tank, (int)$data['to_area_id'], $request->user()->email, $data['notes'] ?? null);
        return back()->with('success','Traslado registrado.');
    }

    public function changeTechnicalStatus(Request $request, TankUnit $tank)
    {
        $data = $request->validate([
            'technical_status_id' => ['required','integer','exists:technical_statuses,id'],
            'notes' => ['nullable','string','max:500'],
        ]);

        $this->inventoryService->changeTechnicalStatus($tank, (int)$data['technical_status_id'], $request->user()->email, $data['notes'] ?? null);
        return back()->with('success','Estado técnico actualizado.');
    }

    public function decommission(Request $request, TankUnit $tank)
    {
        $data = $request->validate([
            'notes' => ['nullable','string','max:500'],
        ]);

        $this->inventoryService->decommission($tank, $request->user()->email, $data['notes'] ?? null);
        return back()->with('success','Tanque dado de baja.');
    }
}
