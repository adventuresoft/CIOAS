<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherOrgGunVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'other_org_gun_application_id',
        'necessity_justification',
        'existing_weapons_verification',
        'weapon_details',
        'guard_name',
        'guard_mother_name',
        'guard_father_name_address',
        'guard_nid',
        'social_discipline_issue',
        'criminal_case_status',
        'conviction_status',
        'guard_existing_license',
        'practical_knowledge',
        'certificate_verification_status',
        'adverse_info',
        'safe_custody_capability',
        'oc_comments',
        'sp_dsb_comments',
    ];

    public function application()
    {
        return $this->belongsTo(OtherOrgGunApplication::class, 'other_org_gun_application_id');
    }
}
