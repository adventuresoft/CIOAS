<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\AccountType;
use App\Models\BasicSettings\Bank;
// use App\Models\BasicSettings\Country;
use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilyType;
// use App\Models\BasicSettings\Profession;
use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\House;
use App\Models\Mouza;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Staff;
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
use Illuminate\Support\Facades\Log;
use App\Traits\FileUploadTrait;

class StaffController extends Controller
{

    use FileUploadTrait;

    public function __construct()
    {
        // $this->middleware('unionAdmin')->except('index', 'approvedlist', 'show', 'searchUser', 'edit', 'update');
    }


    public function searchUser($system_id)
    {
        $user = User::with('staff')->where('system_id', $system_id)->first();

        if ($user) {
            $data['status']  = true;
            $data['message'] = "Staff information loaded.";
            $data['user']    = $user;
            return response()->json($data, 200);
        } else {
            $data['status']  = false;
            $data['message'] = "Staff not found.";
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
        return view('backend.pages.staff.index');
    }

    public function records(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with([
                'staff',
                'department',
                'section'
            ])->where('user_type', 'staff');

            if (Auth::user()->institute_id) {
                $query->where('institute_id', Auth::user()->institute_id);
            }

            // Apply custom search filters
            if ($request->has('search_name') && !empty($request->search_name)) {
                $query->where('name', 'like', '%' . $request->search_name . '%');
            }

            if ($request->has('search_mobile') && !empty($request->search_mobile)) {
                $query->where('mobile', 'like', '%' . $request->search_mobile . '%');
            }

            if ($request->has('search_email') && !empty($request->search_email)) {
                $query->where('email', 'like', '%' . $request->search_email . '%');
            }

            if ($request->has('search_gender') && !empty($request->search_gender)) {
                $query->whereHas('staff', function ($q) use ($request) {
                    $q->where('gender', $request->search_gender);
                });
            }

            // Handle global search
            if ($request->has('search_global') && !empty($request->search_global)) {
                $searchTerm = $request->search_global;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('system_id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('mobile', 'like', '%' . $searchTerm . '%')
                        ->orWhere('email', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('department', function ($subQ) use ($searchTerm) {
                            $subQ->where('name', 'like', '%' . $searchTerm . '%');
                        })
                        ->orWhereHas('section', function ($subQ) use ($searchTerm) {
                            $subQ->where('name', 'like', '%' . $searchTerm . '%');
                        });
                });
            }

            return \Yajra\DataTables\Facades\DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('photo', function ($row) {
                    $photoUrl = asset($row->image ?? 'default.png');
                    $defaultUrl = asset('default.png');
                    return '<div style="width: 45px; height: 45px; border-radius: 50%; overflow: hidden; border: 2px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; background-color: #f8fafc;"><img src="' . $photoUrl . '" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src=\'' . $defaultUrl . '\'"></div>';
                })
                ->addColumn('id_name', function ($row) {
                    $systemId = $row->system_id ?? '';
                    $name = $row->name ?? '';
                    return '<span class="citizen-id">' . htmlspecialchars($systemId) . '</span><br><strong>' . htmlspecialchars($name) . '</strong>';
                })
                ->addColumn('mobile_email', function ($row) {
                    $mobileHtml = '';
                    if ($row->mobile) {
                        $mobileHtml .= '<a href="tel:' . $row->mobile . '">' . htmlspecialchars($row->mobile) . '</a>';
                    }
                    $emailHtml = '';
                    if ($row->email) {
                        if ($mobileHtml) {
                            $emailHtml .= '<br>';
                        }
                        $emailHtml .= '<a href="mailto:' . $row->email . '">' . htmlspecialchars($row->email) . '</a>';
                    }
                    return $mobileHtml . $emailHtml;
                })
                ->addColumn('gender_dob', function ($row) {
                    $genderOptions = people_constant_option('gender');
                    $gender = isset($row->staff->gender) ? ($genderOptions[$row->staff->gender] ?? '') : '';
                    $dob = $row->staff->date_of_birth ?? '';
                    $dobHtml = $dob ? date('d-m-Y', strtotime($dob)) : 'N/A';
                    return $gender . '<br><small>' . $dobHtml . '</small>';
                })
                ->addColumn('department_name', function ($row) {
                    return $row->department->name ?? 'N/A';
                })
                ->addColumn('section_name', function ($row) {
                    return $row->section->name ?? 'N/A';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionButtons = '<div class="table-action d-flex" style="gap: 5px;">';
                    if (view_permission()) {
                        $actionButtons .= '<a href="' . route('staff.edit', $row->id) . '" title="Edit" class="btn btn-primary btn-sm btn-action"><i class="fa fa-edit"></i></a>';
                    }
                    if (view_permission()) {
                        $actionButtons .= '<a href="' . route('staff.show', $row->id) . '" title="View" class="btn btn-info btn-sm btn-action"><i class="fa fa-eye"></i></a>';
                    }
                    $actionButtons .= '</div>';
                    return $actionButtons;
                })
                ->rawColumns(['photo', 'id_name', 'mobile_email', 'gender_dob', 'status', 'action'])
                ->make(true);
        }
    }


    public function approvedlist()
    {
        $data['subMenu'] = 'approvedList';
        $query           = User::with([
            'staff',
            'professionalInfos',
            'addressInfo.presentDistrict',
            'addressInfo.presentThana',
            'addressInfo.presentPostoffice',
            'addressInfo.presentVillage',
            'addressInfo.presentWard'
        ])->where('user_type', 'staff')->where('status', 1);

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
        // $data['countries'] = Country::orderBy('name')->get();
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
            'name'          => 'required|max:190',
            'bn_name'       => 'required|max:190',
            'date_of_birth' => 'nullable|max:190',
            'birth_place'   => 'nullable|max:190',
            'gender'        => 'nullable|max:190',
            'religion'      => 'nullable|max:190',
            'blood_group'   => 'nullable|max:190',
            'mobile'        => 'nullable|max:190',
            'email'         => 'nullable|max:190|unique:users,email',
            'image'         => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'signature'     => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
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
                $user->role_id      = 0;
                $user->institute_id = Auth::user()->institute_id ?? '';

                $user->name       = $request->name;
                $user->email      = $request->email;
                $user->mobile     = $request->mobile;
                $user->status     = 0; // Set to 0 by default, will be set to 1 when approved
                $user->created_by = Auth::id();
                $user->password   = Hash::make('12345678');
                $image            = $request->file('image');
                $user->user_type  = 'staff';

                if ($image) {
                    $user->image = $this->uploadFile($image, 'uploads/users/', 'avatar_');
                }

                if ($user->save()) {



                    $staff                = Staff::firstOrNew([ 'user_id' => $user->id ]);
                    $staff->bn_name       = $request->bn_name;
                    $staff->date_of_birth = $request->date_of_birth;
                    $staff->birth_place   = $request->birth_place;
                    $staff->district_id   = $request->district_id;
                    // $staff->country_id    = $request->country_id;
                    $staff->gender        = $request->gender;
                    $staff->religion_id   = $request->religion;
                    $staff->blood_group   = $request->blood_group;

                    if ($request->hasFile('signature')) {
                        $signature        = $request->file('signature');
                        $staff->signature = $this->uploadFile($signature, 'uploads/signatures/', 'sig_');
                    }

                    if (empty($staff->staff_id)) {
                        $staff->staff_id = $this->generateStaffId(
                            $staff->date_of_birth,
                            $staff->district_id
                        );
                    }

                    if ($staff->save()) {
                        $data['status']       = true;
                        $data['message']      = "Staff saved successfully.";
                        $data['user']         = $user;
                        $data['staff']        = $staff;
                        $data['code']         = 200;
                        $data['redirect_url'] = route('staff.family', $user->id);
                        return $data;
                    } else {
                        $data['status']  = false;
                        $data['message'] = "Staff save failed! Please try again...";
                        $data['code']    = 500;
                        return $data;
                    }
                }
            } catch (\Throwable $th) {
                $data['status']  = false;
                $data['code']    = 500;
                $data['errors']  = $th->getMessage() . ' in ' . $th->getFile() . ':' . $th->getLine();
                $data['message'] = "Something went wrong! Please try again or contact on support...";
                Log::error('Staff Creation Failed: ' . $th->getMessage(), [ 'trace' => $th->getTraceAsString() ]);
                return $data;
            }
        });
        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['religions']        = Religion::where('status', true)->get();
        $data['districts']        = District::where('status', true)->orderBy('name')->get();
        // $data['countries']        = Country::orderBy('name')->get();
        $data['religions']        = Religion::where('status', true)->get();
        $data['familyTypes']      = FamilyType::where('status', true)->get();
        $data['familyCategories'] = FamilyCategory::where('status', true)->get();
        $data['user']             = $user = User::with('familyInfo', 'educationInfos', 'financialInfos', 'propertyInfos', 'disabilityInfo', 'freedomFighterInfo')
            ->with('institute')
            ->with(array(
                'addressInfo' => function ($address) {
                    $address->with('presentUnion', 'presentVillage', 'presentDistrict', 'presentThana');
                }
            ))
            ->with('professionalInfos')
            ->find($id);

        if (!$user) {
            return redirect()->route('staff.index')->with('error', 'User not found.');
        }

        $institute     = $user->institute;
        $data['staff'] = Staff::where('user_id', $id)->first();
        // Keep backward compat alias
        $data['people'] = $data['staff'];

        $data['religions']        = Religion::where('status', true)->get();
        $data['villages']         = [];
        $data['wards']            = [];
        $data['permanent_houses'] = [];
        $data['roads']            = [];
        if (isset($institute?->institute_type_id) && $institute->institute_type_id == 1) {
            $data['villages'] = Village::where('union_id', $institute->union_id)->get();
            $data['wards']    = [];
        } else if (isset($institute?->institute_type_id) && $institute->institute_type_id == 2) {

        } else if (isset($institute?->institute_type_id) && $institute->institute_type_id == 3) {

        }
        $data['divisions'] = Division::where('status', true)->get();

        // $data['professions'] = Profession::where('status', true)->get();

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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!view_permission()) {
            return redirect()->back();
        }

        $data['religions'] = Religion::where('status', true)->get();
        $data['districts'] = District::where('status', true)->orderBy('name')->get();
        // $data['countries'] = Country::orderBy('name')->get();
        $data['user']      = $user = User::with('staff')->find($id);

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
            'name'          => 'required|max:190',
            'bn_name'       => 'required|max:190',
            'date_of_birth' => 'nullable|max:190',
            'birth_place'   => 'nullable|max:190',
            'gender'        => 'nullable|max:190',
            'religion'      => 'nullable|max:190',
            'blood_group'   => 'nullable|max:190',
            'mobile'        => 'required|max:190',
            'email'         => 'nullable|max:190|email',
            'image'         => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'signature'     => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            $data['status']  = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors']  = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request, $userID) {
            $user             = User::find($userID);
            $user->name       = $request->name;
            $user->email      = $request->email;
            $user->mobile     = $request->mobile;
            $user->updated_by = Auth::id();
            $user->user_type  = 'staff';
            $image            = $request->file('image');

            if ($image) {
                $this->deleteFile($user->image);
                $user->image = $this->uploadFile($image, 'uploads/users/', 'avatar_');
            }

            try {
                $user->save();
                $staff                = Staff::firstOrNew([ 'user_id' => $userID ]);
                $staff->bn_name       = $request->bn_name;
                $staff->date_of_birth = $request->date_of_birth;
                $staff->birth_place   = $request->birth_place;
                $staff->district_id   = $request->district_id;
                // $staff->country_id    = $request->country_id;
                $staff->gender        = $request->gender;
                $staff->religion_id   = $request->religion;
                $staff->blood_group   = $request->blood_group;

                if ($request->hasFile('signature')) {
                    $signature = $request->file('signature');
                    $this->deleteFile($staff->signature);
                    $staff->signature = $this->uploadFile($signature, 'uploads/signatures/', 'sig_');
                }

                if (empty($staff->staff_id)) {
                    $staff->staff_id = $this->generateStaffId(
                        $staff->date_of_birth,
                        $staff->district_id
                    );
                }

                try {
                    $staff->save();
                    $data['status']       = true;
                    $data['message']      = "Staff updated successfully.";
                    $data['user']         = $user;
                    $data['staff']        = $staff;
                    $data['code']         = 200;
                    $data['redirect_url'] = route('staff.family', $userID);
                    return $data;
                } catch (\Throwable $th) {
                    $data['status']  = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    $data['code']    = 500;
                    $data['errors']  = $th->getMessage() . ' in ' . $th->getFile() . ':' . $th->getLine();
                    Log::error('Staff Update Failed: ' . $th->getMessage(), [ 'trace' => $th->getTraceAsString() ]);
                    return $data;
                }
            } catch (\Throwable $th) {
                $data['status']  = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['code']    = 500;
                $data['errors']  = $th->getMessage() . ' in ' . $th->getFile() . ':' . $th->getLine();
                Log::error('Staff Update Failed: ' . $th->getMessage(), [ 'trace' => $th->getTraceAsString() ]);
                return $data;
            }

        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    private function generateStaffId($date_of_birth, $district_id)
    {
        $datePart     = \Carbon\Carbon::parse($date_of_birth)->format('ymd');
        $districtPart = str_pad($district_id ?? 0, 2, '0', STR_PAD_LEFT);

        $last = Staff::whereNotNull('staff_id')
            ->where('district_id', $district_id)
            ->orderBy('id', 'desc')
            ->first();

        if ($last && $last->staff_id) {
            $lastSerial = (int) substr($last->staff_id, -4);
            $newSerial  = $lastSerial + 1;
        } else {
            $newSerial = 1;
        }

        $serialPart = str_pad($newSerial, 4, '0', STR_PAD_LEFT);

        return 'SID-' . $districtPart . '-' . $datePart . '-' . $serialPart;
    }




}
