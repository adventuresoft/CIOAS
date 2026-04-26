<?php

namespace App\Http\Controllers;

use App\Models\People\EducationalInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationalInfoController extends Controller
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
        $data['user'] = User::with('educationInfos')->find($id);
        $data['religions'] = Religion::where('status', true)->get();
        return view('backend.pages.people.tabs.educational', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $result = DB::transaction(function () use ($request) {
                $user_id = $request->user_id;
                $degree_id = $request->degree_id;
                $group_id = $request->group_id;
                $grade_id = $request->grade_id;
                $board_id = $request->board_id;
                $institute = $request->institute;

                $degree_idU = $request->degree_idU;
                $group_idU = $request->group_idU;
                $grade_idU = $request->grade_idU;
                $board_idU = $request->board_idU;
                $instituteU = $request->instituteU;

                try {
                    if (!empty($degree_id)) {
                        foreach ($degree_id as $key => $degree) {
                            $education = new EducationalInfo();
                            $education->degree_id = $degree;
                            $education->group_id = $group_id[$key];
                            $education->grade_id = $grade_id[$key];
                            $education->board_id = $board_id[$key];
                            $education->institute = $institute[$key];
                            $education->user_id = $user_id;
                            $education->save();
                        }
                    }
    
                    if (!empty($degree_idU)) {
                        foreach ($degree_idU as $index => $deg) {
                            $education = EducationalInfo::find($index);
                            $education->degree_id = $deg;
                            $education->group_id = $group_idU[$index];
                            $education->grade_id = $grade_idU[$index];
                            $education->board_id = $board_idU[$index];
                            $education->institute = $instituteU[$index];
                            $education->save();
                        }
                    }

                    $data['status'] = true;
                    $data['message'] = "Education submitted successfully!";
                    $data['redirect_url'] = route('people.professional', $request->user_id);
                    $data['code'] = 200;
                    return $data;
                } catch (\Throwable $th) {
                    $data['status'] = true;
                    $data['message'] = "Education submitted successfully!";
                    $data['code'] = 200;
                    $data['errors'] = $th;
                    return $data;
                }

                

            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\EducationalInfo  $educationalInfo
     * @return \Illuminate\Http\Response
     */
    public function show(EducationalInfo $educationalInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\EducationalInfo  $educationalInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(EducationalInfo $educationalInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\EducationalInfo  $educationalInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EducationalInfo $educationalInfo)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\EducationalInfo  $educationalInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $edu = EducationalInfo::find($id);
            if ($edu) {
                if ($edu->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Deleted Successfully!";
                    $data['edu_id'] = $id;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Failed to delete! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status'] = false;
                $data['message'] = "Not Found! Please try again...";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }
}
