<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonGunApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_no',
        'applicant_name',
        'father_name',
        'mother_name',
        'present_address',
        'permanent_address',
        'profession_details',
        'weapon_details',
        'annual_income',
        'income_source',
        'status',
    ];

    public function verification()
    {
        return $this->hasOne(PersonGunVerification::class);
    }

    public function interview()
    {
        return $this->hasOne(PersonGunInterview::class);
    }
}
