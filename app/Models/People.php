<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'people';
    protected $fillable = ['user_id',
    'account_type',
    'name',
    'date_of_birth',
    'birth_place',
    'gender',
    'religion_id',
    'blood_group',
    'mobile',
    'email',
    'name',
    'birth_certificate',
    'nid',
    'image',
    'status',
    'created_by',
    'updated_by'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
