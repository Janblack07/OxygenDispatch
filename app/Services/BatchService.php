<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Enums\TankStatus;
use App\Models\Batch;
use App\Models\CatalogProduct;
use App\Models\InventoryMovement;
use App\Models\TankUnit;
use App\Models\TechnicalStatus;
use App\Models\WarehouseArea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class BatchService
{
    public function generateTanksForProduct(
        Batch $batch,
        CatalogProduct $product,
        int $quantity,
        string $createdByEmail,
        ?string $serialPrefix = null
    ): void {
        DB::transaction(function () use (
            $batch,
            $product,
            $quantity,
            $createdByEmail,
            $serialPrefix
        ) {
            $receptionArea = WarehouseArea::query()
                ->where('name', 'Recepción')
                ->first();

            if (! $receptionArea) {
                throw new RuntimeException(
                    'No existe el área "Recepción". Ejecuta o verifica el catálogo de áreas.'
                );
            }

            $pendingStatus = TechnicalStatus::query()
                ->where('name', 'Pendiente')
                ->first();

            if (! $pendingStatus) {
                throw new RuntimeException(
                    'No existe el estado técnico "Pendiente". Ejecuta o verifica el catálogo de estados técnicos.'
                );
            }

            for ($i = 0; $i < $quantity; $i++) {
                [$serial, $prefix, $number] = $this->nextSerial(
                    $serialPrefix
                );

                $tank = TankUnit::create([
                    'id' => (string) Str::uuid(),

                    'serial' => $serial,
                    'serial_prefix' => $prefix,
                    'serial_number' => $number,

                    'batch_id' => $batch->id,
                    'product_id' => $product->id,

                    'gas_type_id' => $product->gas_type_id,
                    'capacity_id' => $product->capacity_id,

                    // Siempre entra a recepción.
                    'warehouse_area_id' => $receptionArea->id,

                    // Siempre nace pendiente de revisión.
                    'technical_status_id' => $pendingStatus->id,

                    // Se mantiene DISPONIBLE como estado general,
                    // pero NO será despachable hasta aprobar técnicamente.
                    'status' => TankStatus::DISPONIBLE,
                ]);

                InventoryMovement::create([
                    'type' => MovementType::ENTRADA,
                    'occurred_at' => now(),

                    'tank_unit_id' => $tank->id,

                    'from_area_id' => null,
                    'to_area_id' => $receptionArea->id,

                    'batch_id' => $batch->id,

                    'reference_document' => $batch->document_number,

                    'performed_by_user_email' => $createdByEmail,

                    'notes' => sprintf(
                        'Ingreso inicial desde lote %s. Tanque pendiente de revisión técnica.',
                        $batch->batch_number
                    ),
                ]);
            }
        });
    }

    private function nextSerial(?string $prefix = null): array
    {
        $prefix = strtoupper(
            trim($prefix ?: 'OXI')
        );

        $lastNumber = DB::table('tank_units')
            ->where('serial_prefix', $prefix)
            ->lockForUpdate()
            ->max('serial_number');

        $nextNumber = ((int) $lastNumber) + 1;

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
