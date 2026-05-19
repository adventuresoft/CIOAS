<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define modules
        $modules = [
            'people',
            'certificates',
            'institutions',
            'trades',
            'taxes',
            'houses',
            'lands',
            'vehicles',
            'roads',
            'marriages',
            'divorces',
            'roles',
            'permissions',
            'users',
            'basic_settings',
            'departments',
            'sections'
        ];

        $actions = ['read', 'create', 'update', 'delete'];
        $permissions = [];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissionName = "{$module}.{$action}";
                
                // Find or create permission
                $permissions[] = Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web'
                ]);
            }
        }

        // Get Superadmin (Admin) and Developer roles
        $superAdminRole = Role::where('id', 1)->orWhere('name', 'Admin')->first();
        if (!$superAdminRole) {
            $superAdminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web', 'slug' => 'admin', 'created_by' => 1]);
        }

        $developerRole = Role::where('id', 4)->orWhere('name', 'Developer')->first();
        if (!$developerRole) {
            $developerRole = Role::firstOrCreate(['name' => 'Developer', 'guard_name' => 'web', 'slug' => 'developer', 'created_by' => 1]);
        }

        // Sync all permissions to Superadmin and Developer
        if ($superAdminRole) {
            $superAdminRole->syncPermissions($permissions);
        }
        if ($developerRole) {
            $developerRole->syncPermissions($permissions);
        }

        // Also make sure user ID 1 and user ID 4 (or whatever users have these roles) are assigned to these roles in model_has_roles
        // We will assign the roles to the default admin/developer users in the system if they exist.
        $adminUsers = \App\Models\User::where('role_id', 1)->get();
        foreach ($adminUsers as $u) {
            $u->assignRole($superAdminRole);
        }

        $devUsers = \App\Models\User::where('role_id', 4)->get();
        foreach ($devUsers as $u) {
            $u->assignRole($developerRole);
        }
    }
}
