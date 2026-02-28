<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Models\Batch;
use App\Models\CatalogProduct;
use App\Models\InventoryMovement;
use App\Models\TankUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BatchService
{
    public function generateTanksForProduct(
        Batch $batch,
        CatalogProduct $product,
        int $quantity,
        int $warehouseAreaId,
        int $technicalStatusId,
        string $createdByEmail,
        ?string $serialPrefix = null
    ): void {
        DB::transaction(function () use (
            $batch, $product, $quantity, $warehouseAreaId, $technicalStatusId, $createdByEmail, $serialPrefix
        ) {
            for ($i = 0; $i < $quantity; $i++) {
                [$serial, $prefix, $num] = $this->nextSerial($serialPrefix);

                $tank = TankUnit::create([
                    'id' => (string) Str::uuid(),
                    'serial' => $serial,
                    'serial_prefix' => $prefix,
                    'serial_number' => $num,

                    'batch_id' => $batch->id,
                    'product_id' => $product->id,

                    // Copia “recomendado” para filtros rápidos
                    'gas_type_id' => $product->gas_type_id,
                    'capacity_id' => $product->capacity_id,

                    'warehouse_area_id' => $warehouseAreaId,
                    'technical_status_id' => $technicalStatusId,

                    // Sanidad por producto
                    'sanitary_registry' => $product->sanitary_registry,

                    'status' => 1,
                    'created_by_user_email' => $createdByEmail,
                ]);

                InventoryMovement::create([
                    'id' => (string) Str::uuid(),
                    'tank_unit_id' => $tank->id,
                    'movement_type' => MovementType::ENTRADA->value,
                    'from_area_id' => null,
                    'to_area_id' => $warehouseAreaId,
                    'notes' => "Creación desde lote {$batch->batch_number} ({$product->code})",
                    'created_by_user_email' => $createdByEmail,
                ]);
            }
        });
    }

    private function nextSerial(?string $prefix = null): array
    {
        $prefix = strtoupper(trim($prefix ?: 'OXI'));

        // Evita choques por concurrencia (bloqueo)
        $last = DB::table('tank_units')
            ->where('serial_prefix', $prefix)
            ->lockForUpdate()
            ->max('serial_number');

        $next = ((int) $last) + 1;
        $serial = sprintf('%s-%06d', $prefix, $next);

        return [$serial, $prefix, $next];
    }
}
