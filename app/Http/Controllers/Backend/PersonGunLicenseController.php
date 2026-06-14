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
        $validator = Validator::make($request->all(), [
            'applicant_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'profession_details' => 'nullable|string',
            'weapon_details' => 'required|string', // dropdown value selected by user
            'annual_income' => 'nullable|string|max:255',
            'income_source' => 'nullable|string|max:255',
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
            'tracking_no' => $trackingNo,
            'applicant_name' => $request->applicant_name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'profession_details' => $request->profession_details,
            'weapon_details' => $request->weapon_details,
            'annual_income' => $request->annual_income,
            'income_source' => $request->income_source,
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
            'age' => 'required|integer|min:1',
            'education' => 'required|string|max:255',
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
