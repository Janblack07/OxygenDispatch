<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TankTechnicalReview extends Model
{
    protected $fillable = [
        'tank_unit_id',
        'technical_reception_id',
        'result',
        'anomaly_type',
        'observation',
        'reviewed_by_user_email',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function tankUnit()
    {
        return $this->belongsTo(TankUnit::class);
    }

    public function technicalReception()
    {
        return $this->belongsTo(TechnicalReception::class);
    }

    public function isApproved(): bool
    {
        return $this->result === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->result === 'rejected';
    }
}
