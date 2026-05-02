<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Succession extends Model
{
    use HasFactory,SystemIdGenerator;

    public static $snakeAttributes = false;
    public $table = 'successions';
    protected $fillable = ['user_id',
    'members',
    'fees',
    'quantity',
    'total_amount',
    'created_by',
    'taken_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function deathPerson()
    {
        return $this->belongsTo(DeathCertificate::class, 'death_certificate_id', 'id');
    }
    
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->system_id = self::generateSystemId('successions');
        });
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         $model->system_id = IdGenerator::generate(['table' => 'successions', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
    //     });
    // }
}
