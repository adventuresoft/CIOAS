<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtherOrgGunApplication;
use App\Models\OtherOrgGunVerification;
use App\Models\OtherOrgGunInterview;
use App\Models\OtherOrgGunGuardDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OtherOrgGunLicenseController extends Controller
{
    public function index()
    {
        $applications = OtherOrgGunApplication::with(['verification', 'interview', 'guardDetails'])->latest()->paginate(10);
        return view('backend.pages.gun-license.other-org.index', compact('applications'));
    }

    public function createApplication()
    {
        return view('backend.pages.gun-license.other-org.create');
    }

    public function storeApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'org_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'org_address' => 'nullable|string',
            'operation_start_date' => 'nullable|date',
            'organogram_manpower_details' => 'nullable|string',
            'has_trade_license_mou_aou' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'owner_or_ceo_details' => 'nullable|string',
            'rental_agreement_details' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tin_no' => 'nullable|string|max:255',
            'tax_history' => 'nullable|string',
            'paid_up_capital' => 'nullable|string|max:255',
            'existing_weapons_details' => 'nullable|string',
            'safe_custody_details' => 'nullable|string',
            'trained_guard_count' => 'nullable|integer|min:0',

            // Guards array fields
            'guards' => 'required|array|min:1',
            'guards.*.guard_name' => 'required|string|max:255',
            'guards.*.guard_father_name' => 'nullable|string|max:255',
            'guards.*.guard_mother_name' => 'nullable|string|max:255',
            'guards.*.guard_present_address' => 'nullable|string',
            'guards.*.guard_permanent_address' => 'nullable|string',
            'guards.*.guard_age' => 'nullable|integer|min:1',
            'guards.*.guard_education' => 'nullable|string|max:255',
            'guards.*.guard_nid_number' => 'nullable|string|max:255',
            'guards.*.guard_training_certificate_status' => 'required|boolean',
            'guards.*.police_report_for_guard' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [], [
            'guards.*.guard_name' => 'গার্ডের নাম',
            'guards.*.guard_training_certificate_status' => 'প্রশিক্ষণপ্রাপ্ত কিনা',
            'guards.*.police_report_for_guard' => 'গার্ডের অনুকূলে পুলিশ প্রতিবেদন',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'আবেদনপত্র পূরণে কিছু ভুল রয়েছে। অনুগ্রহ করে চেক করুন।',
                    'errors' => $validator->errors()
                ], 400);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle File Uploads for documents
        $has_trade_license = $this->handleFileUpload($request, 'has_trade_license_mou_aou', 'other-org/documents');
        $rental_agreement = $this->handleFileUpload($request, 'rental_agreement_details', 'other-org/documents');

        // Generate tracking number
        $datePart = Carbon::now()->format('Ymd');
        $last = OtherOrgGunApplication::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        $newSerial = 1;
        if ($last && preg_match('/-(\d+)$/', $last->tracking_no, $matches)) {
            $newSerial = ((int)$matches[1]) + 1;
        }
        $trackingNo = 'OOG-' . $datePart . '-' . str_pad($newSerial, 5, '0', STR_PAD_LEFT);

        DB::beginTransaction();
        try {
            $application = OtherOrgGunApplication::create([
                'institute_id' => Auth::user()->institute_id ?? 0,
                'tracking_no' => $trackingNo,
                'org_name' => $request->org_name,
                'org_type' => 'other',
                'phone' => $request->phone,
                'email' => $request->email,
                'org_address' => $request->org_address,
                'operation_start_date' => $request->operation_start_date,
                'organogram_manpower_details' => $request->organogram_manpower_details,
                'has_trade_license_mou_aou' => $has_trade_license,
                'owner_or_ceo_details' => $request->owner_or_ceo_details,
                'rental_agreement_details' => $rental_agreement,
                'tin_no' => $request->tin_no,
                'tax_history' => $request->tax_history,
                'paid_up_capital' => $request->paid_up_capital,
                'existing_weapons_details' => $request->existing_weapons_details,
                'safe_custody_details' => $request->safe_custody_details,
                'trained_guard_count' => $request->trained_guard_count ?? 0,
                'police_report_for_guard' => null,
                'guard_cv' => null,
                'status' => 'Submitted'
            ]);

            // Save dynamic guards
            if ($request->has('guards') && is_array($request->guards)) {
                foreach ($request->guards as $index => $guardData) {
                    $guard_police_report_path = null;
                    if ($request->hasFile("guards.{$index}.police_report_for_guard")) {
                        $file = $request->file("guards.{$index}.police_report_for_guard");
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/other-org/documents'), $filename);
                        $guard_police_report_path = 'uploads/other-org/documents/' . $filename;
                    }

                    OtherOrgGunGuardDetail::create([
                        'other_org_gun_application_id' => $application->id,
                        'guard_name' => $guardData['guard_name'],
                        'father_name' => $guardData['guard_father_name'] ?? null,
                        'mother_name' => $guardData['guard_mother_name'] ?? null,
                        'present_address' => $guardData['guard_present_address'] ?? null,
                        'permanent_address' => $guardData['guard_permanent_address'] ?? null,
                        'age' => $guardData['guard_age'] ?? null,
                        'education' => $guardData['guard_education'] ?? null,
                        'nid_number' => $guardData['guard_nid_number'] ?? null,
                        'training_certificate_status' => $guardData['guard_training_certificate_status'],
                        'police_report_for_guard' => $guard_police_report_path,
                    ]);
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Application submitted successfully! Tracking No: ' . $trackingNo,
                    'redirect_url' => route('gun-license.index')
                ], 200);
            }

            return redirect()->route('gun-license.index')->with('success', 'Application submitted successfully! Tracking No: ' . $trackingNo);
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

    public function show($id)
    {
        $application = OtherOrgGunApplication::with(['verification', 'interview'])->findOrFail($id);
        return view('backend.pages.gun-license.other-org.show', compact('application'));
    }

    public function approve($id)
    {
        $application = OtherOrgGunApplication::findOrFail($id);
        $application->update(['status' => 'Approved']);
        return redirect()->back()->with('success', 'Application Approved.');
    }

    public function reject($id)
    {
        $application = OtherOrgGunApplication::findOrFail($id);
        $application->update(['status' => 'Rejected']);
        return redirect()->back()->with('success', 'Application Rejected.');
    }

    public function createVerification($applicationId)
    {
        $application = OtherOrgGunApplication::with('verification')->findOrFail($applicationId);
        return view('backend.pages.gun-license.other-org.verification', compact('application'));
    }

    public function storeVerification(Request $request, $applicationId)
    {
        $application = OtherOrgGunApplication::findOrFail($applicationId);

        $validator = Validator::make($request->all(), [
            'necessity_justification' => 'nullable|string',
            'existing_weapons_verification' => 'nullable|string',
            'weapon_details' => 'nullable|string',
            'guard_name' => 'nullable|string',
            'guard_mother_name' => 'nullable|string',
            'guard_father_name_address' => 'nullable|string',
            'guard_nid' => 'nullable|string',
            'social_discipline_issue' => 'nullable|string',
            'criminal_case_status' => 'nullable|string',
            'conviction_status' => 'nullable|string',
            'guard_existing_license' => 'nullable|string',
            'practical_knowledge' => 'nullable|string',
            'certificate_verification_status' => 'nullable|string',
            'adverse_info' => 'nullable|string',
            'safe_custody_capability' => 'required|boolean',
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
            OtherOrgGunVerification::updateOrCreate(
                ['other_org_gun_application_id' => $applicationId],
                $request->only([
                    'necessity_justification', 'existing_weapons_verification', 'weapon_details',
                    'guard_name', 'guard_mother_name', 'guard_father_name_address', 'guard_nid',
                    'social_discipline_issue', 'criminal_case_status', 'conviction_status',
                    'guard_existing_license', 'practical_knowledge', 'certificate_verification_status',
                    'adverse_info', 'safe_custody_capability', 'oc_comments', 'sp_dsb_comments'
                ])
            );

            $application->update(['status' => 'Verified']);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Verification details saved successfully!',
                    'redirect_url' => route('gun-license.index')
                ], 200);
            }

            return redirect()->route('gun-license.index')->with('success', 'Verification details saved successfully!');
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
        $application = OtherOrgGunApplication::with('interview')->findOrFail($applicationId);
        return view('backend.pages.gun-license.other-org.interview', compact('application'));
    }

    public function storeInterview(Request $request, $applicationId)
    {
        $application = OtherOrgGunApplication::findOrFail($applicationId);

        $validator = Validator::make($request->all(), [
            'applicant_name_designation' => 'nullable|string',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'documents_correct' => 'required|boolean',
            'guard_name' => 'nullable|string',
            'guard_father_name' => 'nullable|string',
            'guard_mother_name' => 'nullable|string',
            'guard_present_address' => 'nullable|string',
            'guard_permanent_address' => 'nullable|string',
            'guard_age' => 'nullable|string',
            'guard_education' => 'nullable|string',
            'physical_mental_fitness' => 'required|boolean',
            'weapon_handling_knowledge' => 'required|boolean',
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
            OtherOrgGunInterview::updateOrCreate(
                ['other_org_gun_application_id' => $applicationId],
                $request->only([
                    'applicant_name_designation', 'present_address', 'permanent_address', 'documents_correct',
                    'guard_name', 'guard_father_name', 'guard_mother_name', 'guard_present_address', 'guard_permanent_address',
                    'guard_age', 'guard_education', 'physical_mental_fitness', 'weapon_handling_knowledge', 'behavior_satisfactory',
                    'police_report_comments', 'magistrate_final_comments'
                ])
            );

            $application->update(['status' => 'Interviewed']);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Interview details saved successfully!',
                    'redirect_url' => route('gun-license.index')
                ], 200);
            }

            return redirect()->route('gun-license.index')->with('success', 'Interview details saved successfully!');
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

    private function handleFileUpload(Request $request, $fieldName, $path)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/' . $path), $filename);
            return 'uploads/' . $path . '/' . $filename;
        }
        
        // Return existing value if not a file upload but string
        return $request->input($fieldName);
    }
}
