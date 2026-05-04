<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'finance_year',
        'vehicle_type',
        'vehicle_category',
        'fee_for',
        'registration_fee',
        'road_fee',
        'fitness_fee',
        'vat_fee',
        'tax_fee',
        'total_fee',
    ];
}

