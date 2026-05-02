<?php

namespace App\Models;

use App\Models\BasicSettings\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = "houses";
    protected $fillable = [
        'house', 
        'house_bn',
        'institute_id', 
        'village_id',
        'village_area_id', 
        'union_ward_id', 
        'house_type_id',  
        'house_category_id', 
        'house_owner_type_id',
        'mouza_id', 
        'brs_khatian', 
        'brs_dag',  
        'land_quantity', 
        'house_price'
    ];

    public function ownership()
    {
      return  $this->hasMany(HouseOwnership::class, 'house_id', 'id');
    }

    public function village()
    {
      return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function unionWard()
    {
      return $this->belongsTo(UnionWard::class, 'union_ward_id', 'id');
    }

   


}
