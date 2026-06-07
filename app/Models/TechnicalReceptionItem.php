<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalReceptionItem extends Model
{
    protected $fillable = [
        'technical_reception_id',
        'section',
        'label',
        'complies',
        'observation',
        'sort_order',
    ];

    protected $casts = [
        'complies' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function technicalReception()
    {
        return $this->belongsTo(TechnicalReception::class);
    }
}
