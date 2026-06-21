<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryRepairApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'repair_no',
        'application_date',
        'applicant_name',
        'department_name',
        'item_name',
        'product_type',
        'category',
        'unit',
        'quantity',
        'problem_description',
        'status',
        'admin_remarks'
    ];

    protected $casts = [
        'application_date' => 'date',
    ];
}
