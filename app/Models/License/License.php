<?php

namespace App\Models\License;

use App\Models\Institute;
use App\Models\OwnerShipType;
use App\Traits\BelongsToInstitute;
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
}
