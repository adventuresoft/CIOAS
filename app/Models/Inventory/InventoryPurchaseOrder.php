<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryPurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_work_order_id',
        'po_number',
        'validity_date',
        'delivery_date'
    ];

    protected $casts = [
        'validity_date' => 'date',
        'delivery_date' => 'date',
    ];

    public function workOrder()
    {
        return $this->belongsTo(InventoryWorkOrder::class, 'inventory_work_order_id');
    }
}
