<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\HouseCategory;
use App\Models\BasicSettings\HouseOwnerType;
use App\Models\BasicSettings\HouseType;
use App\Models\BasicSettings\Village;
use App\Models\House;
use App\Models\Institute;
use App\Models\Mouza;
use App\Models\Union;
use App\Models\UnionWard;
use App\Models\VillageArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('unionAdmin')->except( 'options', 'index', 'show');
    }

    public function getHouseByArea($areaID)
    {
        $html = '<option value="">Select House</option>';
        $houses = House::where('village_area_id', $areaID)->get();
        if(count($houses)){
            foreach ($houses as $house) {
                $html .= '<option value="'.$house->id.'">'.$house->house.'</option>';
            }
        } else {
            $html .= '<option value="">No House Found</option>';
        }
        $html .= '';
        return $html;
    }

    public function options( Request $request, $id)
    {
        $html = '<option value="">Select '.($request->id ? ucfirst($request->id) : '').' House</option>';

        if($request->village){
            $houses = House::where('union_ward_id', $id)->where('village_id', $request->village)->get();

        } else {
            $houses = House::where('union_ward_id', $id)->where('institute_id', Auth::user()->institute_id ?? 1)->get();

        }


        if(count($houses)){
            foreach ($houses as $house) {
                $html .= '<option value="'.$house->id.'">'.$house->house.'</option>';
            }
        }

        $html .= '';

        return $html;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['houses'] = House::with('ownership')->where('institute_id', Auth::user()->institute_id)->get();
        return view('backend.pages.house.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institute = Institute::find(Auth::user()->institute_id);
        if($institute){
            $data['villages'] = Village::where('union_id', $institute->union_id)->latest()->get();
            $union = Union::find($institute->union_id);
            if($union) {
                $data['mouzas'] = Mouza::where('thana_id', $union->thana_id)->get();
            }

        }else {
            $data['villages'] = [];
            $data['mouzas'] = [];
        }
        $data['villageAreas'] = [];
        $data['union_wards'] = UnionWard::where('status', true)->orderBy('en_ward_no', 'asc')->get();
        $data['house_types'] = HouseType::where('status', true)->latest()->get();
        $data['house_owner_types'] = HouseOwnerType::where('status', true)->latest()->get();
        $data['house_categories'] = HouseCategory::where('status', true)->latest()->get();
        return view('backend.pages.house.create', $data);
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
            'house' => 'required|max:190',
            'house_bn' => 'required|max:190',
            'village_id' => 'nullable|max:190',
            'village_area_id' => 'nullable',
            'union_ward_id' => 'nullable|max:190',
            'house_type_id' => 'nullable|max:190',
            'house_category_id' => 'nullable|max:190',
            'house_owner_type_id' => 'nullable|max:190',
            'mouza_id' => 'nullable|max:190',
            'brs_khatian' => 'nullable|max:190',
            'brs_dag' => 'nullable|max:190',
            'land_quantity' => 'nullable|max:190',
            'house_price' => 'nullable|max:190',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {

            if ($request->id) {
                $house = House::where('id', $request->id)->update([
                    'house' => $request->house,
                    'house_bn' => $request->house_bn,
                    'village_id' => $request->village_id,
                    'village_area_id' => $request->village_area_id,
                    'union_ward_id' => $request->union_ward_id,
                    'house_type_id' => $request->house_type_id,
                    'house_category_id' => $request->house_category_id,
                    'house_owner_type_id' => $request->house_owner_type_id,
                    'mouza_id' => $request->mouza_id,
                    'brs_khatian' => $request->brs_khatian,
                    'brs_dag' => $request->brs_dag,
                    'land_quantity' => $request->land_quantity,
                    'house_price' => $request->house_price,
                ]);
            } else {
                $house = House::create([
                    'institute_id' => Auth::user()->institute_id,
                    'house' => $request->house,
                    'house_bn' => $request->house_bn,
                    'village_id' => $request->village_id,
                    'village_area_id' => $request->village_area_id,
                    'union_ward_id' => $request->union_ward_id,
                    'house_type_id' => $request->house_type_id,
                    'house_category_id' => $request->house_category_id,
                    'house_owner_type_id' => $request->house_owner_type_id,
                    'mouza_id' => $request->mouza_id,
                    'brs_khatian' => $request->brs_khatian,
                    'brs_dag' => $request->brs_dag,
                    'land_quantity' => $request->land_quantity,
                    'house_price' => $request->house_price,
                ]);
            }

           
            $data['status'] = true;
            $data['message'] = "House submitted successfully!";
            $data['result'] = $house;
            $data['code'] = 200;
            $data['redirect_url'] = route('house-ownership.edit', $request->id ?? $house->id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.house.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institute = Institute::find(Auth::user()->institute_id);
        if($institute){
            $data['villages'] = Village::where('union_id', $institute->union_id)->latest()->get();
            $union = Union::find($institute->union_id);
            if($union) {
                $data['mouzas'] = Mouza::where('thana_id', $union->thana_id)->get();
            }
        }else {
            $data['villages'] = [];
            $data['mouzas'] = [];
        }
        
        $data['union_wards'] = UnionWard::where('status', true)->orderBy('en_ward_no', 'asc')->get();
        $data['house_types'] = HouseType::where('status', true)->latest()->get();
        $data['house_owner_types'] = HouseOwnerType::where('status', true)->latest()->get();
        $data['house'] = $house = House::find($id);
        if($data['house']){
            $data['house_categories'] = HouseCategory::where('id', $data['house']->house_category_id)->latest()->get();
            $data['villageAreas'] = VillageArea::where('village_id', $house->village_id)->get();
            return view('backend.pages.house.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::find($id);
        if($house){

            try {
                $house->delete();
                $data['status'] = true;
                $data['message'] = "House Deleted Successfully";
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
}
