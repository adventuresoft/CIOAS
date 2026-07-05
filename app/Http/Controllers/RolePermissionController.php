<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->guardSuperadmin();
            return $next($request);
        });
    }

    protected function guardSuperadmin()
    {
        if (!is_superadmin()) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function index()
    {
        $role_permissions = RoleHasPermission::with(['role', 'permission'])->paginate(15);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.pages.rolepermission.index', compact('role_permissions', 'roles', 'permissions'))
            ->with(['title' => 'Granted Capabilities', 'page' => 'rolepermission']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id'
        ]);

        try {
            $role = Role::findOrFail($request->role_id);
            $permission = Permission::findOrFail($request->permission_id);

            // Check if already mapped
            if ($role->hasPermissionTo($permission->name)) {
                session()->flash('warning', 'Capability mapping already exists.');
                return redirect()->back();
            }

            $role->givePermissionTo($permission);
            session()->flash('success', 'Granted Capability (Permission) mapped to Target Identity (Role) successfully.');
            return redirect()->route('rolepermission.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Operation failed: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($role_id, $permission_id)
    {
        $role_permission = RoleHasPermission::where('role_id', $role_id)
            ->where('permission_id', $permission_id)
            ->firstOrFail();

        $role_permissions = RoleHasPermission::with(['role', 'permission'])->paginate(15);
        $roles = Role::all();
        $permissions = Permission::all();

        return view('backend.pages.rolepermission.index', compact('role_permission', 'role_permissions', 'roles', 'permissions'))
            ->with(['title' => 'Edit Capability Mapping', 'page' => 'rolepermission']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
            'old_role_id' => 'required|exists:roles,id',
            'old_permission_id' => 'required|exists:permissions,id'
        ]);

        try {
            $oldRole = Role::findOrFail($request->old_role_id);
            $oldPermission = Permission::findOrFail($request->old_permission_id);
            
            // Do not revoke critical permissions of admin/developer
            if (in_array($oldRole->id, [1, 4]) && in_array($oldPermission->name, ['roles.read', 'permissions.read', 'users.read'])) {
                session()->flash('error', 'System-critical Capability cannot be revoked from SuperAdmin/Developer.');
                return redirect()->back();
            }

            $oldRole->revokePermissionTo($oldPermission);

            $newRole = Role::findOrFail($request->role_id);
            $newPermission = Permission::findOrFail($request->permission_id);
            $newRole->givePermissionTo($newPermission);

            session()->flash('success', 'Granted Capability (Permission) mapping updated successfully.');
            return redirect()->route('rolepermission.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Operation failed: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id'
        ]);

        try {
            $role = Role::findOrFail($request->role_id);
            $permission = Permission::findOrFail($request->permission_id);

            // Cannot revoke from superadmin/developer
            if (in_array($role->id, [1, 4]) && in_array($permission->name, ['roles.read', 'permissions.read', 'users.read'])) {
                session()->flash('error', 'System-critical permission cannot be revoked from Superadmin/Developer.');
                return redirect()->route('rolepermission.index');
            }

            $role->revokePermissionTo($permission);
            session()->flash('success', 'Granted Capability (Permission) mapping revoked successfully.');
            return redirect()->route('rolepermission.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Operation failed: ' . $th->getMessage());
            return redirect()->route('rolepermission.index');
        }
    }
}
