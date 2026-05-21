<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\AccountType;
use App\Models\BasicSettings\Bank;
use App\Models\BasicSettings\Country;
use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilyType;
use App\Models\BasicSettings\Profession;
use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\House;
use App\Models\Mouza;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\People;
use App\Models\Religion;
use App\Models\Road;
use App\Models\Thana;
use App\Models\UnionWard;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StaffController extends Controller
{

    public function __construct()
    {
        // $this->middleware('unionAdmin')->except('index', 'approvedlist', 'show', 'searchUser', 'edit', 'update');
    }


    public function searchUser($system_id)
    {
        $user = User::with('people', 'familyInfo')->where('system_id', $system_id)->first();

        if ($user) {
            $data['status']  = true;
            $data['message'] = "People information loaded.";
            $data['user']    = $user;
            return response()->json($data, 200);
        } else {
            $data['status']  = false;
            $data['message'] = "People not found.";
            $data['user']    = $user;
            return response()->json($data, 500);
        }
    }








    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = User::with([
            'people',
            'professionalInfos',
            'addressInfo.presentWard',
            'addressInfo.presentDistrict',
            'addressInfo.presentThana',
            'addressInfo.presentPostoffice',
            'addressInfo.presentVillage',
            'addressInfo.presentRoad',
            'addressInfo.presentHouse',
            'addressInfo.permanentDistrict',
            'addressInfo.permanentThana',
            'addressInfo.permanentPostOffice',
            'addressInfo.permanentVillage',
            'addressInfo.permanentRoad',
            'addressInfo.permanentHouse',
        ])->whereHas('people', function ($q) {
            $q->whereNull('approved_id')->where('is_staff', 1);
        });

        if (Auth::user()->institute_id) {
            $query->where('institute_id', Auth::user()->institute_id);
        }

        $data['users'] = $query->latest()->get();
        return view('backend.pages.staff.index', $data);
    }

    public function approvedlist()
    {
        $data['subMenu'] = 'approvedList';
        $query           = User::with([
            'people',
            'professionalInfos',
            'addressInfo.presentDistrict',
            'addressInfo.presentThana',
            'addressInfo.presentPostoffice',
            'addressInfo.presentVillage',
            'addressInfo.presentWard',
            'addressInfo.presentRoad',
            'addressInfo.presentHouse',
        ])->whereHas('people', function ($q) {
            $q->whereNotNull('approved_id')->where('is_staff', 1);
        });

        if (Auth::user()->institute_id) {
            $query->where('institute_id', Auth::user()->institute_id);
        }

        $data['users'] = $query->latest()->get();
        return view('backend.pages.staff.approvedList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] = District::where('status', true)->orderBy('name')->get();
        $data['countries'] = Country::orderBy('name')->get();
        return view('backend.pages.staff.create', $data);
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
            'name'              => 'required|max:190',
            'bn_name'           => 'required|max:190',
            'date_of_birth'     => 'nullable|max:190',
            'birth_place'       => 'nullable|max:190',
            'gender'            => 'nullable|max:190',
            'religion'          => 'nullable|max:190',
            'blood_group'       => 'nullable|max:190',
            'mobile'            => 'nullable|max:190',
            'email'             => 'required|max:190',
            'birth_certificate' => 'nullable|max:190',
            'nid'               => 'nullable|max:190',
            'image'             => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            $data['status']  = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors']  = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            try {
                $user               = new User();
                $user->role_id      = 5; // 5 => User Role
                $user->institute_id = Auth::user()->institute_id ?? '';

                $user->name              = $request->name;
                $user->email             = $request->email;
                $user->mobile            = $request->mobile;
                $user->birth_certificate = $request->birth_certificate;
                $user->nid               = $request->nid;
                $user->status            = $request->status ?? true;
                $user->created_by        = Auth::id();
                $user->password          = Hash::make('12345678');
                $image                   = $request->file('image');
                if ($image) {
                    $image_name      = $request->name . '-' . rand(1111, 9999);
                    $ext             = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . "." . $ext;
                    $upload_path     = 'uploads/users/';
                    $image_url       = $upload_path . $image_full_name;
                    $success         = $image->move($upload_path, $image_full_name);
                    if ($success) {
                        $user->image = $image_url;
                    }
                }
                if ($user->save()) {
                    $people                = new People();
                    $people->user_id       = $user->id;
                    $people->bn_name       = $request->bn_name;
                    $people->date_of_birth = $request->date_of_birth;
                    $people->birth_place   = $request->birth_place;
                    $people->district_id   = $request->district_id;
                    $people->country_id    = $request->country_id;
                    $people->gender        = $request->gender;
                    $people->religion_id   = $request->religion;
                    $people->blood_group   = $request->blood_group;
                    $people->is_staff = 2;
                    if ($people->save()) {


                        $data['status']       = true;
                        $data['message']      = "People saved successfully.";
                        $data['user']         = $user;
                        $data['people']       = $people;
                        $data['code']         = 200;
                        $data['redirect_url'] = route('staff.family', $people->user_id);
                        return $data;
                    } else {
                        $data['status']  = false;
                        $data['message'] = "People save failed! Please try again...";
                        $data['people']  = $people;
                        $data['code']    = 500;
                        return $data;
                    }
                }
            } catch (\Throwable $th) {
                $data['status']  = false;
                $data['code']    = 500;
                $data['errors']  = $th;
                $data['message'] = "Something went wrong! Please try again or contact on support...";
                return $data;
            }
        });
        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['religions']        = Religion::where('status', true)->get();
        $data['districts']        = District::where('status', true)->orderBy('name')->get();
        $data['countries']        = Country::orderBy('name')->get();
        $data['religions']        = Religion::where('status', true)->get();
        $data['familyTypes']      = FamilyType::where('status', true)->get();
        $data['familyCategories'] = FamilyCategory::where('status', true)->get();
        $data['user']             = $user = User::with('familyInfo', 'educationInfos', 'financialInfos', 'propertyInfos', 'disabilityInfo', 'freedomFighterInfo')
            ->with('institute')
            ->with(array(
                'addressInfo' => function ($address) {
                    $address->with('presentUnion', 'permanentHouse', 'presentHouse', 'presentRoad', 'permanentRoad', 'presentVillage', 'presentDistrict', 'presentThana');
                }
            ))
            ->with(array(
                'professionalInfos' => function ($q1) {
                    $q1->with(array(
                        'subcategory' => function ($q2) {
                            $q2->with(array(
                                'category' => function ($q3) {
                                    $q3->with(array(
                                        'type' => function ($q4) {
                                            $q4->with('profession');
                                        }
                                    ));
                                }
                            ));
                        }
                    ));
                }
            ))
            ->find($id);

        if (!$user) {
            return redirect()->route('staff.index')->with('error', 'User not found.');
        }

        $institute      = $user->institute;
        $data['people'] = People::where('user_id', $id)->first();

        $data['religions']        = Religion::where('status', true)->get();
        $data['villages']         = [];
        $data['wards']            = [];
        $data['permanent_houses'] = [];
        $data['roads']            = [];
        if (isset($institute?->institute_type_id) && $institute->institute_type_id == 1) {
            $data['villages'] = Village::where('union_id', $institute->union_id)->get();
            $data['wards']    = UnionWard::where('status', true)->get();
            $data['roads']    = Road::where('institute_id', $institute->id)->latest()->get();
        } else if (isset($institute?->institute_type_id) && $institute->institute_type_id == 2) {

        } else if (isset($institute?->institute_type_id) && $institute->institute_type_id == 3) {

        }
        $data['divisions'] = Division::where('status', true)->get();

        if ($user->addressInfo) {
            if ($user->addressInfo->permanent_ward_id && $institute) {
                $data['permanent_houses'] = House::where('institute_id', $institute->id)
                    ->where('union_ward_id', $user->addressInfo->permanent_ward_id)
                    ->latest()
                    ->get();
            }
        }
        $data['professions'] = Profession::where('status', true)->get();

        $data['account_types'] = AccountType::where('status', true)->latest()->get();
        $data['banks']         = Bank::where('status', true)->latest()->get();

        $data['landThanas'] = $user->propertyInfos ? ($user->propertyInfos->land_district_id ? Thana::where('district_id', $user->propertyInfos->land_district_id)->get() : []) : [];
        $data['landMouzas'] = $user->propertyInfos ? ($user->propertyInfos->land_thana_id ? Mouza::where('thana_id', $user->propertyInfos->land_thana_id)->get() : []) : [];

        $data['flatThanas'] = $user->propertyInfos ? ($user->propertyInfos->flat_district_id ? Thana::where('district_id', $user->propertyInfos->flat_district_id)->get() : []) : [];
        $data['flatMouzas'] = $user->propertyInfos ? ($user->propertyInfos->flat_thana_id ? Mouza::where('thana_id', $user->propertyInfos->flat_thana_id)->get() : []) : [];



        return view('backend.pages.staff.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!view_permission()) {
            return redirect()->back();
        }

        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] = District::where('status', true)->orderBy('name')->get();
        $data['countries'] = Country::orderBy('name')->get();
        $data['user']      = $user = User::with('people')->find($id);

        if (!$user) {
            return redirect()->route('staff.index')->with('error', 'User not found.');
        }

        $presentUnionId   = $user->addressInfo ? $user->addressInfo->present_union_id : null;
        $data['villages'] = $presentUnionId ? Village::where('union_id', $presentUnionId)->get() : [];



        return view('backend.pages.staff.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userID)
    {
        if (!view_permission()) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        $validate = Validator::make($request->all(), [
            'name'              => 'required|max:190',
            'bn_name'           => 'required|max:190',
            'date_of_birth'     => 'nullable|max:190',
            'birth_place'       => 'nullable|max:190',
            'gender'            => 'nullable|max:190',
            'religion'          => 'nullable|max:190',
            'blood_group'       => 'nullable|max:190',
            'mobile'            => 'nullable|max:190',
            'email'             => 'required|max:190|email',
            'birth_certificate' => 'nullable|max:190',
            'nid'               => 'nullable|max:190',
            'image'             => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            $data['status']  = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors']  = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request, $userID) {
            $user                    = User::find($userID);
            $user->name              = $request->name;
            $user->email             = $request->email;
            $user->mobile            = $request->mobile;
            $user->birth_certificate = $request->birth_certificate;
            $user->nid               = $request->nid;
            $user->status            = $request->status ?? true;
            $user->updated_by        = Auth::id();

            $image = $request->file('image');
            if ($image) {
                //if ($user->image) {unlink($user->image);}
                // $image_name = $user->username;
                $image_name      = now()->format('YmdHis') . '_' . $user->id;
                ;
                $ext             = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . "." . $ext;
                $upload_path     = 'uploads/users/';
                $image_url       = $upload_path . $image_full_name;
                $success         = $image->move($upload_path, $image_full_name);
                if ($success) {
                    $user->image = $image_url;
                }
            }


            try {
                $user->save();
                $people                = People::firstOrNew([ 'user_id' => $userID ]);
                $people->bn_name       = $request->bn_name;
                $people->date_of_birth = $request->date_of_birth;
                $people->birth_place   = $request->birth_place;
                $people->district_id   = $request->district_id;
                $people->country_id    = $request->country_id;
                $people->gender        = $request->gender;
                $people->religion_id   = $request->religion;
                $people->blood_group   = $request->blood_group;
                $people->is_staff = $people->is_staff == 2 ? 2 : 1;

                try {
                    $people->save();
                    $data['status']       = true;
                    $data['message']      = "People updated successfully.";
                    $data['user']         = $user;
                    $data['people']       = $people;
                    $data['code']         = 200;
                    $data['redirect_url'] = route('staff.family', $userID);
                    return $data;
                } catch (\Throwable $th) {
                    $data['status']  = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    $data['code']    = 500;
                    $data['errors']  = $th;
                    return $data;
                }
            } catch (\Throwable $th) {
                $data['status']  = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['code']    = 500;
                $data['errors']  = $th;
                return $data;
            }

        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }

    private function generateApprovedId($date_of_birth, $district_id)
    {

        // DOB থেকে YYMMDD
        $datePart = Carbon::parse($date_of_birth)->format('ymd');

        // District ID 2 digit
        $districtPart = str_pad($district_id, 2, '0', STR_PAD_LEFT);

        // একই district + DOB এর last serial বের করা
        $last = People::where('district_id', $district_id)
            ->whereNotNull('approved_id')
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $lastSerial = (int) substr($last->approved_id, -4);
            $newSerial  = $lastSerial + 1;
        } else {
            $newSerial = 1;
        }

        // 4 digit serial
        $serialPart = str_pad($newSerial, 4, '0', STR_PAD_LEFT);

        return $districtPart . '-' . $datePart . '-' . $serialPart;
    }


    public function approve($id)
    {
        if (!Auth::user()->hasRole('DC')) {
            return redirect()->back()->with('error', 'Only DC role can approve staff.');
        }

        DB::beginTransaction();

        try {
            $people = People::findOrFail($id);
            if (!empty($people->approved_id)) {
                DB::commit();
                return redirect()->route('staffapprovedlist')
                    ->with('success', 'Already approved.');
            }

            $district_id = $people->district_id
                ?? ($people->user->addressInfo->permanent_district_id ?? null)
                ?? ($people->user->addressInfo->present_district_id ?? null);

            if (!$people->date_of_birth || !$district_id) {
                DB::rollBack();
                return redirect()->back()->with('error', 'DOB or District missing');
            }

            $approvedId = $this->generateApprovedId(
                $people->date_of_birth,
                $district_id
            );

            $people->approved_id = $approvedId;

            if (empty($people->user->institute_id) && !empty(Auth::user()->institute_id)) {
                $people->user->institute_id = Auth::user()->institute_id;
                $people->user->save();
            }

            $people->save();

            DB::commit();

            return redirect()->route('staffapprovedlist')
                ->with('success', 'Approved Successfully!');

        } catch (\Throwable $e) {

            DB::rollback();

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

}