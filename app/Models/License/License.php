<?php

namespace App\Models\License;

use App\Models\Institute;
use App\Models\OwnerShipType;
use App\Traits\BelongsToInstitute;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\PostOffice;
use App\Models\CityCorporation;
use App\Models\Pourashava;
use App\Models\Ward;
use App\Models\BasicSettings\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $table = 'licenses';

    protected $fillable = [
        'application_id',
        'institute_id',
        'name',
        'bn_name',
        'license_category_id',
        'license_subcategory_id',
        'license_type_id',
        'license_no',
        'issue_date',
        'expire_date',
        'application_type',
        'remarks',
        'rjsc_reg_no',
        'no_of_owner',
        'no_of_dir',
        'capital',
        'establish_year',
        'division_id',
        'district_id',
        'thana_id',
        'post_office_id',
        'union_id',
        'village_id',
        'city_id',
        'pos_id',
        'ward_id',
        'road',
        'house',
        'house_bn',
        'location_type',
        'office_division_id',
        'office_district_id',
        'office_thana_id',
        'office_post_office_id',
        'office_union_id',
        'office_village_id',
        'office_city_id',
        'office_pos_id',
        'office_ward_id',
        'office_road',
        'office_house',
        'office_house_bn',
        'office_location_type',
        'premises_ownership',
        'document_files',
        'license_logo',
        'status',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(LicenseCategory::class, 'license_category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(LicenseSubCategory::class, 'license_subcategory_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(OwnerShipType::class, 'license_type_id', 'id');
    }

    public function getHotelCategoryIdAttribute()
    {
        return $this->license_category_id;
    }

    public function getHotelSubcategoryIdAttribute()
    {
        return $this->license_subcategory_id;
    }

    public function getHotelTypeIdAttribute()
    {
        return $this->license_type_id;
    }

    public function getHotelLogoAttribute()
    {
        return $this->license_logo;
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
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

    public function cityCorporation()
    {
        return $this->belongsTo(\App\Models\CityCorporation::class, 'city_id', 'id');
    }

    public function pourashava()
    {
        return $this->belongsTo(Pourashava::class, 'pos_id', 'id');
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
        return $this->belongsTo(\App\Models\Ward::class, 'ward_id', 'id');
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
        return $this->belongsTo(\App\Models\Ward::class, 'office_ward_id', 'id');
    }

    public function officeUnion()
    {
        return $this->belongsTo(Union::class, 'office_union_id', 'id');
    }

    public function officeCityCorporation()
    {
        return $this->belongsTo(\App\Models\CityCorporation::class, 'office_city_id', 'id');
    }

    public function officePourashava()
    {
        return $this->belongsTo(Pourashava::class, 'office_pos_id', 'id');
    }

    
    public function ownerships()
    {
        return $this->hasMany(\App\Models\LicenseOwnership::class, 'application_id', 'application_id');
    }
}
