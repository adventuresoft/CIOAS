<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyType extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'family_types';
    protected $fillable = ['en_name',
    'bn_name',
    'slug',
    'slug',
    'created_by',
    'updated_by'
    ];
}
