<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryWorkOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        'work_order_no',
        'application_date',
        'validity_date',
        'delivery_date',
        'department_name',
        'applicant_name',
        'designation',
        'mobile_number',
        'email_address',
        'purpose',
        'priority_level',
        'workflow_status',
        'current_step',
        'inventory_vendor_id',
        'chalan_no',
        'invoice_no'
    ];

    protected $casts = [
        'application_date' => 'date',
        'validity_date' => 'date',
        'delivery_date' => 'date',
        'is_approved' => 'boolean',
    ];

    public function vendor()
    {
        return $this->belongsTo(InventoryVendor::class, 'inventory_vendor_id');
    }

    public function purchaseOrder()
    {
        return $this->hasOne(InventoryPurchaseOrder::class, 'inventory_work_order_id');
    }

    public function items()
    {
        return $this->hasMany(InventoryWorkOrderItem::class);
    }

    public function requisitions()
    {
        return $this->belongsToMany(InventoryRequisition::class, 'inventory_requisition_work_order');
    }
}
