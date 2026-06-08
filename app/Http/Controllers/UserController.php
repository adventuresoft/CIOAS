<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Institute;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::with(['roles.permissions', 'permissions', 'institute.union', 'institute.pourashava', 'institute.cityCorporation', 'institute.district', 'institute.type'])
            ->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('mobile', 'LIKE', "%{$search}%")
                    ->orWhere('system_id', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(10);
        return view('backend.pages.user.index', compact('users', 'search'))
            ->with(['title' => 'Operators Directory', 'page' => 'user']);
    }

    public function create()
    {
        $roles = Role::all();
        $institutes = Institute::with(['union', 'pourashava', 'cityCorporation', 'district', 'type'])->get();
        $departments = \App\Models\Department\Department::all();
        return view('backend.pages.user.create', compact('roles', 'institutes', 'departments'))
            ->with(['title' => 'Register Operator', 'page' => 'user']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required|in:admin,staff',
            'mobile' => 'required|string',
            'password' => 'required|min:6|confirmed',
            'institute_id' => 'required',
            'role_id' => 'required',
            'department_id' => 'nullable|integer',
            'section_id' => 'nullable|integer',
            'status' => 'required|in:0,1'
        ]);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->institute_id = $request->institute_id;
            $user->role_id = $request->role_id;
            $user->department_id = $request->department_id;
            $user->section_id = $request->section_id;
            $user->status = $request->status;
            $user->user_type = $request->user_type;
            $user->save();

            // Sync Spatie role
            $role = Role::find($request->role_id);
            if ($role) {
                $user->syncRoles([$role->name]);
            }

            session()->flash("success", "Employee registered successfully.");
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            session()->flash("error", "Failed to register Employee: " . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $institutes = Institute::with(['union', 'pourashava', 'cityCorporation', 'district', 'type'])->get();
        $departments = \App\Models\Department\Department::all();
        $sections = $user->department_id ? \App\Models\Department\Section::where('department_id', $user->department_id)->get() : collect([]);
        return view('backend.pages.user.show', compact('user', 'roles', 'institutes', 'departments', 'sections'))
            ->with(['title' => 'Modify Employee', 'page' => 'user']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $institutes = Institute::with(['union', 'pourashava', 'cityCorporation', 'district', 'type'])->get();
        $departments = \App\Models\Department\Department::all();
        $sections = $user->department_id ? \App\Models\Department\Section::where('department_id', $user->department_id)->get() : collect([]);
        return view('backend.pages.user.edit', compact('user', 'roles', 'institutes', 'departments', 'sections'))
            ->with(['title' => 'Modify Employee', 'page' => 'user']);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $request->validate([
            'role_id' => 'required',
            'status' => 'required|in:0,1'
        ]);

        try {

            $user->role_id = $request->role_id;
            $user->status = $request->status;
            $user->save();

            // Sync Spatie role
            $role = Role::find($request->role_id);
            if ($role) {
                $user->syncRoles([$role->name]);
            }

            session()->flash("success", "Employee updated successfully.");
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            session()->flash("error", "Failed to update Employee: " . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->id == Auth::id()) {
                session()->flash('error', 'You cannot delete your own active session account.');
                return redirect()->route('user.index');
            }
            $user->delete();
            session()->flash('success', 'Employee account deleted successfully.');
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete Employee: ' . $th->getMessage());
            return redirect()->route('user.index');
        }
    }
}
