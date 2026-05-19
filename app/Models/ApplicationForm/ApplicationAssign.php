<?php

namespace App\Models\ApplicationForm;

use App\Models\Department\Department;
use App\Models\Department\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_from_id',
        'from_department_id',
        'from_section_id',
        'to_department_id',
        'to_section_id',
        'from_user_id',
        'to_user_id',
        'assigned_by',
        'note',
        'is_received',
        'received_by',
        'received_at',
    ];

    protected $casts = [
        'is_received' => 'boolean',
        'received_at' => 'datetime',
    ];

    public function applicationForm()
    {
        return $this->belongsTo(ApplicationFrom::class, 'application_from_id');
    }

    public function application_form()
    {
        return $this->applicationForm();
    }

    public function fromDepartment()
    {
        return $this->belongsTo(Department::class, 'from_department_id');
    }

    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section_id');
    }

    public function toDepartment()
    {
        return $this->belongsTo(Department::class, 'to_department_id');
    }

    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function assignedByUser()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function receivedByUser()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
