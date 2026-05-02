<?php

namespace App\Http\Controllers;

use App\Models\People\HealthInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HealthInfoController extends Controller
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
        $data['user'] = User::with('healthInfo')->find($id);
        $data['religions'] = Religion::where('status', true)->get();
        return view('backend.pages.people.tabs.health', $data);
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
                'user_id' => 'nullable',
                'bp' => 'nullable',
                'bp_up' => 'nullable',
                'bp_down' => 'nullable',
                'diabetes' => 'nullable',
                'diabetes_start_date' => 'nullable',
                'diabetes_status' => 'nullable',
                'diabetes_treatment_status' => 'nullable',
                'diabetes_doctor' => 'nullable',
                'azma' => 'nullable',
                'azma_start_date' => 'nullable',
                'azma_status' => 'nullable',
                'azma_treatment_status' => 'nullable',
                'azma_doctor' => 'nullable',
                'kidney' => 'nullable',
                'kidney_start_date' => 'nullable',
                'kidney_status' => 'nullable',
                'kidney_treatment_status' => 'nullable',
                'kidney_doctor' => 'nullable',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $result = DB::transaction(function () use ($request) {

                $peopleFamily = HealthInfo::updateOrCreate([
                    'user_id' => $request->user_id
                ], [
                    'bp' => $request->bp,
                    'bp_up' => $request->bp_up,
                    'bp_down' => $request->bp_down,
                    'diabetes' => $request->diabetes,
                    'diabetes_start_date' => $request->diabetes_start_date,
                    'diabetes_status' => $request->diabetes_status,
                    'diabetes_treatment_status' => $request->diabetes_treatment_status,
                    'diabetes_doctor' => $request->diabetes_doctor,
                    'azma' => $request->azma,
                    'azma_start_date' => $request->azma_start_date,
                    'azma_status' => $request->azma_status,
                    'azma_treatment_status' => $request->azma_treatment_status,
                    'azma_doctor' => $request->azma_doctor,
                    'kidney' => $request->kidney,
                    'kidney_start_date' => $request->kidney_start_date,
                    'kidney_status' => $request->kidney_status,
                    'kidney_treatment_status' => $request->kidney_treatment_status,
                    'kidney_doctor' => $request->kidney_doctor,
                    'present_start_date' => $request->present_start_date,
                ]);



                if ($peopleFamily) {
                    $data['status'] = true;
                    $data['message'] = "Health information submitted successfully!";
                    $data['result'] = $peopleFamily;
                    $data['code'] = 200;
                    $data['redirect_url'] = route('people.disability', $request->user_id);
                    return $data;
                } else {
                    $data['status'] = false;
                    $data['message'] = "Health info save failed!";
                    $data['code'] = 500;
                    return $data;
                }
            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
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
     * @param  \App\Models\People\HealthInfo  $healthInfo
     * @return \Illuminate\Http\Response
     */
    public function show(HealthInfo $healthInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\HealthInfo  $healthInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthInfo $healthInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\HealthInfo  $healthInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HealthInfo $healthInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\HealthInfo  $healthInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthInfo $healthInfo)
    {
        //
    }
}
