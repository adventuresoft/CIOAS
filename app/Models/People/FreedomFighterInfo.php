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
    'commander_name',
    'is_july_fighter',
    'july_type_id',
    'july_area_id',
    'july_designation_id',
    'july_fighter_id',
    'july_commander_name',
    'july_incident_location',
    'july_injury_details',
    'july_contribution_description'
    ];
}
