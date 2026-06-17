<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryQuotationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_quotation_id',
        'item_name',
        'category',
        'unit',
        'price',
    ];

    public function quotation()
    {
        return $this->belongsTo(InventoryQuotation::class, 'inventory_quotation_id');
    }
}
