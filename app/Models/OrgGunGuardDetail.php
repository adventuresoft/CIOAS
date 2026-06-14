<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgGunGuardDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_gun_application_id',
        'guard_name',
        'father_name',
        'mother_name',
        'present_address',
        'permanent_address',
        'age',
        'education',
        'nid_number',
        'training_certificate_status',
    ];

    public function application()
    {
        return $this->belongsTo(OrgGunApplication::class, 'org_gun_application_id');
    }

    public function interview()
    {
        return $this->hasOne(OrgGunInterview::class);
    }
}
