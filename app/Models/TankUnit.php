<?php

namespace App\Models;

use App\Enums\TankStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TankUnit extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'serial',
        'serial_prefix',
        'serial_number',

        'batch_id',
        'product_id',

        'gas_type_id',
        'capacity_id',

        'warehouse_area_id',
        'technical_status_id',
        'sanitary_registry',
        'manufactured_at',
        'expires_at',

        'status',
        'dispatched_at',
    ];

    protected $casts = [
        'dispatched_at' => 'datetime',
        'status' => TankStatus::class,
        'manufactured_at' => 'date',
        'expires_at' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function product()
    {
        return $this->belongsTo(CatalogProduct::class, 'product_id');
    }

    public function gasType()
    {
        return $this->belongsTo(GasType::class);
    }

    public function capacity()
    {
        return $this->belongsTo(CylinderCapacity::class, 'capacity_id');
    }

    public function warehouseArea()
    {
        return $this->belongsTo(WarehouseArea::class);
    }

    public function technicalStatus()
    {
        return $this->belongsTo(TechnicalStatus::class);
    }

    public function movements()
    {
        return $this->hasMany(
            InventoryMovement::class,
            'tank_unit_id'
        )->latest('occurred_at');
    }

    public function technicalReviews()
    {
        return $this->hasMany(
            TankTechnicalReview::class,
            'tank_unit_id'
        )->latest('reviewed_at');
    }

    public function latestTechnicalReview()
    {
        return $this->hasOne(
            TankTechnicalReview::class,
            'tank_unit_id'
        )->latestOfMany('reviewed_at');
    }

    /**
     * Un tanque es realmente despachable únicamente cuando:
     *
     * 1. Su estado general es DISPONIBLE.
     * 2. Su estado técnico es Aprobado.
     * 3. Está físicamente en Productos aprobados.
     */
    public function isAvailableForDispatch(): bool
    {
        $this->loadMissing([
            'technicalStatus',
            'warehouseArea',
        ]);

        return $this->status === TankStatus::DISPONIBLE
            && $this->normalizedTechnicalStatusName() === 'aprobado'
            && $this->normalizedWarehouseAreaName() === 'productos aprobados';
    }

    /**
     * Scope centralizado para obtener únicamente tanques despachables.
     */
    public function scopeDispatchable(Builder $query): Builder
    {
        return $query
            ->where('status', TankStatus::DISPONIBLE->value)
            ->whereHas('technicalStatus', function (Builder $query) {
                $query->where('name', 'Aprobado');
            })
            ->whereHas('warehouseArea', function (Builder $query) {
                $query->where('name', 'Productos aprobados');
            });
    }

    private function normalizedTechnicalStatusName(): string
    {
        return mb_strtolower(
            trim($this->technicalStatus?->name ?? '')
        );
    }

    private function normalizedWarehouseAreaName(): string
    {
        return mb_strtolower(
            trim($this->warehouseArea?->name ?? '')
        );
    }
}
