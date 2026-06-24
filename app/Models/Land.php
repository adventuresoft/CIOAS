<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'dag_no',
        'khatian_no',
        'recorded_owner_name',
        'recorded_class',
        'actual_class',
        'total_land',
        'land_amount',
        'possession_status',
        'case_no',
        'gazette_no',
        'remarks',
        'status',
        'created_by',
        'updated_by',
        'locations',
        'documents',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'locations' => 'array',
        'documents' => 'array',
        'total_land' => 'decimal:4',
        'land_amount' => 'decimal:4',
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

    public function case()
    {
        return $this->hasMany(LandCase::class, 'land_no', 'land_no');
    }
}
