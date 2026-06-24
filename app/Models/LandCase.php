<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandCase extends Model
{
    protected $table = 'land_cases';

    protected $fillable = [
        'land_no',
        'has_case',
        'case_no',
        'court_name',
        'case_status',
        'comment',
        'status',
        'created_by',
        'updated_by',
    ];

    public function land()
    {
        return $this->belongsTo(Land::class, 'land_no', 'land_no');
    }
}

