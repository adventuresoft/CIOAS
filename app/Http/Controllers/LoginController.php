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
use App\Models\People\AddressInfo;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Religion;
use App\Models\Road;
use App\Models\UnionWard;
use App\Models\User;
use App\Models\VillageArea;
use App\Models\Thana;
use App\Models\Union;
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
        $union_id = $request->union ? $request->union : null;
        $pourashava_id = $request->pourashava ? $request->pourashava : null;
        $city_corporation_id = $request->city_corporation ? $request->city_corporation : null;

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if ($user) {
            $data['status'] = false;
            $data['message'] = "This email already registered!";
            return response()->json($data, 404);
        }

        $result = DB::transaction(function () use ($project_type, $union_id, $pourashava_id, $city_corporation_id, $email, $password) {
            try {
                $project = Institute::where('institute_type_id', $project_type)
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
        if (Auth::check()) {
            $data['divisions'] = Division::get();
            $data['districts'] = District::get();
            $data['thanas'] = Thana::get();
            $data['unions'] = Union::get();
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
        } else {
            return "Unauthenticated";
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = User::find(Auth::id());

        // Validate basic inputs
        $request->validate([
            'name' => 'required|string|max:191',
            'bn_name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|string|unique:users,mobile,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        // 1. Update User
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        // Image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user'), $imageName);
            
            // Delete old file
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }
            $user->image = 'uploads/user/' . $imageName;
        }

        // Password update
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'বর্তমান পাসওয়ার্ডটি সঠিক নয়।'])->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        // 2. Update/Create People
        $people = People::updateOrCreate(
            ['user_id' => $user->id],
            [
                'bn_name' => $request->bn_name,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'religion_id' => $request->religion,
                'blood_group' => $request->blood_group,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'nid' => $request->nid,
                'birth_place' => $request->birth_place,
                'district_id' => $request->district_id,
                'country_id' => $request->country_id,
            ]
        );

        // 3. Update/Create Family Info
        FamilyInfo::updateOrCreate(
            ['user_id' => $user->id],
            [
                'family_type_id' => $request->family_type_id,
                'family_category_id' => $request->family_category_id,
                'father_name' => $request->father_name,
                'father_name_bn' => $request->father_name_bn,
                'father_live_status' => $request->father_live_status,
                'father_nid' => $request->father_nid,
                'mother_name' => $request->mother_name,
                'mother_name_bn' => $request->mother_name_bn,
                'mother_live_status' => $request->mother_live_status,
                'mother_nid' => $request->mother_nid,
                'marital_status' => $request->marital_status,
                'spouse_name' => $request->spouse_name,
                'spouse_nid' => $request->spouse_nid,
                'married_date' => $request->married_date,
                'have_children' => $request->has('have_children') ? 1 : 0,
                'boys' => $request->boys,
                'girls' => $request->girls,
            ]
        );

        // 4. Update/Create Address Info
        AddressInfo::updateOrCreate(
            ['user_id' => $user->id],
            [
                'present_division_id' => $request->present_division_id,
                'present_district_id' => $request->present_district_id,
                'present_thana_id' => $request->present_thana_id,
                'present_union_id' => $request->present_union_id,
                'present_ward_id' => $request->present_ward_id,
                'present_village_id' => $request->present_village_id,
                'present_road' => $request->present_road,
                'present_house' => $request->present_house,
                'present_flat' => $request->present_flat,
                'permanent_division_id' => $request->permanent_division_id,
                'permanent_district_id' => $request->permanent_district_id,
                'permanent_thana_id' => $request->permanent_thana_id,
                'permanent_union_id' => $request->permanent_union_id,
                'permanent_ward_id' => $request->permanent_ward_id,
                'permanent_village_id' => $request->permanent_village_id,
                'permanent_road' => $request->permanent_road,
                'permanent_house' => $request->permanent_house,
                'permanent_flat' => $request->permanent_flat,
            ]
        );

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
