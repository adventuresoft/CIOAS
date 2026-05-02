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

class AreaInfo extends Model
{
    use HasFactory;

    

    protected $fillable = ['user_id',
    'chairman_type_id',
    'division_id',
    'district_id',
    'thana_id',
    'union_id',
    'start_date',
    'end_date',
    'status',
    ];
    
    
    
}
