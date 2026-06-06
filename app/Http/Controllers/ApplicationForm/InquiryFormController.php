<?php

namespace App\Http\Controllers\ApplicationForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\InquiryDataTable;
use App\Models\Inquiry;
use App\Models\InquiryHistory;
use App\Models\Department\Department;
use App\Models\Department\Section;
use Illuminate\Support\Facades\DB;

class InquiryFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.inquiry.index');
    }


    public function FormList(InquiryDataTable $dataTable)
    {

        return $dataTable->render('backend.pages.inquiry.form_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'applicant_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'proof_file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:5120'
        ]);

        $data = $request->except('proof_file');

        if ($request->hasFile('proof_file')) {
            $file = $request->file('proof_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/inquiries'), $filename);
            $data['proof_file'] = 'uploads/inquiries/' . $filename;
        }

        $data['status'] = 'pending';
        Inquiry::create($data);

        return redirect()->back()->with('success', 'আপনার জিজ্ঞাসা সফলভাবে জমা দেওয়া হয়েছে।');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inquiry = \App\Models\Inquiry::with([
            'currentDepartment',
            'currentSection',
            'approver',
            'assignments.fromDepartment',
            'assignments.fromSection',
            'assignments.toDepartment',
            'assignments.toSection',
            'assignments.fromUser',
            'assignments.assignedByUser',
        ])->findOrFail($id);

        $departments = Department::orderBy('name')->get();
        $sections = $inquiry->current_department_id
            ? Section::where('department_id', $inquiry->current_department_id)->orderBy('name')->get()
            : collect();

        $canManageAllApplications = true; // or based on user role
        $canAssign = in_array($inquiry->status, ['pending', 'assigned', 'revision']);
        $canReceive = in_array($inquiry->status, ['assigned', 'pending', 'revision']);
        $canApprove = in_array($inquiry->status, ['received', 'processing', 'revision']);
        $showApproveForm = true;

        return view('backend.pages.inquiry.show', compact('inquiry', 'departments', 'sections', 'canManageAllApplications', 'canAssign', 'canReceive', 'canApprove', 'showApproveForm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inquiry = \App\Models\Inquiry::findOrFail($id);
        return view('backend.pages.Inquiry.edit', compact('inquiry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inquiry = \App\Models\Inquiry::findOrFail($id);

        $request->validate([
            'approval_note' => 'required|string',
            'status_action' => 'required|string'
        ]);

        $status = $request->status_action === 'reject' ? 'rejected' : 'approved';

        $inquiry->update([
            'status' => $status,
            'comment' => $request->approval_note,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'approval_note' => $request->approval_note,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Inquiry ' . $status . ' successfully!',
            'redirect' => route('inquiry.formlist')
        ], 200);
    }

    public function assignDepartmentSection(Request $request, $id)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'section_id' => 'required|exists:sections,id',
            'note' => 'nullable|string|max:1000',
        ]);

        $inquiry = Inquiry::findOrFail($id);
        $user = auth()->user();

        $section = Section::where('id', $request->section_id)
            ->where('department_id', $request->department_id)
            ->first();

        if (!$section) {
            return response()->json([
                'status' => false,
                'message' => 'Selected section does not belong to the selected department.',
            ], 422);
        }

        DB::transaction(function () use ($inquiry, $request, $user) {
            $fromDepartmentId = $inquiry->current_department_id;
            $fromSectionId = $inquiry->current_section_id;
            $fromUserId = $inquiry->receive_id;

            $inquiry->current_department_id = $request->department_id;
            $inquiry->current_section_id = $request->section_id;
            $inquiry->receive_id = null;
            $inquiry->status = 'assigned';
            $inquiry->comment = $request->note;
            $inquiry->approval_note = null;
            $inquiry->approved_by = null;
            $inquiry->approved_at = null;
            $inquiry->save();

            InquiryHistory::create([
                'inquiry_id' => $inquiry->id,
                'from_department_id' => $fromDepartmentId,
                'from_section_id' => $fromSectionId,
                'to_department_id' => $request->department_id,
                'to_section_id' => $request->section_id,
                'from_user_id' => $fromUserId,
                'user_id' => optional($user)->id,
                'note' => $request->note,
                'is_received' => false,
            ]);
        });

        return response()->json([
            'status' => true,
            'message' => 'Inquiry assigned successfully.',
        ], 200);
    }

    public function receive($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $user = auth()->user();

        DB::transaction(function () use ($inquiry, $user) {
            $inquiry->status = 'received';
            $inquiry->receive_id = $user->id;
            $inquiry->save();

            $latestAssign = InquiryHistory::where('inquiry_id', $inquiry->id)
                ->where('is_received', false)
                ->latest('id')
                ->first();

            if ($latestAssign) {
                $latestAssign->is_received = true;
                $latestAssign->received_by = $user->id;
                $latestAssign->received_at = now();
                $latestAssign->save();
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Inquiry received successfully.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $inquiry = Inquiry::findOrFail($id);
            if ($inquiry->proof_file && file_exists(public_path($inquiry->proof_file))) {
                @unlink(public_path($inquiry->proof_file));
            }
            $inquiry->delete();
            return response()->json(['message' => 'Inquiry successfully deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete inquiry.', 'error' => $e->getMessage()], 500);
        }
    }
}
