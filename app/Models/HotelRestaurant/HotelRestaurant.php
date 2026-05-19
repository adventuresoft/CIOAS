<?php

namespace App\Models\HotelRestaurant;

use App\Models\HotelRestaurant\HotelCategory;
use App\Models\OwnerShipType;
use App\Models\BasicSettings\OrganizationSubCategory;
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


use App\Models\VillageArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Organization\OrganizationOwnership;
use App\Models\Organization\OrganizationType;
use App\Models\HotelRestaurant\HotelRestaurantOwnership;
use App\Traits\BelongsToInstitute;


class HotelRestaurant extends Model
{
    use HasFactory, BelongsToInstitute;

    public static $snakeAttributes = false;
    protected     $table           = "hotel_restaurants";


    protected $fillable = [
        'institute_id',
        'application_id',
        'name',
        'bn_name',
        'hotel_category_id',
        'hotel_subcategory_id',
        'hotel_work_area_id',
        'hotel_type_id',
        'rjsc_reg_no',
        'no_of_owner',
        'division_id',
        'district_id',
        'thana_id',
        'post_office_id',
        'village_id',
        'ward_id',
        'road',
        'house',
        'house_bn',
        'office_division_id',
        'office_district_id',
        'office_thana_id',
        'office_post_office_id',
        'office_village_id',
        'office_ward_id',
        'office_road',
        'office_house',
        'office_house_bn',
        'premises_ownership',
        'capital',
        'establish_year',
        'application_type',
        'remarks',
        'status',
        'hotel_logo',
        'document_files',
        'no_of_dir',
        'union_id',
        'city_id',
        'pos_id',
        'office_union_id',
        'office_city_id',
        'office_pos_id',
        'location_type',
        'office_location_type'

    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->system_id = IdGenerator::generate([ 'table' => 'hotel_restaurants', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
        });
    }

    public function ownership()
    {
        return $this->hasMany(HotelRestaurantOwnership::class, 'hotel_restaurant_id', 'id');
    }


    public function ownershipType()
    {
        return $this->belongsTo(OwnerShipType::class, 'hotel_type_id', 'id');
    }


    public function Division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }


    public function District()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function Thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }


    public function Union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }


    public function Village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function postOffice()
    {
        return $this->belongsTo(PostOffice::class, 'post_office_id', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(UnionWard::class, 'ward_id', 'id');
    }

    public function officeDivision()
    {
        return $this->belongsTo(Division::class, 'office_division_id', 'id');
    }

    public function officeDistrict()
    {
        return $this->belongsTo(District::class, 'office_district_id', 'id');
    }

    public function officeThana()
    {
        return $this->belongsTo(Thana::class, 'office_thana_id', 'id');
    }

    public function officePostOffice()
    {
        return $this->belongsTo(PostOffice::class, 'office_post_office_id', 'id');
    }

    public function officeVillage()
    {
        return $this->belongsTo(Village::class, 'office_village_id', 'id');
    }

    public function officeWard()
    {
        return $this->belongsTo(UnionWard::class, 'office_ward_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo(HotelCategory::class, 'hotel_category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(HotelSubCategory::class, 'hotel_subcategory_id', 'id');
    }



    public function villageArea()
    {
        return $this->belongsTo(VillageArea::class, 'village_area_id', 'id');
    }


    public function type()
    {
        return $this->belongsTo(OwnerShipType::class, 'hotel_type_id', 'id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }


}