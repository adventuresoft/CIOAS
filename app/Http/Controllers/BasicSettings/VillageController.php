<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\Institute;
use App\Models\Road;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except('villagesByUnion');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function villagesByUnion(Request $request, $union_id)
    {
        $villageOptions = '<option value=""> Select '.($request->id ? ucfirst($request->id) : '').' Village</option>';

        $villages = Village::where('union_id', $union_id)->get();

        if(count($villages)) {
            foreach ($villages as $village) {
               $villageOptions .='<option value="'.$village->id.'">'.$village->en_name.'</option>';
            }
        } 
        
        $roadOptions = '<option value="">Select Road</option>';
        $institute = Institute::where('union_id', $union_id)->first();
        if($institute) {
            $roads = Road::where('institute_id', $institute->id)->get();
            if(count($roads)){
                foreach($roads as $road){
                    $roadOptions .='<option value="'.$road->id.'">'.$road->name.'</option>';
                }
            }
        }

        $data['villageOptions'] = $villageOptions;
        $data['roadOptions'] = $roadOptions;
        return $data;
    }

    public function index()
    {
        $data['villages'] = Village::with('division', 'district', 'thana', 'union')->latest()->get();
        return view('backend.pages.basic.village.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['divisions'] = Division::latest()->get();
        $data['districts'] = District::latest()->get();
        $data['thanas'] = Thana::latest()->get();
        $data['unions'] = Union::latest()->get();


        return view('backend.pages.basic.village.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
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


                $village = new Village();
                $village->en_name = $request->en_name;
                $village->bn_name = $request->bn_name;

                $village->division_id = $request->division_id;
                $village->district_id = $request->district_id;
                $village->thana_id = $request->thana_id;
                $village->union_id = $request->union_id;

                $village->status = $request->status ? $request->status : true;
                $village->created_by = Auth::id();

                if ($village->save()) {
                    $data['status'] = true;
                    $data['message'] = "Village Saved Successfully!";
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
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.village.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['village'] = Village::find($id);
        $data['divisions'] = Division::latest()->get();
        $data['districts'] = District::latest()->get();
        $data['thanas'] = Thana::latest()->get();
        $data['unions'] = Union::latest()->get();
        return view('backend.pages.basic.village.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        try {
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


                $village =  Village::find($id);

                if ($village) {
                    $village->en_name = $request->en_name;
                    $village->bn_name = $request->bn_name;
    
                    $village->division_id = $request->division_id;
                    $village->district_id = $request->district_id;
                    $village->thana_id = $request->thana_id;
                    $village->union_id = $request->union_id;
    
                    $village->status = $request->status ? $request->status : true;
                    $village->updated_by = Auth::id();
    
                    if ($village->save()) {
                        $data['status'] = true;
                        $data['message'] = "Village Updated Successfully!";
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
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = Village::find($id);
            if($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Village Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            }else {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }
}
