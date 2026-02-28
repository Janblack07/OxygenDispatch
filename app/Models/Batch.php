<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    //
    protected $fillable = [
        'batch_number','gas_type_id','capacity_id','received_at',
        'document_number','notes','created_by_user_email',
        'supplier_name','supplier_code','voucher_type','voucher_number','voucher_date',
        'sanitary_registry','manufactured_at','expires_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'voucher_date' => 'date',
        'manufactured_at' => 'date',
        'expires_at' => 'date',
    ];

    public function gasType(){ return $this->belongsTo(GasType::class); }
    public function capacity(){ return $this->belongsTo(CylinderCapacity::class, 'capacity_id'); }
    public function tankUnits(){ return $this->hasMany(TankUnit::class); }
}
