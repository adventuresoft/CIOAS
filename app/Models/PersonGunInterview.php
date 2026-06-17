<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonGunInterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_gun_application_id',
        'age',
        'education',
        'physical_mental_fitness',
        'weapon_handling_knowledge',
        'gun_law_knowledge',
        'safe_custody_capability',
        'safety_necessity_justification',
        'behavior_satisfactory',
        'police_report_comments',
        'magistrate_final_comments',
    ];

    public function application()
    {
        return $this->belongsTo(PersonGunApplication::class, 'person_gun_application_id');
    }
}
