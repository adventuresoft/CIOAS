<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationSubtype extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = "organization_subtypes";
    protected $fillable = [
        'organization_type_id',
        'en_name', 
        'bn_name', 
        'slug', 
        'status', 
        'created_by', 
        'updated_by'
    ];

    public function subtype()
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id', 'id');
    }
}
