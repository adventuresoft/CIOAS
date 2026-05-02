<?php
namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationWorkArea extends Model
{
    use HasFactory;
    protected $table = 'organization_work_areas';

    public function category()
    {
        return $this->belongsTo(OrganizationCategory::class, 'organization_category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(OrganizationSubCategory::class, 'organization_subcategory_id', 'id');
    }

}
