<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleFee;
use App\Models\Organization\Organization;
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
            'owner_id' => 'nullable|required_if:ownership_type,personal|max:191',
            'institutional_name' => 'nullable|required_if:ownership_type,institutional|max:191',
            'trade_license' => 'nullable|required_if:ownership_type,institutional|max:191',
            'institutional_address' => 'nullable|required_if:ownership_type,institutional|max:500',
            'price' => 'nullable|numeric|min:0',
            'engine_number' => 'nullable|max:191',
            'chassis_number' => 'nullable|max:191',
            'tyre_number' => 'nullable|max:191',
            'hp_cc' => 'nullable|max:191',
            'seat_capacity' => 'nullable|max:191',
            'height' => 'nullable|max:191',
            'width' => 'nullable|max:191',
            'tyre_size' => 'nullable|max:191',
            'color' => 'nullable|max:191',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $isInstitutional = $request->ownership_type === 'institutional';
            $ownerUser = $isInstitutional ? null : $this->resolveOwnerUser($request->owner_id);

            if (! $isInstitutional && ! $ownerUser) {
                $data['status'] = false;
                $data['message'] = "Invalid Owner ID. No matching user found.";
                $data['errors'] = ['owner_id' => ['No matching user found for the provided Owner ID.']];
                return response(json_encode($data, JSON_PRETTY_PRINT), 422)->header('Content-Type', 'application/json');
            }

            $payload = [
                'vehicle_type' => $request->vehicle_type,
                'vehicle_category' => $request->vehicle_category,
                'vehicle_model' => $request->vehicle_model,
                'make_year' => $request->make_year,
                'make_company' => $request->make_company,
                'ownership_type' => $request->ownership_type,
                'owner_id' => $isInstitutional ? null : $request->owner_id,
                'owner_name' => $isInstitutional ? $request->institutional_name : ($ownerUser->name ?? null),
                'institutional_name' => $isInstitutional ? $request->institutional_name : null,
                'trade_license' => $isInstitutional ? $request->trade_license : null,
                'institutional_address' => $isInstitutional ? $request->institutional_address : null,
                'price' => $request->price,
                'engine_number' => $request->engine_number,
                'chassis_number' => $request->chassis_number,
                'tyre_number' => $request->tyre_number,
                'hp_cc' => $request->hp_cc,
                'seat_capacity' => $request->seat_capacity,
                'height' => $request->height,
                'width' => $request->width,
                'tyre_size' => $request->tyre_size,
                'color' => $request->color,
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
        $vehicle = Vehicle::findOrFail($id);
        $ownerUser = $vehicle->ownership_type === 'personal'
            ? $this->resolveOwnerUser($vehicle->owner_id)
            : null;

        $ownerOrganization = $vehicle->ownership_type === 'institutional'
            ? $this->resolveOwnerOrganization($vehicle->owner_id, $vehicle->institutional_name)
            : null;

        $data['vehicle'] = $vehicle;
        $data['ownerUser'] = $ownerUser;
        $data['ownerOrganization'] = $ownerOrganization;

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
            'owner_id' => 'nullable|required_if:ownership_type,personal|max:191',
            'institutional_name' => 'nullable|required_if:ownership_type,institutional|max:191',
            'trade_license' => 'nullable|required_if:ownership_type,institutional|max:191',
            'institutional_address' => 'nullable|required_if:ownership_type,institutional|max:500',
            'price' => 'nullable|numeric|min:0',
            'engine_number' => 'nullable|max:191',
            'chassis_number' => 'nullable|max:191',
            'tyre_number' => 'nullable|max:191',
            'hp_cc' => 'nullable|max:191',
            'seat_capacity' => 'nullable|max:191',
            'height' => 'nullable|max:191',
            'width' => 'nullable|max:191',
            'tyre_size' => 'nullable|max:191',
            'color' => 'nullable|max:191',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $isInstitutional = $request->ownership_type === 'institutional';
            $ownerUser = $isInstitutional ? null : $this->resolveOwnerUser($request->owner_id);

            if (! $isInstitutional && ! $ownerUser) {
                $data['status'] = false;
                $data['message'] = "Invalid Owner ID. No matching user found.";
                $data['errors'] = ['owner_id' => ['No matching user found for the provided Owner ID.']];
                return response(json_encode($data, JSON_PRETTY_PRINT), 422)->header('Content-Type', 'application/json');
            }

            $payload = [
                'vehicle_type' => $request->vehicle_type,
                'vehicle_category' => $request->vehicle_category,
                'vehicle_model' => $request->vehicle_model,
                'make_year' => $request->make_year,
                'make_company' => $request->make_company,
                'ownership_type' => $request->ownership_type,
                'owner_id' => $isInstitutional ? null : $request->owner_id,
                'owner_name' => $isInstitutional ? $request->institutional_name : ($ownerUser->name ?? null),
                'institutional_name' => $isInstitutional ? $request->institutional_name : null,
                'trade_license' => $isInstitutional ? $request->trade_license : null,
                'institutional_address' => $isInstitutional ? $request->institutional_address : null,
                'price' => $request->price,
                'engine_number' => $request->engine_number,
                'chassis_number' => $request->chassis_number,
                'tyre_number' => $request->tyre_number,
                'hp_cc' => $request->hp_cc,
                'seat_capacity' => $request->seat_capacity,
                'height' => $request->height,
                'width' => $request->width,
                'tyre_size' => $request->tyre_size,
                'color' => $request->color,
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

    public function approve(Request $request)
    {
        $vehicle = Vehicle::find($request->id);

        if (! $vehicle) {
            return response()->json([
                'status' => false,
                'message' => 'Vehicle not found.',
            ], 404);
        }

        if (! Schema::hasColumn('vehicles', 'status')) {
            return response()->json([
                'status' => false,
                'message' => 'Vehicle approval setup is incomplete. Please run latest migrations.',
            ], 422);
        }

        $vehicle->status = 1;

        if (Schema::hasColumn('vehicles', 'approved_at')) {
            $vehicle->approved_at = now();
        }

        if (Schema::hasColumn('vehicles', 'approved_by')) {
            $vehicle->approved_by = auth()->id();
        }

        $vehicle->save();

        return response()->json([
            'status' => true,
            'message' => 'Vehicle approved successfully.',
        ]);
    }

    public function feesHub()
    {
        return redirect()->route('vehicle.fees.vehicle');
    }

    public function vehicleFees()
    {
        $data['financeYears'] = $this->financeYearOptions();
        $data['vehicleData'] = $this->vehicleTypeCategoryMap();
        $data['feesTableReady'] = Schema::hasTable('vehicle_fees');

        return view('backend.pages.vehicle.fees.vehicle', $data);
    }

    public function vehicleFeesList()
    {
        $data['feesTableReady'] = Schema::hasTable('vehicle_fees');
        $data['vehicleFees'] = $data['feesTableReady']
            ? VehicleFee::latest()->get()
            : collect();

        return view('backend.pages.vehicle.fees.list', $data);
    }

    public function vehicleFeesShow($id)
    {
        if (! Schema::hasTable('vehicle_fees')) {
            return redirect()->route('vehicle.fees.list');
        }

        $data['fee'] = VehicleFee::findOrFail($id);
        return view('backend.pages.vehicle.fees.show', $data);
    }

    public function vehicleFeesEdit($id)
    {
        if (! Schema::hasTable('vehicle_fees')) {
            return redirect()->route('vehicle.fees.list');
        }

        $data['fee'] = VehicleFee::findOrFail($id);
        $data['financeYears'] = $this->financeYearOptions();
        $data['vehicleData'] = $this->vehicleTypeCategoryMap();
        $data['feesTableReady'] = true;

        return view('backend.pages.vehicle.fees.edit', $data);
    }

    public function storeVehicleFees(Request $request)
    {
        if (! Schema::hasTable('vehicle_fees')) {
            return response()->json([
                'status' => false,
                'message' => 'Vehicle fees table is missing. Please run php artisan migrate first.',
            ], 422);
        }

        $validate = Validator::make($request->all(), [
            'finance_year' => 'required|max:191',
            'vehicle_type' => 'required|max:191',
            'vehicle_category' => 'required|max:191',
            'fee_for' => 'required|in:new,renew',
            'registration_fee' => 'required|numeric|min:0',
            'road_fee' => 'required|numeric|min:0',
            'fitness_fee' => 'required|numeric|min:0',
            'vat_fee' => 'required|numeric|min:0',
            'tax_fee' => 'required|numeric|min:0',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid entry.',
                'errors' => $validate->errors(),
            ], 422);
        }

        $vehicleData = $this->vehicleTypeCategoryMap();
        $allowedCategories = $vehicleData[$request->vehicle_type] ?? [];

        if (! in_array($request->vehicle_category, $allowedCategories, true)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid vehicle category for selected vehicle type.',
                'errors' => [
                    'vehicle_category' => ['Invalid category for selected vehicle type.'],
                ],
            ], 422);
        }

        $registrationFee = (float) $request->registration_fee;
        $roadFee = (float) $request->road_fee;
        $fitnessFee = (float) $request->fitness_fee;
        $vatFee = (float) $request->vat_fee;
        $taxFee = (float) $request->tax_fee;

        $totalFee = $registrationFee + $roadFee + $fitnessFee + $vatFee + $taxFee;

        VehicleFee::updateOrCreate(
            [
                'finance_year' => $request->finance_year,
                'vehicle_type' => $request->vehicle_type,
                'vehicle_category' => $request->vehicle_category,
                'fee_for' => $request->fee_for,
            ],
            [
                'registration_fee' => $registrationFee,
                'road_fee' => $roadFee,
                'fitness_fee' => $fitnessFee,
                'vat_fee' => $vatFee,
                'tax_fee' => $taxFee,
                'total_fee' => $totalFee,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Vehicle fees saved successfully.',
            'redirect_url' => route('vehicle.fees.vehicle'),
        ]);
    }

    public function updateVehicleFees(Request $request, $id)
    {
        if (! Schema::hasTable('vehicle_fees')) {
            return response()->json([
                'status' => false,
                'message' => 'Vehicle fees table is missing. Please run php artisan migrate first.',
            ], 422);
        }

        $fee = VehicleFee::find($id);
        if (! $fee) {
            return response()->json([
                'status' => false,
                'message' => 'Vehicle fees setup not found.',
            ], 404);
        }

        $validate = Validator::make($request->all(), [
            'finance_year' => 'required|max:191',
            'vehicle_type' => 'required|max:191',
            'vehicle_category' => 'required|max:191',
            'fee_for' => 'required|in:new,renew',
            'registration_fee' => 'required|numeric|min:0',
            'road_fee' => 'required|numeric|min:0',
            'fitness_fee' => 'required|numeric|min:0',
            'vat_fee' => 'required|numeric|min:0',
            'tax_fee' => 'required|numeric|min:0',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid entry.',
                'errors' => $validate->errors(),
            ], 422);
        }

        $vehicleData = $this->vehicleTypeCategoryMap();
        $allowedCategories = $vehicleData[$request->vehicle_type] ?? [];

        if (! in_array($request->vehicle_category, $allowedCategories, true)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid vehicle category for selected vehicle type.',
                'errors' => [
                    'vehicle_category' => ['Invalid category for selected vehicle type.'],
                ],
            ], 422);
        }

        $duplicate = VehicleFee::query()
            ->where('finance_year', $request->finance_year)
            ->where('vehicle_type', $request->vehicle_type)
            ->where('vehicle_category', $request->vehicle_category)
            ->where('fee_for', $request->fee_for)
            ->where('id', '!=', $fee->id)
            ->exists();

        if ($duplicate) {
            return response()->json([
                'status' => false,
                'message' => 'Same finance year, vehicle type, category and new/renew setup already exists.',
            ], 422);
        }

        $registrationFee = (float) $request->registration_fee;
        $roadFee = (float) $request->road_fee;
        $fitnessFee = (float) $request->fitness_fee;
        $vatFee = (float) $request->vat_fee;
        $taxFee = (float) $request->tax_fee;
        $totalFee = $registrationFee + $roadFee + $fitnessFee + $vatFee + $taxFee;

        $fee->finance_year = $request->finance_year;
        $fee->vehicle_type = $request->vehicle_type;
        $fee->vehicle_category = $request->vehicle_category;
        $fee->fee_for = $request->fee_for;
        $fee->registration_fee = $registrationFee;
        $fee->road_fee = $roadFee;
        $fee->fitness_fee = $fitnessFee;
        $fee->vat_fee = $vatFee;
        $fee->tax_fee = $taxFee;
        $fee->total_fee = $totalFee;
        $fee->save();

        return response()->json([
            'status' => true,
            'message' => 'Vehicle fees updated successfully.',
            'redirect_url' => route('vehicle.fees.list'),
        ]);
    }

    private function resolveOwnerUser(?string $ownerId): ?User
    {
        $ownerId = trim((string) $ownerId);
        if ($ownerId === '') {
            return null;
        }

        $relations = [
            'people',
            'familyInfo',
            'addressInfo.presentDistrict',
            'addressInfo.presentThana',
            'addressInfo.presentUnion',
            'addressInfo.presentPostoffice',
            'addressInfo.presentVillage',
            'addressInfo.presentWard',
            'addressInfo.presentRoad',
            'addressInfo.presentHouse',
            'addressInfo.permanentDistrict',
            'addressInfo.permanentThana',
            'addressInfo.permanentUnion',
            'addressInfo.permanentPostOffice',
            'addressInfo.permanentVillage',
            'addressInfo.permanentWard',
            'addressInfo.permanentRoad',
            'addressInfo.permanentHouse',
        ];

        if (is_numeric($ownerId)) {
            $user = User::with($relations)->find((int) $ownerId);
            if ($user) {
                return $user;
            }
        }

        $user = User::with($relations)->where('system_id', $ownerId)->first();
        if ($user) {
            return $user;
        }

        if (! Schema::hasColumn('people', 'approved_id')) {
            return null;
        }

        return User::with($relations)
            ->whereHas('people', function ($query) use ($ownerId) {
                $query->where('approved_id', $ownerId);
            })
            ->first();
    }

    private function resolveOwnerOrganization(?string $ownerId, ?string $institutionalName = null): ?Organization
    {
        $ownerId = trim((string) $ownerId);
        $institutionalName = trim((string) $institutionalName);

        $relations = [
            'Union.thana.district',
            'Thana.district',
            'District',
            'officeThana.district',
            'officeDistrict',
            'institute.union.thana.district',
        ];

        if ($ownerId !== '') {
            if (is_numeric($ownerId)) {
                $organization = Organization::with($relations)->find((int) $ownerId);
                if ($organization) {
                    return $organization;
                }
            }

            $organization = Organization::with($relations)
                ->where('system_id', $ownerId)
                ->orWhere('application_id', $ownerId)
                ->first();

            if ($organization) {
                return $organization;
            }
        }

        if ($institutionalName === '') {
            return null;
        }

        return Organization::with($relations)
            ->where('name', $institutionalName)
            ->orWhere('bn_name', $institutionalName)
            ->first();
    }

    private function financeYearOptions(): array
    {
        $options = [];
        $startYear = 1990;
        $currentYear = (int) now()->format('Y');
        $currentFiscalStartYear = max($startYear, $currentYear - 1);

        for ($year = $currentFiscalStartYear; $year >= $startYear; $year--) {
            $options[] = $year . '-' . ($year + 1);
        }

        return $options;
    }

    private function vehicleTypeCategoryMap(): array
    {
        return [
            'Auto' => [
                'Rickshaw - রিকশা',
                'Van - ভ্যান / ভ্যানগাড়ি',
            ],
            'Manual' => [
                'Rickshaw - রিকশা',
                'Van - ভ্যান / ভ্যানগাড়ি',
                'Thela Gari - ঠেলাগাড়ি',
                'Gorur Gari - গরুর গাড়ি',
            ],
        ];
    }
}
