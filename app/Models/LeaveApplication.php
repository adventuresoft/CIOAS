<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'leave_type',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'emergency_contact',
        'address_during_leave',
        'relieving_staff_id',
        'attachment',
        'status',
        'admin_remarks',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    public function relievingStaff()
    {
        return $this->belongsTo(Staff::class, 'relieving_staff_id', 'staff_id');
    }
}
