<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Mouza;
use App\Models\People\PropertyInfo;
use App\Models\Religion;
use App\Models\Thana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PropertyInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::with('propertyInfos')->find($id);
        $data['districts'] = District::latest()->get();
        $data['user']  = $user;

        $data['landThanas'] = $user->propertyInfos ? ($user->propertyInfos->land_district_id ?  Thana::where('district_id', $user->propertyInfos->land_district_id )->get() : []  ) : [];
        $data['landMouzas'] = $user->propertyInfos ? ($user->propertyInfos->land_thana_id ?  Mouza::where('thana_id', $user->propertyInfos->land_thana_id )->get() : []  ) : [];

        $data['flatThanas'] = $user->propertyInfos ? ($user->propertyInfos->flat_district_id ?  Thana::where('district_id', $user->propertyInfos->flat_district_id )->get() : []  ) : [];
        $data['flatMouzas'] = $user->propertyInfos ? ($user->propertyInfos->flat_thana_id ?  Mouza::where('thana_id', $user->propertyInfos->flat_thana_id )->get() : []  ) : [];

        return view('backend.pages.people.tabs.property', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
            $validate = Validator::make($request->all(), [
                'user_id' => 'nullable',
                'cash_amount' => 'integer|nullable',
                'tin_number' => 'nullable',
                'house' => 'nullable',
                'house_type' => 'nullable',
                'house_area' => 'nullable',
                'house_land_quantity' => 'nullable',
                'house_price' => 'nullable',
                'house_ownership_status' => 'nullable',
                'house_address' => 'nullable',
                'land' => 'nullable',
                'land_district_id' => 'nullable',
                'land_thana_id' => 'nullable',
                'land_mouza_id' => 'nullable',
                'land_khatian_id' => 'nullable',
                'land_dag_no' => 'nullable',
                'land_bs' => 'nullable',
                'land_rs' => 'nullable',
                'land_sa' => 'nullable',

                'land_cs' => 'nullable',
                'land_quantity' => 'nullable',
                'land_type' => 'nullable',
                'land_ownership_status' => 'nullable',
                'flat' => 'nullable',
                'flat_district_id' => 'nullable',
                'flat_thana_id' => 'nullable',
                'flat_mouza_id' => 'nullable',
                'flat_area' => 'nullable',
                'flat_road' => 'nullable',
                'flat_house_no' => 'nullable',
                'flat_quantity' => 'nullable',
                'flat_price' => 'nullable',
                'flat_ownership_status' => 'nullable',

                'diamond' => 'nullable',
                'diamond_type' => 'nullable',
                'diamond_quantity' => 'nullable',
                'diamond_price' => 'nullable',
                'diamond_ownership_status' => 'nullable',
                'gold' => 'nullable',
                'gold_type' => 'nullable',
                'gold_quantity' => 'nullable',
                'gold_price' => 'nullable',
                'gold_ownership_status' => 'nullable',

                'silver' => 'nullable',
                'silver_type' => 'nullable',
                'silver_quantity' => 'nullable',
                'silver_price' => 'nullable',
                'silver_ownership_status' => 'nullable'
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $result = DB::transaction(function () use ($request) {

                $peopleFamily = PropertyInfo::updateOrCreate([
                    'user_id' => $request->user_id
                ], [
                    'is_property' => $request->is_property,
                    'cash_amount' => $request->cash_amount ?? 0.00,
                    'tin_number' => $request->tin_number,
                    'house' => $request->house ?? 0,
                    'house_type' => $request->house_type,
                    'house_area' => $request->house_area,
                    'house_land_quantity' => $request->house_land_quantity,
                    'house_price' => $request->house_price ?? 0.00,
                    'house_ownership_status' => $request->house_ownership_status,
                    'house_address' => $request->house_address,
                    'land' => $request->land ?? 0,
                    'land_district_id' => $request->land_district_id,
                    'land_thana_id' => $request->land_thana_id,
                    'land_mouza_id' => $request->land_mouza_id,
                    'land_khatian_id' => $request->land_khatian_id,
                    'land_dag_no' => $request->land_dag_no,
                    'land_bs' => $request->land_bs,
                    'land_rs' => $request->land_rs,
                    'land_sa' => $request->land_sa,
                    'land_cs' => $request->land_cs,


                    'land_quantity' => $request->land_quantity,
                    'land_type' => $request->land_type,
                    'land_ownership_status' => $request->land_ownership_status,
                    'land_type' => $request->land_type,
                    'land_ownership_status' => $request->land_ownership_status,
                    'flat' => $request->flat ?? 0,
                    'flat_district_id' => $request->flat_district_id,
                    'flat_thana_id' => $request->flat_thana_id,
                    'flat_mouza_id' => $request->flat_mouza_id,
                    'flat_area' => $request->flat_area,
                    'flat_road' => $request->flat_road,
                    'flat_house_no' => $request->flat_house_no,
                    'flat_quantity' => $request->flat_quantity,
                    'flat_price' => $request->flat_price ?? 0.00,
                    'flat_ownership_status' => $request->flat_ownership_status,
                    'diamond' => $request->diamond ?? 0,
                    'diamond_type' => $request->diamond_type,
                    'diamond_quantity' => $request->diamond_quantity,
                    'diamond_price' => $request->diamond_price ?? 0.00,
                    'diamond_ownership_status' => $request->diamond_ownership_status,

                    'gold' => $request->gold ?? 0,
                    'gold_type' => $request->gold_type,
                    'gold_quantity' => $request->gold_quantity,
                    'gold_price' => $request->gold_price ?? 0.00,
                    'gold_ownership_status' => $request->gold_ownership_status,
                    'silver' => $request->silver ?? 0,
                    'silver_type' => $request->silver_type,
                    'silver_quantity' => $request->silver_quantity,
                    'silver_price' => $request->silver_price ?? 0.00,
                    'silver_ownership_status' => $request->silver_ownership_status
                ]);



                if ($peopleFamily) {
                    $data['status'] = true;
                    $data['message'] = "Property submitted successfully!";
                    $data['result'] = $peopleFamily;
                    $data['code'] = 200;
                    $data['redirect_url'] = route('people.disability', $request->user_id);
                    return $data;
                } else {
                    $data['status'] = false;
                    $data['message'] = "Property save failed!";
                    $data['code'] = 500;
                    return $data;
                }
            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
        // } catch (\Throwable $th) {
        //     $data['status'] = false;
        //     $data['message'] = "Something went wrong! Please try again...";
        //     $data['errors'] = $th;
        //     return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\PropertyInfo  $propertyInfo
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyInfo $propertyInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\PropertyInfo  $propertyInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyInfo $propertyInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\PropertyInfo  $propertyInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyInfo $propertyInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\PropertyInfo  $propertyInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyInfo $propertyInfo)
    {
        //
    }
}
