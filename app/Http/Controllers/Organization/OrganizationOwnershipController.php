<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization\Organization;
use App\Models\Religion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BasicSettings\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\People;
use App\Models\Road;
use App\Models\Thana;
use App\Models\VillageArea;
use App\Models\UnionWard;
use App\Models\PostOffice;
use App\Models\BasicSettings\Village;
use App\Models\People\AddressInfo;
use App\Models\User;
use App\Models\Organization\OrganizationOwnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OrganizationOwnershipController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            if ($user && in_array((int) $user->role_id, [1, 4, 6], true)) {
                return $next($request);
            }

            return redirect()->back();
        })->except('index', 'show');
    }

    public function ownershipForm()
    {



        $data['ownership'] = null;
        return view('backend.pages.organization.forms.ownership', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


public function saveNewOwnership(Request $request)
{
    // ================= VALIDATION =================
    $validate = Validator::make($request->all(), [
        'name' => 'required|max:190',
        'bn_name' => 'required|max:190',
        'email' => 'required|max:190',
    ]);

    if ($validate->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validate->errors()
        ], 400);
    }

    try {

        DB::beginTransaction();

        // ================= USER SAVE =================
        $user = new User();
        $user->role_id = 5;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->birth_certificate = $request->birth_certificate;
        $user->nid = $request->nid;
        $user->status = 1;
        $user->created_by = Auth::id();
        $user->password = Hash::make('12345678');

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/users/', $image_name);
            $user->image = 'uploads/users/' . $image_name;
        }

        if (!$user->save()) {
            throw new \Exception('User save failed');
        }

        // ================= PEOPLE SAVE =================
        $people = new People();
        $people->user_id = $user->id;
        $people->bn_name = $request->bn_name;
        $people->date_of_birth = $request->date_of_birth;
        $people->birth_place = $request->birth_place;
        $people->district_id = $request->district_id;
        $people->country_id = $request->country_id;
        $people->gender = $request->gender;
        $people->religion_id = $request->religion;
        $people->blood_group = $request->blood_group;

        if (!$people->save()) {
            throw new \Exception('People save failed');
        }

        // ================= FAMILY SAVE =================
        $family = new \App\Models\People\FamilyInfo();
        $family->user_id = $user->id;
        $family->family_type_id = $request->family_type_id ?? 1;
        $family->father_name = $request->father_name;
        $family->father_name_bn = $request->father_name_bn;
        $family->mother_name = $request->mother_name;
        $family->mother_name_bn = $request->mother_name_bn;
        $family->save();

        // ================= ADDRESS SAVE (NEW 🔥) =================
        $address = new AddressInfo();
        $address->user_id = $user->id;

        // Permanent
        $address->permanent_division_id = $request->permanent_division_id;
        $address->permanent_district_id = $request->permanent_district_id;
        $address->permanent_thana_id = $request->permanent_thana_id;
        $address->permanent_union_id = $request->permanent_union_id;
        $address->permanent_ward_id = $request->permanent_ward_id;
        $address->permanent_village_id = $request->permanent_village_id;
        $address->permanent_road = $request->permanent_road;
        $address->permanent_house = $request->permanent_house;
        $address->permanent_area_bn = $request->permanent_house_bn;

        // Present
        $address->present_division_id = $request->present_division_id;
        $address->present_district_id = $request->present_district_id;
        $address->present_thana_id = $request->present_thana_id;
        $address->present_union_id = $request->present_union_id;
        $address->present_ward_id = $request->present_ward_id;
        $address->present_village_id = $request->present_village_id;
        $address->present_road = $request->present_road;
        $address->present_house = $request->present_house;
        $address->present_area_bn = $request->present_house_bn;

        if (!$address->save()) {
            throw new \Exception('Address save failed');
        }

        // ================= OWNERSHIP SAVE =================
        $ownership = new OrganizationOwnership();
        $ownership->organization_id = $request->organization_id;
        $ownership->user_id = $user->id;
        $ownership->system_id = $user->system_id;
        $ownership->user_name = $user->name;
        $ownership->same_union = 1;
        // $ownership->created_by = Auth::id();

        if (!$ownership->save()) {
            throw new \Exception('Ownership save failed');
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Ownership saved successfully'
        ], 200);

    } catch (\Throwable $e) {

        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong!',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function store_31_03_26(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'organization_id' => 'nullable|max:190',
            'system_id' => 'nullable|max:190',
            'quantity' => 'required|max:190'
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $ids = $request->id;
        $system_ids = $request->system_id;
        $quantities = $request->quantity;
        $user_names = $request->user_name;
        $is_trade_licenses = $request->is_trade_license;
        $user_ids = $request->user_id;

        if(!empty($system_ids)){

            try {
                foreach ($system_ids as $key => $system_id) {
                    if($ids[$key]){
                        $ownership = OrganizationOwnership::find($ids[$key]);
                    }else {
                        $ownership = new OrganizationOwnership();
                    }

                    $ownership->organization_id  = $request->organization_id;
                    $ownership->system_id  = $system_id;

                    $ownership->quantity  = $quantities[$key];

                    $ownership->user_id = $user_ids[$key];
                    $ownership->user_name  = $user_names[$key];

                    $ownership->is_trade_license = $is_trade_licenses[$key] ??  false;
                    $ownership->save();
                }

                $data['status'] = true;
                $data['message'] = "Ownership saved successfully!";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = true;
                $data['message'] = "Ownership save failed!";
                $data['errors'] = $th;
                return response()->json($data, 500);
            }


        }
    }


    public function store(Request $request)
{
    $validate = Validator::make($request->all(), [
        'organization_id' => 'nullable|max:190',
        'system_id' => 'nullable',
        'quantity' => 'required'
    ]);

    if ($validate->fails()) {
        $data['status'] = false;
        $data['message'] = "Sorry! Invalid Entry.";
        $data['errors'] = $validate->errors();
        return response(json_encode($data, JSON_PRETTY_PRINT), 400)
            ->header('Content-Type', 'application/json');
    }

    $ids = $request->id;
    $system_ids = $request->system_id;
    $quantities = $request->quantity;
    $user_names = $request->user_name;
    $is_trade_licenses = $request->is_trade_license;
    $user_ids = $request->user_id;

    if (!empty($system_ids)) {
        try {
            foreach ($system_ids as $key => $system_id) {

                if (!empty($ids[$key])) {
                    $ownership = OrganizationOwnership::find($ids[$key]);
                } else {
                    $ownership = new OrganizationOwnership();
                }

                if (!$ownership) {
                    $ownership = new OrganizationOwnership();
                }

                $resolvedUserId = $user_ids[$key] ?? null;
                $resolvedUserName = $user_names[$key] ?? null;

                // If user_id is null, then find user by system_id
                if (empty($resolvedUserId) && !empty($system_id)) {
                    $user = User::where('system_id', $system_id)->first();

                    if ($user) {
                        $resolvedUserId = $user->id;
                        $resolvedUserName = $user->name;
                    }
                }

                $ownership->organization_id = $request->organization_id;
                $ownership->system_id = $system_id;
                $ownership->quantity = $quantities[$key] ?? null;
                $ownership->user_id = $resolvedUserId;
                $ownership->user_name = $resolvedUserName;
                $ownership->is_trade_license = $is_trade_licenses[$key] ?? false;
                $ownership->save();
            }

            $data['status'] = true;
            $data['message'] = "Ownership saved successfully!";
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Ownership save failed!";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }
    }

    return response()->json([
        'status' => false,
        'message' => 'No system_id data found.'
    ], 400);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization\OrganizationOwnership  $organizationOwnership
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationOwnership $organizationOwnership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization\OrganizationOwnership  $organizationOwnership
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $user=User::find(Auth::user()->id);
        $data['user'] = $user;
        $data['religions'] = Religion::where('status', true)->get();
        $data['villages'] = [];
        $data['permanentVillageAreas'] = [];
        $data['presentVillageAreas'] = [];
        $data['wards'] = [];
        $data['permanent_houses'] = [];
        $data['roads'] = [];
        $data['post_officeses'] = PostOffice::latest()->get();

         if(isset($user->institute->institute_type_id) && $user->institute->institute_type_id == 1) {
            $data['villages'] = Village::where('union_id', $user->institute->union_id)->get();
            $data['wards'] = UnionWard::where('status', true)->get();
            $data['roads'] = Road::where('institute_id',  $user->institute->id)->latest()->get();

        }

        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] =  District::where('status', true)->orderBy('name')->get();
        $data['countries'] =  Country::orderBy('name')->get();
         $data['divisions'] = Division::where('status', true)->get();
        $organization= Organization::with('ownership')->find($id);
        if($organization) {
            $data['organization'] = $organization;
            return view('backend.pages.organization.tabs.ownership', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization\OrganizationOwnership  $organizationOwnership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationOwnership $organizationOwnership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization\OrganizationOwnership  $organizationOwnership
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ownership = OrganizationOwnership::find($id);
        if($ownership){
            try {
                $ownership->delete();
                $data['status'] = true;
                $data['message'] = "Ownership deleted successfully";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Nothing found to delete!";
                $data['errors'] = $th;
                return response()->json($data, 500);
            }
        } else {
            $data['status'] = false;
            $data['message'] = "Nothing found to delete!";
            return response()->json($data, 404);
        }
    }
}
