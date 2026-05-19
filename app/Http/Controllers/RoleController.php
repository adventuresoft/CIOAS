<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
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
        $roles = Role::paginate(10);
        $permissions = Permission::all();
        
        // Group permissions by module
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->name);
            $module = $parts[0] ?? 'general';
            $action = $parts[1] ?? 'read';
            $groupedPermissions[$module][$action] = $permission;
        }

        return view('backend.pages.role.index', compact('roles', 'permissions', 'groupedPermissions'))
            ->with(['title' => 'Access Control (Role)', 'page' => 'role']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:roles,name',
            'description' => 'nullable|string',
            'permissions' => 'nullable|array'
        ]);

        try {
            $role = Role::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'guard_name' => 'web',
                'status' => 1,
                'created_by' => auth()->id()
            ]);

            if ($request->has('permissions')) {
                // Get permissions by ID or name
                $role->syncPermissions($request->permissions);
            }

            session()->flash('success', 'Target Identity (Role) has been registered successfully.');
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Operation failed: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $roles = Role::paginate(10);
        $permissions = Permission::all();
        
        // Group permissions by module
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->name);
            $module = $parts[0] ?? 'general';
            $action = $parts[1] ?? 'read';
            $groupedPermissions[$module][$action] = $permission;
        }

        // Active permissions for this role
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('backend.pages.role.index', compact('role', 'roles', 'permissions', 'groupedPermissions', 'rolePermissions'))
            ->with(['title' => 'Edit Control Identity', 'page' => 'role']);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:191|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
            'permissions' => 'nullable|array'
        ]);

        try {
            $role->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'updated_by' => auth()->id()
            ]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }

            session()->flash('success', 'Target Identity (Role) has been modified successfully.');
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Operation failed: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);

            // Do not delete superadmin/developer
            if (in_array($role->id, [1, 4]) || in_array(strtolower($role->name), ['admin', 'developer'])) {
                session()->flash('error', 'System-critical Identity (Role) cannot be removed.');
                return redirect()->route('role.index');
            }

            $role->delete(); // Soft delete
            session()->flash('success', 'Target Identity (Role) has been deleted successfully.');
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Operation failed: ' . $th->getMessage());
            return redirect()->route('role.index');
        }
    }
}
