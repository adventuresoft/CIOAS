<?php

namespace App\Models;
use App\Models\Union;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    use HasFactory;


public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }

}
