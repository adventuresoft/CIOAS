<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityCorporation extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = 'city_corporations';
    protected $fillable = ['district_id', 'name', 'bn_name', 'slug', 'status'];

    public function district(){
        return $this->belongsTo(District::class);
    }
}
