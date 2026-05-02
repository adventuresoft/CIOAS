<?php

namespace App\Models\People;

use App\Models\Thana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'property_infos';
    protected $fillable = ['user_id',
    'is_property',
    'cash_amount',
    'tin_number',
    'house',
    'house_type',
    'house_area',
    'house_land_quantity',
    'house_price',
    'house_ownership_status',
    'house_address',
    'land',
    'land_district_id',
    'land_thana_id',
    'land_mouza_id',
    'land_khatian_id',
    'land_dag_no',
    'land_bs',
    'land_rs',
    'land_sa',
    'land_cs',
    'land_quantity',
    'land_type',
    'land_ownership_status',
    'flat',
    'flat_district_id',
    'flat_thana_id',
    'flat_mouza_id',
    'flat_area',
    'flat_road',
    'flat_house_no',
    'flat_quantity',
    'flat_price',
    'flat_ownership_status',
    'diamond',
    'diamond_type',
    'diamond_quantity',
    'diamond_price',
    'diamond_ownership_status',
    'gold',
    'gold_type',
    'gold_quantity',
    'gold_price',
    'gold_ownership_status',
    'silver',
    'silver_type',
    'silver_quantity',
    'silver_price',
    'silver_ownership_status'
    ];


}
