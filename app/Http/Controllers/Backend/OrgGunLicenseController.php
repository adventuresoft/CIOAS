<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrgGunApplication;
use App\Models\OrgGunGuardDetail;
use App\Models\OrgGunVerification;
use App\Models\OrgGunInterview;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrgGunLicenseController extends Controller
{
    public function index()
    {
        $applications = OrgGunApplication::with(['guardDetails', 'verification', 'interviews'])->latest()->paginate(10);
        return view('backend.pages.gun-license.org.index', compact('applications'));
    }

    public function createApplication()
    {
        return view('backend.pages.gun-license.org.create');
    }

    public function storeApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Org fields
            'org_name' => 'required|string|max:255',
            'org_address' => 'nullable|string',
            'operation_start_date' => 'nullable|date',
            'vault_limit' => 'nullable|string|max:255',
            'vehicle_count' => 'nullable|integer|min:0',
            'owner_or_ceo_details' => 'nullable|string',
            'organogram_manpower_details' => 'nullable|string',
            'bangladesh_bank_permission' => 'required|boolean',
            'tax_details' => 'nullable|string',
            'current_security_description' => 'nullable|string',
            'rental_agreement_details' => 'nullable|string',
            'weapon_count_requested' => 'nullable|integer|min:0',
            'weapon_nature_requested' => 'required|string|max:255', // selected gun type dropdown
            'justification_of_necessity' => 'nullable|string',
            'existing_weapons_details' => 'nullable|string',

            // Guard fields
            'guard_name' => 'required|string|max:255',
            'guard_father_name' => 'nullable|string|max:255',
            'guard_mother_name' => 'nullable|string|max:255',
            'guard_present_address' => 'nullable|string',
            'guard_permanent_address' => 'nullable|string',
            'guard_age' => 'nullable|integer|min:1',
            'guard_education' => 'nullable|string|max:255',
            'guard_nid_number' => 'nullable|string|max:255',
            'guard_training_certificate_status' => 'required|boolean',
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
        $last = OrgGunApplication::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        $newSerial = 1;
        if ($last && preg_match('/-(\d+)$/', $last->tracking_no, $matches)) {
            $newSerial = ((int)$matches[1]) + 1;
        }
        $trackingNo = 'OG-' . $datePart . '-' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);

        DB::beginTransaction();
        try {
            $application = OrgGunApplication::create([
                'tracking_no' => $trackingNo,
                'org_name' => $request->org_name,
                'org_address' => $request->org_address,
                'operation_start_date' => $request->operation_start_date,
                'vault_limit' => $request->vault_limit,
                'vehicle_count' => $request->vehicle_count ?? 0,
                'owner_or_ceo_details' => $request->owner_or_ceo_details,
                'organogram_manpower_details' => $request->organogram_manpower_details,
                'bangladesh_bank_permission' => $request->bangladesh_bank_permission,
                'tax_details' => $request->tax_details,
                'current_security_description' => $request->current_security_description,
                'rental_agreement_details' => $request->rental_agreement_details,
                'weapon_count_requested' => $request->weapon_count_requested ?? 0,
                'weapon_nature_requested' => $request->weapon_nature_requested,
                'justification_of_necessity' => $request->justification_of_necessity,
                'existing_weapons_details' => $request->existing_weapons_details,
                'status' => 'Submitted'
            ]);

            OrgGunGuardDetail::create([
                'org_gun_application_id' => $application->id,
                'guard_name' => $request->guard_name,
                'father_name' => $request->guard_father_name,
                'mother_name' => $request->guard_mother_name,
                'present_address' => $request->guard_present_address,
                'permanent_address' => $request->guard_permanent_address,
                'age' => $request->guard_age,
                'education' => $request->guard_education,
                'nid_number' => $request->guard_nid_number,
                'training_certificate_status' => $request->guard_training_certificate_status,
            ]);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Organization application submitted successfully! Tracking No: ' . $trackingNo,
                    'redirect_url' => route('gun-license.org.index')
                ], 200);
            }

            return redirect()->route('gun-license.org.index')->with('success', 'Organization application submitted successfully! Tracking No: ' . $trackingNo);
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to save application: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Failed to save application: ' . $e->getMessage())->withInput();
        }
    }

    public function createVerification($applicationId)
    {
        $application = OrgGunApplication::with(['guardDetails', 'verification'])->findOrFail($applicationId);
        return view('backend.pages.gun-license.org.verification', compact('application'));
    }

    public function storeVerification(Request $request, $applicationId)
    {
        $application = OrgGunApplication::findOrFail($applicationId);

        $validator = Validator::make($request->all(), [
            'weapon_necessity_approved' => 'required|boolean',
            'existing_weapons_verified' => 'nullable|string',
            'vault_limit_verified' => 'required|boolean',
            'guard_has_criminal_record' => 'required|boolean',
            'guard_case_details' => 'nullable|string',
            'guard_social_discipline_issue' => 'required|boolean',
            'guard_existing_license' => 'required|boolean',
            'guard_practical_knowledge' => 'required|boolean',
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
            OrgGunVerification::updateOrCreate(
                ['org_gun_application_id' => $applicationId],
                [
                    'weapon_necessity_approved' => $request->weapon_necessity_approved,
                    'existing_weapons_verified' => $request->existing_weapons_verified,
                    'vault_limit_verified' => $request->vault_limit_verified,
                    'guard_has_criminal_record' => $request->guard_has_criminal_record,
                    'guard_case_details' => $request->guard_case_details,
                    'guard_social_discipline_issue' => $request->guard_social_discipline_issue,
                    'guard_existing_license' => $request->guard_existing_license,
                    'guard_practical_knowledge' => $request->guard_practical_knowledge,
                    'certificate_verification_status' => $request->certificate_verification_status,
                    'adverse_info' => $request->adverse_info,
                    'oc_comments' => $request->oc_comments,
                    'sp_dsb_comments' => $request->sp_dsb_comments,
                ]
            );

            $application->update(['status' => 'Verified']);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Verification details saved successfully!',
                    'redirect_url' => route('gun-license.org.index')
                ], 200);
            }

            return redirect()->route('gun-license.org.index')->with('success', 'Verification details saved successfully!');
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
        $application = OrgGunApplication::with(['guardDetails', 'interviews'])->findOrFail($applicationId);
        // We'll get the first guard for interview purposes
        $guard = $application->guardDetails->first();
        if (!$guard) {
            return redirect()->back()->with('error', 'No guard detail found for this application to interview.');
        }

        // Get existing interview if any
        $interview = OrgGunInterview::where('org_gun_application_id', $applicationId)
            ->where('org_gun_guard_detail_id', $guard->id)
            ->first();

        return view('backend.pages.gun-license.org.interview', compact('application', 'guard', 'interview'));
    }

    public function storeInterview(Request $request, $applicationId)
    {
        $application = OrgGunApplication::findOrFail($applicationId);
        $guard = OrgGunGuardDetail::where('org_gun_application_id', $applicationId)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'guard_physical_mental_capability' => 'required|boolean',
            'guard_weapon_knowledge' => 'required|boolean',
            'guard_behavior_satisfactory' => 'required|boolean',
            'safe_custody_capability' => 'required|boolean',
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
            OrgGunInterview::updateOrCreate(
                [
                    'org_gun_application_id' => $applicationId,
                    'org_gun_guard_detail_id' => $guard->id
                ],
                [
                    'guard_physical_mental_capability' => $request->guard_physical_mental_capability,
                    'guard_weapon_knowledge' => $request->guard_weapon_knowledge,
                    'guard_behavior_satisfactory' => $request->guard_behavior_satisfactory,
                    'safe_custody_capability' => $request->safe_custody_capability,
                    'police_report_comments' => $request->police_report_comments,
                    'magistrate_final_comments' => $request->magistrate_final_comments,
                ]
            );

            $application->update(['status' => 'Interviewed']);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Interview details saved successfully!',
                    'redirect_url' => route('gun-license.org.index')
                ], 200);
            }

            return redirect()->route('gun-license.org.index')->with('success', 'Interview details saved successfully!');
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
        $application = OrgGunApplication::findOrFail($id);
        $application->update(['status' => 'Approved']);
        return redirect()->route('gun-license.org.index')->with('success', 'Application ' . $application->tracking_no . ' has been approved.');
    }

    public function reject($id)
    {
        $application = OrgGunApplication::findOrFail($id);
        $application->update(['status' => 'Rejected']);
        return redirect()->route('gun-license.org.index')->with('success', 'Application ' . $application->tracking_no . ' has been rejected.');
    }

    public function show($id)
    {
        $application = OrgGunApplication::with(['guardDetails', 'verification', 'interviews'])->findOrFail($id);
        return view('backend.pages.gun-license.org.show', compact('application'));
    }
}
