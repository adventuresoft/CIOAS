<?php
$permissions = ['union.read', 'union.create', 'union.update', 'union.delete', 'unions.read', 'unions.create', 'unions.update', 'unions.delete'];
foreach($permissions as $p) {
    \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
}
$roles = \Spatie\Permission\Models\Role::whereIn('name', ['Admin', 'Developer', 'Super Admin'])->get();
foreach($roles as $role) {
    $role->givePermissionTo($permissions);
}
echo "Permissions added successfully.";
