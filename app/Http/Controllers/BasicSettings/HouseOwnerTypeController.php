<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\HouseOwnerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HouseOwnerTypeController extends Controller
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
        $data['types'] = HouseOwnerType::latest()->get();
        return view('backend.pages.basic.house.ownership_type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.basic.house.ownership_type.create');
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
            'en_name' => 'required|unique:house_owner_types,en_name',
            'bn_name' => 'required|unique:house_owner_types,bn_name',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $query = new HouseOwnerType();
        $query->en_name = $request->en_name;
        $query->bn_name = $request->bn_name;
        $query->slug = Str::slug($request->en_name, '-');
        $query->status = $request->status ? $request->status : true;
        $query->created_by = Auth::id();
        try {
            $query->save();
            $data['status'] = true;
            $data['message'] = "House Ownership Type Saved Successfully!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
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
     * @param  \App\Models\BasicSettings\HouseOwnerType  $houseOwnerType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.house.ownership_type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BasicSettings\HouseOwnerType  $houseOwnerType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['type'] = HouseOwnerType::find($id);
        return view('backend.pages.basic.house.ownership_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BasicSettings\HouseOwnerType  $houseOwnerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            'en_name' => 'required|unique:house_owner_types,en_name,' . $id,
            'bn_name' => 'required|unique:house_owner_types,bn_name,' . $id,
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $query = HouseOwnerType::find($id);
        if ($query) {
            $query->en_name = $request->en_name;
            $query->bn_name = $request->bn_name;
            $query->slug = Str::slug($request->en_name, '-');
            $query->status = $request->status ? $request->status : true;
            $query->created_by = Auth::id();

            try {
                $query->save();
                $data['status'] = true;
                $data['message'] = "House Ownership Type Updated Successfully!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } else {
            $data['status'] = false;
            $data['message'] = "Not found!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BasicSettings\HouseOwnerType  $houseOwnerType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $query = HouseOwnerType::find($id);
        if ($query) {

            try {
                $query->delete();
                $data['status'] = true;
                $data['message'] = "House Ownership Type Deleted successfully";
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } else {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
        }
    }
}
