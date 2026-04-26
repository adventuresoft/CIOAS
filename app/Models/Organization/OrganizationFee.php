<?php

namespace App\Models\Organization;

use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationSubCategory;
use App\Models\InstituteType;
use App\Models\Tax\TaxYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationFee extends Model
{
    use HasFactory;


    public function taxYear()
    {
        return $this->belongsTo(TaxYear::class, 'tax_year_id', 'id');
    }

    public function instituteType()
    {
        return $this->belongsTo(InstituteType::class, 'institute_type_id', 'id');
    }

    public function organizationCategory()
    {
        return $this->belongsTo(OrganizationCategory::class, 'organization_category_id', 'id');
    }

    public function organizationSubcategory()
    {
        return $this->belongsTo(OrganizationSubCategory::class, 'organization_subcategory_id', 'id');
    }


}
