<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type',
        'vehicle_category',
        'vehicle_model',
        'make_year',
        'make_company',
        'ownership_type',
        'owner_id',
        'owner_name',
        'price',
    ];
}
