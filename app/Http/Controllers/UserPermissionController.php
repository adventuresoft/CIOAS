<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Admin\Employee;
use App\Models\ModelHasPermission;

class UserPermissionController extends Controller
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
        $userPermissions=ModelHasPermission::paginate(20);
        $admins=User::all();
        $permissions = Permission::all();
        return view('backend.pages.userpermission.index', compact('permissions','admins','userPermissions'))->with(['title'=>'Employee Permission','page'=>'userper']);
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
        $user=User::find($request->user_id);
        $permission=Permission::find($request->permission_id);
        $user->givePermissionTo($permission);      
        session()->flash("success", "Information saved Successfully");
        return redirect(route('userper.index'));
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
    public function edit($user_id,$permission_id)
    {

        $userPermission=ModelHasPermission::where('model_id',$user_id)->where('permission_id',$permission_id)->first();
       $userPermissions=ModelHasPermission::paginate(20);
        $admins=User::all();
        $permissions = Permission::all();
        return view('backend.pages.userpermission.index', compact('permissions','admins','userPermissions','userPermission'))->with(['title'=>'Employee Permission','page'=>'userper']);
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
            'user_id' => 'required',
            'permission_id' => 'required',
        ]);
        $model_id=User::find($request->old_model_id);
        $permission=Permission::find($request->old_permission_id);     
        $model_id->revokePermissionTo($permission);  

        $user=User::find($request->user_id);
        $permission=Permission::find($request->permission_id);
        $user->givePermissionTo($permission);      
        session()->flash("success", "Information saved Successfully");
        return redirect(route('userper.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $model_id=User::find($request->model_id);
        $permission=Permission::find($request->permission);     
        $model_id->revokePermissionTo($permission);  
        session()->flash("success", "Information Successfully Delete");
        return redirect(route('userper.index'));
    }
}
