<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\DataTables\ThanaDataTable;
use App\Models\Thana;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ThanaController extends Controller
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
    public function index(ThanaDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.basic.thana.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['districts'] = District::latest()->get();
        return view('backend.pages.basic.thana.create', $data);
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
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $thana              = new Thana();
            $thana->name        = $request->name;
            $thana->bn_name     = $request->bn_name;
            $thana->district_id = $request->district_id;
            $thana->status      = $request->status;
            
            $thana->save();

            $data['status']  = true;
            $data['message'] = "Thana Saved Successfully!";
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
        $data['thana'] = Thana::with('district')->find($id);
        return view('backend.pages.basic.thana.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['thana']     = Thana::find($id);
        $data['districts'] = District::latest()->get();
        return view('backend.pages.basic.thana.edit', $data);
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
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $thana = Thana::find($id);

            if ($thana) {
                $thana->name        = $request->name;
                $thana->bn_name     = $request->bn_name;
                $thana->district_id = $request->district_id;
                $thana->status      = $request->status;

                if ($thana->save()) {
                    $data['status']  = true;
                    $data['message'] = "Thana Updated Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Thana not found!";
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
            $thana = Thana::find($id);
            if ($thana) {
                if ($thana->delete()) {
                    $data['status']  = true;
                    $data['message'] = "Thana Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Thana not found!";
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
