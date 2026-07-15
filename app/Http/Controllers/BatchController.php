<?php

namespace App\Http\Controllers;

use App\Enums\MovementType;
use App\Models\Batch;
use App\Models\CatalogProduct;
use App\Models\CylinderCapacity;
use App\Models\GasType;
use App\Models\InventoryMovement;
use App\Models\TankUnit;
use App\Models\TechnicalStatus;
use App\Models\WarehouseArea;
use App\Services\BatchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    public function __construct(
        private readonly BatchService $batchService
    ) {}

    public function index(Request $request)
    {
        $q = Batch::with([
            'gasType',
            'capacity',
        ])->orderByDesc('created_at');

        if ($request->filled('q')) {
            $term = $request->input('q');

            $q->where(function ($qq) use ($term) {
                $qq->where('batch_number', 'like', "%{$term}%")
                    ->orWhere('document_number', 'like', "%{$term}%");
            });
        }

        /*
         * Si mantienes filtros por gas/capacidad en batches.index,
         * se conservan como filtros referenciales.
         */
        if ($request->filled('gas_type_id')) {
            $q->where(
                'gas_type_id',
                (int) $request->input('gas_type_id')
            );
        }

        if ($request->filled('capacity_id')) {
            $q->where(
                'capacity_id',
                (int) $request->input('capacity_id')
            );
        }

        $batches = $q
            ->paginate(15)
            ->withQueryString();

        return view('batches.index', [
            'batches' => $batches,

            'gasTypes' => GasType::query()
                ->orderBy('name')
                ->get(),

            'capacities' => CylinderCapacity::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('batches.create', [
            'gasTypes' => GasType::query()
                ->orderBy('name')
                ->get(),

            'capacities' => CylinderCapacity::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        /*
         * Opción B:
         *
         * El lote puede no tener gas/capacidad porque esos datos
         * pertenecen realmente a cada producto/tanque.
         */
        $data = $request->validate([
            'batch_number' => [
                'required',
                'string',
                'max:100',
                'unique:batches,batch_number',
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

            'received_at' => [
                'required',
                'date',
            ],

            'document_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'supplier_name' => [
                'nullable',
                'string',
                'max:200',
            ],

            'supplier_code' => [
                'nullable',
                'string',
                'max:100',
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

            'voucher_date' => [
                'nullable',
                'date',
            ],

            /*
             * En Opción B el registro sanitario debería pertenecer
             * al producto. Se mantiene aquí como dato referencial.
             */
            'sanitary_registry' => [
                'nullable',
                'string',
                'max:100',
            ],

            'manufactured_at' => [
                'nullable',
                'date',
            ],

            'expires_at' => [
                'nullable',
                'date',
            ],
        ]);

        $data['created_by_user_email'] = $request->user()->email;

        $batch = Batch::create($data);

        return redirect()
            ->route('batches.show', $batch)
            ->with(
                'success',
                'Lote creado.'
            );
    }

    public function show(Batch $batch)
    {
        $batch->load([
            'gasType',
            'capacity',
            'tankUnits.product.capacity',
            'tankUnits.warehouseArea',
            'tankUnits.technicalStatus',
        ]);

        /*
         * Los mantenemos porque pueden seguir utilizándose
         * en otras acciones de la vista del lote.
         */
        $areas = WarehouseArea::query()
            ->orderBy('name')
            ->get();

        $techStatuses = TechnicalStatus::query()
            ->orderBy('name')
            ->get();

        $products = CatalogProduct::query()
            ->with('capacity')
            ->orderBy('detail')
            ->get();

        return view(
            'batches.show',
            compact(
                'batch',
                'areas',
                'techStatuses',
                'products'
            )
        );
    }

    public function edit(Batch $batch)
    {
        return view('batches.edit', [
            'batch' => $batch,

            'gasTypes' => GasType::query()
                ->orderBy('name')
                ->get(),

            'capacities' => CylinderCapacity::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function update(Request $request, Batch $batch)
    {
        $data = $request->validate([
            'batch_number' => [
                'required',
                'string',
                'max:100',
                'unique:batches,batch_number,' . $batch->id,
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

            'received_at' => [
                'required',
                'date',
            ],

            'document_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'supplier_name' => [
                'nullable',
                'string',
                'max:200',
            ],

            'supplier_code' => [
                'nullable',
                'string',
                'max:100',
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

            'voucher_date' => [
                'nullable',
                'date',
            ],

            'sanitary_registry' => [
                'nullable',
                'string',
                'max:100',
            ],

            'manufactured_at' => [
                'nullable',
                'date',
            ],

            'expires_at' => [
                'nullable',
                'date',
            ],
        ]);

        $batch->update($data);

        return redirect()
            ->route('batches.show', $batch)
            ->with(
                'success',
                'Lote actualizado.'
            );
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();

        return redirect()
            ->route('batches.index')
            ->with(
                'success',
                'Lote eliminado.'
            );
    }

    /**
     * Genera tanques nuevos para un lote.
     *
     * Regla obligatoria:
     *
     * Todo tanque nuevo inicia en:
     * - Área: Recepción
     * - Estado técnico: Pendiente
     *
     * El usuario no puede elegir estos dos valores.
     */
    public function generateTanks(Request $request, Batch $batch)
    {
        $data = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],

            'product_id' => [
                'required',
                'integer',
                'exists:catalog_products,id',
            ],

            'serial_prefix' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^[A-Za-z0-9_-]+$/',
            ],
        ], [
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'Debes generar al menos un tanque.',
            'quantity.max' => 'No puedes generar más de 5000 tanques por operación.',

            'product_id.required' => 'Debes seleccionar un producto.',
            'product_id.exists' => 'El producto seleccionado no existe.',

            'serial_prefix.max' => 'El prefijo no puede superar los 10 caracteres.',
            'serial_prefix.regex' => 'El prefijo solo puede contener letras, números, guiones y guion bajo.',
        ]);

        $product = CatalogProduct::findOrFail(
            $data['product_id']
        );

        /*
         * IMPORTANTE:
         *
         * El área y el estado técnico se resuelven en backend.
         * Nunca confiamos en valores enviados desde el formulario.
         */
        $receptionArea = WarehouseArea::query()
            ->where('name', 'Recepción')
            ->first();

        if (! $receptionArea) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity' => 'No existe el área "Recepción" en el catálogo. Debes crearla antes de generar tanques.',
                ]);
        }

        $pendingTechnicalStatus = TechnicalStatus::query()
            ->where('name', 'Pendiente')
            ->first();

        if (! $pendingTechnicalStatus) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity' => 'No existe el estado técnico "Pendiente" en el catálogo. Debes crearlo antes de generar tanques.',
                ]);
        }

        try {
            DB::transaction(function () use (
                $data,
                $batch,
                $product,
                $receptionArea,
                $pendingTechnicalStatus,
                $request
            ) {
                for ($i = 0; $i < $data['quantity']; $i++) {
                    /*
                     * Se mantiene tu método generateSerial().
                     *
                     * Como estamos dentro de una transacción,
                     * lockForUpdate() protege correctamente
                     * la secuencia contra concurrencia.
                     */
                    [$serial, $prefix, $number] = $this->generateSerial(
                        $data['serial_prefix'] ?? null
                    );

                    $tank = TankUnit::create([
                        'batch_id' => $batch->id,

                        'product_id' => $product->id,

                        'gas_type_id' => $product->gas_type_id,

                        'capacity_id' => $product->capacity_id,

                        /*
                         * OBLIGATORIO:
                         * Todo tanque nuevo entra a Recepción.
                         */
                        'warehouse_area_id' => $receptionArea->id,

                        /*
                         * OBLIGATORIO:
                         * Todo tanque nuevo nace Pendiente.
                         */
                        'technical_status_id' => $pendingTechnicalStatus->id,

                        'serial' => $serial,

                        'serial_prefix' => $prefix,

                        'serial_number' => $number,
                    ]);

                    /*
                     * Conservamos exactamente la estructura real
                     * de InventoryMovement que ya utilizas actualmente.
                     */
                    InventoryMovement::create([
                        'type' => MovementType::ENTRADA,

                        'occurred_at' => now(),

                        'tank_unit_id' => $tank->id,

                        'from_area_id' => null,

                        'to_area_id' => $receptionArea->id,

                        'batch_id' => $batch->id,

                        'reference_document' => $batch->document_number,

                        'performed_by_user_email' => $request->user()->email,

                        'notes' => sprintf(
                            'Ingreso inicial desde lote %s. Tanque pendiente de revisión técnica.',
                            $batch->batch_number
                        ),
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'quantity' => 'No se pudieron generar los tanques: ' . $exception->getMessage(),
                ]);
        }

        return back()->with(
            'success',
            'Tanques generados correctamente. Todos ingresaron al área Recepción con estado técnico Pendiente y deberán ser aprobados antes del despacho.'
        );
    }

    /**
     * Genera el siguiente serial disponible para un prefijo.
     *
     * Ejemplo:
     *
     * OXI-000001
     * OXI-000002
     * OXI-000003
     */
    private function generateSerial(?string $prefix = null): array
    {
        $prefix = strtoupper(
            trim($prefix ?: 'OXI')
        );

        /*
         * El método se ejecuta dentro de una transacción.
         *
         * lockForUpdate() evita que dos operaciones concurrentes
         * obtengan el mismo último número.
         */
        $last = DB::table('tank_units')
            ->where('serial_prefix', $prefix)
            ->lockForUpdate()
            ->max('serial_number');

        $nextNumber = ((int) $last) + 1;

        $serial = sprintf(
            '%s-%06d',
            $prefix,
            $nextNumber
        );

        return [
            $serial,
            $prefix,
            $nextNumber,
        ];
    }
}
