<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'vehicle_type',
        'vehicle_category',
        'vehicle_model',
        'make_year',
        'make_company',
        'ownership_type',
        'owner_id',
        'owner_name',
        'institutional_name',
        'trade_license',
        'institutional_address',
        'price',
        'engine_number',
        'chassis_number',
        'tyre_number',
        'hp_cc',
        'seat_capacity',
        'height',
        'width',
        'tyre_size',
        'color',
        // New columns
        'registration_no',
        'rc_attachment', 'rc_issue_date', 'rc_validity_date',
        'rp_attachment', 'rp_issue_date', 'rp_validity_date',
        'tt_attachment', 'tt_issue_date', 'tt_validity_date',
        'in_attachment', 'in_issue_date', 'in_validity_date',
        'driver_registration_no'
    ];

    public function routes()
    {
        return $this->hasMany(VehicleRoute::class);
    }

    public function repairings()
    {
        return $this->hasMany(VehicleRepairing::class);
    }

    public function fuels()
    {
        return $this->hasMany(VehicleFuel::class);
    }
}
