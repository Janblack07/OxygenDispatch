<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DispatchLine extends Model
{
    //
    public $timestamps = false;

    protected $fillable = ['dispatch_id','tank_unit_id'];

    public function dispatch(){ return $this->belongsTo(Dispatch::class); }
    public function tankUnit(){ return $this->belongsTo(TankUnit::class); }
}
