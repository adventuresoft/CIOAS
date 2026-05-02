<?php

namespace App\Http\Controllers;

use App\Models\People\DisabilityInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DisabilityInfoController extends Controller
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
        $data['user'] = User::with('disabilityInfo')->find($id);
        return view('backend.pages.people.tabs.disability', $data);
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
                'user_id' => 'required',
                'is_disability' => 'required',
                'disability_name_id' => 'nullable',
                'disability_category_id' => 'nullable',
                'disability_type_id' => 'nullable',
                'start_date' => 'nullable',
                'treatment_status_id' => 'nullable',
                'disability_doctor' => 'nullable',

            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $query = DB::transaction(function () use ($request) {

                try {
                    DisabilityInfo::updateOrCreate([
                        'user_id' => $request->user_id
                    ], [
                        'is_disability' => $request->is_disability ?? false,
                        'disability_name_id' => $request->is_disability ? $request->disability_name_id : null,
                        'disability_category_id' => $request->is_disability ? $request->disability_category_id : null,
                        'disability_type_id' => $request->is_disability ? $request->disability_type_id  : null,
                        'start_date' =>  $request->is_disability ? (($request->disability_type_id !=1) ? $request->start_date : null )  : null,
                        'treatment_status_id' => $request->is_disability ? $request->treatment_status_id : null,
                        'disability_doctor' => $request->is_disability ? (($request->treatment_status_id !=1) ? $request->disability_doctor : null )   : null,
                    ]);

                    $data['status'] = true;
                    $data['message'] = "Disability information submitted successfully!";
                    $data['code'] = 200;
                    $data['redirect_url'] = route('people.freedom', $request->user_id);
                    return $data;
                } catch (\Throwable $th) {
                    $data['status'] = false;
                    $data['message'] = "Disability information save failed!";
                    $data['errors'] = $th;
                    $data['code'] = 500;
                    return $data;
                }
            });

            return response(json_encode($query, JSON_PRETTY_PRINT), $query['code'])->header('Content-Type', 'application/json');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\DisabilityInfo  $disabilityInfo
     * @return \Illuminate\Http\Response
     */
    public function show(DisabilityInfo $disabilityInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\DisabilityInfo  $disabilityInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(DisabilityInfo $disabilityInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\DisabilityInfo  $disabilityInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DisabilityInfo $disabilityInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\DisabilityInfo  $disabilityInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DisabilityInfo $disabilityInfo)
    {
        //
    }
}
