<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $table = 'lands';

    protected $fillable = [
        'land_no',
        'land_type',
        'record_type',
        'district_id',
        'upazila_id',
        'mouza_id',
        'status',
        'created_by',
        'updated_by',
        'locations',
        'details',
        'documents',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'locations' => 'array',
        'details' => 'array',
        'documents' => 'array',
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

    public function type()
    {
        return $this->belongsTo(LandType::class, 'land_type', 'id');
    }

    public function record()
    {
        return $this->belongsTo(LandRecord::class, 'record_type', 'id');
    }
}
