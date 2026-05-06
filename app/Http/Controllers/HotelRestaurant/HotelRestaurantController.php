<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelRestaurant\HotelCategory;
use App\Models\BasicSettings\OrganizationOwnershipType;
use App\Models\BasicSettings\OrganizationWorkArea;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\Union;
use App\Models\PostOffice;
use App\Models\HotelRestaurant\HotelRestaurant;
use App\Models\HotelRestaurant\HotelOwnerShip;
use App\Models\Organization\OrganizationOwnership;
use App\Models\Road;
use App\Models\People\AddressInfo;
use App\Models\User;
use App\Models\UnionWard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class HotelRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['organizations'] = HotelRestaurant::with('category')->latest()->get();

        // dd($data);

        return view('backend.pages.hotel-restaurant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    private function generateApplicationId()
    {
        $datePart = Carbon::now()->format('ymd');

        // আজকের last record
        $last = HotelRestaurant::whereDate('created_at', Carbon::today())
            ->whereNotNull('application_id')
            ->orderBy('id', 'desc')
            ->first();

        if ($last) {
            $lastSerial = (int) substr($last->application_id, -5);
            $newSerial  = $lastSerial + 1;
        } else {
            $newSerial = 1;
        }

        return $datePart . str_pad($newSerial, 5, '0', STR_PAD_LEFT);
    }
    public function create()
    {
        $data['types']           = HotelOwnerShip::where('status', true)->latest()->get();
        $data['categories']      = HotelCategory::where('status', true)->latest()->get();
        $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
        $data['wards']           = UnionWard::where('status', true)->get();
        $data['roads']           = Road::where('institute_id', Auth::user()->institute_id)->get();
        $data['divisions']       = Division::where('status', true)->get();
        // dd($data['divisions']);

        $data['post_officeses'] = PostOffice::latest()->get();
        $institute              = Institute::find(Auth::user()->institute_id);
        if ($institute) {
            $data['villages'] = Village::where('union_id', $institute->union_id)->get();

        } else {
            $data['villages'] = [];
        }

        return view('backend.pages.hotel-restaurant.create', $data);
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
            'id'                             => 'nullable|integer',
            'name'                           => 'required|max:190',
            'bn_name'                        => 'nullable|max:190',
            'organization_category_id'       => 'nullable|integer',
            'organization_subcategory_id'    => 'nullable|integer',
            'organization_work_area_id'      => 'nullable|array',
            'organization_work_area_id.*'    => 'nullable|integer',
            'organization_type_id'           => 'nullable|integer',
            'organization_ownership_type_id' => 'nullable|integer',

            'rjsc_reg_no'                    => 'nullable|max:190',
            'no_of_owner'                    => 'nullable|integer',
            'capital'                        => 'nullable|numeric',
            'establish_year'                 => 'nullable|integer|min:1900|max:' . date('Y'),
            'application_type'               => 'nullable|in:new,old',
            'remarks'                        => 'nullable|max:500',

            // Address fields from blade
            'division_id'                    => 'nullable|integer',
            'district_id'                    => 'nullable|integer',
            'thana_id'                       => 'nullable|integer',
            'post_office_id'                 => 'nullable|integer',
            'union_id'                       => 'nullable|integer',
            'village_id'                     => 'nullable|integer',
            'ward_id'                        => 'nullable|integer',
            'road'                           => 'nullable|max:190',
            'house'                          => 'nullable|max:190',
            'house_bn'                       => 'nullable|max:190',
            'office_division_id'             => 'nullable|integer',
            'office_district_id'             => 'nullable|integer',
            'office_thana_id'                => 'nullable|integer',
            'office_post_office_id'          => 'nullable|integer',
            'office_village_id'              => 'nullable|integer',
            'office_ward_id'                 => 'nullable|integer',
            'office_road'                    => 'nullable|max:190',
            'office_house'                   => 'nullable|max:190',
            'office_house_bn'                => 'nullable|max:190',
            'no_of_dir'                      => 'nullable|integer',
            'premises_ownership'             => 'nullable|in:owned,rented',
            'document_files.*'               => 'nullable|image|max:2048',
            'status'                         => 'nullable|boolean',
        ]);

        if ($validate->fails()) {
            $data['status']  = false;
            $data['message'] = $validate->errors();
            $data['errors']  = $validate->errors();

            return response()->json($data, 400);
        }

        if ($request->hasFile('owned_document_file') || $request->hasFile('rented_document_file')) {
            $files = $request->file('owned_document_file') ?? $request->file('rented_document_file');

            foreach ($files as $file) {
                $ext      = $file->getClientOriginalExtension();
                $filename = 'rented_doc_' . time() . '_' . uniqid() . '.' . $ext;
                $file->move(public_path('uploads/rented_documents'), $filename);
                $rentedDocumentNames[] = 'uploads/rented_documents/' . $filename;
            }

            if (!empty($rentedDocumentNames)) {
                $document_files = json_encode($rentedDocumentNames);
            }

        }



        try {
            $payload = [
                'name'                        => $request->name,
                'bn_name'                     => $request->bn_name,

                'institute_id'                => Auth::user()->institute_id,

                'organization_category_id'    => $request->organization_category_id,
                'organization_subcategory_id' => $request->organization_subcategory_id,
                'organization_work_area_id'   => !empty($request->organization_work_area_id)
                    ? json_encode($request->organization_work_area_id)
                    : null,
                'organization_type_id'        => $request->organization_type_id,
                'rjsc_reg_no'                 => $request->rjsc_reg_no,
                'no_of_owner'                 => $request->no_of_owner,
                'no_of_dir'                   => $request->no_of_dir,

                // Address fields
                'division_id'                 => $request->division_id,
                'district_id'                 => $request->district_id,
                'thana_id'                    => $request->thana_id,
                'post_office_id'              => $request->post_office_id,
                'union_id'                    => $request->union_id,
                'village_id'                  => $request->village_id,
                'ward_id'                     => $request->ward_id,
                'road'                        => $request->road,
                'house'                       => $request->house,
                'house_bn'                    => $request->house_bn,
                'office_division_id'          => $request->office_division_id,
                'office_district_id'          => $request->office_district_id,
                'office_thana_id'             => $request->office_thana_id,
                'office_post_office_id'       => $request->office_post_office_id,
                'office_village_id'           => $request->office_village_id,
                'office_ward_id'              => $request->office_ward_id,
                'office_road'                 => $request->office_road,
                'office_house'                => $request->office_house,
                'office_house_bn'             => $request->office_house_bn,
                'premises_ownership'          => $request->premises_ownership,

                'capital'                     => $request->capital,
                'establish_year'              => $request->establish_year,
                'application_type'            => $request->application_type,
                'remarks'                     => $request->remarks,
                'document_files'              => $document_files ?? null,
                'status'                      => 0,
            ];


            $payload['institute_id'] = Auth::user()->institute_id;

            $payload['application_id'] = $this->generateApplicationId();
            $organization              = HotelRestaurant::create($payload);


            $data['status']       = true;
            $data['message']      = "Organization saved successfully!";
            $data['result']       = $organization;
            $data['code']         = 200;
            $data['redirect_url'] = route('hotel-restaurant.index');

            return response()->json($data, 200);

        } catch (\Throwable $th) {
            $data['status']  = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors']  = $th->getMessage();

            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}