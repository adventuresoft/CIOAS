<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vehicles'] = Vehicle::latest()->get();
        return view('backend.pages.vehicle.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.vehicle.create');
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
            'vehicle_type' => 'required|max:191',
            'vehicle_category' => 'required|max:191',
            'vehicle_model' => 'required|max:191',
            'make_year' => 'required|integer|min:1900|max:2099',
            'make_company' => 'required|max:191',
            'ownership_type' => 'required|in:personal,institutional',
            'owner_id' => 'nullable|max:191',
            'owner_name' => 'nullable|max:191',
            'price' => 'nullable|numeric|min:0',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $payload = [
                'vehicle_type' => $request->vehicle_type,
                'vehicle_category' => $request->vehicle_category,
                'vehicle_model' => $request->vehicle_model,
                'make_year' => $request->make_year,
                'make_company' => $request->make_company,
                'ownership_type' => $request->ownership_type,
                'owner_id' => $request->owner_id,
                'owner_name' => $request->owner_name,
                'price' => $request->price,
            ];

            $vehicle = new Vehicle();
            $columns = Schema::getColumnListing($vehicle->getTable());

            foreach ($payload as $key => $value) {
                if (in_array($key, $columns, true)) {
                    $vehicle->{$key} = $value;
                }
            }

            if ($vehicle->save()) {
                $data['status'] = true;
                $data['message'] = "Vehicle Saved Successfully!";
                $data['redirect_url'] = route('vehicle.index');
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            }

            $data['status'] = false;
            $data['message'] = "Failed to save data!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
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
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['vehicle'] = Vehicle::findOrFail($id);
        return view('backend.pages.vehicle.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['vehicle'] = Vehicle::findOrFail($id);
        return view('backend.pages.vehicle.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validate = Validator::make($request->all(), [
            'vehicle_type' => 'required|max:191',
            'vehicle_category' => 'required|max:191',
            'vehicle_model' => 'required|max:191',
            'make_year' => 'required|integer|min:1900|max:2099',
            'make_company' => 'required|max:191',
            'ownership_type' => 'required|in:personal,institutional',
            'owner_id' => 'nullable|max:191',
            'owner_name' => 'nullable|max:191',
            'price' => 'nullable|numeric|min:0',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $payload = [
                'vehicle_type' => $request->vehicle_type,
                'vehicle_category' => $request->vehicle_category,
                'vehicle_model' => $request->vehicle_model,
                'make_year' => $request->make_year,
                'make_company' => $request->make_company,
                'ownership_type' => $request->ownership_type,
                'owner_id' => $request->owner_id,
                'owner_name' => $request->owner_name,
                'price' => $request->price,
            ];

            $columns = Schema::getColumnListing($vehicle->getTable());

            foreach ($payload as $key => $value) {
                if (in_array($key, $columns, true)) {
                    $vehicle->{$key} = $value;
                }
            }

            if ($vehicle->save()) {
                $data['status'] = true;
                $data['message'] = "Vehicle Updated Successfully!";
                $data['redirect_url'] = route('vehicle.index');
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            }

            $data['status'] = false;
            $data['message'] = "Failed to update data!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
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
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
