<?php

namespace App\Http\Controllers\License;

use App\Http\Controllers\Controller;
use App\DataTables\License\LicenseDataTable;
use App\Models\CityCorporation;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\License\License;
use App\Models\License\LicenseCategory;
use App\Models\License\LicenseSubCategory;
use App\Models\OwnerShipType;
use App\Models\PostOffice;
use App\Models\Pourashava;
use App\Models\Thana;
use App\Models\Union;
use App\Models\BasicSettings\Village;
use App\Traits\FileUploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LicenseController extends Controller
{
    use FileUploadTrait;


    public function __construct()
    {
        $this->middleware('permission:license.read')->only('index', 'show');
        $this->middleware('permission:license.create')->only('create', 'store');
        $this->middleware('permission:license.update')->only('update', 'edit');
        $this->middleware('permission:license.delete')->only('destroy');
    }

    public function index(LicenseDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.license.index');
    }

    public function create()
    {
        $data = $this->formData();
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('backend.pages.license.create', $data);
    }

    public function store(Request $request)
    {
        $licenseCategoryId = $request->input('organization_category_id', $request->license_category_id);
        $licenseSubcategoryId = $request->input('organization_subcategory_id', $request->license_subcategory_id);

        $validate = Validator::make($request->all(), [
            'id' => 'nullable|integer',
            'name' => 'required|max:190',
            'bn_name' => 'nullable|max:190',
            'organization_category_id' => 'nullable|integer|exists:license_categories,id',
            'organization_subcategory_id' => 'nullable|integer|exists:license_sub_categories,id',
            'organization_type_id' => 'nullable|integer',
            'license_category_id' => 'nullable|integer|exists:license_categories,id',
            'license_subcategory_id' => 'nullable|integer|exists:license_sub_categories,id',
            'license_no' => 'nullable|max:190',
            'issue_date' => 'nullable|date',
            'expire_date' => 'nullable|date|after_or_equal:issue_date',
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

        $license = $request->id ? License::findOrFail($request->id) : null;
        $logoName = $license->license_logo ?? null;

        if ($request->hasFile('hotel_logo')) {
            if ($license && $license->license_logo && File::exists(public_path($license->license_logo))) {
                File::delete(public_path($license->license_logo));
            }

            $logoName = $this->uploadFile($request->hotel_logo, 'uploads/license/logo/', 'logo_');
        }

        $documentFiles = $license->document_files ?? null;
        if ($request->hasFile('owned_document_file') || $request->hasFile('rented_document_file')) {
            if ($license && $license->document_files) {
                $oldDocuments = json_decode($license->document_files, true) ?? [];
                foreach ($oldDocuments as $file) {
                    if (File::exists(public_path($file))) {
                        File::delete(public_path($file));
                    }
                }
            }

            $files = $request->file('owned_document_file') ?? $request->file('rented_document_file');
            $uploadedDocuments = [];

            foreach ($files as $file) {
                $uploadedDocuments[] = $this->uploadFile($file, 'uploads/license/documents/', 'doc_');
            }

            $documentFiles = json_encode($uploadedDocuments);
        }

        $payload = [
            'name' => $request->name,
            'bn_name' => $request->bn_name,
            'license_category_id' => $licenseCategoryId,
            'license_subcategory_id' => $licenseSubcategoryId,
            'license_type_id' => $request->organization_type_id,
            'license_no' => $request->license_no,
            'issue_date' => $request->issue_date,
            'expire_date' => $request->expire_date,
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
        ];

        if ($request->id) {
            $payload['updated_by'] = Auth::id();
            $license->update($payload);
        } else {
            $payload['institute_id'] = Auth::user()->institute_id ?? null;
            $payload['application_id'] = $this->generateApplicationId();
            $payload['created_by'] = Auth::id();
            $license = License::create($payload);
        }

        return response()->json([
            'status' => true,
            'message' => 'License saved successfully!',
            'result' => $license,
            'redirect_url' => route('license.index'),
        ], 200);
    }

    public function show($id)
    {
        $license = License::with('category', 'subcategory', 'type')->findOrFail($id);
        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('backend.pages.license.show', compact('license'));
    }

    public function edit($id)
    {
        $license = License::findOrFail($id);
        $data = $this->formData($license);
        $data['license'] = $license;

        $data["wards"] = [];
        $data["ownership_types"] = [];
        return view('backend.pages.license.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        return $this->store($request);
    }

    public function destroy($id)
    {
        License::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'License deleted successfully.',
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

    private function formData(?License $license = null)
    {
        $data['types'] = OwnerShipType::where('status', true)->latest()->get();
        $data['categories'] = LicenseCategory::where('status', true)->latest()->get();
        $data['divisions'] = Division::where('status', true)->get();
        $data['post_officeses'] = PostOffice::latest()->get();

        $institute = Institute::find(Auth::user()->institute_id ?? null);
        $data['villages'] = $institute ? Village::where('union_id', $institute->union_id)->get() : [];

        if (!$license) {
            return $data;
        }

        $data['subcategories'] = LicenseSubCategory::where('license_category_id', $license->license_category_id)
            ->where('status', true)
            ->latest()
            ->get();

        $data['districts'] = District::where('status', true)
            ->where('division_id', $license->division_id)
            ->get();
        $data['thanas'] = Thana::where('status', true)
            ->where('district_id', $license->district_id)
            ->get();
        $data['post_officeses'] = PostOffice::where('status', true)
            ->where('thana_id', $license->thana_id)
            ->get();
        $data['unions'] = Union::where('status', true)
            ->where('thana_id', $license->thana_id)
            ->get();
        $data['pourashavas'] = Pourashava::where('status', true)
            ->where('district_id', $license->district_id)
            ->get();
        $data['city_corporations'] = CityCorporation::where('status', true)
            ->where('district_id', $license->district_id)
            ->get();

        if (!empty($license->union_id)) {
            $data['villages'] = Village::where('status', true)->where('thana_id', $license->thana_id)->get();
        } elseif (!empty($license->pos_id)) {
            $data['villages'] = Village::where('status', true)->where('pos_id', $license->pos_id)->get();
        } elseif (!empty($license->city_id)) {
            $data['villages'] = Village::where('status', true)->where('city_id', $license->city_id)->get();
        }

        $data['office_districts'] = District::where('status', true)
            ->where('division_id', $license->office_division_id)
            ->get();
        $data['office_thanas'] = Thana::where('status', true)
            ->where('district_id', $license->office_district_id)
            ->get();
        $data['office_post_officeses'] = PostOffice::where('status', true)
            ->where('thana_id', $license->office_thana_id)
            ->get();
        $data['office_unions'] = Union::where('status', true)
            ->where('thana_id', $license->office_thana_id)
            ->get();
        $data['office_pourashavas'] = Pourashava::where('status', true)
            ->where('district_id', $license->office_district_id)
            ->get();
        $data['office_city_corporations'] = CityCorporation::where('status', true)
            ->where('district_id', $license->office_district_id)
            ->get();

        if (!empty($license->office_union_id)) {
            $data['office_villages'] = Village::where('status', true)->where('thana_id', $license->office_thana_id)->get();
        } elseif (!empty($license->office_pos_id)) {
            $data['office_villages'] = Village::where('status', true)->where('pos_id', $license->office_pos_id)->get();
        } elseif (!empty($license->office_city_id)) {
            $data['office_villages'] = Village::where('status', true)->where('city_id', $license->office_city_id)->get();
        }

        return $data;
    }
}
