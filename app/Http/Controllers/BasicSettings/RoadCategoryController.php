<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\RoadCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoadCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = RoadCategory::latest()->get();
        return view('backend.pages.basic.road.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.basic.road.category.create');
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
                'en_name' => 'required|unique:road_categories,en_name',
                'bn_name' => 'required|unique:road_categories,bn_name',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = new RoadCategory();
                $query->en_name = $request->en_name;
                $query->bn_name = $request->bn_name;
                $query->slug = Str::slug($request->en_name, '-');
                $query->status = $request->status ? $request->status : true;
                $query->created_by = Auth::id();

                if ($query->save()) {
                    $data['status'] = true;
                    $data['message'] = "Road Category Saved Successfully!";
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
     * @param  \App\Models\RoadCategory  $roadCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.road.category.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoadCategory  $roadCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = RoadCategory::find($id);
        return view('backend.pages.basic.road.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoadCategory  $roadCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'en_name' => 'required|unique:road_categories,en_name,'. $id,
                'bn_name' => 'required|unique:road_categories,bn_name,'. $id,
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = RoadCategory::find($id);

                if ($query) {
                    $query->en_name = $request->en_name;
                    $query->bn_name = $request->bn_name;
                    $query->slug = Str::slug($request->en_name, '-');
                    $query->status = $request->status ? $request->status : true;
                    $query->created_by = Auth::id();

                    if ($query->save()) {
                        $data['status'] = true;
                        $data['message'] = "Road Category Updated Successfully!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Failed to save data!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Not found!";
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
     * @param  \App\Models\RoadCategory  $roadCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = RoadCategory::find($id);
            if($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Road Category Deleted successfully";
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
