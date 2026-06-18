<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\DataTables\MouzaDataTable;
use App\Models\Mouza;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MouzaController extends Controller
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
    public function index(MouzaDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.basic.mouza.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['districts'] = District::latest()->get();
        return view('backend.pages.basic.mouza.create', $data);
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
                'upazila_id'  => 'required|exists:upazilas,id',
                'record'      => 'required|in:CS,SA,RS,City/BRS',
                'code'        => 'nullable|max:255',
                'order'       => 'nullable|integer',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $mouza              = new Mouza();
            $mouza->name        = $request->name;
            $mouza->bn_name     = $request->bn_name;
            $mouza->district_id = $request->district_id;
            $mouza->upazila_id  = $request->upazila_id;
            $mouza->record      = $request->record;
            $mouza->code        = $request->code;
            $mouza->order       = $request->order ?? 0;
            $mouza->status      = $request->status;
            
            $mouza->save();

            $data['status']  = true;
            $data['message'] = "Mouza Saved Successfully!";
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
        $data['mouza'] = Mouza::with('district', 'upazila')->find($id);
        return view('backend.pages.basic.mouza.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['mouza']     = Mouza::find($id);
        $data['districts'] = District::latest()->get();
        if ($data['mouza']) {
            $data['upazilas'] = Upazila::where('district_id', $data['mouza']->district_id)->get();
        } else {
            $data['upazilas'] = [];
        }
        return view('backend.pages.basic.mouza.edit', $data);
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
                'upazila_id'  => 'required|exists:upazilas,id',
                'record'      => 'required|in:CS,SA,RS,City/BRS',
                'code'        => 'nullable|max:255',
                'order'       => 'nullable|integer',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $mouza = Mouza::find($id);

            if ($mouza) {
                $mouza->name        = $request->name;
                $mouza->bn_name     = $request->bn_name;
                $mouza->district_id = $request->district_id;
                $mouza->upazila_id  = $request->upazila_id;
                $mouza->record      = $request->record;
                $mouza->code        = $request->code;
                $mouza->order       = $request->order ?? 0;
                $mouza->status      = $request->status;

                if ($mouza->save()) {
                    $data['status']  = true;
                    $data['message'] = "Mouza Updated Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Mouza not found!";
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
            $mouza = Mouza::find($id);
            if ($mouza) {
                if ($mouza->delete()) {
                    $data['status']  = true;
                    $data['message'] = "Mouza Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Mouza not found!";
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
