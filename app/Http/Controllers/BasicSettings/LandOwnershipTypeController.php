<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\LandOwnershipType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LandOwnershipTypeController extends Controller
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
        $data['types'] = LandOwnershipType::latest()->get();
        return view('backend.pages.basic.land.ownership.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.basic.land.ownership.create');
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
                'en_name' => 'required|unique:land_ownership_types,en_name',
                'bn_name' => 'required|unique:land_ownership_types,bn_name',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = new LandOwnershipType();
                $query->en_name = $request->en_name;
                $query->bn_name = $request->bn_name;
                $query->slug = Str::slug($request->en_name, '-');
                $query->status = $request->status ? $request->status : true;
                $query->created_by = Auth::id();

                if ($query->save()) {
                    $data['status'] = true;
                    $data['message'] = "Land Ownership Type Saved Successfully!";
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
     * @param  \App\Models\LandOwnershipType  $landOwnershipType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.land.ownership.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandOwnershipType  $landOwnershipType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['type'] = LandOwnershipType::find($id);
        return view('backend.pages.basic.land.ownership.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LandOwnershipType  $landOwnershipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'en_name' => 'required|unique:land_ownership_types,en_name,'. $id,
                'bn_name' => 'required|unique:land_ownership_types,bn_name,'. $id,
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = LandOwnershipType::find($id);

                if ($query) {
                    $query->en_name = $request->en_name;
                    $query->bn_name = $request->bn_name;
                    $query->slug = Str::slug($request->en_name, '-');
                    $query->status = $request->status ? $request->status : true;
                    $query->created_by = Auth::id();

                    if ($query->save()) {
                        $data['status'] = true;
                        $data['message'] = "Land Ownership Type Updated Successfully!";
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
     * @param  \App\Models\LandOwnershipType  $landOwnershipType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query =  LandOwnershipType::find($id);
            if ($query) {
 
                 if ($query->delete()) {
                     $data['status'] = true;
                     $data['message'] = "Land Type Deleted Successfully!";
                     return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                 } else {
                     $data['status'] = false;
                     $data['message'] = "Failed to delete type! Please try again...";
                     return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                 }
             
            } else {
             $data['status'] = false;
             $data['message'] = "Failed to delete type! Please try again...";
             return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
         } catch (\Throwable $th) {
             $data['status'] = false;
             $data['message'] = "Something went wrong! Please try again...";
             $data['errors'] = $th;
             return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
         }
    }
}
