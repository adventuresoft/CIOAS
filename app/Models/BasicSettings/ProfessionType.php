<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionType extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'profession_types';
    protected $fillable = [
        'profession_id ',
        'en_name',
        'bn_name',
        'slug',
        'status',
        'created_by',
        'updated_by',
        ];

        public function profession()
        {
            return $this->belongsTo(Profession::class, 'profession_id', 'id');
        }
}
