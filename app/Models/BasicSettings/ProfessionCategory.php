<?php

namespace App\Models\BasicSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionCategory extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(ProfessionType::class, 'profession_type_id', 'id');
    }
}
