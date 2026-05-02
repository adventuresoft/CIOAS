<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'health_infos';
    protected $fillable = ['user_id',
    'bp',
    'bp_up',
    'bp_down',
    'diabetes',
    'diabetes_start_date',
    'diabetes_status',
    'diabetes_treatment_status',
    'diabetes_doctor',
    'azma',
    'azma_start_date',
    'azma_status',
    'azma_treatment_status',
    'azma_doctor',
    'kidney',
    'kidney_start_date',
    'kidney_status',
    'kidney_treatment_status',
    'kidney_doctor'
    ];
}
