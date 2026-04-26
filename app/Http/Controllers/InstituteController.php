<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationSuccessMail;
use App\Models\CityCorporation;
use App\Models\Division;
use App\Models\Institute;
use App\Models\InstituteCategory;
use App\Models\InstituteType;
use App\Models\Pourashava;
use App\Models\Union;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InstituteController extends Controller
{

    public function generateUserName($name)
    {
        $username = Str::slug($name, '-');
        for ($i = 1; $this->checkExistsUsername($username); $i++) {
            $username = $username . $i;
        }
        return $username;
    }

    public function uploadImage($image, $name)
    {
        if ($image && $name) {
            $image_name =  $name ;
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . "." . $ext;
            $upload_path = 'uploads/institute/';
            $image_url = $upload_path . $image_full_name;

            try {
                $image->move($upload_path, $image_full_name);
                return $image_url;
            } catch (\Throwable $th) {
                return "upload_failed.png";
            }
        }
    }

    public function checkExistsUsername($username)
    {
        if (User::where('username', $username)->exists()) {
            return true;
        } else {
            return false;
        }
    }


    public function getInstituteName($institute_type, $union_id = 0, $pourashava_id = 0, $city_corporation_id = 0 ){
        if($institute_type == 1){
            $institute = Union::find($union_id);
            return $institute;
        } else if($institute_type == 2) {
            $institute = Pourashava::find($pourashava_id);
            return $institute;
        } else if($institute_type == 3) {
            $institute = CityCorporation::find($city_corporation_id);
            return $institute;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutes = Institute::latest()->get();
        if (count($institutes)) {
            foreach ($institutes as $institute) {
                if ($institute->institute_type_id == 1) {
                    $institute->union = Union::find($institute->union_id);
                } else if($institute->institute_type_id == 2) {
                    $institute->pourashava = Pourashava::find($institute->pourashava_id);
                } else if($institute->institute_type_id == 3) {
                    $institute->cityCorporation = CityCorporation::find($institute->city_corporation_id);
                }
            }
        }

        $data['institutes'] = $institutes;
        return view('backend.pages.institute.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['institute_categories'] = InstituteCategory::where('status', true)->get();
        $data['institute_types'] = InstituteType::where('status', true)->get();
        $data['divisions'] = Division::where('status', true)->get();
        return view('backend.pages.institute.create', $data);
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
            'institute_category' => 'required|exists:institute_categories,id',
            'activation_time' => 'required',
            'division' => 'required|exists:divisions,id',
            'district' => 'required|exists:districts,id',
            'institute_type' => 'required|exists:institute_types,id',
            'union' => 'nullable',
            'pourashava' => 'nullable',
            'city_corporation' => 'nullable',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $institute = Institute::where('institute_type_id', $request->institute_type)
        ->where('institute_category_id', $request->institute_category )
        ->where('institute_category_id', $request->institute_category )
        ->where('union_id', $request->union)
        ->where('pourashava_id', $request->pourashava)
        ->where('city_corporation_id',$request->city_corporation)
        ->first();

        if (!$institute) {
            $institute = new Institute();
            $institute->institute_category_id = $request->institute_category;
            $institute->institute_subcategory_id = $request->institute_subcategory_id;

            $institute->institute_type_id = $request->institute_type;
            $institute->union_id = $request->union ;
            $institute->pourashava_id = $request->pourashava;
            $institute->city_corporation_id = $request->city_corporation;
            $institute->activation_time = $request->activation_time;

            try {
                $institute->save();
                $data['status'] = true;
                $data['code'] = 200;
                $data['message'] = "Institute created successfully.";
                $data['redirect_url'] = route('instituteA.adminCreate', $institute->id);
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['code'] = 500;
                $data['message'] = "Failed to create institute.";
                $data['errors'] = $th;
                return response()->json($data, 400);
            }
        } else {
            $data['status'] = false;
            $data['message'] = "Already available this institute.";
            return response()->json($data, 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.institute.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['institute'] = Institute::find($id);
        $data['institute_categories'] = InstituteCategory::where('status', true)->get();
        return view('backend.pages.institute.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'institute_category' => 'required|exists:institute_categories,id',
            'activation_time' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

     
        $institute = Institute::find($id);

        if ($institute) {
            $institute->institute_category_id = $request->institute_category;
            $institute->institute_subcategory_id = $request->institute_subcategory_id;
            $institute->activation_time = $request->activation_time;

            try {
                $institute->save();
                $data['status'] = true;
                $data['message'] = "Institute Updated Successfully!";
                $data['institute'] = $institute;
                $data['redirect_url'] = route('instituteA.adminCreate', $institute->id);
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['errors'] = $th;
                $data['message'] = "Failed to update institute.";
            }
            
        }else{
            $data['status'] = false;
            $data['message'] = "Institute not found!";
            return response()->json($data, 404);
        }

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $result = DB::transaction(function() use($id){
            try {
                Institute::where('id', $id)->delete();
                User::where('institute_id', $id)->delete();
                $data['status'] = true;
                $data['code'] = 200;
                $data['message'] = "Institute Deleted Successfully!";
                return $data;
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['code'] = 500;
                $data['errors'] = $th;
                $data['message'] = "Institute Delete Failed!";
                return $data;
            }
        });

        return response()->json($result, $result['code']);
        
    }




    public function admin($id)
    {
        $data['institute'] = Institute::with('superUser')->find($id);
        return view('backend.pages.institute.admin', $data);
    }

    public function adminStore(Request $request)
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
        $user = User::find($request->user_id);

        if(!$user){
            $user = new User();
        } 

        $user->institute_id = $request->institute_id;
        $user->role_id = 6;
        $user->email = $request->email;
        $user->status = true;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        try {

            $user->save();


            if ($request->email) {
                $details = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'system_id' => $user->system_id
                ];
                Mail::to($request->email)->send(new ApplicationSuccessMail($details));
            }

            if($request->mobile){
                $message = "User created successful! Application ID: ".$user->system_id. " Password: " .date('dmY', strtotime($request->date_of_birth)). " Login: http://bit.ly/3YH8zRw";
                $response = Http::get('https://api.mobireach.com.bd/SendTextMessage', [
                    'Username' => "advsoft", 
                    'Password' => 'Dhaka@0088',
                    'From' => '8801847050122',
                    'To' => $request->mobile,
                    'Message' => $message,

                ]);
                if ($response->failed()) {
                    $data['SMS'] = "failed";
                } else {
                    $data['SMS'] = "success";                   
                }
            }


            $data['status'] = true;
            $data['message'] = "Successfully Saved Admin Information!";
            $data['redirect_url'] = route('instituteA.imagesCreate', $request->institute_id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to store Admin Information!";
            $data['errors'] = $th;
            return response()->json($data, 500);
        }

    }

    public function images($id)
    {
        $data['institute'] = Institute::find($id);
        return view('backend.pages.institute.images', $data);
    }

    public function imagesStore(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'left_image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'top_image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'right_image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $institute = Institute::find($request->institute_id);

        if($institute){

            if($institute->left_image){
                try {
                    unlink($institute->left_image);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            if($institute->top_image){
                try {
                    unlink($institute->top_image);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            
            if($institute->right_image){
                try {
                    unlink($institute->right_image);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            $instituteInfo = $this->getInstituteName($institute->institute_type_id, $institute->union_id, $institute->pourashava_id, $institute->city_corporation_id);
            $left_image = $request->file('left_image');
            $left_image_url = '';
            if ($left_image) {
                $image_name =  Str::slug($instituteInfo->name, '-') . '-left-' . $instituteInfo->id ;
                $ext = strtolower($left_image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/institute/';
                $image_url = $upload_path . $image_full_name;
                $success = $left_image->move($upload_path, $image_full_name);
                if ($success) {
                    $left_image_url = $image_url;
                }
            } else {
                $left_image_url = $institute->left_image;
            }
    
            $top_image = $request->file('top_image');
            $top_image_url = '';
            if ($top_image) {
                $image_name =  Str::slug($instituteInfo->name, '-') . '-top-' . $instituteInfo->id ;
                $ext = strtolower($top_image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/institute/';
                $image_url = $upload_path . $image_full_name;
                $success = $top_image->move($upload_path, $image_full_name);
                if ($success) {
                    $top_image_url = $image_url;
                }
            } else {
                $top_image_url = $institute->top_image;
            }
    
            $right_image = $request->file('right_image');
            $right_image_url = '';
            if ($right_image) {
                $image_name =  Str::slug($instituteInfo->name, '-') . '-right-' . $instituteInfo->id ;
                $ext = strtolower($right_image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/institute/';
                $image_url = $upload_path . $image_full_name;
                $success = $right_image->move($upload_path, $image_full_name);
                if ($success) {
                    $right_image_url = $image_url;
                }
            }else {
                $right_image_url = $institute->right_image;
            }


            try {
                $institute->left_image = $left_image_url;
                $institute->top_image = $top_image_url;
                $institute->right_image = $right_image_url;
                $institute->save();

                $data['status'] = true;
                $data['message'] = "Updated Institute Images";
                return response()->json($data, 200);

            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['errors'] = $th;
                $data['message'] = "Failed to update data";
                return response()->json($data, 200);
            }

        } else {
            $data['status'] = false;
            $data['code'] = 404;
            $data['message'] = "Noting found to update";
            return response()->json($data, 200);
        }
    }
}
