<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public $table = 'staffs';

    protected $fillable = [
        'user_id',
        'staff_id',
        'is_staff',
        'bn_name',
        'date_of_birth',
        'birth_place',
        'district_id',
        'country_id',
        'gender',
        'religion_id',
        'blood_group',
        'approved_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}

