<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'educational_infos';
    protected $fillable = ['user_id',
    'degree_id',
    'group_id',
    'grade_id',
    'board_id',
    'passing_year',
    'institute'
    ];
}
