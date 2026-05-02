<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'disability_infos';
    protected $fillable = ['user_id',
    'is_disability',
    'disability_name_id',
    'disability_category_id',
    'disability_type_id',
    'start_date',
    'treatment_status_id',
    'disability_doctor'
    ];
}
