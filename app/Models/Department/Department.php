<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'department_id', 'id');
    }
}
