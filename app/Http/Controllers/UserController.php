<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       // $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('backend.pages.user.index', compact('users'))->with(['title' => 'Students', 'page' => 'user']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create')->with(['title' => 'Student', 'page' => 'user']);
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->student_id = $request->student_id;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();
        session()->flash("success", "Information saved Successfully");
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show', compact('user'))->with(['title' => 'Student', 'page' => 'user']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'))->with(['title' => 'Student', 'page' => 'user']);
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
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id);

        $image =  $user ->image;
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(('upload/users/images'), $image);
        }
        $user->image = $image;

        $user->name = $request->name;
        $user->student_id = $request->student_id;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();
        session()->flash("success", "Information Update Successfully");
        return redirect(route('user.index'));
    }

    /**
     * Show the form for change password the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changePass($id)
    {
        $user = User::find($id);
        return view('admin.user.changePassword', compact('user'))->with(['title' => 'User Change Password', 'page' => 'user']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePass(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::find($id);
        $user->password = $request->password;
        $user->save();
        session()->flash("success", "Information Update Successfully");
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
