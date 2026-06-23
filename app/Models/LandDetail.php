<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandDetail extends Model
{
    use HasFactory;

    protected $table = 'land_details';

    protected $fillable = [
        'land_id',
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
        'remarks'
    ];

    public function land()
    {
        return $this->belongsTo(Land::class, 'land_id', 'id');
    }
}
