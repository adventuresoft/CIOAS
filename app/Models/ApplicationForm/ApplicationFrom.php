<?php

namespace App\Models\ApplicationForm;

use App\Models\Department\Department;
use App\Models\Department\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationFrom extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'recipient',
        'subject',
        'sender',
        'nid_no',
        'mobile',
        'address',
        'father_name',
        'email',
        'form_type',
        'message',
        'attachment',
        'created_by',
        'updated_by',
        'current_department_id',
        'current_section_id',
        'current_officer_id',
        'receive_id',
        'status',
        'note',
        'initial_approved_by',
        'initial_approved_at',
        'initial_approval_note',
        'approval_note',
        'approved_by',
        'approved_at',
        'final_approved_by',
        'final_approved_at',
        'final_approval_note',
        'revision_note',
        'application_number',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'final_approved_at' => 'datetime',
        'initial_approved_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();


        static::creating(function ($application) {
            $currentYear = date('Y');

$lastApplication = self::whereYear('created_at', $currentYear)
    ->latest('id')
    ->first();

$lastNumber = 0;

if ($lastApplication) {
    preg_match('/N(\d{4})$/', $lastApplication->application_number, $matches);

    if (!empty($matches[1])) {
        $lastNumber = (int) $matches[1];
    }
}

$newNumber = $lastNumber + 1;

$number = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

$application->application_number = 'APP-' . date('ymd') . '-N' . $number;
           
        });
    }


    public function assignments()
    {
        return $this->hasMany(ApplicationAssign::class, 'application_from_id')->latest('id');
    }

    public function currentDepartment()
    {
        return $this->belongsTo(Department::class, 'current_department_id');
    }

    public function currentSection()
    {
        return $this->belongsTo(Section::class, 'current_section_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receive_id');
    }

    public function initialApprover()
    {
        return $this->belongsTo(User::class, 'initial_approved_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function finalApprover()
    {
        return $this->belongsTo(User::class, 'final_approved_by');
    }

}
