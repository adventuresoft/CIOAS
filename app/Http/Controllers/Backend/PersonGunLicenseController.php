<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonGunApplication;
use App\Models\PersonGunVerification;
use App\Models\PersonGunInterview;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PersonGunLicenseController extends Controller
{
    public function index()
    {
        $applications = PersonGunApplication::with(['verification', 'interview'])->latest()->paginate(10);
        return view('backend.pages.gun-license.person.index', compact('applications'));
    }

    public function createApplication()
    {
        return view('backend.pages.gun-license.person.create');
    }

    public function storeApplication(Request $request)
    {
        if ($request->has('age_at_application')) {
            $bnDigits = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
            $enDigits = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
            $convertedAge = str_replace($bnDigits, $enDigits, $request->age_at_application);
            $request->merge(['age_at_application' => $convertedAge]);
        }

        $validator = Validator::make($request->all(), [
            'district_magistrate' => 'nullable|string|max:255',
            'application_class' => 'nullable|string|max:255',
            'applicant_name' => 'required|string|max:255',
            'applicant_name_en' => 'nullable|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'age_at_application' => 'nullable|integer|min:0',
            'mother_name' => 'nullable|string|max:255',
            'mother_profession' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'father_profession' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'spouse_name' => 'nullable|string|max:255',
            'spouse_profession' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'education_qualification' => 'nullable|string|max:255',
            'profession_details' => 'nullable|string',
            'profession_address' => 'nullable|string',
            'annual_income' => 'nullable|string|max:255',
            'income_source' => 'nullable|string|max:255',
            'tin_no' => 'nullable|string|max:255',
            'tax_history_details' => 'nullable|string',
            'is_govt_employee' => 'required|boolean',
            'cadre_service_name' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'pay_grade_salary' => 'nullable|string|max:255',
            'workplace_address' => 'nullable|string',
            'duty_free_import' => 'nullable|string|max:255',
            'license_cancelled_before' => 'required|boolean',
            'cancelled_weapon_type' => 'nullable|string|max:255',
            'cancellation_reason' => 'nullable|string',
            'weapon_details' => 'required|string',
            'necessity_reason' => 'nullable|string',
            'affidavit_attached' => 'required|boolean',
            'heir_deed_attached' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 400);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate tracking number
        $datePart = Carbon::now()->format('Ymd');
        $last = PersonGunApplication::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();
        
        $newSerial = 1;
        if ($last && preg_match('/-(\d+)$/', $last->tracking_no, $matches)) {
            $newSerial = ((int)$matches[1]) + 1;
        }
        $trackingNo = 'PG-' . $datePart . '-' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);

        $application = PersonGunApplication::create([
            'institute_id' => Auth::user()->institute_id ?? 0,
            'tracking_no' => $trackingNo,
            'district_magistrate' => $request->district_magistrate,
            'application_class' => $request->application_class,
            'applicant_name' => $request->applicant_name,
            'applicant_name_en' => $request->applicant_name_en,
            'nid_no' => $request->nid_no,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'age_at_application' => $request->age_at_application,
            'mother_name' => $request->mother_name,
            'mother_profession' => $request->mother_profession,
            'father_name' => $request->father_name,
            'father_profession' => $request->father_profession,
            'marital_status' => $request->marital_status,
            'spouse_name' => $request->spouse_name,
            'spouse_profession' => $request->spouse_profession,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'education_qualification' => $request->education_qualification,
            'profession_details' => $request->profession_details,
            'profession_address' => $request->profession_address,
            'annual_income' => $request->annual_income,
            'income_source' => $request->income_source,
            'tin_no' => $request->tin_no,
            'tax_history_details' => $request->tax_history_details,
            'is_govt_employee' => $request->is_govt_employee,
            'cadre_service_name' => $request->cadre_service_name,
            'designation' => $request->designation,
            'pay_grade_salary' => $request->pay_grade_salary,
            'workplace_address' => $request->workplace_address,
            'duty_free_import' => $request->duty_free_import,
            'license_cancelled_before' => $request->license_cancelled_before,
            'cancelled_weapon_type' => $request->cancelled_weapon_type,
            'cancellation_reason' => $request->cancellation_reason,
            'weapon_details' => $request->weapon_details,
            'necessity_reason' => $request->necessity_reason,
            'affidavit_attached' => $request->affidavit_attached,
            'heir_deed_attached' => $request->heir_deed_attached,
            'status' => 'Submitted'
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Application submitted successfully! Tracking No: ' . $trackingNo,
                'redirect_url' => route('gun-license.person.index')
            ], 200);
        }

        return redirect()->route('gun-license.person.index')->with('success', 'Application submitted successfully! Tracking No: ' . $trackingNo);
    }

    public function createVerification($applicationId)
    {
        $application = PersonGunApplication::with('verification')->findOrFail($applicationId);
        return view('backend.pages.gun-license.person.verification', compact('application'));
    }

    public function storeVerification(Request $request, $applicationId)
    {
        $application = PersonGunApplication::findOrFail($applicationId);

        $validator = Validator::make($request->all(), [
            'has_criminal_record' => 'required|boolean',
            'criminal_case_details' => 'nullable|string',
            'social_discipline_issue' => 'required|boolean',
            'practical_knowledge' => 'required|boolean',
            'life_threat_justification' => 'required|string',
            'certificate_verification_status' => 'required|boolean',
            'adverse_info' => 'nullable|string',
            'oc_comments' => 'nullable|string',
            'sp_dsb_comments' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 400);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            PersonGunVerification::updateOrCreate(
                ['person_gun_application_id' => $applicationId],
                [
                    'has_criminal_record' => $request->has_criminal_record,
                    'criminal_case_details' => $request->criminal_case_details,
                    'social_discipline_issue' => $request->social_discipline_issue,
                    'practical_knowledge' => $request->practical_knowledge,
                    'life_threat_justification' => $request->life_threat_justification,
                    'certificate_verification_status' => $request->certificate_verification_status,
                    'adverse_info' => $request->adverse_info,
                    'oc_comments' => $request->oc_comments,
                    'sp_dsb_comments' => $request->sp_dsb_comments,
                ]
            );

            // Update application status to Verified
            $application->update(['status' => 'Verified']);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Verification details saved successfully!',
                    'redirect_url' => route('gun-license.person.index')
                ], 200);
            }

            return redirect()->route('gun-license.person.index')->with('success', 'Verification details saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to save verification: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Failed to save verification: ' . $e->getMessage())->withInput();
        }
    }

    public function createInterview($applicationId)
    {
        $application = PersonGunApplication::with('interview')->findOrFail($applicationId);
        return view('backend.pages.gun-license.person.interview', compact('application'));
    }

    public function storeInterview(Request $request, $applicationId)
    {
        $application = PersonGunApplication::findOrFail($applicationId);

        $validator = Validator::make($request->all(), [
            'age' => 'nullable|integer|min:1',
            'education' => 'nullable|string|max:255',
            'physical_mental_fitness' => 'required|boolean',
            'weapon_handling_knowledge' => 'required|boolean',
            'gun_law_knowledge' => 'required|boolean',
            'safe_custody_capability' => 'required|boolean',
            'safety_necessity_justification' => 'required|boolean',
            'behavior_satisfactory' => 'required|boolean',
            'police_report_comments' => 'nullable|string',
            'magistrate_final_comments' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 400);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            PersonGunInterview::updateOrCreate(
                ['person_gun_application_id' => $applicationId],
                [
                    'age' => $request->age,
                    'education' => $request->education,
                    'physical_mental_fitness' => $request->physical_mental_fitness,
                    'weapon_handling_knowledge' => $request->weapon_handling_knowledge,
                    'gun_law_knowledge' => $request->gun_law_knowledge,
                    'safe_custody_capability' => $request->safe_custody_capability,
                    'safety_necessity_justification' => $request->safety_necessity_justification,
                    'behavior_satisfactory' => $request->behavior_satisfactory,
                    'police_report_comments' => $request->police_report_comments,
                    'magistrate_final_comments' => $request->magistrate_final_comments,
                ]
            );

            // Update application status to Interviewed
            $application->update(['status' => 'Interviewed']);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Interview details saved successfully!',
                    'redirect_url' => route('gun-license.person.index')
                ], 200);
            }

            return redirect()->route('gun-license.person.index')->with('success', 'Interview details saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to save interview: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Failed to save interview: ' . $e->getMessage())->withInput();
        }
    }

    public function approve($id)
    {
        $application = PersonGunApplication::findOrFail($id);
        $application->update(['status' => 'Approved']);
        return redirect()->route('gun-license.person.index')->with('success', 'Application ' . $application->tracking_no . ' has been approved.');
    }

    public function reject($id)
    {
        $application = PersonGunApplication::findOrFail($id);
        $application->update(['status' => 'Rejected']);
        return redirect()->route('gun-license.person.index')->with('success', 'Application ' . $application->tracking_no . ' has been rejected.');
    }

    public function show($id)
    {
        $application = PersonGunApplication::with(['verification', 'interview'])->findOrFail($id);
        return view('backend.pages.gun-license.person.show', compact('application'));
    }
}
