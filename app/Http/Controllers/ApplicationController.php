<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationSuccessMail;
use App\Models\BasicSettings\Village;
use App\Models\Division;
use App\Models\District;
use App\Models\Institute;
use App\Models\People;
use App\Models\People\AddressInfo;
use App\Models\People\FamilyInfo;
use App\Models\PostOffice;
use App\Models\Road;
use App\Models\UnionWard;
use App\Models\Religion;
use App\Models\User;
use App\Models\Union;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{

    public function create()
    {
        $data['divisions'] = Division::orderBy('name', 'asc')->get();
        $data['districts'] = District::where('status', true)->orderBy('name', 'asc')->get();
        $data['religions'] = Religion::where('status', true)->orderBy('name', 'asc')->get();
        $data['permanent_villages'] = Village::latest()->get();
        $data['wards'] = UnionWard::get();
        $data['roads'] = Road::latest()->get();
        $data['permanent_unions'] = Union::where('thana_id', 385)->get();
        $data['permanent_post_offices'] = PostOffice::where('thana_id', 385)->get();


        return view('frontend.pages.application.create', $data);
    }

    public function store(Request $request)
    {
//dd($request);
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'bn_name' => 'required|max:190',

            'father_name' => 'nullable|max:190',
            'father_name_bn' => 'nullable|max:190',

            'mother_name' => 'nullable|max:190',
            'mother_name_bn' => 'nullable|max:190',

            'email' => 'nullable|email',
            'mobile' => 'required|max:11|min:11',

            'date_of_birth' => 'required',
            'birth_place' => 'required',
            'gender' => 'required',
            'religion' => 'nullable|exists:religions,id',
            'union_id' => 'required',

            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }


        DB::beginTransaction();

        try {
            $institute = Institute::firstOrNew(['union_id' => $request->union_id]);
            $institute->institute_category_id= 1;
            $institute->institute_type_id= 1;
            $institute->save();

            $user = new User();
            $user->role_id = 5;
            $user->institute_id = $institute->id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->birth_certificate = $request->birth_certificate;
            $user->nid = $request->nid;
            $user->password = Hash::make(date('dmY', strtotime($request->date_of_birth)));
            $user->created_by = 1;
            $user->status = 1;

            $image = $request->file('image');
            if ($image) {
                $image_name = $request->name.'-'.rand(1111,9999);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path = 'uploads/users/';
                $image_url = $upload_path . $image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $user->image = $image_url;
                }
            }


            $user->save();


            $people = new People();
            $people->user_id = $user->id;
            $people->bn_name = $request->bn_name;
            $people->date_of_birth = $request->date_of_birth;
            $people->birth_place = $request->birth_place;
            $people->district_id = $request->birth_place;
            $people->gender = $request->gender;
            $people->religion_id = $request->religion;
            $people->save();

            $family = new FamilyInfo();
            $family->user_id = $user->id;
            $family->father_name = $request->father_name;
            $family->father_name_bn = $request->father_name_bn;
            $family->mother_name = $request->mother_name;
            $family->mother_name_bn = $request->mother_name_bn;
            $family->save();

            // $address = new AddressInfo();
            // $address->user_id = $user->id;
            // $address->permanent_village_id = $request->permanent_village;
            // $address->permanent_ward_id = $request->permanent_ward;
            // $address->permanent_road = $request->permanent_road;
            // $address->permanent_house = $request->permanent_house;
            // $address->permanent_house = $request->permanent_house;


            // $address->union_name = $request->union_name;
            // $address->village = $request->village;
            // $address->present_address = $request->present_address;

            // if($request->same_as_present_address){
            //     $address->present_village_id = $request->permanent_village;
            //     $address->present_ward_id = $request->permanent_ward;
            //     $address->present_road = $request->permanent_road;
            //     $address->present_house = $request->permanent_house;
            // }else{

            //     $address->present_division_id = $request->present_division;
            //     $address->present_district_id = $request->present_district;
            //     $address->present_thana_id = $request->present_thana;
            //     $address->present_union_id = $request->present_union;

            //     $address->present_village_id = $request->present_village;
            //     $address->present_ward_id = $request->present_ward;
            //     $address->present_road = $request->present_road;
            //     $address->present_house = $request->present_house;
            // }

            // $address->save();


            $address = new AddressInfo();
            $address->user_id = $user->id;

            /* ================= PERMANENT ADDRESS ================= */

            $address->permanent_division_id = $request->permanent_division;
            $address->permanent_district_id = $request->permanent_district;
            $address->permanent_thana_id    = $request->permanent_thana;
            $address->permanent_union_id    = $request->permanent_union;
            $address->permanent_post_office_id = $request->permanent_post_office_id;

            $address->permanent_village_id  = $request->permanent_village;
            $address->permanent_ward_id     = $request->permanent_ward;

            $address->permanent_road  = $request->permanent_road;
            $address->permanent_house = $request->permanent_house_no;

            /* ================= PRESENT ADDRESS ================= */

            if($request->same_as_present_address){

                $address->present_division_id = $request->permanent_division;
                $address->present_district_id = $request->permanent_district;
                $address->present_thana_id    = $request->permanent_thana;
                $address->present_union_id    = $request->permanent_union;
                $address->present_post_office_id = $request->permanent_post_office_id;

                $address->present_village_id  = $request->permanent_village;
                $address->present_ward_id     = $request->permanent_ward;
                $address->present_road        = $request->permanent_road;
                $address->present_house       = $request->permanent_house_no;

            }else{

                $address->present_division_id = $request->present_division;
                $address->present_district_id = $request->present_district;
                $address->present_thana_id    = $request->present_thana;
                $address->present_union_id    = $request->present_union_name;
                $address->present_post_office_id = $request->present_post_office_id;

                $address->present_village_id  = $request->present_village;
                $address->present_ward_id     = $request->present_ward;
                $address->present_road        = $request->present_road;
                $address->present_house       = $request->present_house_no;
            }

            /* Optional fields */
            $address->union_name      = $request->union_name;
            $address->village         = $request->village;
            $address->present_address = $request->present_address;

            $address->save();


            // if ($request->email) {
            //     $details = [
            //         'email' => $request->email,
            //         'password' => date('dmY', strtotime($request->date_of_birth)),
            //         'system_id' => $user->system_id
            //     ];
            //     Mail::to($request->email)->send(new ApplicationSuccessMail($details));
            // }

            //if($request->mobile){
                // $message = "Application successful! Application ID: ".$user->system_id. " Password: " .date('dmY', strtotime($request->date_of_birth)). " Login: http://bit.ly/3YH8zRw";
                // $response = Http::get('https://api.mobireach.com.bd/SendTextMessage', [
                //     'Username' => "advsoft",
                //     'Password' => 'Dhaka@0088',
                //     'From' => '8801847050122',
                //     'To' => $request->mobile,
                //     'Message' => $message,

                // ]);
                // if ($response->failed()) {
                //     $data['SMS'] = "failed";
                //   // return failure
                // } else {
                //     $data['SMS'] = "success";
                //     // return success
                // }
            //}




            $data['message'] ="Successfully submitted the application!";
            $data['status'] = true;
            $data['redirect_url'] = route('application.success', $user->system_id);
            DB::commit();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            $data['message'] ="Sorry, Application Failed!";
            $data['status'] = false;
            $data['errors'] = $th;
            return response()->json($data, 500);
        }
    }

    public function success($system_id)
    {
        $data['user'] = User::where('system_id', $system_id)->first();
        return view('frontend.pages.application.success', $data);
    }

}
