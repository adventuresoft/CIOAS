<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventoryRequisitionItem extends Model
{
    protected $fillable = [
        'inventory_requisition_id',
        'item_name',
        'category',
        'unit',
        'required_quantity',
        'estimated_unit_cost',
        'estimated_total_cost',
        'remarks',
        'requested_quantity',
        'available_quantity',
        'issue_quantity',
        'stock_status',
        'approved_quantity',
        'issued_quantity',
        'store_remarks',
    ];

    protected $casts = [
        'required_quantity' => 'integer',
        'estimated_unit_cost' => 'decimal:2',
        'estimated_total_cost' => 'decimal:2',
        'requested_quantity' => 'integer',
        'available_quantity' => 'integer',
        'issue_quantity' => 'integer',
        'approved_quantity' => 'integer',
        'issued_quantity' => 'integer',
    ];

    public function requisition()
    {
        return $this->belongsTo(InventoryRequisition::class);
    }
}
