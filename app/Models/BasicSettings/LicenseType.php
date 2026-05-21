<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'license_types';
    protected $fillable = [
        'en_name',
        'bn_name',
        'slug',
        'status',
        'created_by',
        'updated_by'
    ];
}
