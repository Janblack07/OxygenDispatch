<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\MovementType;

class InventoryMovement extends Model
{
    //
     public $timestamps = false;

    protected $fillable = [
        'type','occurred_at','tank_unit_id',
        'from_area_id','to_area_id','batch_id',
        'reference_document','performed_by_user_email','notes',
    ];

    protected $casts = [
        'type' => MovementType::class,
        'occurred_at' => 'datetime',
    ];

    public function tankUnit(){ return $this->belongsTo(TankUnit::class); }
    public function fromArea(){ return $this->belongsTo(WarehouseArea::class, 'from_area_id'); }
    public function toArea(){ return $this->belongsTo(WarehouseArea::class, 'to_area_id'); }
    public function batch(){ return $this->belongsTo(Batch::class); }
}
