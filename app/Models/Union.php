<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = 'unions';
    protected $fillable = ['name', 'bn_name', 'url', 'status', 'thana_id'];

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id');
    }

}
