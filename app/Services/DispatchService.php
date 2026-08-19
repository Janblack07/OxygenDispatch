<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Enums\TankStatus;
use App\Models\Dispatch;
use App\Models\DispatchLine;
use App\Models\InventoryMovement;
use App\Models\TankUnit;
use Illuminate\Support\Facades\DB;

class DispatchService
{
    public function createDispatch(array $dispatchData, array $tankIds, string $performedBy): Dispatch
    {
        return DB::transaction(function () use ($dispatchData, $tankIds, $performedBy) {
            $dispatch = Dispatch::create($dispatchData + [
                'performed_by_user_email' => $performedBy,
            ]);

            $tanks = TankUnit::query()
                ->with([
                    'technicalStatus',
                    'warehouseArea',
                ])
                ->whereIn('id', $tankIds)
                ->lockForUpdate()
                ->get();

            foreach ($tanks as $tank) {
                if (! $tank->isAvailableForDispatch()) {
                    throw new \RuntimeException(
                        "El tanque {$tank->serial} no está disponible para despacho. Debe estar disponible, aprobado técnicamente y ubicado en Productos aprobados."
                    );
                }

                $tank->status = TankStatus::DESPACHADO;
                $tank->dispatched_at = now();
                $tank->save();

                DispatchLine::create([
                    'dispatch_id' => $dispatch->id,
                    'tank_unit_id' => $tank->id,
                ]);

                InventoryMovement::create([
                    'type' => MovementType::SALIDA,
                    'occurred_at' => now(),
                    'tank_unit_id' => $tank->id,
                    'from_area_id' => $tank->warehouse_area_id,
                    'batch_id' => $tank->batch_id,
                    'performed_by_user_email' => $performedBy,
                    'reference_document' => $dispatch->document_number,
                ]);
            }

            return $dispatch
                ->refresh()
                ->load([
                    'client',
                    'lines.tankUnit',
                ]);
        });
    }

    public function createDispatchByQuantity(array $dispatchData, int $quantity, array $filters, string $performedBy): Dispatch
    {
        return DB::transaction(function () use ($dispatchData, $quantity, $filters, $performedBy) {
            /*
             * Selección automática segura:
             *
             * Solo se toman tanques realmente despachables:
             * - status = DISPONIBLE
             * - estado técnico = Aprobado
             * - área = Productos aprobados
             */
            $query = TankUnit::query()
                ->dispatchable();

            if (! empty($filters['gas_type_id'])) {
                $query->where('gas_type_id', $filters['gas_type_id']);
            }

            if (! empty($filters['capacity_id'])) {
                $query->where('capacity_id', $filters['capacity_id']);
            }

            if (! empty($filters['warehouse_area_id'])) {
                $query->where('warehouse_area_id', $filters['warehouse_area_id']);
            }

            if (! empty($filters['technical_status_id'])) {
                $query->where('technical_status_id', $filters['technical_status_id']);
            }

            $tanks = $query
                ->orderBy('created_at', 'asc')
                ->limit($quantity)
                ->lockForUpdate()
                ->get();

            if ($tanks->count() < $quantity) {
                throw new \RuntimeException(
                    'No hay stock suficiente. Solicitado: ' . $quantity . ', disponible: ' . $tanks->count()
                );
            }

            $dispatch = Dispatch::create($dispatchData + [
                'performed_by_user_email' => $performedBy,
            ]);

            foreach ($tanks as $tank) {
                $tank->status = TankStatus::DESPACHADO;
                $tank->dispatched_at = now();
                $tank->save();

                DispatchLine::create([
                    'dispatch_id' => $dispatch->id,
                    'tank_unit_id' => $tank->id,
                ]);

                InventoryMovement::create([
                    'type' => MovementType::SALIDA,
                    'occurred_at' => now(),
                    'tank_unit_id' => $tank->id,
                    'from_area_id' => $tank->warehouse_area_id,
                    'batch_id' => $tank->batch_id,
                    'performed_by_user_email' => $performedBy,
                    'reference_document' => $dispatch->document_number,
                ]);
            }

            return $dispatch
                ->refresh()
                ->load([
                    'client',
                    'lines.tankUnit',
                ]);
        });
    }
}
