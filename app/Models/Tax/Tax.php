<?php

namespace App\Models\Tax;

use App\Models\BasicSettings\Village;
use App\Models\House;
use App\Models\UnionWard;
use App\Models\User;
use App\Models\VillageArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class Tax extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function taxYear()
    {
        return $this->belongsTo(TaxYear::class, 'tax_year_id', 'id');
    }

    public function village()
    {
        return  $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function unionWard()
    {
        return $this->belongsTo(UnionWard::class, 'ward_id', 'id');
    }

    public function villageArea()
    {
        return $this->belongsTo(VillageArea::class, 'area_id', 'id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = IdGenerator::generate(['table' => 'taxes', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
        });
    }

}
