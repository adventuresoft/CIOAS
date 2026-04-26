<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class InstitutionalAdminController extends Controller
{

    public function generateUserName($name)
    {
        $username = Str::slug($name, '-');
        for ($i = 1; $this->checkExistsUsername($username); $i++) {
            $username = $username . $i;
        }
        return $username;
    }

    public function checkExistsUsername($username)
    {
        if (User::where('username', $username)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admins'] = User::where('role_id', 6)
        ->where('institute_id', Auth::user()->institute_id)
        ->get();
        return view('backend.pages.institutional_admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.institutional_admin.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'email' => 'required|max:190|email',
            'mobile' => 'nullable|max:190',
            'password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
           
            $user = new User();
            $user->role_id = 6;
            $user->institute_id = Auth::user()->institute_id;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->status = true;
            $user->created_by = Auth::id();
            $user->save();

            $data['status'] = true;
            $data['message'] = "Successfully Saved Admin Information!";
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to store Admin Information!";
            $data['errors'] = $th;
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['admin'] = User::find($id);
        return view('backend.pages.institutional_admin.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['admin'] = User::find($id);
        return view('backend.pages.institutional_admin.edit', $data);
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
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'email' => 'required|max:190|email',
            'mobile' => 'nullable|max:190',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $user =  User::find($id);
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->name = $request->name;
            $user->updated_by = Auth::id();


            $user->save();
            $data['status'] = true;
            $data['message'] = "Successfully Saved Admin Information!";
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to store Admin Information!";
            $data['errors'] = $th;
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            $data['status'] = true;
            $data['message'] = "Institutional Admin Deleted Successfully!";
            return response($data, 200);
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['errors'] = $th;
            $data['message'] = "Institutional Admin Delete Failed!";
            return response($data, 200);
        }
    }
}
