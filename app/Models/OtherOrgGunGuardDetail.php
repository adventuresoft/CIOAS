<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherOrgGunGuardDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'other_org_gun_application_id',
        'guard_name',
        'father_name',
        'mother_name',
        'present_address',
        'permanent_address',
        'age',
        'education',
        'nid_number',
        'training_certificate_status',
        'police_report_for_guard',
    ];

    public function application()
    {
        return $this->belongsTo(OtherOrgGunApplication::class, 'other_org_gun_application_id');
    }
}
