<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'land_id', 'record_type', 'district_id', 'upazila_id', 'mouza_id', 
        'record_group', 'dag_no', 'khatian_no', 'total_dag_no', 
        'total_land', 'owner_name'
    ];

    public function land()
    {
        return $this->belongsTo(Land::class, 'land_id', 'id');
    }
}
