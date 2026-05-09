<?php

namespace App\Models\HotelRestaurant;

// elloooeh

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BasicSettings\Village;
use App\Models\House;
use App\Models\Institute;
use App\Models\Road;

use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\PostOffice;
use App\Models\UnionWard;
class HotelRestaurantOwnership extends Model
{
    use HasFactory;

    protected $table = "hotel_ownerships";

    protected $fillable = [
        'hotel_restaurant_id',

        'name',
        'bn_name',
        'date_of_birth',
        'birth_certificate',
        'nid',
        'gender',
        'religion',
        'blood_group',
        'mobile',
        'email',

        'father_name',
        'father_name_bn',
        'mother_name',
        'mother_name_bn',

        'permanent_division',
        'permanent_district',
        'permanent_thana',
        'permanent_post_office',
        'permanent_village_id',
        'permanent_ward_id',
        'permanent_road',
        'permanent_house',
        'permanent_house_bn',

        'present_division',
        'present_district_id',
        'present_thana_id',
        'present_post_office_id',
        'present_village_id',
        'present_ward_id',
        'present_road',
        'present_house',
        'present_house_bn',
    ];

    public function permanentDistrict()
    {
        return $this->belongsTo(District::class, 'permanent_district', 'id');

    }

    public function presentDistrict()
    {
        return $this->belongsTo(District::class, 'present_district_id', 'id');

    }


    public function permanentThana()
    {
        return $this->belongsTo(Thana::class, 'permanent_thana', 'id');

    }

    public function presentThana()
    {
        return $this->belongsTo(Thana::class, 'present_thana_id', 'id');

    }
}