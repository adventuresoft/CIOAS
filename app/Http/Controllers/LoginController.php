<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\Country;
use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilyType;
use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\House;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\People;
use App\Models\People\FamilyInfo;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Religion;
use App\Models\Road;
use App\Models\UnionWard;
use App\Models\User;
use App\Models\VillageArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   
    public function register()
    {
        $data['divisions'] = Division::where('status', true)->get();
        $data['institute_types'] = InstituteType::where('status', true)->get();
        return view('authenticate.pages.register', $data);
    }

    public function registerStore(Request $request)
    {
        $project_type = $request->institute_type;
        $union_id = $request->union ? $request->union : null ;
        $pourashava_id = $request->pourashava ?  $request->pourashava : null ;
        $city_corporation_id = $request->city_corporation ? $request->city_corporation : null;

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if($user) {
            $data['status'] = false;
            $data['message'] = "This email already registered!";
            return response()->json($data, 404);
        }

      $result =   DB::transaction(function() use($project_type, $union_id, $pourashava_id, $city_corporation_id, $email,  $password   ) {
            try {
                $project = Institute::where('institute_type_id', $project_type )
                ->where('union_id', $union_id)
                ->where('pourashava_id', $pourashava_id)
                ->where('city_corporation_id', $city_corporation_id)
                ->first();

                if (!$project) {
                    $project = new Project();
                    $project->project_type_id = $project_type;
                    $project->union_id = $union_id;
                    $project->pourashava_id = $pourashava_id;
                    $project->city_corporation_id = $city_corporation_id;
                    $project->save();
                }

                $user = new User();
                $user->role_id = 5;
                $user->institute_id = $project->id;
                $user->email = $email;
                $user->username = $email;
                $user->name = "Stranger";
                $user->password = Hash::make($password);
                $user->created_by = 1;
                $user->save();
                $data['status'] = true;
                $data['code'] = 200;
                $data['message'] = "Registration successful!";
                return $data;
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['code'] = 500;
                $data['message'] = "Registration failed";
                $data['errors'] = $th;
                return $data;
            }
        });


        return response()->json($result, $result['code']);

    

    }

    // public function login()
    // {
    //     if (Auth::check()) {
    //         return redirect()->route('dashboard');
    //     } else {
    //         return view('auth.login');
    //     }
    // }

    // public function loginCheck(Request $request)
    // {
    //         $validate = Validator::make($request->all(), [
    //             'email' => 'required|max:190',
    //             'password' => 'required',
    //         ]);

    //         if ($validate->fails()) {
    //             $data['status'] = false;
    //             $data['message'] = "Invalid input contains! Please check your entries...";
    //             $data['errors'] = $validate->errors();
    //             return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
    //         }

    //         $remember = $request->remember ? true : false;


    //         // $user = User::where('email', $email)->where('status', 1)->whereIn('role_id', [1,2,3,4,5,6])->first();
    //         $user = User::where('email', $request->email)->orWhere('system_id', $request->email)->where('status', 1)->whereIn('role_id', [1,2,3,4,5,6])->first();

    //         if ($user) {

    //             $credential = [];
    //             if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
    //                 $credential = ['email' =>  $request->email, 'password' => $request->password];
    //             } else  {
    //                 $credential = ['system_id' => $request->email, 'password' => $request->password];
    //             }


    //             try {

    //                 if (Auth::attempt($credential, $remember)) {
    //                     $data['status'] = true;
    //                     $data['user'] = $user;
    //                     $data['message'] = "Login Successfully! Redirecting to the authenticate page...";
    //                     return response()->json($data, 200);
    //                 } else {
    //                     $data['status'] = false;
    //                     $data['message'] = "Email or password does not match!";
    //                     return response()->json($data, 403);
    //                 }
    //             } catch (\Throwable $th) {
    //                 $data['status'] = false;
    //                 $data['message'] = "Something went wrong! Please try again...";
    //                 $data['errors'] = $th;
    //                 return response()->json($data, 500);
    //             }
    //         } else {
    //             $data['status'] = false;
    //             $data['message'] = "User is not authenticate!";
    //             return response()->json($data, 404);
    //         }
      
    // }

        public function login()
    {
        return view('auth.login');
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }
    }

    public function profile()
    {
        if(Auth::check()){
            $data['districts'] = District::get();
            $data['countries'] = Country::get();
            $data['religions'] = Religion::get();
            $data['familyTypes'] = FamilyType::get();
            $data['familyCategories'] = FamilyCategory::get();
            $data['villages'] = Village::get();
            $data['permanentVillageAreas'] = VillageArea::get();
            $data['wards'] = UnionWard::get();
            $data['roads'] = Road::get();
            $data['houses'] = $data['permanent_houses'] = House::get();
            $data['user'] = User::with('people', 'familyInfo', 'addressInfo')->find(Auth::id());
            return view('frontend.pages.user.profile', $data);
        } else{
            return "Unauthenticated";
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
