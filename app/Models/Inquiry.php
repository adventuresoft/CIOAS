<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'details',
        'applicant_name',
        'father_name',
        'nid_number',
        'mobile_number',
        'email',
        'address',
        'proof_file',
        'status',
        'comment',
        'current_department_id',
        'current_section_id',
        'approved_by',
    ];

    public function currentDepartment()
    {
        return $this->belongsTo(\App\Models\Department\Department::class, 'current_department_id');
    }

    public function currentSection()
    {
        return $this->belongsTo(\App\Models\Department\Section::class, 'current_section_id');
    }

    public function approver()
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function assignments()
    {
        return $this->hasMany(InquiryHistory::class, 'inquiry_id');
    }
}
