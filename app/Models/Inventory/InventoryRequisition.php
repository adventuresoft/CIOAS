<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryRequisition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'institute_id',
        'requisition_no',
        'application_date',
        'department_name',
        'applicant_name',
        'designation',
        'mobile_number',
        'email_address',
        'purpose',
        'priority_level',
        'workflow_status',
        'current_step',
        'department_head_recommendation',
        'department_head_recommended_quantity',
        'department_head_remarks',
        'ndc_budget_availability',
        'ndc_stock_verification_required',
        'ndc_budget_remarks',
        'ndc_recommendation',
        'ndc_comments',
        'adc_administrative_status',
        'adc_financial_status',
        'adc_remarks',
        'dc_final_decision',
        'dc_remarks',
        'issue_slip_number',
        'issue_date',
        'receiver_name',
        'receiver_designation',
        'prepared_by',
        'store_officer',
        'received_by',
        'approved_by',
    ];

    protected $casts = [
        'application_date' => 'date',
        'issue_date' => 'date',
        'ndc_stock_verification_required' => 'boolean',
        'department_head_recommended_quantity' => 'integer',
    ];

    public function items()
    {
        return $this->hasMany(InventoryRequisitionItem::class);
    }

    public function workflowLogs()
    {
        return $this->hasMany(InventoryWorkflowLog::class);
    }
}
