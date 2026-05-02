<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\RoadCategory;
use App\Models\BasicSettings\RoadType;
use App\Models\Road;
use App\Models\RoadOwner;
use App\Models\UnionWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roads'] = Road::latest()->get();
        return view('backend.pages.road.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['road_categories'] = RoadCategory::latest()->get();
        $data['road_types'] = RoadType::latest()->get();
        $data['road_owners'] = RoadOwner::latest()->get();
        $data['union_wards'] = UnionWard::latest()->get();
        // return response()->json($data, 200);
        return view('backend.pages.road.create', $data);
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
                'name' => 'required',
                'bn_name' => 'required',
                'distance' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'road_type' => 'nullable',
                'road_category' => 'nullable',
                'road_owner' => 'nullable',
                'start_point' => 'nullable',
                'end_point' => 'nullable',
                'make_year' => 'nullable',
                'make_contactor' => 'nullable',
                'make_value' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'current_condition' => 'nullable',
            ]);
            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            try {
                $road = new Road();
                $road->name = $request->name;
                $road->bn_name = $request->bn_name;
                $road->institute_id = Auth::user()->institute_id ?? NULL;
                $road->distance = $request->distance;
                $road->road_type_id = $request->road_type;
                $road->road_category_id = $request->road_category;
                $road->road_owner_id = $request->road_owner;
                $road->start_point = $request->start_point;
                $road->end_point = $request->end_point;
                $road->make_year = $request->make_year;
                $road->make_contactor = $request->make_contactor;
                $road->make_value = $request->make_value;
                $road->current_condition = $request->current_condition;

                if ($road->save()) {
                    $data['status'] = true;
                    $data['message'] = "Road Saved Successfully!";
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
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.road.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['road'] = Road::find($id);
        $data['road_categories'] = RoadCategory::latest()->get();
        $data['road_types'] = RoadType::latest()->get();
        $data['road_owners'] = RoadOwner::latest()->get();
        $data['union_wards'] = UnionWard::latest()->get();
        return view('backend.pages.road.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'bn_name' => 'required',
                'distance' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'road_type' => 'nullable',
                'road_category' => 'nullable',
                'road_owner' => 'nullable',
                'start_point' => 'nullable',
                'end_point' => 'nullable',
                'make_year' => 'nullable',
                'make_contactor' => 'nullable',
                'make_value' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'current_condition' => 'nullable',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            try {
                $road =  Road::find($id);
                $road->name = $request->name;
                $road->bn_name = $request->bn_name;
                $road->institute_id = Auth::user()->institute_id ?? NULL;
                $road->distance = $request->distance;
                $road->road_type_id = $request->road_type;
                $road->road_category_id = $request->road_category;
                $road->road_owner_id = $request->road_owner;
                $road->start_point = $request->start_point;
                $road->end_point = $request->end_point;
                $road->make_year = $request->make_year;
                $road->make_contactor = $request->make_contactor;
                $road->make_value = $request->make_value;
                $road->current_condition = $request->current_condition;

                if ($road->save()) {
                    $data['status'] = true;
                    $data['message'] = "Road Updated Successfully!";
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Road  $road
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = Road::find($id);
            if($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Road  Deleted successfully";
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
