<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgGunVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_gun_application_id',
        'weapon_necessity_approved',
        'existing_weapons_verified',
        'vault_limit_verified',
        'guard_has_criminal_record',
        'guard_case_details',
        'guard_social_discipline_issue',
        'guard_existing_license',
        'guard_practical_knowledge',
        'certificate_verification_status',
        'adverse_info',
        'oc_comments',
        'sp_dsb_comments',
    ];

    public function application()
    {
        return $this->belongsTo(OrgGunApplication::class, 'org_gun_application_id');
    }
}
