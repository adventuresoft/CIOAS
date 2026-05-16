<?php

namespace App\Models\ApplicationForm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

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
        'current_officer_id',
        'receive_id',
        'status',
        'note',
        'application_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            $lastId                          = self::max('id') + 1;
            $number                          = str_pad($lastId, 4, '0', STR_PAD_LEFT);
            $application->application_number = 'APP-' . $number;
        });
    }


    public function assignments()
    {
        return $this->hasMany(ApplicationFrom::class);
    }

}
