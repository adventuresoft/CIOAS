<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'from_point',
        'middle_point',
        'end_point',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
