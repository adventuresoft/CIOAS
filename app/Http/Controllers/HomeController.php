<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Union;
use App\Models\Pourashava;
use App\Models\CityCorporation;
use App\Models\MisCase;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\PostOffice;
use App\Models\BasicSettings\Village;
use App\Models\OwnerShipType;
use App\Models\License\LicenseCategory;
use App\Models\License\LicenseSubCategory;
use App\Models\License\License;
use App\Models\HotelRestaurant\HotelRestaurant;
use App\Models\HotelRestaurant\HotelCategory;
use App\Models\HotelRestaurant\HotelRestaurantOwnership;
use App\Models\LicenseOwnership;
use App\Models\PersonGunApplication;
use App\Models\OrgGunApplication;
use App\Models\OtherOrgGunApplication;
use App\Models\OrgGunGuardDetail;
use App\Models\OtherOrgGunGuardDetail;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $data['total_unions'] = Union::count();
        $data['total_pourashavas'] = Pourashava::count();
        $data['total_city_corporations'] = CityCorporation::count();

        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.index', $data);
    }

    public function miscaseList(Request $request)
    {
        if ($request->ajax()) {
            $query = MisCase::query()->orderBy('created_at', 'desc');

            if ($request->filled('date')) {
                $query->whereDate('case_date', $request->date);
            }

            return \Yajra\DataTables\Facades\DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('case_date', function ($row) {
                    return $row->case_date ? \Carbon\Carbon::parse($row->case_date)->format('d/m/Y') : '-';
                })
                ->addColumn('plaintiffs', function ($row) {
                    $html = '';
                    if (is_array($row->plaintiffs)) {
                        foreach ($row->plaintiffs as $plaintiff) {
                            $name = $plaintiff['name'] ?? '';
                            $html .= '<div class="mb-1">' . htmlspecialchars($name) . '</div>';
                        }
                    }
                    return $html;
                })
                ->addColumn('defendants', function ($row) {
                    $html = '';
                    if (is_array($row->defendants)) {
                        foreach ($row->defendants as $defendant) {
                            $name = $defendant['name'] ?? '';
                            $html .= '<div class="mb-1">' . htmlspecialchars($name) . '</div>';
                        }
                    }
                    return $html;
                })
                ->editColumn('next_hearing_date', function ($row) {
                    return $row->next_hearing_date ? \Carbon\Carbon::parse($row->next_hearing_date)->format('d/m/Y') : '-';
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'running') {
                        return '<span class="badge bg-primary px-3 py-2 rounded-pill fs-content">চলমান</span>';
                    } elseif ($row->status == 'resolved') {
                        return '<span class="badge bg-success px-3 py-2 rounded-pill fs-content">নিষ্পন্ন</span>';
                    }
                    return '<span class="badge bg-secondary px-3 py-2 rounded-pill fs-content">' . ucfirst($row->status) . '</span>';
                })
                ->rawColumns(['plaintiffs', 'defendants', 'status'])
                ->make(true);
        }

        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.miscase_list', $data);
    }


    public function testHttpRequest()
    {
        $response = Http::get('https://api.github.com/octocat', [
            'key1' => "test",
            'key2' => 'Test',
        ]);

        if ($response->failed()) {
            $data['status'] = false;
            $data['message'] = "failed";
            $data['response'] = $response;
            return response()->json($data, 500);
            // return failure
        } else {
            $data['status'] = true;
            $data['message'] = "success";
            $data['response'] = $response;
            return response()->json($data, 500);
            // return success
        }
    }

    public function licenseForm()
    {
        $data['types'] = OwnerShipType::where('status', true)->latest()->get();
        $data['categories'] = LicenseCategory::where('status', true)->latest()->get();

        $data['divisions'] = Division::where('status', true)->get();
        $data['post_officeses'] = PostOffice::latest()->get();
        $data['villages'] = Village::where('status', true)->get();

        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.license.create', $data);
    }

    public function licenseSuccess($application_id)
    {
        $data['application_id'] = $application_id;
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.license.success', $data);
    }

    public function licenseStore(Request $request)
    {
        $licenseCategoryId = $request->input('organization_category_id', $request->license_category_id);
        $licenseSubcategoryId = $request->input('organization_subcategory_id', $request->license_subcategory_id);

        $validate = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'bn_name' => 'nullable|max:190',
            'organization_category_id' => 'nullable|integer|exists:license_categories,id',
            'organization_subcategory_id' => 'nullable|integer|exists:license_sub_categories,id',
            'organization_type_id' => 'nullable|integer',
            'license_category_id' => 'nullable|integer|exists:license_categories,id',
            'license_subcategory_id' => 'nullable|integer|exists:license_sub_categories,id',
            'application_type' => 'nullable|in:new,old',
            'remarks' => 'nullable|max:500',
            'rjsc_reg_no' => 'nullable|max:190',
            'no_of_owner' => 'nullable|integer',
            'no_of_dir' => 'nullable|integer',
            'capital' => 'nullable|numeric',
            'establish_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'division_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'thana_id' => 'nullable|integer',
            'post_office_id' => 'nullable|integer',
            'union_id' => 'nullable|integer',
            'village_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'pos_id' => 'nullable|integer',
            'ward_id' => 'nullable|integer',
            'road' => 'nullable|max:190',
            'house' => 'nullable|max:190',
            'house_bn' => 'nullable|max:190',
            'office_division_id' => 'nullable|integer',
            'office_district_id' => 'nullable|integer',
            'office_thana_id' => 'nullable|integer',
            'office_post_office_id' => 'nullable|integer',
            'office_union_id' => 'nullable|integer',
            'office_village_id' => 'nullable|integer',
            'office_city_id' => 'nullable|integer',
            'office_pos_id' => 'nullable|integer',
            'office_ward_id' => 'nullable|integer',
            'office_road' => 'nullable|max:190',
            'office_house' => 'nullable|max:190',
            'office_house_bn' => 'nullable|max:190',
            'location_type' => 'nullable',
            'office_location_type' => 'nullable',
            'premises_ownership' => 'nullable|in:owned,rented',
            'hotel_logo' => 'nullable|image|max:2048',
            'owned_document_file.*' => 'nullable|file|max:2048',
            'rented_document_file.*' => 'nullable|file|max:2048',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors' => $validate->errors(),
            ], 400);
        }

        $logoName = null;

        if ($request->hasFile('hotel_logo')) {
            $logoName = $this->uploadFile($request->hotel_logo, 'uploads/license/logo/', 'logo_');
        }

        $documentFiles = null;
        if ($request->hasFile('owned_document_file') || $request->hasFile('rented_document_file')) {
            $files = $request->file('owned_document_file') ?? $request->file('rented_document_file');
            $uploadedDocuments = [];

            foreach ($files as $file) {
                if ($file) {
                    $uploadedDocuments[] = $this->uploadFile($file, 'uploads/license/documents/', 'doc_');
                }
            }

            $documentFiles = json_encode($uploadedDocuments);
        }

        $application_id = $this->generateApplicationId();

        $payload = [
            'application_id' => $application_id,
            'name' => $request->name,
            'bn_name' => $request->bn_name,
            'license_category_id' => $licenseCategoryId,
            'license_subcategory_id' => $licenseSubcategoryId,
            'license_type_id' => $request->organization_type_id,
            'application_type' => $request->application_type ?? 'new',
            'remarks' => $request->remarks,
            'rjsc_reg_no' => $request->rjsc_reg_no,
            'no_of_owner' => $request->no_of_owner,
            'no_of_dir' => $request->no_of_dir,
            'capital' => $request->capital,
            'establish_year' => $request->establish_year,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'thana_id' => $request->thana_id,
            'post_office_id' => $request->post_office_id,
            'union_id' => $request->union_id,
            'village_id' => $request->village_id,
            'city_id' => $request->city_id,
            'pos_id' => $request->pos_id,
            'ward_id' => $request->ward_id,
            'road' => $request->road,
            'house' => $request->house,
            'house_bn' => $request->house_bn,
            'location_type' => $request->location_type,
            'office_division_id' => $request->office_division_id,
            'office_district_id' => $request->office_district_id,
            'office_thana_id' => $request->office_thana_id,
            'office_post_office_id' => $request->office_post_office_id,
            'office_union_id' => $request->office_union_id,
            'office_village_id' => $request->office_village_id,
            'office_city_id' => $request->office_city_id,
            'office_pos_id' => $request->office_pos_id,
            'office_ward_id' => $request->office_ward_id,
            'office_road' => $request->office_road,
            'office_house' => $request->office_house,
            'office_house_bn' => $request->office_house_bn,
            'office_location_type' => $request->office_location_type,
            'premises_ownership' => $request->premises_ownership,
            'document_files' => $documentFiles,
            'license_logo' => $logoName,
            'status' => 'pending', // default pending status for public submissions
        ];

        $license = License::create($payload);

        // Process Ownerships
        if ($request->has('owner_name') && is_array($request->owner_name)) {
            foreach ($request->owner_name as $key => $ownerName) {
                if (empty($ownerName)) continue;

                $photoName = null;
                if ($request->hasFile("owner_photo.$key")) {
                    $photoName = $this->uploadFile($request->file("owner_photo")[$key], 'uploads/license/owners/photo/', 'photo_');
                }

                $signatureName = null;
                if ($request->hasFile("owner_signature.$key")) {
                    $signatureName = $this->uploadFile($request->file("owner_signature")[$key], 'uploads/license/owners/signature/', 'sign_');
                }

                LicenseOwnership::create([
                    'application_id' => $application_id, // License applications link by application_id commonly or license->id, let's use application_id as defined in migration
                    'name' => $ownerName,
                    'nid' => $request->owner_nid[$key] ?? null,
                    'gender' => $request->owner_gender[$key] ?? null,
                    'religion' => $request->owner_religion[$key] ?? null,
                    'mobile' => $request->owner_mobile[$key] ?? null,
                    'email' => $request->owner_email[$key] ?? null,
                    'father_name' => $request->owner_father_name[$key] ?? null,
                    'mother_name' => $request->owner_mother_name[$key] ?? null,
                    'present_road' => $request->owner_present_address[$key] ?? null,
                    'permanent_road' => $request->owner_permanent_address[$key] ?? null,
                    'photo' => $photoName,
                    'signature' => $signatureName,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'License application submitted successfully!',
            'result' => $license,
            'redirect_url' => route('frontend.license.success', $application_id),
        ], 200);
    }

    private function generateApplicationId()
    {
        $datePart = Carbon::now()->format('ymd');

        $last = License::whereDate('created_at', Carbon::today())
            ->whereNotNull('application_id')
            ->orderBy('id', 'desc')
            ->first();

        $newSerial = $last ? ((int) substr($last->application_id, -5)) + 1 : 1;

        return $datePart . str_pad($newSerial, 5, '0', STR_PAD_LEFT);
    }

    public function hotelRestaurantForm()
    {
        $data['types'] = OwnerShipType::where('status', true)->latest()->get();
        $data['categories'] = HotelCategory::where('status', true)->latest()->get();


        $data['divisions'] = Division::where('status', true)->get();
        $data['post_officeses'] = PostOffice::latest()->get();
        $data['villages'] = Village::where('status', true)->get();

        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.hotel-restaurant.create', $data);
    }

    public function hotelRestaurantSuccess($application_id)
    {
        $data['application_id'] = $application_id;
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.hotel-restaurant.success', $data);
    }

    public function hotelRestaurantStore(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'bn_name' => 'nullable|max:190',
            'organization_category_id' => 'nullable|integer',
            'organization_subcategory_id' => 'nullable|integer',
            'organization_type_id' => 'nullable|integer',
            'rjsc_reg_no' => 'nullable|max:190',
            'no_of_owner' => 'nullable|integer',
            'capital' => 'nullable|numeric',
            'establish_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'application_type' => 'nullable|in:new,old',
            'remarks' => 'nullable|max:500',
            'division_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'thana_id' => 'nullable|integer',
            'post_office_id' => 'nullable|integer',
            'union_id' => 'nullable|integer',
            'village_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'pos_id' => 'nullable|integer',
            'ward_id' => 'nullable|integer',
            'road' => 'nullable|max:190',
            'house' => 'nullable|max:190',
            'house_bn' => 'nullable|max:190',
            'office_division_id' => 'nullable|integer',
            'office_district_id' => 'nullable|integer',
            'office_thana_id' => 'nullable|integer',
            'office_post_office_id' => 'nullable|integer',
            'office_village_id' => 'nullable|integer',
            'office_union_id' => 'nullable|integer',
            'office_city_id' => 'nullable|integer',
            'office_pos_id' => 'nullable|integer',
            'office_ward_id' => 'nullable|integer',
            'office_road' => 'nullable|max:190',
            'office_house' => 'nullable|max:190',
            'office_house_bn' => 'nullable|max:190',
            'no_of_dir' => 'nullable|integer',
            'location_type' => 'nullable',
            'office_location_type' => 'nullable',
            'premises_ownership' => 'nullable|in:owned,rented',
            'hotel_logo' => 'nullable|image|max:2048',
            'owned_document_file.*' => 'nullable|file|max:2048',
            'rented_document_file.*' => 'nullable|file|max:2048',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors' => $validate->errors(),
            ], 400);
        }

        $logoName = null;
        if ($request->hasFile('hotel_logo')) {
            $logoName = $this->uploadFile($request->hotel_logo, 'uploads/hotel/logo/', 'logo_');
        }

        $document_files = null;
        if ($request->hasFile('owned_document_file') || $request->hasFile('rented_document_file')) {
            $files = $request->file('owned_document_file') ?? $request->file('rented_document_file');
            $uploadedDocuments = [];

            foreach ($files as $file) {
                if ($file) {
                    $uploadedDocuments[] = $this->uploadFile($file, 'uploads/hotel/documents/', 'rented_doc_');
                }
            }

            if (!empty($uploadedDocuments)) {
                $document_files = json_encode($uploadedDocuments);
            }
        }

        $application_id = $this->generateHotelApplicationId();

        $payload = [
            'institute_id' => \Illuminate\Support\Facades\Auth::user()->institute_id ?? 0,
            'name' => $request->name,
            'bn_name' => $request->bn_name,
            'application_id' => $application_id,
            'hotel_category_id' => $request->organization_category_id,
            'hotel_subcategory_id' => $request->organization_subcategory_id,
            'hotel_type_id' => $request->organization_type_id,
            'rjsc_reg_no' => $request->rjsc_reg_no,
            'no_of_owner' => $request->no_of_owner,
            'no_of_dir' => $request->no_of_dir,
            'capital' => $request->capital,
            'establish_year' => $request->establish_year,
            'application_type' => $request->application_type,
            'premises_ownership' => $request->premises_ownership,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'thana_id' => $request->thana_id,
            'post_office_id' => $request->post_office_id,
            'union_id' => $request->union_id,
            'village_id' => $request->village_id,
            'city_id' => $request->city_id,
            'pos_id' => $request->pos_id,
            'ward_id' => $request->ward_id,
            'road' => $request->road,
            'house' => $request->house,
            'house_bn' => $request->house_bn,
            'office_division_id' => $request->office_division_id,
            'office_district_id' => $request->office_district_id,
            'office_thana_id' => $request->office_thana_id,
            'office_post_office_id' => $request->office_post_office_id,
            'office_union_id' => $request->office_union_id,
            'office_village_id' => $request->office_village_id,
            'office_city_id' => $request->office_city_id,
            'office_pos_id' => $request->office_pos_id,
            'office_ward_id' => $request->office_ward_id,
            'office_road' => $request->office_road,
            'office_house' => $request->office_house,
            'office_house_bn' => $request->office_house_bn,
            'location_type' => $request->location_type,
            'office_location_type' => $request->office_location_type,
            'document_files' => $document_files,
            'hotel_logo' => $logoName,
            'status' => 0,
        ];

        $organization = HotelRestaurant::create($payload);

        // Process Ownerships
        if ($request->has('owner_name') && is_array($request->owner_name)) {
            foreach ($request->owner_name as $key => $ownerName) {
                if (empty($ownerName)) continue;

                $photoName = null;
                if ($request->hasFile("owner_photo.$key")) {
                    $photoName = $this->uploadFile($request->file("owner_photo")[$key], 'uploads/hotel/owners/photo/', 'photo_');
                }

                $signatureName = null;
                if ($request->hasFile("owner_signature.$key")) {
                    $signatureName = $this->uploadFile($request->file("owner_signature")[$key], 'uploads/hotel/owners/signature/', 'sign_');
                }

                HotelRestaurantOwnership::create([
                    'hotel_restaurant_id' => $organization->id,
                    'name' => $ownerName,
                    'nid' => $request->owner_nid[$key] ?? null,
                    'gender' => $request->owner_gender[$key] ?? null,
                    'religion' => $request->owner_religion[$key] ?? null,
                    'mobile' => $request->owner_mobile[$key] ?? null,
                    'email' => $request->owner_email[$key] ?? null,
                    'father_name' => $request->owner_father_name[$key] ?? null,
                    'mother_name' => $request->owner_mother_name[$key] ?? null,
                    'present_road' => $request->owner_present_address[$key] ?? null,
                    'permanent_road' => $request->owner_permanent_address[$key] ?? null,
                    'image' => $photoName, // using image field instead of photo
                    // add signature if table supports it (or omit for now)
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Organization saved successfully!',
            'result' => $organization,
            'redirect_url' => route('frontend.hotel-restaurant.success', $application_id),
        ], 200);
    }

    private function generateHotelApplicationId()
    {
        $datePart = Carbon::now()->format('ymd');
        $last = HotelRestaurant::whereDate('created_at', Carbon::today())
            ->whereNotNull('application_id')
            ->orderBy('id', 'desc')
            ->first();

        $newSerial = $last ? ((int) substr($last->application_id, -5)) + 1 : 1;
        return $datePart . str_pad($newSerial, 5, '0', STR_PAD_LEFT);
    }

    public function gunLicenseSelect()
    {
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.gun-license.select-type');
    }

    public function personGunForm()
    {
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.gun-license.person.create');
    }

    public function personGunSuccess($application_id)
    {
        $data['application_id'] = $application_id;
        $data['title'] = 'ব্যক্তিগত আগ্নেয়াস্ত্র লাইসেন্স আবেদন সফল';
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.gun-license.success', $data);
    }

    public function personGunStore(Request $request)
    {
        if ($request->has('age_at_application')) {
            $bnDigits = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
            $enDigits = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
            $convertedAge = str_replace($bnDigits, $enDigits, $request->age_at_application);
            $request->merge(['age_at_application' => $convertedAge]);
        }

        $validator = Validator::make($request->all(), [
            'district_magistrate' => 'nullable|string|max:255',
            'application_class' => 'nullable|string|max:255',
            'applicant_name' => 'required|string|max:255',
            'applicant_name_en' => 'nullable|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'age_at_application' => 'nullable|integer|min:0',
            'mother_name' => 'nullable|string|max:255',
            'mother_profession' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'father_profession' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'spouse_name' => 'nullable|string|max:255',
            'spouse_profession' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'education_qualification' => 'nullable|string|max:255',
            'profession_details' => 'nullable|string',
            'profession_address' => 'nullable|string',
            'annual_income' => 'nullable|string|max:255',
            'income_source' => 'nullable|string|max:255',
            'tin_no' => 'nullable|string|max:255',
            'tax_history_details' => 'nullable|string',
            'is_govt_employee' => 'required|boolean',
            'cadre_service_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'pay_grade_salary' => 'nullable|string|max:255',
            'workplace_address' => 'nullable|string',
            'duty_free_import' => 'nullable|string|max:255',
            'license_cancelled_before' => 'required|boolean',
            'cancelled_weapon_type' => 'nullable|string|max:255',
            'cancellation_reason' => 'nullable|string',
            'weapon_details' => 'required|string',
            'weapon_count' => 'required|integer|min:1',
            'necessity_reason' => 'nullable|string',
            'affidavit_attached' => 'required|boolean',
            'heir_deed_attached' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $appClass = $request->application_class;
        $weaponCount = (int) $request->weapon_count;
        $maxAllowed = ($appClass === 'শ্যুটার') ? 3 : 1;

        if ($weaponCount > $maxAllowed) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => ['weapon_count' => ["আগ্নেয়াস্ত্র সংখ্যা সর্বোচ্চ {$maxAllowed} টি হতে পারে।"]]
            ], 400);
        }

        $datePart = Carbon::now()->format('Ymd');
        $last = PersonGunApplication::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        $newSerial = 1;
        if ($last && preg_match('/-(\d+)$/', $last->tracking_no, $matches)) {
            $newSerial = ((int) $matches[1]) + 1;
        }
        $trackingNo = 'PG-' . $datePart . '-' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);

        $application = PersonGunApplication::create([
            'institute_id' => \Illuminate\Support\Facades\Auth::user()->institute_id ?? 0,
            'tracking_no' => $trackingNo,
            'district_magistrate' => $request->district_magistrate,
            'application_class' => $request->application_class,
            'applicant_name' => $request->applicant_name,
            'applicant_name_en' => $request->applicant_name_en,
            'nid_no' => $request->nid_no,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'age_at_application' => $request->age_at_application,
            'mother_name' => $request->mother_name,
            'mother_profession' => $request->mother_profession,
            'father_name' => $request->father_name,
            'father_profession' => $request->father_profession,
            'marital_status' => $request->marital_status,
            'spouse_name' => $request->spouse_name,
            'spouse_profession' => $request->spouse_profession,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'education_qualification' => $request->education_qualification,
            'profession_details' => $request->profession_details,
            'profession_address' => $request->profession_address,
            'annual_income' => $request->annual_income,
            'income_source' => $request->income_source,
            'tin_no' => $request->tin_no,
            'tax_history_details' => $request->tax_history_details,
            'is_govt_employee' => $request->is_govt_employee,
            'cadre_service_name' => $request->cadre_service_name,
            'designation' => $request->designation,
            'pay_grade_salary' => $request->pay_grade_salary,
            'workplace_address' => $request->workplace_address,
            'duty_free_import' => $request->duty_free_import,
            'license_cancelled_before' => $request->license_cancelled_before,
            'cancelled_weapon_type' => $request->cancelled_weapon_type,
            'cancellation_reason' => $request->cancellation_reason,
            'weapon_details' => $request->weapon_details,
            'weapon_count' => $request->weapon_count ?? 1,
            'necessity_reason' => $request->necessity_reason,
            'affidavit_attached' => $request->affidavit_attached,
            'heir_deed_attached' => $request->heir_deed_attached,
            'status' => 'Submitted'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Application submitted successfully! Tracking No: ' . $trackingNo,
            'redirect_url' => route('frontend.gun-license.person.success', $trackingNo)
        ], 200);
    }

    public function orgGunForm()
    {
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.gun-license.org.create');
    }

    public function orgGunSuccess($application_id)
    {
        $data['application_id'] = $application_id;
        $data['title'] = 'ব্যাংক/আর্থিক প্রতিষ্ঠান আগ্নেয়াস্ত্র লাইসেন্স আবেদন সফল';
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.gun-license.success', $data);
    }

    public function orgGunStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'org_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'org_address' => 'nullable|string',
            'operation_start_date' => 'nullable|date',
            'vault_limit' => 'required|string|in:সর্বোচ্চ ১ কোটি টাকা,১ কোটি টাকার উর্ধ্বে কিন্তু ৫ কোটি টাকার নিম্মে,৫ কোটি টাকার উর্ধ্বে,up_to_1_crore,1_to_5_crore,above_5_crore',
            'vehicle_count' => 'nullable|integer|min:0',
            'owner_or_ceo_details' => 'nullable|string',
            'organogram_manpower_details' => 'nullable|string',
            'bangladesh_bank_permission' => 'required|boolean',
            'tax_details' => 'nullable|string',
            'current_security_description' => 'nullable|string',
            'rental_agreement_details' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'weapon_count_requested' => 'required|integer|min:1',
            'weapon_nature_requested' => 'required|string|max:255',
            'justification_of_necessity' => 'nullable|string',
            'existing_weapons_details' => 'nullable|string',
            'guards' => 'required|array|min:1',
            'guards.*.guard_name' => 'required|string|max:255',
            'guards.*.guard_father_name' => 'nullable|string|max:255',
            'guards.*.guard_mother_name' => 'nullable|string|max:255',
            'guards.*.guard_present_address' => 'nullable|string',
            'guards.*.guard_permanent_address' => 'nullable|string',
            'guards.*.guard_age' => 'nullable|integer|min:1',
            'guards.*.guard_education' => 'nullable|string|max:255',
            'guards.*.guard_nid_number' => 'nullable|string|max:255',
            'guards.*.guard_training_certificate_status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'আবেদনপত্র পূরণে কিছু ভুল রয়েছে। অনুগ্রহ করে চেক করুন।',
                'errors' => $validator->errors()
            ], 400);
        }

        $vaultLimit = $request->vault_limit;
        $weaponCount = (int) $request->weapon_count_requested;
        $maxWeapons = 4;
        if ($vaultLimit === 'সর্বোচ্চ ১ কোটি টাকা' || $vaultLimit === 'up_to_1_crore') {
            $maxWeapons = 2;
        } elseif ($vaultLimit === '১ কোটি টাকার উর্ধ্বে কিন্তু ৫ কোটি টাকার নিম্মে' || $vaultLimit === '1_to_5_crore') {
            $maxWeapons = 3;
        }

        if ($weaponCount > $maxWeapons) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => ['weapon_count_requested' => ["সিন্দুক সীমা অনুযায়ী প্রার্থীত আগ্নেয়াস্ত্রের সংখ্যা সর্বোচ্চ {$maxWeapons} টি হতে পারে।"]]
            ], 400);
        }

        $rental_agreement_path = null;
        if ($request->hasFile('rental_agreement_details')) {
            $file = $request->file('rental_agreement_details');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/rental_agreements'), $filename);
            $rental_agreement_path = 'uploads/rental_agreements/' . $filename;
        }

        $datePart = Carbon::now()->format('Ymd');
        $last = OrgGunApplication::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        $newSerial = 1;
        if ($last && preg_match('/-(\d+)$/', $last->tracking_no, $matches)) {
            $newSerial = ((int) $matches[1]) + 1;
        }
        $trackingNo = 'OG-' . $datePart . '-' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);

        DB::beginTransaction();
        try {
            $application = OrgGunApplication::create([
                'institute_id' => \Illuminate\Support\Facades\Auth::user()->institute_id ?? 0,
                'tracking_no' => $trackingNo,
                'org_name' => $request->org_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'org_address' => $request->org_address,
                'operation_start_date' => $request->operation_start_date,
                'vault_limit' => $request->vault_limit,
                'vehicle_count' => $request->vehicle_count ?? 0,
                'owner_or_ceo_details' => $request->owner_or_ceo_details,
                'organogram_manpower_details' => $request->organogram_manpower_details,
                'bangladesh_bank_permission' => $request->bangladesh_bank_permission,
                'tax_details' => $request->tax_details,
                'current_security_description' => $request->current_security_description,
                'rental_agreement_details' => $rental_agreement_path,
                'weapon_count_requested' => $request->weapon_count_requested ?? 0,
                'weapon_nature_requested' => $request->weapon_nature_requested,
                'justification_of_necessity' => $request->justification_of_necessity,
                'existing_weapons_details' => $request->existing_weapons_details,
                'status' => 'Submitted'
            ]);

            if ($request->has('guards') && is_array($request->guards)) {
                foreach ($request->guards as $guardData) {
                    OrgGunGuardDetail::create([
                        'org_gun_application_id' => $application->id,
                        'guard_name' => $guardData['guard_name'],
                        'father_name' => $guardData['guard_father_name'] ?? null,
                        'mother_name' => $guardData['guard_mother_name'] ?? null,
                        'present_address' => $guardData['guard_present_address'] ?? null,
                        'permanent_address' => $guardData['guard_permanent_address'] ?? null,
                        'age' => $guardData['guard_age'] ?? null,
                        'education' => $guardData['guard_education'] ?? null,
                        'nid_number' => $guardData['guard_nid_number'] ?? null,
                        'training_certificate_status' => $guardData['guard_training_certificate_status'],
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Organization application submitted successfully! Tracking No: ' . $trackingNo,
                'redirect_url' => route('frontend.gun-license.org.success', $trackingNo)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($rental_agreement_path && file_exists(public_path($rental_agreement_path))) {
                @unlink(public_path($rental_agreement_path));
            }
            return response()->json([
                'status' => false,
                'message' => 'Failed to save application: ' . $e->getMessage()
            ], 500);
        }
    }

    public function otherOrgGunForm()
    {
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.gun-license.other-org.create');
    }

    public function otherOrgGunSuccess($application_id)
    {
        $data['application_id'] = $application_id;
        $data['title'] = 'প্রতিষ্ঠান আগ্নেয়াস্ত্র লাইসেন্স আবেদন সফল';
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('frontend.pages.gun-license.success', $data);
    }

    public function otherOrgGunStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'org_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'org_address' => 'nullable|string',
            'operation_start_date' => 'nullable|date',
            'organogram_manpower_details' => 'nullable|string',
            'has_trade_license_mou_aou' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'owner_or_ceo_details' => 'nullable|string',
            'rental_agreement_details' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tin_no' => 'nullable|string|max:255',
            'tax_history' => 'nullable|string',
            'paid_up_capital' => 'nullable|string|max:255',
            'existing_weapons_details' => 'nullable|string',
            'safe_custody_details' => 'nullable|string',
            'trained_guard_count' => 'nullable|integer|min:0',
            'guards' => 'required|array|min:1',
            'guards.*.guard_name' => 'required|string|max:255',
            'guards.*.guard_father_name' => 'nullable|string|max:255',
            'guards.*.guard_mother_name' => 'nullable|string|max:255',
            'guards.*.guard_present_address' => 'nullable|string',
            'guards.*.guard_permanent_address' => 'nullable|string',
            'guards.*.guard_age' => 'nullable|integer|min:1',
            'guards.*.guard_education' => 'nullable|string|max:255',
            'guards.*.guard_nid_number' => 'nullable|string|max:255',
            'guards.*.guard_training_certificate_status' => 'required|boolean',
            'guards.*.police_report_for_guard' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'আবেদনপত্র পূরণে কিছু ভুল রয়েছে। অনুগ্রহ করে চেক করুন।',
                'errors' => $validator->errors()
            ], 400);
        }

        $has_trade_license = null;
        if ($request->hasFile('has_trade_license_mou_aou')) {
            $file = $request->file('has_trade_license_mou_aou');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/other-org/documents'), $filename);
            $has_trade_license = 'uploads/other-org/documents/' . $filename;
        }

        $rental_agreement = null;
        if ($request->hasFile('rental_agreement_details')) {
            $file = $request->file('rental_agreement_details');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/other-org/documents'), $filename);
            $rental_agreement = 'uploads/other-org/documents/' . $filename;
        }

        $datePart = Carbon::now()->format('Ymd');
        $last = OtherOrgGunApplication::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        $newSerial = 1;
        if ($last && preg_match('/-(\d+)$/', $last->tracking_no, $matches)) {
            $newSerial = ((int) $matches[1]) + 1;
        }
        $trackingNo = 'OOG-' . $datePart . '-' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);

        DB::beginTransaction();
        try {
            $application = OtherOrgGunApplication::create([
                'institute_id' => \Illuminate\Support\Facades\Auth::user()->institute_id ?? 0,
                'tracking_no' => $trackingNo,
                'org_name' => $request->org_name,
                'org_type' => 'other',
                'phone' => $request->phone,
                'email' => $request->email,
                'org_address' => $request->org_address,
                'operation_start_date' => $request->operation_start_date,
                'organogram_manpower_details' => $request->organogram_manpower_details,
                'has_trade_license_mou_aou' => $has_trade_license,
                'owner_or_ceo_details' => $request->owner_or_ceo_details,
                'rental_agreement_details' => $rental_agreement,
                'tin_no' => $request->tin_no,
                'tax_history' => $request->tax_history,
                'paid_up_capital' => $request->paid_up_capital,
                'existing_weapons_details' => $request->existing_weapons_details,
                'safe_custody_details' => $request->safe_custody_details,
                'trained_guard_count' => $request->trained_guard_count ?? 0,
                'status' => 'Submitted'
            ]);

            if ($request->has('guards') && is_array($request->guards)) {
                foreach ($request->guards as $index => $guardData) {
                    $guard_police_report_path = null;
                    if ($request->hasFile("guards.{$index}.police_report_for_guard")) {
                        $file = $request->file("guards.{$index}.police_report_for_guard");
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/other-org/documents'), $filename);
                        $guard_police_report_path = 'uploads/other-org/documents/' . $filename;
                    }

                    OtherOrgGunGuardDetail::create([
                        'other_org_gun_application_id' => $application->id,
                        'guard_name' => $guardData['guard_name'],
                        'father_name' => $guardData['guard_father_name'] ?? null,
                        'mother_name' => $guardData['guard_mother_name'] ?? null,
                        'present_address' => $guardData['guard_present_address'] ?? null,
                        'permanent_address' => $guardData['guard_permanent_address'] ?? null,
                        'age' => $guardData['guard_age'] ?? null,
                        'education' => $guardData['guard_education'] ?? null,
                        'nid_number' => $guardData['guard_nid_number'] ?? null,
                        'training_certificate_status' => $guardData['guard_training_certificate_status'],
                        'police_report_for_guard' => $guard_police_report_path,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Application submitted successfully! Tracking No: ' . $trackingNo,
                'redirect_url' => route('frontend.gun-license.other-org.success', $trackingNo)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to save application: ' . $e->getMessage()
            ], 500);
        }
    }
}
