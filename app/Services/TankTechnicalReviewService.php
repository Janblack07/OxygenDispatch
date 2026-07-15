<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Models\InventoryMovement;
use App\Models\TankTechnicalReview;
use App\Models\TankUnit;
use App\Models\TechnicalReception;
use App\Models\TechnicalStatus;
use App\Models\WarehouseArea;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TankTechnicalReviewService
{
    public function approve(
        TechnicalReception $technicalReception,
        array $tankIds,
        string $reviewedBy
    ): int {
        return DB::transaction(function () use (
            $technicalReception,
            $tankIds,
            $reviewedBy
        ) {
            $approvedStatus = $this->technicalStatus('Aprobado');

            $approvedArea = $this->warehouseArea(
                'Productos aprobados'
            );

            $tanks = $this->getAndLockPendingTanks(
                technicalReception: $technicalReception,
                tankIds: $tankIds,
            );

            foreach ($tanks as $tank) {
                $previousAreaId = $tank->warehouse_area_id;
                $previousTechnicalStatus = $tank->technicalStatus?->name;

                $tank->update([
                    'technical_status_id' => $approvedStatus->id,
                    'warehouse_area_id' => $approvedArea->id,
                ]);

                TankTechnicalReview::create([
                    'tank_unit_id' => $tank->id,
                    'technical_reception_id' => $technicalReception->id,
                    'result' => 'approved',
                    'anomaly_type' => null,
                    'observation' => null,
                    'reviewed_by_user_email' => $reviewedBy,
                    'reviewed_at' => now(),
                ]);

                InventoryMovement::create([
                    'type' => MovementType::CAMBIO_ESTADO_TECNICO,
                    'occurred_at' => now(),
                    'tank_unit_id' => $tank->id,
                    'from_area_id' => $previousAreaId,
                    'to_area_id' => $approvedArea->id,
                    'batch_id' => $tank->batch_id,
                    'reference_document' => $technicalReception->document_number,
                    'performed_by_user_email' => $reviewedBy,
                    'notes' => sprintf(
                        'Revisión técnica aprobada. Estado técnico: %s → Aprobado.',
                        $previousTechnicalStatus ?: 'Sin estado'
                    ),
                ]);
            }

            return $tanks->count();
        });
    }

    public function reject(
        TechnicalReception $technicalReception,
        array $tankIds,
        string $anomalyType,
        ?string $observation,
        string $reviewedBy
    ): int {
        return DB::transaction(function () use (
            $technicalReception,
            $tankIds,
            $anomalyType,
            $observation,
            $reviewedBy
        ) {
            $rejectedStatus = $this->technicalStatus('Rechazado');

            $returnsArea = $this->warehouseArea(
                'Rechazos, devoluciones y retiro del mercado'
            );

            $tanks = $this->getAndLockPendingTanks(
                technicalReception: $technicalReception,
                tankIds: $tankIds,
            );

            foreach ($tanks as $tank) {
                $previousAreaId = $tank->warehouse_area_id;
                $previousTechnicalStatus = $tank->technicalStatus?->name;

                $tank->update([
                    'technical_status_id' => $rejectedStatus->id,
                    'warehouse_area_id' => $returnsArea->id,
                ]);

                TankTechnicalReview::create([
                    'tank_unit_id' => $tank->id,
                    'technical_reception_id' => $technicalReception->id,
                    'result' => 'rejected',
                    'anomaly_type' => $anomalyType,
                    'observation' => $observation,
                    'reviewed_by_user_email' => $reviewedBy,
                    'reviewed_at' => now(),
                ]);

                InventoryMovement::create([
                    'type' => MovementType::CAMBIO_ESTADO_TECNICO,
                    'occurred_at' => now(),
                    'tank_unit_id' => $tank->id,
                    'from_area_id' => $previousAreaId,
                    'to_area_id' => $returnsArea->id,
                    'batch_id' => $tank->batch_id,
                    'reference_document' => $technicalReception->document_number,
                    'performed_by_user_email' => $reviewedBy,
                    'notes' => sprintf(
                        'Revisión técnica rechazada. Estado técnico: %s → Rechazado. Anomalía: %s.%s',
                        $previousTechnicalStatus ?: 'Sin estado',
                        $anomalyType,
                        $observation
                            ? ' Observación: ' . $observation
                            : ''
                    ),
                ]);
            }

            return $tanks->count();
        });
    }

    public function approveAllPending(
        TechnicalReception $technicalReception,
        string $reviewedBy
    ): int {
        $tankIds = TankUnit::query()
            ->whereHas('batch', function ($query) use ($technicalReception) {
                $query->where(
                    'document_number',
                    $technicalReception->document_number
                );
            })
            ->whereHas('technicalStatus', function ($query) {
                $query->where('name', 'Pendiente');
            })
            ->pluck('id')
            ->all();

        if (empty($tankIds)) {
            throw new RuntimeException(
                'No existen tanques pendientes de revisión para esta orden.'
            );
        }

        return $this->approve(
            technicalReception: $technicalReception,
            tankIds: $tankIds,
            reviewedBy: $reviewedBy,
        );
    }

    private function getAndLockPendingTanks(
        TechnicalReception $technicalReception,
        array $tankIds
    ): Collection {
        $tankIds = array_values(
            array_unique($tankIds)
        );

        if (empty($tankIds)) {
            throw new RuntimeException(
                'Debes seleccionar al menos un tanque.'
            );
        }

        $tanks = TankUnit::query()
            ->with([
                'technicalStatus',
                'warehouseArea',
                'batch',
            ])
            ->whereIn('id', $tankIds)
            ->whereHas('batch', function ($query) use ($technicalReception) {
                $query->where(
                    'document_number',
                    $technicalReception->document_number
                );
            })
            ->lockForUpdate()
            ->get();

        if ($tanks->count() !== count($tankIds)) {
            throw new RuntimeException(
                'Uno o más tanques no pertenecen a esta orden.'
            );
        }

        $invalidTank = $tanks->first(function (TankUnit $tank) {
            return mb_strtolower(
                trim($tank->technicalStatus?->name ?? '')
            ) !== 'pendiente';
        });

        if ($invalidTank) {
            throw new RuntimeException(
                "El tanque {$invalidTank->serial} ya fue revisado."
            );
        }

        return $tanks;
    }

    private function technicalStatus(string $name): TechnicalStatus
    {
        $status = TechnicalStatus::query()
            ->where('name', $name)
            ->first();

        if (! $status) {
            throw new RuntimeException(
                "No existe el estado técnico \"{$name}\"."
            );
        }

        return $status;
    }

    private function warehouseArea(string $name): WarehouseArea
    {
        $area = WarehouseArea::query()
            ->where('name', $name)
            ->first();

        if (! $area) {
            throw new RuntimeException(
                "No existe el área \"{$name}\"."
            );
        }

        return $area;
    }
}
