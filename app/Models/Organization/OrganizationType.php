<?php

namespace App\Models\Organization;

use App\Models\BasicSettings\OrganizationCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationType extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = "organization_types";
    protected $fillable = [
        'organization_category_id',
        'en_name', 
        'bn_name', 
        'slug', 
        'status', 
        'created_by', 
        'updated_by'
    ];

    public function category()
    {
        return $this->belongsTo(OrganizationCategory::class, 'organization_category_id', 'id');
    }

}
