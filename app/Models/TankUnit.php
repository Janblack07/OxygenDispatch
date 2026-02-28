<?php

namespace App\Models;

use App\Enums\TankStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

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

        // redundantes para filtros (ok tenerlas)
        'gas_type_id',
        'capacity_id',

        'warehouse_area_id',
        'technical_status_id',

        'status',
        'dispatched_at',
    ];

    protected $casts = [
        'dispatched_at' => 'datetime',
        'status' => TankStatus::class,
    ];

    public function batch() { return $this->belongsTo(Batch::class); }
    public function product() { return $this->belongsTo(CatalogProduct::class, 'product_id'); }

    public function gasType() { return $this->belongsTo(GasType::class); }
    public function capacity() { return $this->belongsTo(CylinderCapacity::class, 'capacity_id'); }

    public function warehouseArea() { return $this->belongsTo(WarehouseArea::class); }
    public function technicalStatus() { return $this->belongsTo(TechnicalStatus::class); }

    public function movements() { return $this->hasMany(InventoryMovement::class); }
}
