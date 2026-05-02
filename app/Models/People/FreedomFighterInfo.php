<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreedomFighterInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'freedom_fighter_infos';
    protected $fillable = ['user_id',
    'is_freedom_fighter',
    'type_id',
    'area_id',
    'designation_id',
    'freedom_fighter_id',
    'commander_name'
    ];
}
