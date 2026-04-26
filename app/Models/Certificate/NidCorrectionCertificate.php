<?php

namespace App\Models\Certificate;

use App\Models\User;
use App\Traits\SystemIdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class NidCorrectionCertificate extends Model
{
    use HasFactory,SystemIdGenerator;

    public static $snakeAttributes = false;
    public $table = 'nid_correction_certificates';
    protected $fillable = [
    'system_id',
    'user_id',
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
            $model->system_id = self::generateSystemId('nid_correction_certificates');
        });
    }
    
    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         $model->system_id = IdGenerator::generate(['table' => 'nid_correction_certificates', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd") ]);
    //     });
    // }
}
