<?php

namespace App\Models;

use App\Models\BasicSettings\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageArea extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'village_areas';
    protected $fillable = ['division_id', 'district_id', 'thana_id', 'union_id', 'village_id', 'en_name', 'bn_name', 'slug', 'status', 'created_by', 'updated_by'];


    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }
}
