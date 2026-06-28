<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleRepairing;
use Illuminate\Support\Facades\Validator;

use App\DataTables\VehicleRepairingDataTable;

class VehicleRepairingController extends Controller
{
    public function index(VehicleRepairingDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.vehicle_repairing.index');
    }

    public function create()
    {
        $data['mainMenu'] = 'Vehicle';
        $data['subMenu'] = 'VehicleRepairingCreate';
        $data['vehicles'] = Vehicle::select('id', 'registration_no')->get();
        return view('backend.pages.vehicle_repairing.create', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'repair_date' => 'required|date',
            'repair_type' => 'nullable|string|max:191',
            'spare_parts' => 'nullable|string|max:191',
            'workshop_name' => 'nullable|string|max:191',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
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
                'repair_date' => $request->repair_date,
                'repair_type' => $request->repair_type,
                'spare_parts' => $request->spare_parts,
                'workshop_name' => $request->workshop_name,
                'description' => $request->description,
                'cost' => $request->cost,
                'remarks' => $request->remarks,
                'created_by' => auth()->id(),
            ];

            if (VehicleRepairing::create($payload)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Vehicle Repairing recorded successfully!',
                    'redirect_url' => route('vehicle.repairing.index')
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

    public function destroy($id)
    {
        try {
            $repairing = VehicleRepairing::findOrFail($id);
            if ($repairing->delete()) {
                return redirect()->route('vehicle.repairing.index')->with('success', 'Vehicle Repairing deleted successfully!');
            }
            return redirect()->route('vehicle.repairing.index')->with('error', 'Failed to delete record!');
        } catch (\Exception $e) {
            return redirect()->route('vehicle.repairing.index')->with('error', 'Something went wrong!');
        }
    }
}
