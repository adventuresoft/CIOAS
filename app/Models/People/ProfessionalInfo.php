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
    protected $fillable = [
        'user_id',
        'profession',
        'profession_start',
        'profession_end',
        'grade',
        'salary_structure',
        'company',
        'address',
        'recruitment_notice_no',
        'appointment_letter_no',
        'designation_joining',
        'date_of_joining',
        'department',
        'current_designation',
        'date_current_designation',
        'current_workplace',
        'date_joining_current_workplace'
    ];


    public function subcategory()
    {
        return $this->belongsTo(ProfessionSubCategory::class, 'profession_subcategory_id', 'id');
    }
}
