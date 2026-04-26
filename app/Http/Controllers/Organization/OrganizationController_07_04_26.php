<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationOwnershipType;
use App\Models\BasicSettings\OrganizationWorkArea;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\District;
use App\Models\Division;
use App\Models\PostOffice;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationType;
use App\Models\Organization\OrganizationOwnership;
use App\Models\Road;
use App\Models\People\AddressInfo;
use App\Models\User;
use App\Models\UnionWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{

    // public function getOrganizationBySystemId($system_id)
    // {
    //     $organization = Organization::with('house', 'road', 'villageArea', 'village')->where('system_id', $system_id)->first();
    //     $onersip=OrganizationOwnership::where('organization_id',$organization->id)->pluck('user_id');
    //     if($organization){
    //         $data['status'] = true;
    //         $data['message'] = "Loaded organization information!";
    //         $data['organization'] = $organization;
    //         $data['organization_name'] = $organization->name;

    //         $address = "";
    //         $address .= "House# ".($organization->house->house ?? '--'). ", ";
    //         $address .= "Road# ".($organization->road->name ?? '--'). ", ";
    //         $address .= "Area# ".($organization->villageArea->en_name ?? '--'). ", ";
    //         $address .= "Village# ".($organization->village->en_name ?? '-- ');

    //         $data['organization_address'] = $address;
    //         return response()->json($data, 200);

    //     } else{
    //         $data['status'] = false;
    //         $data['message'] = "No data found!";
    //         return response()->json($data, 404);
    //     }
    // }


public function getOrganizationBySystemId($system_id)
{
    $organization = Organization::with('house', 'road', 'villageArea', 'village')
        ->where('system_id', $system_id)
        ->first();

    if ($organization) {

        $ownershipUserIds = OrganizationOwnership::where('organization_id', $organization->id)
            ->pluck('user_id')
            ->toArray();

        $users = User::whereIn('id', $ownershipUserIds)->get();
        
         $addressInfos = AddressInfo::whereIn('user_id', $ownershipUserIds)->get();

        $names = $users->pluck('name')->filter()->implode(', ');
        $mobiles = $users->pluck('mobile')->filter()->implode(', ');
        $emails = $users->pluck('email')->filter()->implode(', ');
        $nids = $users->pluck('nid')->filter()->implode(', ');

        $pics = $users->pluck('image')
            ->filter()
            ->map(function ($image) {
                return asset( $image);
            })
            ->implode(', ');


  $currentAddresses = $addressInfos->map(function ($address) {
            $parts = [];

            if (!empty($address->present_house)) {
                $parts[] = 'House# ' . $address->present_house;
            }

            if (!empty($address->present_road)) {
                $parts[] = 'Road# ' . $address->present_road;
            }

            if (!empty($address->present_area)) {
                $parts[] = 'Area# ' . $address->present_area;
            }

            if (!empty($address->present_address)) {
                $parts[] = $address->present_address;
            }

            return implode(', ', $parts);
        })->filter()->implode(', ');

        $permanentAddresses = $addressInfos->map(function ($address) {
            $parts = [];

            if (!empty($address->permanent_house)) {
                $parts[] = 'House# ' . $address->permanent_house;
            }

            if (!empty($address->permanent_road)) {
                $parts[] = 'Road# ' . $address->permanent_road;
            }

            if (!empty($address->permanent_area)) {
                $parts[] = 'Area# ' . $address->permanent_area;
            }

            return implode(', ', $parts);
        })->filter()->implode(', ');
        
        $address = "";
        $address .= "House# " . ($organization->house->house ?? '--') . ", ";
        $address .= "Road# " . ($organization->road->name ?? '--') . ", ";
        $address .= "Area# " . ($organization->villageArea->en_name ?? '--') . ", ";
        $address .= "Village# " . ($organization->village->en_name ?? '--');

        $data['status'] = true;
        $data['message'] = "Loaded organization information!";
        $data['organization'] = $organization;
        $data['organization_name'] = $organization->name;
        $data['organization_address'] = $address;
        
        
        

        $data['name'] = $names ?: '--';
        $data['current_address'] = $currentAddresses ?: '--';
        $data['permanent_address'] = $permanentAddresses ?: '--';
        $data['pic'] = $pics ?: '';
        $data['nid'] = $nids ?: '--';
        $data['father_name'] = '--';
        $data['mother_name'] = '--';
        $data['mobile'] = $mobiles ?: '--';
        $data['email'] = $emails ?: '--';

        return response()->json($data, 200);

    } else {
        $data['status'] = false;
        $data['message'] = "No data found!";
        return response()->json($data, 404);
    }
}
    
    public function index()
    {
        $data['organizations'] = Organization::with('category')->latest()->get();
        return view('backend.pages.organization.index', $data);
    }

    
    public function create()
    {
        $data['types'] = OrganizationType::where('status', true)->latest()->get();
        $data['categories'] = OrganizationCategory::where('status', true)->latest()->get();
        $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
        $data['wards'] = UnionWard::where('status', true)->get();
        $data['roads'] = Road::where('institute_id', Auth::user()->institute_id)->get();
        $data['divisions'] = Division::where('status', true)->get();
        // dd($data['divisions']);  
       $data['post_officeses']=PostOffice::latest()->get();
        $institute = Institute::find(Auth::user()->institute_id);
        if($institute )
        {
            $data['villages'] = Village::where('union_id', $institute->union_id )->get();

        }else {
            $data['villages'] = [];
        }

        return view('backend.pages.organization.create', $data);
    }

    // public function store(Request $request)
    // {

    //     $validate = Validator::make($request->all(), [
    //         'name' => 'required|max:190',
    //         'bn_name' => 'nullable|max:190',
    //         'organization_category_id' => 'nullable|max:190',
    //         'organization_subcategory_id' => 'nullable|max:190',
    //         'organization_work_area_id' => 'nullable',
    //         'organization_type_id' => 'nullable|max:190',
    //         'organization_ownership_type_id' => 'nullable|max:190',
    //         'road_id' => 'nullable|max:190',
    //         'union_ward_id' => 'nullable|max:190',
    //         'house_id' => 'nullable|max:190',
    //         'capital' => 'nullable|max:190',
    //         'rjsc_reg_no' => 'nullable|max:190',
    //         'application_type' => 'nullable|max:190',
    //         'remarks' => 'nullable|max:190',
    //         'no_of_owner' => 'integer|nullable',
    //         'establish_year' => 'nullable',
    //         'status' => 'nullable|boolean'
    //     ]);

    //     if ($validate->fails()) {
    //         $data['status'] = false;
    //         $data['message'] = "Sorry! Invalid Entry.";
    //         $data['errors'] = $validate->errors();
    //         return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
    //     }

    //     try {

    //         if ($request->id) {
    //             $organization = Organization::where('id', $request->id)->update([
    //                 'name' => $request->name,
    //                 'bn_name' => $request->bn_name,
    //                 'organization_category_id' => $request->organization_category_id,
    //                 'organization_subcategory_id' => $request->organization_subcategory_id,
    //                 'organization_work_area_id' => json_encode($request->organization_work_area_id),
    //                 'organization_type_id' => $request->organization_type_id,
    //                 'rjsc_reg_no' => $request->rjsc_reg_no,

    //                 'organization_ownership_type_id' => $request->organization_ownership_type_id,
    //                 'no_of_owner' =>  $request->no_of_owner,

    //                 'village_id' => $request->village_id,
    //                 'union_ward_id' => $request->union_ward_id,
    //                 'village_area_id' => $request->village_area_id,
    //                 'road_id' => $request->road_id,
    //                 'house_id' => $request->house_id,

    //                 'capital' => $request->capital,
    //                 'establish_year' => $request->establish_year,
    //                 'application_type' => $request->application_type,
    //                 'remarks' => $request->remarks,
    //             ]);
    //         } else {
    //             $organization = Organization::create([
    //                 'institute_id' => Auth::user()->institute_id,
    //                 'name' => $request->name,
    //                 'bn_name' => $request->bn_name,
    //                 'organization_category_id' => $request->organization_category_id,
    //                 'organization_subcategory_id' => $request->organization_subcategory_id,
    //                 'organization_work_area_id' => json_encode($request->organization_work_area_id),
    //                 'organization_type_id' => $request->organization_type_id,
    //                 'rjsc_reg_no' => $request->rjsc_reg_no,

    //                 'organization_ownership_type_id' => $request->organization_ownership_type_id,
    //                 'no_of_owner' =>  $request->no_of_owner,

    //                 'village_id' => $request->village_id,
    //                 'union_ward_id' => $request->union_ward_id,
    //                 'village_area_id' => $request->village_area_id,
    //                 'road_id' => $request->road_id,
    //                 'house_id' => $request->house_id,

    //                 'capital' => $request->capital,
    //                 'establish_year' => $request->establish_year,
    //                 'application_type' => $request->application_type,
    //                 'remarks' => $request->remarks,
    //             ]);
    //         }

           
    //         $data['status'] = true;
    //         $data['message'] = "Organization saved successfully!";
    //         $data['result'] = $organization;
    //         $data['code'] = 200;
    //         $data['redirect_url'] = route('organization-ownership.edit', $request->id ?? $organization->id);
    //         return response()->json($data, 200);
    //     } catch (\Throwable $th) {
    //         $data['status'] = false;
    //         $data['message'] = "Something went wrong! Please try again...";
    //         $data['errors'] = $th;
    //         return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
    //     }
    // }
    
    public function store(Request $request)
{
    $validate = Validator::make($request->all(), [
        'id' => 'nullable|integer',

        'name' => 'required|max:190',
        'bn_name' => 'nullable|max:190',

        'organization_category_id' => 'nullable|integer',
        'organization_subcategory_id' => 'nullable|integer',
        'organization_work_area_id' => 'nullable|array',
        'organization_work_area_id.*' => 'nullable|integer',
        'organization_type_id' => 'nullable|integer',
        'organization_ownership_type_id' => 'nullable|integer',

        'rjsc_reg_no' => 'nullable|max:190',
        'no_of_owner' => 'nullable|integer',
        'capital' => 'nullable|numeric',
        'establish_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        'application_type' => 'nullable|in:new,old',
        'remarks' => 'nullable|max:500',

        // Address fields from blade
        'division_id' => 'nullable|integer',
        'district_id' => 'nullable|integer',
        'thana_id' => 'nullable|integer',
        'post_office_id' => 'nullable|integer',
        'union_id' => 'nullable|integer',
        'village_id' => 'nullable|integer',
        'ward_id' => 'nullable|integer',
        'road' => 'nullable|max:190',
        'house' => 'nullable|max:190',
        'house_bn' => 'nullable|max:190',

        'status' => 'nullable|boolean',
    ]);

    if ($validate->fails()) {
        $data['status'] = false;
        $data['message'] = "Sorry! Invalid Entry.";
        $data['errors'] = $validate->errors();

        return response()->json($data, 400);
    }

    try {
        $payload = [
            'name' => $request->name,
            'bn_name' => $request->bn_name,

            'organization_category_id' => $request->organization_category_id,
            'organization_subcategory_id' => $request->organization_subcategory_id,
            'organization_work_area_id' => !empty($request->organization_work_area_id)
                ? json_encode($request->organization_work_area_id)
                : null,
            'organization_type_id' => $request->organization_type_id,
            'organization_ownership_type_id' => $request->organization_ownership_type_id,

            'rjsc_reg_no' => $request->rjsc_reg_no,
            'no_of_owner' => $request->no_of_owner,

            // Address fields
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'thana_id' => $request->thana_id,
            'post_office_id' => $request->post_office_id,
            'union_id' => $request->union_id,
            'village_id' => $request->village_id,
            'ward_id' => $request->ward_id,
            'road' => $request->road,
            'house' => $request->house,
            'house_bn' => $request->house_bn,

            'capital' => $request->capital,
            'establish_year' => $request->establish_year,
            'application_type' => $request->application_type,
            'remarks' => $request->remarks,
            // 'status' => $request->has('status') ? $request->status : 1,
            'status' =>0,
        ];

        if ($request->id) {
            $organization = Organization::findOrFail($request->id);
            $organization->update($payload);
        } else {
            
            $payload['institute_id'] = Auth::user()->institute_id;
            $organization = Organization::create($payload);
        }

        $data['status'] = true;
        $data['message'] = "Organization saved successfully!";
        $data['result'] = $organization;
        $data['code'] = 200;
        $data['redirect_url'] = route('organization-ownership.edit', $organization->id);

        return response()->json($data, 200);

    } catch (\Throwable $th) {
        $data['status'] = false;
        $data['message'] = "Something went wrong! Please try again...";
        $data['errors'] = $th->getMessage();

        return response()->json($data, 500);
    }
}

    public function show($id)
    {
         $data['organization'] = Organization::find($id);
        if($data['organization'] ){
            $data['areas'] = OrganizationWorkArea::where('organization_subcategory_id', $data['organization']->organization_subcategory_id)->where('status', true)->latest()->get();
            $data['types'] = OrganizationType::where('organization_category_id', $data['organization']->organization_category_id)->where('status', true)->latest()->get();
            $data['categories'] = OrganizationCategory::where('status', true)->latest()->get();
            $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
            $data['wards'] = UnionWard::where('status', true)->get();
            $data['roads'] = Road::where('institute_id', Auth::user()->institute_id)->get();
            // return response()->json($data, 200);
             $data['divisions'] = Division::where('status', true)->get();
       $data['post_officeses']=PostOffice::latest()->get();

            $institute = Institute::find(Auth::user()->institute_id);
            if($institute)
            {
                $data['villages'] = Village::where('union_id', $institute->union_id )->get();
            }else {
                $data['villages'] = [];
            }

            return view('backend.pages.organization.show', $data);
        } else {
            return "Not found";
        }
    }

    public function edit($id)
    {
        $data['organization'] = Organization::find($id);
        if($data['organization'] ){
            $data['areas'] = OrganizationWorkArea::where('organization_subcategory_id', $data['organization']->organization_subcategory_id)->where('status', true)->latest()->get();
            $data['types'] = OrganizationType::where('organization_category_id', $data['organization']->organization_category_id)->where('status', true)->latest()->get();
            $data['categories'] = OrganizationCategory::where('status', true)->latest()->get();
            $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
            $data['wards'] = UnionWard::where('status', true)->get();
            $data['roads'] = Road::where('institute_id', Auth::user()->institute_id)->get();
            // return response()->json($data, 200);
             $data['divisions'] = Division::where('status', true)->get();
        // dd($data['divisions']);  
       $data['post_officeses']=PostOffice::latest()->get();

            $institute = Institute::find(Auth::user()->institute_id);
            if($institute)
            {
                $data['villages'] = Village::where('union_id', $institute->union_id )->get();
            }else {
                $data['villages'] = [];
            }

            return view('backend.pages.organization.edit', $data);
        } else {
            return "Not found";
        }
       
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $house = Organization::find($id);
        if($house){

            try {
                $house->delete();
                $data['status'] = true;
                $data['message'] = "Organization Deleted Successfully";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Failed to delete";
                $data['errors'] = $th;
                return response()->json($data, 500);
            }

        } else {
            $data['status'] = false;
            $data['message'] = "Noting found to delete";
            return response()->json($data, 404);
        }
    }
    
    public function approve(Request $request)
    {
        $organization = Organization::findOrFail($request->id);
    
        $organization->status = 1; // approved
        $organization->save();
    
        return response()->json(['success' => true]);
    }

}
