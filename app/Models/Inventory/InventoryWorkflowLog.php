<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class InventoryWorkflowLog extends Model
{
    protected $fillable = [
        'inventory_requisition_id',
        'stage_name',
        'status',
        'actor_name',
        'remarks',
        'action_at',
    ];

    protected $casts = [
        'action_at' => 'datetime',
    ];

    public function requisition()
    {
        return $this->belongsTo(InventoryRequisition::class);
    }
}
