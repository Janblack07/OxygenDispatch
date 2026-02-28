<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasType extends Model
{
    //
    protected $fillable = ['name'];

    public function batches() { return $this->hasMany(Batch::class); }
    public function tankUnits() { return $this->hasMany(TankUnit::class); }
}
