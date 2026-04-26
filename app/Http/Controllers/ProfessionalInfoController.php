<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\Profession;
use App\Models\People\ProfessionalInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessionalInfoController extends Controller
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
        $data['user'] = User::with(array('professionalInfos' => function($q1){
            $q1->with(array('subcategory' => function($q2){
                $q2->with(array('category' => function($q3){
                    $q3->with(array('type'=> function($q4){
                        $q4->with('profession');
                    }));
                }));
            }));
        }))->find($id);
        $data['professions'] = Profession::where('status', true)->get();
        // return response()->json($data,  200);
        return view('backend.pages.people.tabs.professional', $data);
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

                $profession = $request->profession_subcategory;
                $profession_start = $request->profession_start;
                $profession_end = $request->profession_end;
                $organization = $request->organization;
                $designation = $request->designation;
                $address = $request->address;

                $professionU = $request->profession_subcategoryU;
                $profession_startU = $request->profession_startU;
                $profession_endU = $request->profession_endU;
                $organizationU = $request->organizationU;
                $designationU = $request->designationU;
                $addressU = $request->addressU;

                try {

                    if (!empty($profession)) {
                        foreach ($profession as $key => $pro) {
                            $prof = new ProfessionalInfo();
                            $prof->profession_subcategory_id = $pro;
                            $prof->profession_start = $profession_start[$key];
                            $prof->profession_end = $profession_end[$key];
                            $prof->organization = $organization[$key];
                            $prof->designation = $designation[$key];
                            $prof->address = $address[$key];
                            $prof->user_id = $user_id;
                            $prof->save();
                        }
                    }

                    if (!empty($professionU)) {
                        foreach ($professionU as $key => $pr) {
                            $profs = ProfessionalInfo::find($key);
                            $profs->profession_subcategory_id = $pr;
                            $profs->profession_start = $profession_startU[$key];
                            $profs->profession_end = $profession_endU[$key];
                            $profs->organization = $organizationU[$key];
                            $profs->designation = $designationU[$key];
                            $profs->address = $addressU[$key];
                            $profs->save();
                        }
                    }

                    $data['status'] = true;
                    $data['message'] = "Profession submitted successfully!";
                    $data['code'] = 200;
                    $data['redirect_url'] = route('people.financial', $request->user_id);
                    return $data;

                } catch (\Throwable $th) {
                    $data['status'] = false;
                    $data['code'] = 500;
                    $data['message'] = "Something went wrong! Please try again...";
                    $data['errors'] = $th;
                    return $data;

                }



                
            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\ProfessionalInfo  $professionalInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ProfessionalInfo $professionalInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\ProfessionalInfo  $professionalInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfessionalInfo $professionalInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\ProfessionalInfo  $professionalInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfessionalInfo $professionalInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\ProfessionalInfo  $professionalInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $edu = ProfessionalInfo::find($id);
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
