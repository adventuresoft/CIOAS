<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseOwnership extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = "house_ownerships";
    protected $fillable = [
        'house_id', 
        'name', 
        'nid', 
        'mobile', 
        'address', 
        'quantity'
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'id');
    }
}
