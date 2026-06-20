<?php

namespace App\Http\Controllers;

use App\Models\Pourashava;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PourashavaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('pourashavaByDistrict');
    }

    public function pourashavaByDistrict(Request $request, $id)
    {
        $Pourashavas = Pourashava::where('district_id', $id)->get();
        $html        = '<option value="0">Select Pourashava</option>';
        if (count($Pourashavas)) {
            foreach ($Pourashavas as $pourashava) {
                $html .= '<option value="' . $pourashava->id . '">' . $pourashava->name . '</option>';
            }
        }
        return $html;
    }

    public function index()
    {
        $data['pourashavas'] = Pourashava::with('district')->latest()->get();
        return view('backend.pages.basic.pourashava.index', $data);
    }

    public function create()
    {
        $data['districts'] = District::latest()->get();
        return view('backend.pages.basic.pourashava.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name'        => 'required|max:255',
                'bn_name'     => 'required|max:255',
                'category'    => 'required|in:A,B,C,D',
                'district_id' => 'required|exists:districts,id',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $pourashava              = new Pourashava();
            $pourashava->name        = $request->name;
            $pourashava->bn_name     = $request->bn_name;
            $pourashava->slug        = Str::slug($request->name);
            $pourashava->category    = $request->category;
            $pourashava->district_id = $request->district_id;
            $pourashava->status      = $request->status;
            
            $pourashava->save();

            $data['status']  = true;
            $data['message'] = "Pourashava Saved Successfully!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');

        } catch (\Throwable $th) {
            $data['status']  = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors']  = $th->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['pourashava'] = Pourashava::find($id);
        $data['districts']  = District::latest()->get();
        return view('backend.pages.basic.pourashava.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name'        => 'required|max:255',
                'bn_name'     => 'required|max:255',
                'category'    => 'required|in:A,B,C,D',
                'district_id' => 'required|exists:districts,id',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $pourashava = Pourashava::find($id);

            if ($pourashava) {
                $pourashava->name        = $request->name;
                $pourashava->bn_name     = $request->bn_name;
                $pourashava->slug        = Str::slug($request->name);
                $pourashava->category    = $request->category;
                $pourashava->district_id = $request->district_id;
                $pourashava->status      = $request->status;

                if ($pourashava->save()) {
                    $data['status']  = true;
                    $data['message'] = "Pourashava Updated Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Pourashava not found!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }

        } catch (\Throwable $th) {
            $data['status']  = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors']  = $th->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function destroy($id)
    {
        try {
            $pourashava = Pourashava::find($id);
            if ($pourashava) {
                if ($pourashava->delete()) {
                    $data['status']  = true;
                    $data['message'] = "Pourashava Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Pourashava not found!";
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

