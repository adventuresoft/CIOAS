<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'family_infos';
    protected $fillable = ['user_id',
    'family_type_id',
    'family_category_id',
    'father_name',
    'father_name_bn',
    'father_live_status',
    'father_nid',
    'mother_name',
    'mother_name_bn',
    'mother_live_status',
    'mother_nid',
    'marital_status',
    'spouse_name',
    'spouse_nid',
    'married_date',
    'have_children',
    'boys',
    'girls',
    ];
}
