<?php

namespace App\Models;

use App\Models\BasicSettings\RoadCategory;
use App\Models\BasicSettings\RoadType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'roads';
    protected $fillable = ['name', 'bn_name', 'distance', 'road_type_id', 'road_category_id', 'start_point', 'end_point', 'make_year', 'make_contactor', 'make_value', 'current_condition', 'road_owner_id', 'institute_id', 'created_by', 'updated_by'];


    public function roadType()
    {
        return $this->belongsTo(RoadType::class, 'road_type_id', 'id');
    }

    public function roadCategory()
    {
        return $this->belongsTo(RoadCategory::class, 'road_category_id', 'id');
    }

    public function roadOwner()
    {
        return $this->belongsTo(RoadOwner::class, 'road_owner_id', 'id');
    }

}
