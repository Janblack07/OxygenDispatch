<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CylinderCapacity extends Model
{
    //
     protected $table = 'cylinder_capacities';
    protected $fillable = ['name','m3'];

    protected $casts = ['m3' => 'decimal:2'];
}
