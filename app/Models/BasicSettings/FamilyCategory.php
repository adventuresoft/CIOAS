<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyCategory extends Model
{
    use HasFactory;

    protected $table = 'family_categories';

    protected $fillable = [
        'en_name',
        'bn_name',
        'slug',
        'status',
        'created_by',
        'updated_by',
    ];
}
