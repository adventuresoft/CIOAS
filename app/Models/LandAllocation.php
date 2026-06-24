<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandAllocation extends Model
{
    use HasFactory;

    protected $table = 'land_allocations';

    protected $fillable = [
        'land_no',
        'total_persons',
        'persons',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'persons' => 'array',
    ];

    public function land()
    {
        return $this->belongsTo(Land::class, 'land_no', 'land_no');
    }
}
