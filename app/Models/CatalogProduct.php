<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogProduct extends Model
{
    protected $fillable = [
        'code','detail','gas_type_id','capacity_id','sanitary_registry',
    ];

    public function gasType()
    {
        return $this->belongsTo(GasType::class);
    }

    public function capacity()
    {
        return $this->belongsTo(CylinderCapacity::class, 'capacity_id');
    }
}
