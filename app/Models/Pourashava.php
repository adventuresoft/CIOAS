<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pourashava extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = 'pourashavas';
    protected $fillable = ['district_id', 'name', 'bn_name', 'slug', 'category', 'status'];

    public function district(){
        return $this->belongsTo(District::class);
    }
}
