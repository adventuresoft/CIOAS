<?php

namespace App\Models\People;

use App\Models\BasicSettings\ProfessionSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'professional_infos';
    protected $fillable = ['user_id',
    'profession',
    'profession_start',
    'profession_end',
    'grade',
    'salary_structure',
    'company',
    'address'
    ];


    public function subcategory()
    {
        return $this->belongsTo(ProfessionSubCategory::class, 'profession_subcategory_id', 'id');
    }
}
