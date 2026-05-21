<?php

namespace App\Models\License;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseSubCategory extends Model
{
    use HasFactory;

    protected $table = 'license_sub_categories';

    protected $fillable = [
        'license_category_id',
        'en_name',
        'bn_name',
        'slug',
        'status',
        'created_by',
        'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(LicenseCategory::class, 'license_category_id', 'id');
    }
}
