<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ModelHasRole extends Model
{
    use HasFactory;

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class,'model_id','id');
    }
}
