<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryVendor extends Model
{
    protected $fillable = [
        'name',
        'name_bn',
        'trade_license',
        'tin',
        'bin',
        'contact_number',
        'email',
        'address',
        'bank_ac_number',
        'bank_name',
        'branch',
    ];
}
