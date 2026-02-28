<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EntityType;

class Dispatch extends Model
{
   protected $fillable = [
        'client_id','dispatched_at','document_number','entity_type',
        'remission_plate','performed_by_user_email',
        'voucher_type','voucher_number','remission_number','notes',
    ];

    protected $casts = [
        'dispatched_at' => 'datetime',
        'entity_type' => EntityType::class,
    ];

    public function client(){ return $this->belongsTo(Client::class); }
    public function lines(){ return $this->hasMany(DispatchLine::class); }

}
