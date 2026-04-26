<?php

namespace App\Models\Organization;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationOwnership extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = "organization_ownerships";
    protected $fillable = [
        'organization_id', 
        'name', 
        'nid', 
        'mobile', 
        'address', 
        'quantity'
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'organization_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
