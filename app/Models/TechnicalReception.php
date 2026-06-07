<?php

namespace App\Models;

use App\Models\TechnicalReceptionItem;
use Illuminate\Database\Eloquent\Model;

class TechnicalReception extends Model
{
    protected $fillable = [
        'document_number',
        'reception_date',
        'invoice_number',
        'remission_guide_number',
        'supplier_name',
        'manufacturer_name',
        'delivered_by',
        'received_by',
        'storage_conditions',
        'quantity_received',
        'documentation_complies',
        'final_result',
        'responsible_name',
        'responsible_position',
        'responsible_observation',
        'created_by_user_email',
        'signed_pdf_path',
        'signed_pdf_uploaded_at',
        'signed_pdf_uploaded_by',
    ];

    protected $casts = [
        'reception_date' => 'datetime',
        'quantity_received' => 'integer',
        'documentation_complies' => 'boolean',
        'signed_pdf_uploaded_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(TechnicalReceptionItem::class)->orderBy('sort_order');
    }

    public function batches()
    {
        return Batch::query()->where('document_number', $this->document_number);
    }

    public function isApproved(): bool
    {
        return $this->final_result === 'aprobado';
    }

    public function isRejected(): bool
    {
        return $this->final_result === 'rechazado';
    }
}
