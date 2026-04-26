<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilySubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_category_id',
        'en_name',
        'bn_name',
    ];

    public function category()
    {
        return $this->belongsTo(FamilyCategory::class, 'family_category_id', 'id');
    }
}
