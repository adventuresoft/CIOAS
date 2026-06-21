<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use App\Models\Staff;
use Illuminate\Http\Request;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $leaves = LeaveApplication::with('staff.user')->orderBy('created_at', 'desc')->get();
        return view('backend.pages.leave-application.index', compact('leaves'));
    }

    public function create()
    {
        return view('backend.pages.leave-application.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_days' => 'required|integer|min:1',
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $payload = $request->except('_token', 'attachment');

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('leave_attachments', 'public');
            $payload['attachment'] = $path;
        }

        LeaveApplication::create($payload);

        return redirect()->route('leave-application.index')->with('success', 'Leave Application submitted successfully!');
    }

    public function show($id)
    {
        $leave = LeaveApplication::with(['staff.user', 'relievingStaff.user'])->findOrFail($id);
        return view('backend.pages.leave-application.show', compact('leave'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'admin_remarks' => 'nullable|string',
        ]);

        $leave = LeaveApplication::findOrFail($id);
        $leave->status = $request->status;
        $leave->admin_remarks = $request->admin_remarks;
        $leave->save();

        return redirect()->back()->with('success', 'Leave Application status updated!');
    }

    public function getStaffInfo(Request $request)
    {
        $staffId = $request->input('staff_id');
        if (!$staffId) {
            return response()->json(['status' => false, 'message' => 'No ID provided']);
        }

        $staff = Staff::where('staff_id', $staffId)->with('user')->first();
        if ($staff && $staff->user) {
            return response()->json([
                'status' => true,
                'name' => $staff->user->name,
                'phone' => $staff->user->mobile,
                'designation' => $staff->user->role->name ?? 'Staff',
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Staff not found']);
    }
}
