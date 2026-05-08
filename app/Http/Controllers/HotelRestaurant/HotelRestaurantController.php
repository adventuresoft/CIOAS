<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelRestaurant\HotelCategory;
use App\Models\BasicSettings\OrganizationOwnershipType;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\PostOffice;
use App\Models\HotelRestaurant\HotelRestaurant;
use App\Models\HotelRestaurant\HotelOwnerShip;
use App\Models\Organization\OrganizationOwnership;
use App\Models\People\AddressInfo;
use App\Models\UnionWard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Traits\FileUploadTrait;


class HotelRestaurantController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of all hotel restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all hotel restaurants with their category and subcategory relationships
        $data['organizations'] = HotelRestaurant::with('category', 'subcategory')
            ->latest()
            ->get();

        return view('backend.pages.hotel-restaurant.index', $data);
    }

    /**
     * Generate a unique application ID based on date and sequential number.
     *
     * @return string
     */
    private function generateApplicationId()
    {
        // Get today's date in YMD format (e.g., 260509 for 2026-05-09)
        $datePart = Carbon::now()->format('ymd');

        // Find the last application created today to continue the sequence
        $last = HotelRestaurant::whereDate('created_at', Carbon::today())
            ->whereNotNull('application_id')
            ->orderBy('id', 'desc')
            ->first();

        // Extract serial number from last application or start with 1
        if ($last) {
            $lastSerial = (int) substr($last->application_id, -5);
            $newSerial  = $lastSerial + 1;
        } else {
            $newSerial = 1;
        }

        // Return application ID as date + 5-digit serial (e.g., 26050900001)
        return $datePart . str_pad($newSerial, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Show the form for creating a new hotel restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load all lookup data for the form
        $data['types']           = HotelOwnerShip::where('status', true)->latest()->get();
        $data['categories']      = HotelCategory::where('status', true)->latest()->get();
        $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
        $data['wards']           = UnionWard::where('status', true)->get();
        $data['divisions']       = Division::where('status', true)->get();
        $data['post_officeses']  = PostOffice::latest()->get();

        // Load villages for the current user's institute
        $institute        = Institute::find(Auth::user()->institute_id);
        $data['villages'] = $institute ? Village::where('union_id', $institute->union_id)->get() : [];

        return view('backend.pages.hotel-restaurant.create', $data);
    }

    /**
     * Store a newly created hotel restaurant in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate all incoming request data
        $validate = Validator::make($request->all(), [
            'id'                          => 'nullable|integer',
            'name'                        => 'required|max:190',
            'bn_name'                     => 'nullable|max:190',
            'organization_category_id'    => 'nullable|integer',
            'organization_subcategory_id' => 'nullable|integer',
            'organization_work_area_id'   => 'nullable|array',
            'organization_work_area_id.*' => 'nullable|integer',
            'organization_type_id'        => 'nullable|integer',

            'rjsc_reg_no'                 => 'nullable|max:190',
            'no_of_owner'                 => 'nullable|integer',
            'capital'                     => 'nullable|numeric',
            'establish_year'              => 'nullable|integer|min:1900|max:' . date('Y'),
            'application_type'            => 'nullable|in:new,old',
            'remarks'                     => 'nullable|max:500',

            // Address fields from blade
            'division_id'                 => 'nullable|integer',
            'district_id'                 => 'nullable|integer',
            'thana_id'                    => 'nullable|integer',
            'post_office_id'              => 'nullable|integer',
            'village_id'                  => 'nullable|integer',
            'ward_id'                     => 'nullable|integer',
            'road'                        => 'nullable|max:190',
            'house'                       => 'nullable|max:190',
            'house_bn'                    => 'nullable|max:190',
            'office_division_id'          => 'nullable|integer',
            'office_district_id'          => 'nullable|integer',
            'office_thana_id'             => 'nullable|integer',
            'office_post_office_id'       => 'nullable|integer',
            'office_village_id'           => 'nullable|integer',
            'office_ward_id'              => 'nullable|integer',
            'office_road'                 => 'nullable|max:190',
            'office_house'                => 'nullable|max:190',
            'office_house_bn'             => 'nullable|max:190',
            'no_of_dir'                   => 'nullable|integer',
            'premises_ownership'          => 'nullable|in:owned,rented',
            'document_files.*'            => 'nullable|image|max:2048',
            'hotel_logo.*'                => 'nullable|image|max:2048',
            'status'                      => 'nullable|boolean',
        ]);

        // Return validation errors if validation fails
        if ($validate->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validate->errors(),
                'errors'  => $validate->errors(),
            ], 400);
        }

        // Handle hotel logo upload
        $logoName = null;
        if ($request->hasFile('hotel_logo')) {
            $logoName = $this->uploadFile(
                $request->hotel_logo,
                'uploads/hotel/logo/',
                'logo_'
            );
        }

        // Handle document files upload (owned or rented premises)
        $document_files = null;
        if ($request->hasFile('owned_document_file') || $request->hasFile('rented_document_file')) {
            $files             = $request->file('owned_document_file') ?? $request->file('rented_document_file');
            $uploadedDocuments = [];

            foreach ($files as $file) {
                $filePath            = $this->uploadFile(
                    $file,
                    'uploads/hotel/documents/',
                    'rented_doc_'
                );
                $uploadedDocuments[] = $filePath;
            }

            if (!empty($uploadedDocuments)) {
                $document_files = json_encode($uploadedDocuments);
            }
        }



        // Prepare data for database insertion
        $payload = [
            // Basic information
            'name'                  => $request->name,
            'bn_name'               => $request->bn_name,
            'institute_id'          => Auth::user()->institute_id,
            'application_id'        => $this->generateApplicationId(),

            // Category and type information
            'hotel_category_id'     => $request->organization_category_id,
            'hotel_subcategory_id'  => $request->organization_subcategory_id,
            'hotel_type_id'         => $request->organization_type_id,

            // Registration and ownership details
            'rjsc_reg_no'           => $request->rjsc_reg_no,
            'no_of_owner'           => $request->no_of_owner,
            'no_of_dir'             => $request->no_of_dir,
            'capital'               => $request->capital,
            'establish_year'        => $request->establish_year,
            'application_type'      => $request->application_type,
            'premises_ownership'    => $request->premises_ownership,

            // Primary address fields
            'division_id'           => $request->division_id,
            'district_id'           => $request->district_id,
            'thana_id'              => $request->thana_id,
            'post_office_id'        => $request->post_office_id,
            'village_id'            => $request->village_id,
            'ward_id'               => $request->ward_id,
            'road'                  => $request->road,
            'house'                 => $request->house,
            'house_bn'              => $request->house_bn,

            // Office address fields
            'office_division_id'    => $request->office_division_id,
            'office_district_id'    => $request->office_district_id,
            'office_thana_id'       => $request->office_thana_id,
            'office_post_office_id' => $request->office_post_office_id,
            'office_village_id'     => $request->office_village_id,
            'office_ward_id'        => $request->office_ward_id,
            'office_road'           => $request->office_road,
            'office_house'          => $request->office_house,
            'office_house_bn'       => $request->office_house_bn,

            // Files and status
            'document_files'        => $document_files,
            'hotel_logo'            => $logoName,
            'status'                => 0, // New entries start as pending
        ];

        // Save the hotel restaurant to database
        $organization = HotelRestaurant::create($payload);

        // Return success response
        return response()->json([
            'status'       => true,
            'message'      => 'Organization saved successfully!',
            'result'       => $organization,
            'code'         => 200,
            'redirect_url' => route('hotel-restaurant.index'),
        ], 200);
    }

    /**
     * Display the details of a specific hotel restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Fetch hotel restaurant with related data
        $data['organization'] = HotelRestaurant::with([
            'category',
            'subcategory',
            'type',
            'Division',
            'District',
            'Thana',
            'Village',
        ])->find($id);

        return view('backend.pages.hotel-restaurant.show', $data);
    }

    /**
     * Show the form for editing an existing hotel restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the hotel restaurant by ID
        $data['organization'] = HotelRestaurant::find($id);

        // Return 404 if not found
        if (!$data['organization']) {
            return response('Not found', 404);
        }

        // Load all lookup data for the edit form
        $data['types']           = HotelOwnerShip::where('status', true)->latest()->get();
        $data['categories']      = HotelCategory::where('status', true)->latest()->get();
        $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
        $data['wards']           = UnionWard::where('status', true)->get();
        $data['divisions']       = Division::where('status', true)->get();

        // Load districts and thanas for primary address
        $data['districts'] = District::where('status', true)
            ->where('division_id', $data['organization']->division_id)
            ->get();
        $data['thanas']    = Thana::where('status', true)
            ->where('district_id', $data['organization']->district_id)
            ->get();

        // Load districts and thanas for office address
        $data['office_districts'] = District::where('status', true)
            ->where('division_id', $data['organization']->office_division_id)
            ->get();
        $data['office_thanas']    = Thana::where('status', true)
            ->where('district_id', $data['organization']->office_district_id)
            ->get();

        // Load other location data
        $data['post_officeses'] = PostOffice::latest()->get();
        $institute              = Institute::find(Auth::user()->institute_id);
        $data['villages']       = $institute
            ? Village::where('union_id', $institute->union_id)->get()
            : [];

        return view('backend.pages.hotel-restaurant.edit', $data);
    }

    /**
     * Update the hotel restaurant in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the hotel restaurant or return error
        $hotelRestaurant = HotelRestaurant::find($id);
        if (!$hotelRestaurant) {
            return response()->json([
                'status'  => false,
                'message' => 'Hotel restaurant not found',
            ], 404);
        }

        // Validate all incoming request data
        $validate = Validator::make($request->all(), [
            'id'                          => 'nullable|integer',
            'name'                        => 'required|max:190',
            'bn_name'                     => 'nullable|max:190',
            'organization_category_id'    => 'nullable|integer',
            'organization_subcategory_id' => 'nullable|integer',
            'organization_work_area_id'   => 'nullable|array',
            'organization_work_area_id.*' => 'nullable|integer',
            'organization_type_id'        => 'nullable|integer',

            'rjsc_reg_no'                 => 'nullable|max:190',
            'no_of_owner'                 => 'nullable|integer',
            'capital'                     => 'nullable|numeric',
            'establish_year'              => 'nullable|integer|min:1900|max:' . date('Y'),
            'application_type'            => 'nullable|in:new,old',
            'remarks'                     => 'nullable|max:500',

            // Address fields from blade
            'division_id'                 => 'nullable|integer',
            'district_id'                 => 'nullable|integer',
            'thana_id'                    => 'nullable|integer',
            'post_office_id'              => 'nullable|integer',
            'village_id'                  => 'nullable|integer',
            'ward_id'                     => 'nullable|integer',
            'road'                        => 'nullable|max:190',
            'house'                       => 'nullable|max:190',
            'house_bn'                    => 'nullable|max:190',
            'office_division_id'          => 'nullable|integer',
            'office_district_id'          => 'nullable|integer',
            'office_thana_id'             => 'nullable|integer',
            'office_post_office_id'       => 'nullable|integer',
            'office_village_id'           => 'nullable|integer',
            'office_ward_id'              => 'nullable|integer',
            'office_road'                 => 'nullable|max:190',
            'office_house'                => 'nullable|max:190',
            'office_house_bn'             => 'nullable|max:190',
            'no_of_dir'                   => 'nullable|integer',
            'premises_ownership'          => 'nullable|in:owned,rented',
            'document_files.*'            => 'nullable|image|max:2048',
            'hotel_logo'                  => 'nullable|image|max:2048',
            'status'                      => 'nullable|boolean',
        ]);

        // Return validation errors if validation fails
        if ($validate->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validate->errors(),
                'errors'  => $validate->errors(),
            ], 400);
        }

        // Handle hotel logo upload and delete old one if exists
        $logoName = null;
        if ($request->hasFile('hotel_logo')) {
            // Delete old logo if it exists
            if ($hotelRestaurant->hotel_logo && File::exists(public_path($hotelRestaurant->hotel_logo))) {
                File::delete(public_path($hotelRestaurant->hotel_logo));
            }

            // Upload new logo
            $logoName = $this->uploadFile(
                $request->hotel_logo,
                'uploads/hotel/logo/',
                'logo_'
            );
        }

        // Handle document files upload (delete old and upload new)
        $document_files = null;
        if ($request->hasFile('owned_document_file') || $request->hasFile('rented_document_file')) {
            // Delete old documents if they exist
            if ($hotelRestaurant->document_files) {
                $oldDocuments = json_decode($hotelRestaurant->document_files);
                if (!empty($oldDocuments)) {
                    foreach ($oldDocuments as $file) {
                        if (File::exists(public_path($file))) {
                            File::delete(public_path($file));
                        }
                    }
                }
            }

            // Upload new documents
            $files             = $request->file('owned_document_file') ?? $request->file('rented_document_file');
            $uploadedDocuments = [];

            foreach ($files as $file) {
                $filePath            = $this->uploadFile(
                    $file,
                    'uploads/hotel/documents/',
                    'rented_doc_'
                );
                $uploadedDocuments[] = $filePath;
            }

            if (!empty($uploadedDocuments)) {
                $document_files = json_encode($uploadedDocuments);
            }
        }

        // Prepare data for database update
        $payload = [
            // Basic information
            'name'                  => $request->name,
            'bn_name'               => $request->bn_name,
            'institute_id'          => Auth::user()->institute_id,

            // Category and type information
            'hotel_category_id'     => $request->organization_category_id,
            'hotel_subcategory_id'  => $request->organization_subcategory_id,
            'hotel_type_id'         => $request->organization_type_id,

            // Registration and ownership details
            'rjsc_reg_no'           => $request->rjsc_reg_no,
            'no_of_owner'           => $request->no_of_owner,
            'no_of_dir'             => $request->no_of_dir,
            'capital'               => $request->capital,
            'establish_year'        => $request->establish_year,
            'application_type'      => $request->application_type,
            'premises_ownership'    => $request->premises_ownership,

            // Primary address fields
            'division_id'           => $request->division_id,
            'district_id'           => $request->district_id,
            'thana_id'              => $request->thana_id,
            'post_office_id'        => $request->post_office_id,
            'village_id'            => $request->village_id,
            'ward_id'               => $request->ward_id,
            'road'                  => $request->road,
            'house'                 => $request->house,
            'house_bn'              => $request->house_bn,

            // Office address fields
            'office_division_id'    => $request->office_division_id,
            'office_district_id'    => $request->office_district_id,
            'office_thana_id'       => $request->office_thana_id,
            'office_post_office_id' => $request->office_post_office_id,
            'office_village_id'     => $request->office_village_id,
            'office_ward_id'        => $request->office_ward_id,
            'office_road'           => $request->office_road,
            'office_house'          => $request->office_house,
            'office_house_bn'       => $request->office_house_bn,

            // Files (only update if new files provided)
            'document_files'        => $document_files ?? $hotelRestaurant->document_files,
            'hotel_logo'            => $logoName ?? $hotelRestaurant->hotel_logo,
        ];

        // Update the hotel restaurant in database
        HotelRestaurant::where('id', $id)->update($payload);

        // Return success response
        return response()->json([
            'status'       => true,
            'message'      => 'Organization updated successfully!',
            'code'         => 200,
            'redirect_url' => route('hotel-restaurant.index'),
        ], 200);
    }

    /**
     * Delete a hotel restaurant from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the hotel restaurant by ID
        $hotelRestaurant = HotelRestaurant::find($id);

        // Return error if not found
        if (!$hotelRestaurant) {
            return response()->json([
                'status'  => false,
                'message' => 'Nothing found to delete',
            ], 404);
        }


        // Delete hotel logo if it exists
        $this->deleteFile($hotelRestaurant->hotel_logo);


        // Delete document files if they exist
        $this->deleteFiles(json_decode($hotelRestaurant->document_files, true) ?? []);

        // Delete the hotel restaurant
        $hotelRestaurant->delete();

        // Return success response
        return response()->json([
            'status'  => true,
            'message' => 'Organization deleted successfully',
        ], 200);
    }

    /**
     * Approve a hotel restaurant application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function approve(Request $request)
    {
        // Find and approve the hotel restaurant
        $organization         = HotelRestaurant::findOrFail($request->id);
        $organization->status = 1; // Mark as approved
        $organization->save();

        return response()->json([ 'success' => true ]);
    }
}