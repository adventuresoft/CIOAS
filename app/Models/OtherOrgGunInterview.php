<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherOrgGunInterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'other_org_gun_application_id',
        'applicant_name_designation',
        'present_address',
        'permanent_address',
        'documents_correct',
        
        'guard_name',
        'guard_father_name',
        'guard_mother_name',
        'guard_present_address',
        'guard_permanent_address',
        'guard_age',
        'guard_education',
        
        'physical_mental_fitness',
        'weapon_handling_knowledge',
        'behavior_satisfactory',
        
        'police_report_comments',
        'magistrate_final_comments',
    ];

    public function application()
    {
        return $this->belongsTo(OtherOrgGunApplication::class, 'other_org_gun_application_id');
    }
}
