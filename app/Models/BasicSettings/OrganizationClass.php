<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationClass extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(OrganizationCategory::class, 'organization_category_id', 'id');
    }
}
