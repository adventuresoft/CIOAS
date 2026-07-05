<?php

namespace App\Models;

use App\Models\Certificate\BirthCertificate;
use App\Models\Certificate\CharacterCertificate;
use App\Models\Certificate\CitizenCertificate;
use App\Models\Certificate\DeathCertificate;
use App\Models\People\AddressInfo;
use App\Models\People\DisabilityInfo;
use App\Models\People\EducationalInfo;
use App\Models\People\FamilyInfo;
use App\Models\People\FinancialInfo;
use App\Models\People\FreedomFighterInfo;
use App\Models\People\HealthInfo;
use App\Models\People\ProfessionalInfo;
use App\Models\People\PropertyInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Haruncpi\LaravelIdGenerator\IdGenerator;
// use Spatie\Permission\Traits\HasRoles;
use App\Traits\BelongsToInstitute;
use App\Models\Staff;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BelongsToInstitute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public static $snakeAttributes = false;
    public $table = 'users';
    protected $fillable = [
        'system_id',
        'institute_id',
        'department_id',
        'section_id',
        'role_id',
        'name',
        'email',
        'mobile',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->system_id = IdGenerator::generate(['table' => 'users', 'field' => 'system_id', 'length' => 11, 'prefix' => date("Ymd")]);
        });
    }


    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department\Department::class, 'department_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(\App\Models\Department\Section::class, 'section_id', 'id');
    }

    public function people()
    {
        return $this->hasOne(Staff::class, 'user_id', 'id');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'user_id', 'id');
    }
    
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id', 'id');
    }

    public function getRoleNames()
    {
        return collect([$this->role?->name])->filter();
    }

    public function hasRole($roles, string $guard = null): bool
    {
        if (is_string($roles) && false !== strpos($roles, '|')) {
            $roles = explode('|', $roles);
        }
        if (is_string($roles)) {
            return $this->role?->name === $roles;
        }
        if (is_array($roles)) {
            return in_array($this->role?->name, $roles);
        }
        return false;
    }

    public function hasAnyRole(...$roles): bool
    {
        return $this->hasRole($roles);
    }

    public function assignRole(...$roles)
    {
        $role = collect($roles)->flatten()->first();
        if ($role instanceof \App\Models\Role) {
            $this->role_id = $role->id;
        } else {
            $roleModel = \App\Models\Role::where('name', $role)->first();
            if ($roleModel) {
                $this->role_id = $roleModel->id;
            }
        }
        $this->save();
        return $this;
    }

    public function syncRoles(...$roles)
    {
        return $this->assignRole(...$roles);
    }

    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if (!$this->role) return false;
        try {
            return $this->role->hasPermissionTo($permission, $guardName);
        } catch (\Spatie\Permission\Exceptions\PermissionDoesNotExist $e) {
            return false;
        }
    }

    public function checkPermissionTo($permission, $guardName = null): bool
    {
        return $this->hasPermissionTo($permission, $guardName);
    }

    public function peopleProfile()
    {
        return $this->hasOne(People::class, 'user_id', 'id');
    }
    public function familyInfo()
    {
        return $this->hasOne(FamilyInfo::class, 'user_id', 'id');
    }
    public function addressInfo()
    {
        return $this->hasOne(AddressInfo::class, 'user_id', 'id');
    }
    public function healthInfo()
    {
        return $this->hasOne(HealthInfo::class, 'user_id', 'id');
    }

    public function disabilityInfo()
    {
        return $this->hasOne(DisabilityInfo::class, 'user_id', 'id');
    }

    public function freedomFighterInfo()
    {
        return $this->hasOne(FreedomFighterInfo::class, 'user_id', 'id');
    }

    public function educationInfos()
    {
        return $this->hasMany(EducationalInfo::class, 'user_id', 'id');
    }

    public function professionalInfos()
    {
        return $this->hasMany(ProfessionalInfo::class, 'user_id', 'id');
    }

    public function financialInfos()
    {
        return $this->hasMany(FinancialInfo::class, 'user_id', 'id');
    }

    public function propertyInfos()
    {
        return $this->hasOne(PropertyInfo::class, 'user_id', 'id');
    }

    public function citizenCertificate()
    {
        return $this->hasMany(CitizenCertificate::class, 'user_id', 'id');
    }

    public function characterCertificate()
    {
        return $this->hasMany(CharacterCertificate::class, 'user_id', 'id');
    }

    public function deathCertificate()
    {
        return $this->hasMany(DeathCertificate::class, 'user_id', 'id');
    }

    public function birthCertificate()
    {
        return $this->hasMany(BirthCertificate::class, 'user_id', 'id');
    }
}
