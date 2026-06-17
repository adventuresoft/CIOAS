<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryWorkOrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'required_quantity' => 'decimal:2',
        'purchase_quantity' => 'decimal:2',
        'receive_quantity' => 'decimal:2',
        'price' => 'decimal:2',
    ];

    public function workOrder()
    {
        return $this->belongsTo(InventoryWorkOrder::class, 'inventory_work_order_id');
    }
}
