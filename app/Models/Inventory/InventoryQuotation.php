<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryQuotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quotation_no',
        'quotation_date',
        'department_name',
        'applicant_name',
        'designation',
        'mobile_number',
        'email_address',
        'purpose',
        'priority_level',
        'workflow_status',
        'current_step',
    ];

    protected $casts = [
        'quotation_date' => 'date',
    ];

    public function items()
    {
        return $this->hasMany(InventoryQuotationItem::class);
    }
}
