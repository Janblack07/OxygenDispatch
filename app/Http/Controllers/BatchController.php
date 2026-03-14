<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\CatalogProduct;
use App\Models\CylinderCapacity;
use App\Models\GasType;
use App\Models\TankUnit;
use App\Services\BatchService;
use App\Models\WarehouseArea;
use App\Models\TechnicalStatus;
use App\Enums\MovementType;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    public function __construct(private readonly BatchService $batchService) {}

    public function index(Request $request)
    {
        $q = Batch::with(['gasType','capacity'])->orderByDesc('created_at');

        if ($request->filled('q')) {
            $term = $request->input('q');
            $q->where(function($qq) use ($term) {
                $qq->where('batch_number', 'like', "%{$term}%")
                    ->orWhere('document_number', 'like', "%{$term}%");
            });
        }

        // OJO: si mantienes filtros por gas/capacidad en batches.index, déjalos.
        // En Opción B real, estos filtros son "referenciales", no obligatorios.
        if ($request->filled('gas_type_id')) $q->where('gas_type_id', (int)$request->input('gas_type_id'));
        if ($request->filled('capacity_id')) $q->where('capacity_id', (int)$request->input('capacity_id'));

        $batches = $q->paginate(15)->withQueryString();

        return view('batches.index', [
            'batches' => $batches,
            'gasTypes' => GasType::orderBy('name')->get(),
            'capacities' => CylinderCapacity::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('batches.create', [
            'gasTypes' => GasType::orderBy('name')->get(),
            'capacities' => CylinderCapacity::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Opción B: el lote PUEDE no tener gas/capacidad (porque eso va por tanque/producto).
        $data = $request->validate([
            'batch_number' => ['required','string','max:100','unique:batches,batch_number'],

            'gas_type_id' => ['nullable','integer','exists:gas_types,id'],
            'capacity_id' => ['nullable','integer','exists:cylinder_capacities,id'],

            'received_at' => ['required','date'],
            'document_number' => ['nullable','string','max:100'],
            'notes' => ['nullable','string'],

            'supplier_name' => ['nullable','string','max:200'],
            'supplier_code' => ['nullable','string','max:100'],
            'voucher_type' => ['nullable','string','max:50'],
            'voucher_number' => ['nullable','string','max:100'],
            'voucher_date' => ['nullable','date'],

            // En Opción B, sanitario va por producto. Si quieres conservarlo en lote como "referencial", ok:
            'sanitary_registry' => ['nullable','string','max:100'],

            'manufactured_at' => ['nullable','date'],
            'expires_at' => ['nullable','date'],
        ]);

        $data['created_by_user_email'] = $request->user()->email;

        $batch = Batch::create($data);

        return redirect()->route('batches.show', $batch)->with('success','Lote creado.');
    }

   public function show(Batch $batch)
{
    $batch->load([
        'gasType','capacity',
        'tankUnits.product.capacity',
        'tankUnits.warehouseArea',
        'tankUnits.technicalStatus',
    ]);

    $areas = \App\Models\WarehouseArea::orderBy('name')->get();
    $techStatuses = \App\Models\TechnicalStatus::orderBy('name')->get();
    $products = \App\Models\CatalogProduct::with('capacity')->orderBy('detail')->get();

    return view('batches.show', compact('batch','areas','techStatuses','products'));
}

    public function edit(Batch $batch)
    {
        return view('batches.edit', [
            'batch' => $batch,
            'gasTypes' => GasType::orderBy('name')->get(),
            'capacities' => CylinderCapacity::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Batch $batch)
    {
        $data = $request->validate([
            'batch_number' => ['required','string','max:100','unique:batches,batch_number,'.$batch->id],

            'gas_type_id' => ['nullable','integer','exists:gas_types,id'],
            'capacity_id' => ['nullable','integer','exists:cylinder_capacities,id'],

            'received_at' => ['required','date'],
            'document_number' => ['nullable','string','max:100'],
            'notes' => ['nullable','string'],

            'supplier_name' => ['nullable','string','max:200'],
            'supplier_code' => ['nullable','string','max:100'],
            'voucher_type' => ['nullable','string','max:50'],
            'voucher_number' => ['nullable','string','max:100'],
            'voucher_date' => ['nullable','date'],

            'sanitary_registry' => ['nullable','string','max:100'],
            'manufactured_at' => ['nullable','date'],
            'expires_at' => ['nullable','date'],
        ]);

        $batch->update($data);

        return redirect()->route('batches.show', $batch)->with('success','Lote actualizado.');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('batches.index')->with('success','Lote eliminado.');
    }

    public function generateTanks(Request $request, Batch $batch)
    {
    $data = $request->validate([
        'quantity' => 'required|integer|min:1|max:5000',
        'warehouse_area_id' => 'required|exists:warehouse_areas,id',
        'technical_status_id' => 'required|exists:technical_statuses,id',
        'product_id' => 'required|exists:catalog_products,id',
        'serial_prefix' => 'nullable|string|max:10',
    ]);

    $product = CatalogProduct::findOrFail($data['product_id']);
    $area = WarehouseArea::findOrFail($data['warehouse_area_id']);
    $technicalStatus = TechnicalStatus::findOrFail($data['technical_status_id']);

    $areaName = mb_strtolower(trim($area->name));
    $techName = mb_strtolower(trim($technicalStatus->name));

    // Reglas operativas mínimas según tus áreas
    if ($areaName === 'despacho') {
        return back()
            ->withInput()
            ->withErrors([
                'warehouse_area_id' => 'No se deben generar tanques directamente en el área de despacho.',
            ]);
    }

    if (
        in_array($techName, ['pendiente'], true) &&
        in_array($areaName, ['productos aprobados', 'área de productos aprobados'], true)
    ) {
        return back()
            ->withInput()
            ->withErrors([
                'warehouse_area_id' => 'Un tanque pendiente no debe ingresar directamente al área de productos aprobados.',
            ]);
    }

    if (
        in_array($techName, ['rechazado'], true) &&
        !in_array($areaName, [
            'rechazos',
            'devoluciones',
            'retiro del mercado',
            'rechazos, devoluciones y retiro del mercado',
            'área para rechazos, devoluciones y retiro del mercado',
        ], true)
    ) {
        return back()
            ->withInput()
            ->withErrors([
                'warehouse_area_id' => 'Si el estado técnico es rechazado, el tanque debe ir al área de rechazos/devoluciones.',
            ]);
    }

    DB::transaction(function () use ($data, $batch, $product, $area, $technicalStatus, $request) {
        for ($i = 0; $i < $data['quantity']; $i++) {
            [$serial, $prefix, $num] = $this->generateSerial($data['serial_prefix'] ?? null);

            $tank = TankUnit::create([
                'batch_id' => $batch->id,
                'product_id' => $product->id,
                'gas_type_id' => $product->gas_type_id,
                'capacity_id' => $product->capacity_id,
                'warehouse_area_id' => $area->id,
                'technical_status_id' => $technicalStatus->id,
                'serial' => $serial,
                'serial_prefix' => $prefix,
                'serial_number' => $num,
            ]);

            InventoryMovement::create([
                'type' => MovementType::ENTRADA,
                'occurred_at' => now(),
                'tank_unit_id' => $tank->id,
                'from_area_id' => null,
                'to_area_id' => $area->id,
                'batch_id' => $batch->id,
                'reference_document' => $batch->document_number,
                'performed_by_user_email' => $request->user()->email,
                'notes' => "Ingreso inicial desde lote {$batch->batch_number}",
            ]);
        }
    });

    return back()->with('success', 'Tanques generados correctamente y movimientos de entrada registrados.');
}

    private function generateSerial(?string $prefix = null): array
    {
        $prefix = strtoupper(trim($prefix ?: 'OXI'));

        $last = DB::table('tank_units')
            ->where('serial_prefix', $prefix)
            ->lockForUpdate()
            ->max('serial_number');

        $nextNumber = ((int) $last) + 1;

        $serial = sprintf('%s-%06d', $prefix, $nextNumber);

        return [$serial, $prefix, $nextNumber];
    }
}
