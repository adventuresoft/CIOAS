<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\ModelHasRole;

class RoleUserController extends Controller
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
        $roleUser=ModelHasRole::orderBy('model_id','desc')->paginate(10);        
        $roles = Role::get();        
        // $admins = Employee::get();        
        $admins = User::all();           
       
        return view('backend.pages.roleuser.index', compact('roleUser','roles','admins'))->with(['title'=>'User Role','page'=>'roleuser']);
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
        $this->validate($request, [
            'user_id' => 'required',            
            'role_id' => 'required',            
        ]);

        $user=User::find($request->user_id);
        $role=Role::find($request->role_id);      
        $user->assignRole($role->name);

        session()->flash("success", "Information saved Successfully");
        return redirect(route('roleuser.index'));
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
    public function edit($role_id,$user_id)
    {        
        $singleRoleUser=ModelHasRole::where('role_id',$role_id)->where('model_id',$user_id)->first();
        $roleUser=ModelHasRole::orderBy('model_id','desc')->paginate(10);    
        $roles = Role::get();        
        $admins = User::get();        
        return view('backend.pages.roleuser.index', compact('roleUser','roles','admins','singleRoleUser'))->with(['title'=>'User Role','page'=>'roleuser']);
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
            'role_id' => 'required',            
        ]);

        $delete=ModelHasRole::where('model_id',$request->old_model_id)->where('role_id',$id)->delete();

        $user=User::find($request->user_id);
        $role=Role::find($request->role_id);      
        $user->assignRole($role->name);

        session()->flash("success", "Information saved Successfully");
        return redirect(route('roleuser.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roleusersoft(Request $request)
    {
        
        $delete=ModelHasRole::where('model_id',$request->model_id)->where('role_id',$request->role_id)->delete();
         session()->flash("success", "Information Delete Successfully");
        return redirect(route('roleuser.index'));
    }
}
