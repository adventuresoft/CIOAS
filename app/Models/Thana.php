<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = 'thanas';
    protected $fillable = ['name', 'bn_name', 'url', 'status', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
