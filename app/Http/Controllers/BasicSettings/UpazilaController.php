<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\Upazila;
use App\Models\District;
use App\Models\LandRecord;
use App\DataTables\UpazilaDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpazilaController extends Controller
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
    public function index(UpazilaDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.basic.upazila.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['districts'] = District::latest()->get();
        $data['land_records'] = LandRecord::all();
        return view('backend.pages.basic.upazila.create', $data);
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
                'name'        => 'required|max:255',
                'bn_name'     => 'required|max:255',
                'district_id' => 'required|exists:districts,id',
                'code'        => 'nullable|max:255',
                'record'      => 'nullable|exists:land_records,id',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $upazila              = new Upazila();
            $upazila->name        = $request->name;
            $upazila->bn_name     = $request->bn_name;
            $upazila->district_id = $request->district_id;
            $upazila->code        = $request->code;
            $upazila->record      = $request->record;
            $upazila->status      = $request->status;
            
            $upazila->save();

            $data['status']  = true;
            $data['message'] = "Upazila/Circle Saved Successfully!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');

        } catch (\Throwable $th) {
            $data['status']  = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors']  = $th->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
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
        $data['upazila'] = Upazila::with('district')->find($id);
        return view('backend.pages.basic.upazila.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['upazila']   = Upazila::find($id);
        $data['districts'] = District::latest()->get();
        $data['land_records'] = LandRecord::all();
        return view('backend.pages.basic.upazila.edit', $data);
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
        try {
            $validate = Validator::make($request->all(), [
                'name'        => 'required|max:255',
                'bn_name'     => 'required|max:255',
                'district_id' => 'required|exists:districts,id',
                'code'        => 'nullable|max:255',
                'record'      => 'nullable|exists:land_records,id',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $upazila = Upazila::find($id);

            if ($upazila) {
                $upazila->name        = $request->name;
                $upazila->bn_name     = $request->bn_name;
                $upazila->district_id = $request->district_id;
                $upazila->code        = $request->code;
                $upazila->record      = $request->record;
                $upazila->status      = $request->status;

                if ($upazila->save()) {
                    $data['status']  = true;
                    $data['message'] = "Upazila/Circle Updated Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Upazila/Circle not found!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }

        } catch (\Throwable $th) {
            $data['status']  = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors']  = $th->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $upazila = Upazila::find($id);
            if ($upazila) {
                if ($upazila->delete()) {
                    $data['status']  = true;
                    $data['message'] = "Upazila/Circle Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Upazila/Circle not found!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status']  = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors']  = $th->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }
}
