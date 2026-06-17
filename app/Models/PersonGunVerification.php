<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonGunVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_gun_application_id',
        'has_criminal_record',
        'criminal_case_details',
        'social_discipline_issue',
        'practical_knowledge',
        'life_threat_justification',
        'certificate_verification_status',
        'adverse_info',
        'oc_comments',
        'sp_dsb_comments',
    ];

    public function application()
    {
        return $this->belongsTo(PersonGunApplication::class, 'person_gun_application_id');
    }
}
