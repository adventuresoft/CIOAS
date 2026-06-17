<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgGunInterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_gun_application_id',
        'org_gun_guard_detail_id',
        'guard_physical_mental_capability',
        'guard_weapon_knowledge',
        'guard_behavior_satisfactory',
        'safe_custody_capability',
        'police_report_comments',
        'magistrate_final_comments',
    ];

    public function application()
    {
        return $this->belongsTo(OrgGunApplication::class, 'org_gun_application_id');
    }

    public function guardDetail()
    {
        return $this->belongsTo(OrgGunGuardDetail::class, 'org_gun_guard_detail_id');
    }
}
