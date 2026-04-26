<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilyType;
use App\Models\People\FamilyInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FamilyInfoController extends Controller
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
        $data['user'] = User::with('familyInfo')->find($id);
        $data['religions'] = Religion::where('status', true)->get();
        $data['familyTypes'] = FamilyType::where('status', true)->get();
        $data['familyCategories'] = FamilyCategory::where('status', true)->get();

        return view('backend.pages.people.tabs.family', $data);
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
                'family_type_id' => 'required',
                'father_name' => 'nullable|max:190',
                'father_live_status' => 'nullable|max:190',
                'father_nid' => 'nullable|max:190',
                'mother_name' => 'nullable|max:190',
                'mother_live_status' => 'nullable|max:190',
                'mother_nid' => 'nullable|max:190',
                'marital_status' => 'nullable|max:190',
                'spouse_name' => 'nullable|max:190',
                'spouse_nid' => 'nullable|max:190',
                'married_date' => 'nullable|max:190',
                'have_children' => 'nullable|max:190',
                'boys' => 'nullable|max:190',
                'girls' => 'nullable|max:190',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            // try {


                $peopleFamily = FamilyInfo::updateOrCreate([
                    'user_id' => $request->user_id
                ], [
                    'family_type_id' => $request->family_type_id,
                    'family_category_id' => $request->family_category_id,
                    'father_name' => $request->father_name,

                    'father_name_bn' => $request->father_name_bn,
                    'father_live_status' => $request->father_live_status,
                    'father_nid' => $request->father_nid,
                    'mother_name' => $request->mother_name,
                    'mother_name_bn' => $request->mother_name_bn,

                    'mother_live_status' => $request->mother_live_status,
                    'mother_nid' => $request->mother_nid,
                    'marital_status' => $request->marital_status,
                    'spouse_name' => $request->spouse_name,
                    'spouse_nid' => $request->spouse_nid,
                    'married_date' => $request->married_date,
                    'have_children' => $request->have_children ?? 0 ,
                    'boys' => $request->boys,
                    'girls' => $request->girls,
                ]);



                if ($peopleFamily) {
                    $data['status'] = true;
                    $data['message'] = "Family submitted successfully!";
                    $data['result'] = $peopleFamily;
                    $data['redirect_url'] = route('people.address', $request->user_id);
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Family comment save failed!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
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
     * @param  \App\Models\People\FamilyInfo  $familyInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyInfo $familyInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\FamilyInfo  $familyInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyInfo $familyInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\FamilyInfo  $familyInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyInfo $familyInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\FamilyInfo  $familyInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyInfo $familyInfo)
    {
        //
    }
}
