<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleFuel;
use Illuminate\Support\Facades\Validator;

class VehicleFuelController extends Controller
{
    public function index()
    {
        $data['mainMenu'] = 'Vehicle';
        $data['subMenu'] = 'VehicleFuelList';
        $data['fuels'] = VehicleFuel::with('vehicle')->orderBy('id', 'desc')->get();
        return view('backend.pages.vehicle_fuel.index', $data);
    }

    public function create()
    {
        $data['mainMenu'] = 'Vehicle';
        $data['subMenu'] = 'VehicleFuelCreate';
        $data['vehicles'] = Vehicle::select('id', 'registration_no')->get();
        return view('backend.pages.vehicle_fuel.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'fuel_date' => 'required|date',
            'fuel_type' => 'required|string|max:191',
            'quantity' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'pump_name' => 'nullable|string|max:191',
            'odometer_reading' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response()->json($data, 400);
        }

        try {
            $payload = [
                'vehicle_id' => $request->vehicle_id,
                'fuel_date' => $request->fuel_date,
                'fuel_type' => $request->fuel_type,
                'quantity' => $request->quantity,
                'total_cost' => $request->total_cost,
                'pump_name' => $request->pump_name,
                'odometer_reading' => $request->odometer_reading,
                'remarks' => $request->remarks,
                'created_by' => auth()->id(),
            ];

            if (VehicleFuel::create($payload)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Vehicle Fuel recorded successfully!',
                    'redirect_url' => route('vehicle.fuel.index')
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Failed to save data!',
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
