<?php

namespace App\Models;

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
use App\Models\Ward;

class LicenseOwnership extends Model
{
    use HasFactory;

    protected $table = "license_ownerships";

    protected $fillable = [
        'application_id',

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

        'permanent_location_type',
        'permanent_city_id',
        'permanent_pos_id',
        'permanent_union_id',
        'present_division',
        'present_district_id',
        'present_thana_id',
        'present_post_office_id',
        'present_village_id',
        'present_ward_id',
        'present_road',
        'present_house',
        'present_house_bn',
        'present_location_type',
        'present_city_id',
        'present_pos_id',
        'present_union_id',
        
        'photo',
        'signature',
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

    public function presentVillage()
    {
        return $this->belongsTo(Village::class, 'present_village_id', 'id');
    }

    public function permanentVillage()
    {
        return $this->belongsTo(Village::class, 'permanent_village_id', 'id');
    }

    public function permanentPostOffice()
    {
        return $this->belongsTo(PostOffice::class, 'permanent_post_office', 'id');
    }

    public function presentPostOffice()
    {
        return $this->belongsTo(PostOffice::class, 'present_post_office_id', 'id');
    }

    public function presentWard()
    {
        return $this->belongsTo(Ward::class, 'present_ward_id', 'id');
    }

    public function permanentWard()
    {
        return $this->belongsTo(Ward::class, 'permanent_ward_id', 'id');
    }

    public function permanentUnion()
    {
        return $this->belongsTo(Union::class, 'permanent_union_id', 'id');
    }

    public function permanentCityCorporation()
    {
        return $this->belongsTo(\App\Models\CityCorporation::class, 'permanent_city_id', 'id');
    }

    public function permanentPourashava()
    {
        return $this->belongsTo(\App\Models\Pourashava::class, 'permanent_pos_id', 'id');
    }

    public function presentUnion()
    {
        return $this->belongsTo(Union::class, 'present_union_id', 'id');
    }

    public function presentCityCorporation()
    {
        return $this->belongsTo(\App\Models\CityCorporation::class, 'present_city_id', 'id');
    }

    public function presentPourashava()
    {
        return $this->belongsTo(\App\Models\Pourashava::class, 'present_pos_id', 'id');
    }
}
