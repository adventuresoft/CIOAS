<?php

namespace App\Models\Certificate;

use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unmarried extends Model
{
    use HasFactory,SystemIdGenerator;

    
    
     protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = self::generateSystemId('unmarried_certificates');
        });
    }
    
}
