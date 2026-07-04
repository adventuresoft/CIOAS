<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\Profession;
use App\Models\Department\Section;
use App\Models\People\ProfessionalInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StaffProfessionalInfoController extends Controller
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
        $data['user'] = User::with('professionalInfos')->find($id);
        $data['departments'] = \App\Models\Department\Department::all();
        // return response()->json($data,  200);
        return view('backend.pages.staff.tabs.professional', $data);
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
            'department.*' => 'nullable|integer',
            'current_designation.*' => 'nullable|integer',
            'departmentU.*' => 'nullable|integer',
            'current_designationU.*' => 'nullable|integer',
        ]);

        $validate->after(function ($validator) use ($request) {
            foreach (($request->department ?? []) as $key => $departmentId) {
                $departmentId = trim((string) $departmentId);
                if ($departmentId === '') {
                    continue;
                }

                $sectionId = trim((string) ($request->current_designation[$key] ?? ''));
                if ($sectionId === '') {
                    $validator->errors()->add("current_designation.$key", 'Department select korle Section select korte hobe.');
                    continue;
                }

                $belongsToDepartment = Section::where('id', $sectionId)
                    ->where('department_id', $departmentId)
                    ->exists();

                if (!$belongsToDepartment) {
                    $validator->errors()->add("current_designation.$key", 'Selected section does not belong to the selected department.');
                }
            }

            foreach (($request->departmentU ?? []) as $key => $departmentId) {
                $departmentId = trim((string) $departmentId);
                if ($departmentId === '') {
                    continue;
                }

                $sectionId = trim((string) ($request->current_designationU[$key] ?? ''));
                if ($sectionId === '') {
                    $validator->errors()->add("current_designationU.$key", 'Department select korle Section select korte hobe.');
                    continue;
                }

                $belongsToDepartment = Section::where('id', $sectionId)
                    ->where('department_id', $departmentId)
                    ->exists();

                if (!$belongsToDepartment) {
                    $validator->errors()->add("current_designationU.$key", 'Selected section does not belong to the selected department.');
                }
            }
        });

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {
            $user_id = $request->user_id;

            $recruitment_notice_no = $request->recruitment_notice_no;
            $recruitment_notice_date = $request->recruitment_notice_date;
            $appointment_letter_no = $request->appointment_letter_no;
            $appointment_letter_date = $request->appointment_letter_date;
            $designation_joining = $request->designation_joining;
            $date_of_joining = $request->date_of_joining;
            $department = $request->department;
            $current_designation = $request->current_designation;
            $current_designation_manual = $request->current_designation_manual;
            $date_current_designation = $request->date_current_designation;
            $current_workplace = $request->current_workplace;
            $date_joining_current_workplace = $request->date_joining_current_workplace;

            $recruitment_notice_noU = $request->recruitment_notice_noU;
            $recruitment_notice_dateU = $request->recruitment_notice_dateU;
            $appointment_letter_noU = $request->appointment_letter_noU;
            $appointment_letter_dateU = $request->appointment_letter_dateU;
            $designation_joiningU = $request->designation_joiningU;
            $date_of_joiningU = $request->date_of_joiningU;
            $departmentU = $request->departmentU;
            $current_designationU = $request->current_designationU;
            $current_designation_manualU = $request->current_designation_manualU;
            $date_current_designationU = $request->date_current_designationU;
            $current_workplaceU = $request->current_workplaceU;
            $date_joining_current_workplaceU = $request->date_joining_current_workplaceU;

            try {

                if (!empty($recruitment_notice_no)) {
                    foreach ($recruitment_notice_no as $key => $val) {
                        $selectedSection = $current_designation[$key] ?? null;
                        $manualDesignation = trim((string) ($current_designation_manual[$key] ?? ''));
                        $resolvedSectionOrDesignation = filled($selectedSection)
                            ? $selectedSection
                            : ($manualDesignation !== '' ? $manualDesignation : null);

                        $prof = new ProfessionalInfo();
                        $user_table = User::find($user_id);
                        $prof->profession_subcategory_id = '0'; // default since not used for staff
                        $prof->recruitment_notice_no = $recruitment_notice_no[$key] ?? null;
                        $prof->recruitment_notice_date = $recruitment_notice_date[$key] ?? null;
                        $prof->appointment_letter_no = $appointment_letter_no[$key] ?? null;
                        $prof->appointment_letter_date = $appointment_letter_date[$key] ?? null;
                        $prof->designation_joining = $designation_joining[$key] ?? null;
                        $prof->designation = $manualDesignation !== '' ? $manualDesignation : null;
                        $prof->date_of_joining = $date_of_joining[$key] ?? null;
                        $prof->department = $department[$key] ?? null;
                        $prof->current_designation = $resolvedSectionOrDesignation;
                        $prof->date_current_designation = $date_current_designation[$key] ?? null;
                        $prof->current_workplace = $current_workplace[$key] ?? null;
                        $prof->date_joining_current_workplace = $date_joining_current_workplace[$key] ?? null;
                        $prof->user_id = $user_id;
                        $user_table->department_id = $department[$key] ?? null;
                        $user_table->section_id = $resolvedSectionOrDesignation;
                        $user_table->save();
                        $prof->save();
                    }
                }

                if (!empty($recruitment_notice_noU)) {
                    foreach ($recruitment_notice_noU as $key => $val) {
                        $selectedSectionU = $current_designationU[$key] ?? null;
                        $manualDesignationU = trim((string) ($current_designation_manualU[$key] ?? ''));
                        $resolvedSectionOrDesignationU = filled($selectedSectionU)
                            ? $selectedSectionU
                            : ($manualDesignationU !== '' ? $manualDesignationU : null);

                        $profs = ProfessionalInfo::find($key);
                        $user_table = User::find($user_id);
                        if ($profs) {
                            $profs->recruitment_notice_no = $recruitment_notice_noU[$key] ?? null;
                            $profs->recruitment_notice_date = $recruitment_notice_dateU[$key] ?? null;
                            $profs->appointment_letter_no = $appointment_letter_noU[$key] ?? null;
                            $profs->appointment_letter_date = $appointment_letter_dateU[$key] ?? null;
                            $profs->designation_joining = $designation_joiningU[$key] ?? null;
                            $profs->designation = $manualDesignationU !== '' ? $manualDesignationU : null;
                            $profs->date_of_joining = $date_of_joiningU[$key] ?? null;
                            $profs->department = $departmentU[$key] ?? null;
                            $profs->current_designation = $resolvedSectionOrDesignationU;
                            $profs->date_current_designation = $date_current_designationU[$key] ?? null;
                            $profs->current_workplace = $current_workplaceU[$key] ?? null;
                            $profs->date_joining_current_workplace = $date_joining_current_workplaceU[$key] ?? null;
                            $profs->save();
                            $user_table->section_id = $resolvedSectionOrDesignationU;
                            $user_table->department_id = $departmentU[$key] ?? null;
                            $user_table->save();
                        }
                    }
                }

                $data['status'] = true;
                $data['message'] = "Employment details submitted successfully!";
                $data['code'] = 200;
                $data['redirect_url'] = route('staff.financial', $request->user_id);
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
