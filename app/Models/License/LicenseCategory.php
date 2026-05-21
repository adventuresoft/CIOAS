<?php

namespace App\Models\License;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseCategory extends Model
{
    use HasFactory;

    protected $table = 'license_categories';

    protected $fillable = [
        'en_name',
        'bn_name',
        'slug',
        'status',
        'created_by',
        'updated_by',
    ];

    public function subcategories()
    {
        return $this->hasMany(LicenseSubCategory::class, 'license_category_id', 'id');
    }
}
