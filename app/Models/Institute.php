<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;
    public static $snakeAttributes = false;
    protected $table = 'institutes';
    protected $fillable = ['institute_category_id', 'institute_subcategory_id', 'institute_type_id', 'union_id', 'pourashava_id', 'city_corporation_id', 'activation_time',  'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(InstituteCategory::class, 'institute_category_id', 'id');
    }

    public function type()
    {
      return $this->belongsTo(InstituteType::class, 'institute_type_id', 'id');
    }

    public function union()
    {
      return $this->belongsTo(Union::class, 'union_id', 'id');
    }

    public function superUser()
    {
      return $this->hasOne(User::class, 'institute_id', 'id');
    }

   

}
