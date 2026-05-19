<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\ModelHasRole;
use Illuminate\Http\Request;

class RoleUserController extends Controller
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
        $roleUser = ModelHasRole::with(['role', 'user'])->orderBy('model_id', 'desc')->paginate(10);
        $roles = Role::all();
        $admins = User::all();

        return view('backend.pages.roleuser.index', compact('roleUser', 'roles', 'admins'))
            ->with(['title' => 'User Security Assignments', 'page' => 'roleuser']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $role = Role::findOrFail($request->role_id);

            // Spatie check or direct assignment
            if ($user->hasRole($role->name)) {
                session()->flash('warning', 'Role assignment already exists for this User.');
                return redirect()->back();
            }

            // Sync user model role_id column as well
            $user->role_id = $role->id;
            $user->save();

            // Assign role using Spatie method
            $user->assignRole($role->name);

            session()->flash('success', 'Role assigned to User successfully.');
            return redirect()->route('roleuser.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Assignment failed: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($role_id, $user_id)
    {
        $singleRoleUser = ModelHasRole::where('role_id', $role_id)
            ->where('model_id', $user_id)
            ->firstOrFail();

        $roleUser = ModelHasRole::with(['role', 'user'])->orderBy('model_id', 'desc')->paginate(10);
        $roles = Role::all();
        $admins = User::all();

        return view('backend.pages.roleuser.index', compact('roleUser', 'roles', 'admins', 'singleRoleUser'))
            ->with(['title' => 'Edit User Security Assignment', 'page' => 'roleuser']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
            'old_model_id' => 'required|exists:users,id',
            'old_role_id' => 'required|exists:roles,id',
        ]);

        try {
            $oldUser = User::findOrFail($request->old_model_id);
            $oldRole = Role::findOrFail($request->old_role_id);
            
            // Safety: Don't remove the last Superadmin
            if ($oldRole->id == 1 && User::role('Admin')->count() <= 1 && $oldUser->id == auth()->id()) {
                session()->flash('error', 'Cannot revoke Superadmin role from the last active administrator.');
                return redirect()->back();
            }

            $oldUser->removeRole($oldRole->name);

            $newUser = User::findOrFail($request->user_id);
            $newRole = Role::findOrFail($request->role_id);
            
            // Assign Spatie Role
            $newUser->assignRole($newRole->name);
            
            // Sync user model role_id column as well
            $newUser->role_id = $newRole->id;
            $newUser->save();

            session()->flash('success', 'User Security Assignment updated successfully.');
            return redirect()->route('roleuser.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Assignment failed: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function roleusersoft(Request $request)
    {
        $request->validate([
            'model_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        try {
            $user = User::findOrFail($request->model_id);
            $role = Role::findOrFail($request->role_id);

            // Safety: Don't remove the last Superadmin
            if ($role->id == 1 && User::role('Admin')->count() <= 1 && $user->id == auth()->id()) {
                session()->flash('error', 'Cannot revoke Superadmin role from the last active administrator.');
                return redirect()->route('roleuser.index');
            }

            $user->removeRole($role->name);
            
            // Reset user table role_id column to a fallback if it was the active role
            if ($user->role_id == $role->id) {
                $user->role_id = 5; // Default fallback to regular 'User'
                $user->save();
            }

            session()->flash('success', 'User Security Assignment revoked successfully.');
            return redirect()->route('roleuser.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Security Assignment failed: ' . $th->getMessage());
            return redirect()->route('roleuser.index');
        }
    }
}
