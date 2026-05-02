<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionSubCategory extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'profession_sub_categories';
    protected $fillable = ['profession_category_id',
    'en_name',
    'bn_name',
    'slug',
    'status',
    'created_by',
    'updated_by',
    ];

    public function category()
    {
        return $this->belongsTo(ProfessionCategory::class, 'profession_category_id', 'id');
    }
}
