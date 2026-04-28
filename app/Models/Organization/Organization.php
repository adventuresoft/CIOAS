<?php

namespace App\Models\Organization;

use App\Models\BasicSettings\OrganizationCategory;
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

class Organization extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = "organizations";
    // protected $fillable = [
    //     'system_id',
    //     'name',
    //     'bn_name',
    //     'institute_id',
    //     'organization_category_id',
    //     'organization_subcategory_id',
    //     'organization_work_area_id',
    //     'organization_type_id',
    //     'rjsc_reg_no',
    //     'organization_ownership_type_id',
    //     'no_of_owner',
    //     'village_id',
    //     'union_ward_id',
    //     'village_area_id',
    //     'road_id',
    //     'house_id',
    //     'capital',
    //     'application_type',
    //     'establish_year',
    //     'remarks',
    //     'status'
    // ];

    protected $fillable = [
    'institute_id',
    'application_id',
    'name',
    'bn_name',
    'organization_category_id',
    'organization_subcategory_id',
    'organization_work_area_id',
    'organization_type_id',
    'organization_ownership_type_id',
    'rjsc_reg_no',
    'no_of_owner',
    'division_id',
    'district_id',
    'thana_id',
    'post_office_id',
    'union_id',
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
];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->system_id = IdGenerator::generate(['table' => 'organizations', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
        });
    }

    public function ownership()
    {
        return $this->hasMany(OrganizationOwnership::class, 'organization_id', 'id');
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
        return $this->belongsTo(OrganizationCategory::class, 'organization_category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(OrganizationSubCategory::class, 'organization_subcategory_id', 'id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'id');
    }

    public function road()
    {
        return $this->belongsTo(Road::class, 'road_id', 'id');
    }

    public function villageArea()
    {
        return $this->belongsTo(VillageArea::class, 'village_area_id', 'id');
    }

    // public function village()
    // {
    //     return $this->belongsTo(Village::class, 'village_id', 'id');
    // }

    public function type()
    {
       return $this->belongsTo(OrganizationType::class, 'organization_type_id', 'id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }


}
