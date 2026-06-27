<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnionWard extends Model
{
    use HasFactory;

    protected $table = 'union_wards';

    protected $fillable = [
        'en_ward_no',
        'bn_ward_no',
        'status',
        'created_by',
        'updated_by',
    ];
}
