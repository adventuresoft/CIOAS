<?php

namespace App\Models\People;

use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\House;
use App\Models\Road;
use App\Models\Thana;
use App\Models\Union;
use App\Models\UnionWard;
use App\Models\VillageArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouncilMemberHistory extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;

    protected $fillable = ['user_id',
    'chairman_type_id',
    'area_info_id',
    'city_corporation',
    'union_id',
    'word_id',    
    'status',
    ];
    
    
    
}
