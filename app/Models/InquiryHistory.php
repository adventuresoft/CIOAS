<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'user_id',
        'from_department_id',
        'from_section_id',
        'to_department_id',
        'to_section_id',
        'from_user_id',
        'to_user_id',
        'note',
    ];

    public function fromDepartment()
    {
        return $this->belongsTo(\App\Models\Department\Department::class, 'from_department_id');
    }

    public function fromSection()
    {
        return $this->belongsTo(\App\Models\Department\Section::class, 'from_section_id');
    }

    public function toDepartment()
    {
        return $this->belongsTo(\App\Models\Department\Department::class, 'to_department_id');
    }

    public function toSection()
    {
        return $this->belongsTo(\App\Models\Department\Section::class, 'to_section_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'to_user_id');
    }

    public function assignedByUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
