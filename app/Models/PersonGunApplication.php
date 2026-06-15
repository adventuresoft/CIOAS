<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonGunApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'tracking_no',
        'district_magistrate',
        'application_class',
        'applicant_name',
        'applicant_name_en',
        'nid_no',
        'dob',
        'gender',
        'phone',
        'email',
        'age_at_application',
        'mother_name',
        'mother_profession',
        'father_name',
        'father_profession',
        'marital_status',
        'spouse_name',
        'spouse_profession',
        'nationality',
        'religion',
        'present_address',
        'permanent_address',
        'education_qualification',
        'profession_details',
        'profession_address',
        'annual_income',
        'income_source',
        'tin_no',
        'tax_history_details',
        'is_govt_employee',
        'cadre_service_name',
        'designation',
        'pay_grade_salary',
        'workplace_address',
        'duty_free_import',
        'license_cancelled_before',
        'cancelled_weapon_type',
        'cancellation_reason',
        'weapon_details',
        'necessity_reason',
        'affidavit_attached',
        'heir_deed_attached',
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
