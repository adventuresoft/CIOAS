<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgGunApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'tracking_no',
        'org_name',
        'phone',
        'email',
        'org_address',
        'operation_start_date',
        'vault_limit',
        'vehicle_count',
        'owner_or_ceo_details',
        'organogram_manpower_details',
        'bangladesh_bank_permission',
        'tax_details',
        'current_security_description',
        'rental_agreement_details',
        'weapon_count_requested',
        'weapon_nature_requested',
        'justification_of_necessity',
        'existing_weapons_details',
        'status',
    ];

    public function guardDetails()
    {
        return $this->hasMany(OrgGunGuardDetail::class);
    }

    public function verification()
    {
        return $this->hasOne(OrgGunVerification::class);
    }

    public function interviews()
    {
        return $this->hasMany(OrgGunInterview::class);
    }
}
