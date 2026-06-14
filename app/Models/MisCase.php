<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\institute;

class MisCase extends Model
{
    use HasFactory;

    protected $casts = [
        'case_date' => 'date',
        'next_hearing_date' => 'date',
        'plaintiffs' => 'array',
        'defendants' => 'array',
        'land_info' => 'array',
        'files' => 'array',
    ];

    const CASE_TYPES = [
        '1' => 'শ্রেণি পরিবর্তন',
        '2' => 'নামজারি সংক্রান্ত',
        '3' => 'মুদ্রণজনিত ত্রুটি',
        '4' => 'নিলাম বিজ্ঞপ্তি',
        '5' => 'অর্পিত থেকে খাস করা',
        '6' => 'বন্দোবস্ত মামলা',

        // Roman mappings for auto-generation
        'X-1' => 'শ্রেণি পরিবর্তন',
        'XI-1' => 'নামজারি সংক্রান্ত',
        'III-1' => 'মুদ্রণজনিত ত্রুটি',
        'I-1' => 'নিলাম বিজ্ঞপ্তি',
        'XII-1' => 'অর্পিত থেকে খাস করা',
    ];

    const CASE_CATEGORIES = [
        'unit-1' => 'Unit 1',
        'unit-2' => 'Unit 2',
    ];

    public function getCaseTypeLabelAttribute()
    {
        return self::CASE_TYPES[$this->case_type] ?? $this->case_type;
    }

    public function getCaseTypeCodeAttribute()
    {
        $map = [
            '1' => 'X-1',
            '2' => 'XI-1',
            '3' => 'III-1',
            '4' => 'I-1',
            '5' => 'XII-1',
            '6' => 'XI-1',
        ];

        return $map[$this->case_type] ?? ($this->case_type ?: 'XI-1');
    }

    public function getCaseCategoryLabelAttribute()
    {
        return self::CASE_CATEGORIES[$this->case_category] ?? $this->case_category;
    }

    /**
     * Has many CaseOrders
     */
    public function caseOrders()
    {
        return $this->hasMany(CaseOrder::class, 'mis_case_id')->orderBy('created_at', 'desc');
    }

    public function institue()
    {
        return $this->belongsTo(institute::class, 'institute_id');
    }
}
