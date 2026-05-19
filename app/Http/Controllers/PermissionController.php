<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
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
        $permissions = Permission::paginate(10);        
        return view('backend.pages.permission.index', compact('permissions'))
            ->with(['title' => 'Permission Pool', 'page' => 'permission']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:permissions,name',            
        ]);

        try {
            Permission::create(['name' => strtolower($request->name)]);
            session()->flash("success", "Permission registered successfully.");
            return redirect()->route('permission.index');
        } catch (\Throwable $th) {
            session()->flash("error", "Failed to register permission: " . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $permissions = Permission::paginate(10);
        return view('backend.pages.permission.index', compact('permission', 'permissions'))
            ->with(['title' => 'Modify Permission', 'page' => 'permission']);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:191|unique:permissions,name,' . $permission->id,            
        ]);

        try {
            $permission->update(['name' => strtolower($request->name)]);
            session()->flash("success", "Permission modified successfully.");
            return redirect()->route('permission.index');
        } catch (\Throwable $th) {
            session()->flash("error", "Failed to modify permission: " . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();
            session()->flash('success', 'Permission removed successfully.');
            return redirect()->route('permission.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete permission: ' . $th->getMessage());
            return redirect()->route('permission.index');
        }
    }
}
