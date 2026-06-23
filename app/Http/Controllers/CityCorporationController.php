<?php

namespace App\Http\Controllers;

use App\Models\CityCorporation;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CityCorporationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('cityByDistrict');
    }

    public function cityByDistrict(Request $request, $id)
    {
        $city_ids = CityCorporation::where('district_id', $id)->get();
        $html = '<option value="0">Select City Corporation</option>';
        if (count($city_ids)) {
            foreach ($city_ids as $city) {
                $html .= '<option value="' . $city->id . '">' . $city->bn_name . '</option>';
            }
        }
        return $html;
    }

    public function index()
    {
        $data['city_corporations'] = CityCorporation::with('district')->latest()->get();
        return view('backend.pages.basic.city_corporation.index', $data);
    }

    public function create()
    {
        $data['districts'] = District::latest()->get();
        return view('backend.pages.basic.city_corporation.create', $data);
    }

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

            $city              = new CityCorporation();
            $city->name        = $request->name;
            $city->bn_name     = $request->bn_name;
            $city->slug        = Str::slug($request->name);
            $city->district_id = $request->district_id;
            $city->status      = $request->status;
            
            $city->save();

            $data['status']  = true;
            $data['message'] = "City Corporation Saved Successfully!";
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
        $data['city_corporation'] = CityCorporation::find($id);
        $data['districts'] = District::latest()->get();
        return view('backend.pages.basic.city_corporation.edit', $data);
    }

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

            $city = CityCorporation::find($id);

            if ($city) {
                $city->name        = $request->name;
                $city->bn_name     = $request->bn_name;
                $city->slug        = Str::slug($request->name);
                $city->district_id = $request->district_id;
                $city->status      = $request->status;

                if ($city->save()) {
                    $data['status']  = true;
                    $data['message'] = "City Corporation Updated Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "City Corporation not found!";
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
            $city = CityCorporation::find($id);
            if ($city) {
                if ($city->delete()) {
                    $data['status']  = true;
                    $data['message'] = "City Corporation Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "City Corporation not found!";
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