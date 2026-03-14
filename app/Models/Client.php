<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EntityType;

class Client extends Model
{
    //
    protected $fillable = [
        'name',
        'entity_type',
        'document',
        'phone',
        'email',
        'address',
    ];

    protected $casts = [
        'entity_type' => EntityType::class,
    ];

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
    }
}
