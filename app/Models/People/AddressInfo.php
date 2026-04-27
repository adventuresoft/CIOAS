<?php

namespace App\Models\People;

use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\House;
use App\Models\Road;
use App\Models\Thana;
use App\Models\Union;
use App\Models\UnionWard;
use App\Models\User;
use App\Models\PostOffice;
use App\Models\VillageArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;

    // protected $fillable = ['user_id',
    // 'chairman_type_id',
    // 'division_id',
    // 'district_id',
    // 'thana_id',
    // 'union_id',
    // 'start_date',
    // 'end_date',
    // 'status',
    // ];

     protected $guarded = [];

    public function presentUnion()
    {
        return $this->belongsTo(Union::class, 'present_union_id', 'id');
    }

    public function permanentUnion()
    {
        return $this->belongsTo(Union::class, 'permanent_union_id', 'id');
    }

    public function presentRoad()
    {
        return $this->belongsTo(Road::class, 'present_road', 'id');
    }

    public function permanentRoad()
    {
        return $this->belongsTo(Road::class, 'permanent_road', 'id');
    }
 public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     public function permanentThana()
    {
        return $this->belongsTo(Thana::class, 'permanent_thana_id', 'id');
    }

    public function presentThana()
    {
        return $this->belongsTo(Thana::class, 'present_thana_id', 'id');
    }


 public function permanentDistrict()
    {
        return $this->belongsTo(District::class, 'permanent_district_id', 'id');
    }

    public function presentDistrict()
    {
        return $this->belongsTo(District::class, 'present_district_id', 'id');
    }

    public function permanentVillage()
    {
        return $this->belongsTo(Village::class, 'permanent_village_id', 'id');
    }

    public function presentVillage()
    {
        return $this->belongsTo(Village::class, 'present_village_id', 'id');
    }

    public function permanentWard()
    {
        return $this->belongsTo(UnionWard::class, 'permanent_ward_id', 'id');

    }

    public function presentWard()
    {
        return $this->belongsTo(UnionWard::class, 'present_ward_id', 'id');
    }

    public function permanentHouse()
    {
        return $this->belongsTo(House::class, 'permanent_house', 'id');
    }

    public function presentHouse()
    {
        return $this->belongsTo(House::class, 'present_house', 'id');
    }

    public function presentArea()
    {
        return $this->belongsTo(VillageArea::class, 'present_village_area_id', 'id');
    }
    public function permanentArea()
    {
        return $this->belongsTo(VillageArea::class, 'permanent_village_area_id', 'id');
    }

    public function presentPostoffice()
    {
        return $this->belongsTo(PostOffice::class, 'present_post_office_id', 'id');
    }

    public function permanentPostOffice()
    {
        return $this->belongsTo(PostOffice::class, 'permanent_post_office_id', 'id');
    }


}
