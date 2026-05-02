<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
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
}
