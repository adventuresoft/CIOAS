<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $table = 'lands';

    protected $fillable = [
        'land_type',
        'record_type',
        'district_id',
        'upazila_id',
        'mouza_id',
        'status',
        'created_by',
        'approved_by',
        'approved_at'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }

    public function mouza()
    {
        return $this->belongsTo(Mouza::class, 'mouza_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(LandDetail::class, 'land_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(LandDocument::class, 'land_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany(LandLocation::class, 'land_id', 'id');
    }
}
