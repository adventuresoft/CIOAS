<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthCertificate extends Model
{
    use HasFactory,SystemIdGenerator;

    public static $snakeAttributes = false;
    public $table = 'birth_certificates';
    protected $fillable = ['user_id',
    'system_id',
    'fees',
    'quantity',
    'total_amount',
    'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
     protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = self::generateSystemId('birth_certificates');
        });
    }
}
