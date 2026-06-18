<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = 'upazilas';
    protected $fillable = ['name', 'bn_name', 'code', 'status', 'district_id', 'record'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
