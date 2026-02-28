<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Enums\TankStatus;
use App\Models\InventoryMovement;
use App\Models\TankUnit;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function transfer(TankUnit $tank, int $toAreaId, string $performedBy, ?string $notes = null): TankUnit
    {
        return DB::transaction(function () use ($tank, $toAreaId, $performedBy, $notes) {
            $from = $tank->warehouse_area_id;

            $tank->warehouse_area_id = $toAreaId;
            $tank->save();

            InventoryMovement::create([
                'type' => MovementType::TRASLADO,
                'occurred_at' => now(),
                'tank_unit_id' => $tank->id,
                'from_area_id' => $from,
                'to_area_id' => $toAreaId,
                'batch_id' => $tank->batch_id,
                'performed_by_user_email' => $performedBy,
                'notes' => $notes,
            ]);

            return $tank->refresh();
        });
    }

    public function changeTechnicalStatus(TankUnit $tank, int $technicalStatusId, string $performedBy, ?string $notes = null): TankUnit
    {
        return DB::transaction(function () use ($tank, $technicalStatusId, $performedBy, $notes) {
            $tank->technical_status_id = $technicalStatusId;
            $tank->save();

            InventoryMovement::create([
                'type' => MovementType::CAMBIO_ESTADO_TECNICO,
                'occurred_at' => now(),
                'tank_unit_id' => $tank->id,
                'batch_id' => $tank->batch_id,
                'performed_by_user_email' => $performedBy,
                'notes' => $notes,
            ]);

            return $tank->refresh();
        });
    }

    public function decommission(TankUnit $tank, string $performedBy, ?string $notes = null): TankUnit
    {
        return DB::transaction(function () use ($tank, $performedBy, $notes) {
            $tank->status = TankStatus::BAJA;
            $tank->save();

            InventoryMovement::create([
                'type' => MovementType::CAMBIO_ESTADO_TECNICO,
                'occurred_at' => now(),
                'tank_unit_id' => $tank->id,
                'batch_id' => $tank->batch_id,
                'performed_by_user_email' => $performedBy,
                'notes' => $notes ? "[BAJA] ".$notes : "[BAJA]",
            ]);

            return $tank->refresh();
        });
    }
}
