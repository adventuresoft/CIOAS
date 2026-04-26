<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermission extends Model
{
    use HasFactory;

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
    public function Permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
