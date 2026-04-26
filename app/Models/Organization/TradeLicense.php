<?php

namespace App\Models\Organization;

use App\Models\Tax\TaxYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class TradeLicense extends Model
{
    use HasFactory;


    public function taxYear()
    {
        return $this->belongsTo(TaxYear::class, 'tax_year_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = IdGenerator::generate(['table' => 'trade_licenses', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
        });
    }

}
