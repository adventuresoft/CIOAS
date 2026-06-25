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
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         $this->guardSuperadmin();
    //         return $next($request);
    //     });
    // }


    public function index(\App\DataTables\UserDataTable $dataTable)
    {
        $departments = \App\Models\Department\Department::all();
        $sections = \App\Models\Department\Section::all();
        return $dataTable->render('backend.pages.user.index', [
            'title' => 'Operators Directory', 
            'page' => 'user',
            'departments' => $departments,
            'sections' => $sections
        ]);
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'user_type' => 'required|in:admin,staff',
            'mobile' => 'required|string',
            'password' => 'nullable|min:6|confirmed',
            'institute_id' => 'required',
            'role_id' => 'required',
            'department_id' => 'nullable|integer',
            'section_id' => 'nullable|integer',
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
            $user->department_id = $request->department_id;
            $user->section_id = $request->section_id;
            $user->user_type = $request->user_type;

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
