<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\Union;
use App\Models\VillageArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VillageAreaController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin')->except('areasByVillage');
    }

    public function areasByVillage($id)
    {
        $html = '<option value="">Select Area</option>';
        $areas =  VillageArea::where('village_id', $id)->get();
        if(count($areas)) {
            foreach ($areas as $key => $area) {
                $html .='<option value="'.$area->id.'">'.$area->en_name.'</option>';
            }
        } else {
            $html .='<option value="">No Area Found!</option>';
        }

        return $html;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['areas'] = VillageArea::with('division', 'district', 'thana', 'union', 'village')->latest()->get();
        return view('backend.pages.basic.village.area.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['divisions'] = Division::latest()->get();
        return view('backend.pages.basic.village.area.create', $data);
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
                'en_name' => 'required',
                'bn_name' => 'required',
                'division_id' => 'required',
                'district_id' => 'required',
                'thana_id' => 'required',
                'union_id' => 'required',
                'village_id' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            try {

                $village = new VillageArea();
                $village->en_name = $request->en_name;
                $village->bn_name = $request->bn_name;

                $village->division_id = $request->division_id;
                $village->district_id = $request->district_id;
                $village->thana_id = $request->thana_id;
                $village->union_id = $request->union_id;
                $village->village_id = $request->village_id;
                $village->status = $request->status ? $request->status : true;
                $village->created_by = Auth::id();

                if ($village->save()) {
                    $data['status'] = true;
                    $data['message'] = "Village area saved successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }

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
     * @param  \App\Models\VillageArea  $villageArea
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VillageArea  $villageArea
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = VillageArea::find($id);
        if( $area ){
            $data['area'] =  $area ;
            $data['divisions'] = Division::latest()->get();
            $data['districts'] = District::where('division_id', $area->division_id)->latest()->get();
            $data['thanas'] = Thana::where('district_id', $area->district_id)->latest()->get();
            $data['unions'] = Union::where('thana_id', $area->thana_id)->latest()->get();
            $data['villages'] = Village::where('union_id', $area->union_id)->latest()->get();
            return view('backend.pages.basic.village.area.edit', $data);
        } else{
            return "Not found";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VillageArea  $villageArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
            $validate = Validator::make($request->all(), [
                'en_name' => 'required',
                'bn_name' => 'required',
                'division_id' => 'required',
                'district_id' => 'required',
                'thana_id' => 'required',
                'union_id' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            try {
                $village =  VillageArea::find($id);
                if ($village) {
                    $village->en_name = $request->en_name;
                    $village->bn_name = $request->bn_name;
    
                    $village->division_id = $request->division_id;
                    $village->district_id = $request->district_id;
                    $village->thana_id = $request->thana_id;
                    $village->union_id = $request->union_id;
                    $village->village_id = $request->village_id;

                    $village->status = $request->status ? $request->status : true;
                    $village->updated_by = Auth::id();
    
                    if ($village->save()) {
                        $data['status'] = true;
                        $data['message'] = "Village area updated successfully!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Failed to save data!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Noting to save!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VillageArea  $villageArea
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $query = VillageArea::find($id);
            if($query) {
                try {
                    if ($query->delete()) {
                        $data['status'] = true;
                        $data['message'] = "Village deleted successfully";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Something went wrong! Please try again...";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                    }
                } catch (\Throwable $th) {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    $data['errors'] = $th;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            }else {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
    }
}
