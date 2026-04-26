<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin\Admin;
use App\Models\RoleHasPermission;
use DB;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct() {
        // $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $role_permissions=RoleHasPermission::paginate(20);
        $permissions = Permission::all();
        $roles = Role::get();              
        return view('backend.pages.rolepermission.index', compact('permissions','roles','role_permissions'))->with(['title'=>'Permission','page'=>'rolepermission']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role=Role::find($request->role_id);
        $permission=Permission::find($request->permission_id);
        $role->givePermissionTo($permission);      
        session()->flash("success", "Information saved Successfully");
        return redirect(route('rolepermission.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

     public function edit($role_id,$permission_id)
    {        
        $role_permission=RoleHasPermission::where('role_id',$role_id)->where('permission_id',$permission_id)->first();
        
       $role_permissions=RoleHasPermission::paginate(20);
        $permissions = Permission::all();
        $roles = Role::get();              
        return view('backend.pages.rolepermission.index', compact('permissions','roles','role_permissions','role_permission'))->with(['title'=>'Permission','page'=>'rolepermission']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'role_id' => 'required',            
            'permission_id' => 'required',            
        ]);

        $delete=RoleHasPermission::where('permission_id',$request->old_permission_id)->where('role_id',$request->old_role_id)->delete();

        $role=Role::find($request->role_id);      
        $permission=Permission::find($request->permission_id);
       $role->givePermissionTo($permission); 

        session()->flash("success", "Information Update Successfully");
        return redirect(route('rolepermission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {               
        $role=Role::find($request->role_id);
        $permission=Permission::find($request->permission_id);     
        $role->revokePermissionTo($permission); 
        session()->flash("success", "Information Successfully Delete");
        return redirect(route('rolepermission.index'));
    }
}
