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
        
        $query = User::with(['roles.permissions', 'permissions', 'institute.union', 'institute.pourashava', 'institute.cityCorporation'])
            ->orderBy('id', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
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
        $institutes = Institute::with(['union', 'pourashava', 'cityCorporation'])->get();
        return view('backend.pages.user.create', compact('roles', 'institutes'))
            ->with(['title' => 'Register Operator', 'page' => 'user']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string',
            'password' => 'required|min:6|confirmed',
            'institute_id' => 'required',
            'role_id' => 'required',
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
            $user->status = $request->status;
            $user->save();

            // Sync Spatie role
            $role = Role::find($request->role_id);
            if ($role) {
                $user->syncRoles([$role->name]);
            }

            session()->flash("success", "Operator registered successfully.");
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            session()->flash("error", "Failed to register operator: " . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $user = User::with(['roles', 'institute.union', 'institute.pourashava', 'institute.cityCorporation'])->findOrFail($id);
        return view('backend.pages.user.show', compact('user'))
            ->with(['title' => 'Operator Details', 'page' => 'user']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $institutes = Institute::with(['union', 'pourashava', 'cityCorporation'])->get();
        return view('backend.pages.user.edit', compact('user', 'roles', 'institutes'))
            ->with(['title' => 'Modify Operator', 'page' => 'user']);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|string',
            'password' => 'nullable|min:6|confirmed',
            'institute_id' => 'required',
            'role_id' => 'required',
            'status' => 'required|in:0,1'
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->institute_id = $request->institute_id;
            $user->role_id = $request->role_id;
            $user->status = $request->status;
            $user->save();

            // Sync Spatie role
            $role = Role::find($request->role_id);
            if ($role) {
                $user->syncRoles([$role->name]);
            }

            session()->flash("success", "Operator updated successfully.");
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            session()->flash("error", "Failed to update operator: " . $th->getMessage());
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
            session()->flash('success', 'Operator account deleted successfully.');
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete operator: ' . $th->getMessage());
            return redirect()->route('user.index');
        }
    }
}
