<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherOrgGunApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'tracking_no',
        'org_name',
        'org_type',
        'phone',
        'email',
        'org_address',
        'operation_start_date',
        'organogram_manpower_details',
        'has_trade_license_mou_aou',
        'owner_or_ceo_details',
        'rental_agreement_details',
        'tin_no',
        'tax_history',
        'paid_up_capital',
        'existing_weapons_details',
        'safe_custody_details',
        'trained_guard_count',
        'police_report_for_guard',
        'guard_cv',
        'status',
    ];

    public function verification()
    {
        return $this->hasOne(OtherOrgGunVerification::class, 'other_org_gun_application_id');
    }

    public function interview()
    {
        return $this->hasOne(OtherOrgGunInterview::class, 'other_org_gun_application_id');
    }

    public function guardDetails()
    {
        return $this->hasMany(OtherOrgGunGuardDetail::class, 'other_org_gun_application_id');
    }
}
