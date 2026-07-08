<?php

namespace App\Http\Controllers\ApplicationForm;

use App\Http\Controllers\Controller;
use App\Models\ApplicationForm\ApplicationAssign;
use App\Models\ApplicationForm\ApplicationFrom;
use App\Models\Department\Department;
use App\Models\Department\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\FileUploadTrait;


class ApplicationFormController extends Controller
{

    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('permission:application_form.read')->only('index', 'show');
    //     $this->middleware('permission:application_form.create')->only('create', 'store');
    //     $this->middleware('permission:application_form.update')->only('update', 'edit');
    //     $this->middleware('permission:application_form.delete')->only('destroy');

    // }
    public function index()
    {


        if (auth()->user()->can('application_form.create')) {
            $applicationForms = ApplicationFrom::with(['currentDepartment', 'currentSection', 'receiver'])
                ->latest()
                ->get();
        } elseif (auth()->user()->can('application_form.delete')) {

            $applicationForms = ApplicationFrom::with(['currentDepartment', 'currentSection', 'receiver'])
                ->orwhere('status', 'processing')
                ->orwhere('status', 'approved')
                ->latest()
                ->get();
        } else {
            $user = auth()->user();
            $query = ApplicationFrom::with(['currentDepartment', 'currentSection', 'receiver'])
                ->where('institute_id', $user->institute_id)
                ->where('current_department_id', $user->department_id);
                
            if ($user->section_id) {
                $query->where(function($q) use ($user) {
                    $q->whereNull('current_section_id')
                      ->orWhere('current_section_id', $user->section_id);
                });
            }

            $applicationForms = $query->latest()->get();
        }

        $canCreateApplication = auth()->user()->can('application_form.create');
        $canManageAllApplications = auth()->user()->can('application_form.red');

        return view('backend.pages.application-form.index', compact(
            'applicationForms',
            'canCreateApplication',
            'canManageAllApplications'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.pages.application-form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->rules());

        $applicationForm = new ApplicationFrom();
        $applicationForm->fill($request->only($this->formFields()));
        $applicationForm->created_by = optional(auth()->user())->id;
        $applicationForm->status = 'pending';
        $applicationForm->institute_id = auth()->user()->institute_id;

        if ($request->hasFile('attachment')) {
            $applicationForm->attachment = $this->uploadFile($request->attachment, 'uploads/application-form/', 'app_doc_');
        }

        $applicationForm->save();


        return
            response()->json([
                'status' => true,
                'message' => 'Application Form Created Successfully!',
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicationForm = ApplicationFrom::with([
            'currentDepartment',
            'currentSection',
            'creator',
            'receiver',
            'approver',
            'assignments.fromDepartment',
            'assignments.fromSection',
            'assignments.toDepartment',
            'assignments.toSection',
            'assignments.fromUser',
            'assignments.assignedByUser',
            'assignments.receivedByUser',
        ])->findOrFail($id);

        if (!$this->canAccessApplication(auth()->user(), $applicationForm)) {
            abort(403, 'You do not have permission to view this application.');
        }

        $departments = Department::orderBy('name')->get();
        $sections = $applicationForm->current_department_id
            ? Section::where('department_id', $applicationForm->current_department_id)->orderBy('name')->get()
            : collect();

        $canManageAllApplications = $this->canViewAllApplications(auth()->user());
        $canAssign = $this->canAssignApplication(auth()->user(), $applicationForm);
        $canReceive = $this->canReceiveApplication(auth()->user(), $applicationForm);
        $canApprove = $this->canApproveApplication(auth()->user(), $applicationForm);
        $showApproveForm = $this->canAccessApplication(auth()->user(), $applicationForm) || $canManageAllApplications;

        return view('backend.pages.application-form.view', compact(
            'applicationForm',
            'departments',
            'sections',
            'canManageAllApplications',
            'canAssign',
            'canReceive',
            'canApprove',
            'showApproveForm'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->canViewAllApplications(auth()->user())) {
            abort(403, 'You do not have permission to edit this application.');
        }

        $applicationForm = ApplicationFrom::findOrFail($id);
        return view('backend.pages.application-form.edit', compact('applicationForm'));
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
        if (!$this->canViewAllApplications(auth()->user())) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to update this application.',
            ], 403);
        }

        $request->validate($this->rules());

        $applicationForm = ApplicationFrom::findOrFail($id);
        $applicationForm->fill($request->only($this->formFields()));
        $applicationForm->updated_by = optional(auth()->user())->id;

        if ($request->hasFile('attachment')) {
            $this->deleteFile($applicationForm->attachment);
            $applicationForm->attachment = $this->uploadFile($request->attachment, 'uploads/application-form/', 'app_doc_');
        }

        $applicationForm->save();

        return response()->json([
            'status' => true,
            'message' => 'Application Form Updated Successfully!',
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


        $applicationForm = ApplicationFrom::findOrFail($id);
        $this->deleteFile($applicationForm->attachment);
        $applicationForm->delete();

        return response()->json([
            'status' => true,
            'message' => 'Application Form Deleted Successfully!',
        ], 200);
    }

    public function assignDepartmentSection(Request $request, $id): JsonResponse
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'section_id' => 'required|exists:sections,id',
            'note' => 'nullable|string|max:1000',
        ]);

        $applicationForm = ApplicationFrom::findOrFail($id);
        $user = auth()->user();

        if (!$this->canAssignApplication($user, $applicationForm)) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to assign this application.',
            ], 403);
        }

        $section = Section::where('id', $request->section_id)
            ->where('department_id', $request->department_id)
            ->first();

        if (!$section) {
            return response()->json([
                'status' => false,
                'message' => 'Selected section does not belong to the selected department.',
            ], 422);
        }

        DB::transaction(function () use ($applicationForm, $request, $user) {
            $fromDepartmentId = $applicationForm->current_department_id ?? optional($user)->department_id ?? 1;
            $fromSectionId = $applicationForm->current_section_id ?? optional($user)->section_id ?? 1;
            $fromUserId = $applicationForm->receive_id ?? optional($user)->id;

            $applicationForm->current_department_id = $request->department_id;
            $applicationForm->current_section_id = $request->section_id;
            $applicationForm->current_officer_id = null;
            $applicationForm->receive_id = null;
            $applicationForm->status = 'assigned';
            $applicationForm->note = $request->note;
            $applicationForm->approval_note = null;
            $applicationForm->approved_by = null;
            $applicationForm->approved_at = null;
            $applicationForm->updated_by = optional($user)->id;
            $applicationForm->save();

            ApplicationAssign::create([
                'application_from_id' => $applicationForm->id,
                'from_department_id' => $fromDepartmentId,
                'from_section_id' => $fromSectionId,
                'to_department_id' => $request->department_id,
                'to_section_id' => $request->section_id,
                'from_user_id' => $fromUserId,
                'assigned_by' => optional($user)->id,
                'note' => $request->note,
                'is_received' => false,
            ]);
        });

        return response()->json([
            'status' => true,
            'message' => 'Application assigned successfully. Status set to assigned.',
        ], 200);
    }

    public function receive($id): JsonResponse
    {
        $applicationForm = ApplicationFrom::findOrFail($id);
        $user = auth()->user();

        if (!$this->canReceiveApplication($user, $applicationForm)) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to receive this application.',
            ], 403);
        }

        DB::transaction(function () use ($applicationForm, $user) {
            $applicationForm->status = 'received';
            $applicationForm->receive_id = $user->id;
            $applicationForm->current_officer_id = $user->id;
            $applicationForm->updated_by = $user->id;
            $applicationForm->save();

            $latestAssign = ApplicationAssign::where('application_from_id', $applicationForm->id)
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
            'message' => 'Application received successfully. Status set to received.',
        ], 200);
    }

    public function approve(Request $request, $id): JsonResponse
    {
        $request->validate([
            'approval_note' => 'required|string|max:1000',
        ]);

        $applicationForm = ApplicationFrom::findOrFail($id);
        $user = auth()->user();

        if ($applicationForm->status === 'received' || $applicationForm->status === 'revision') {
            if (!$this->canApproveApplication($user, $applicationForm)) {
                return response()->json([
                    'status' => false,
                    'message' => 'You do not have permission to approve this application.',
                ], 403);
            }
        } elseif ($applicationForm->status === 'processing') {
            if (!$user->can('application_form.update')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Only users with application update access can finally approve, reject, or request revision for this application.',
                ], 403);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Application must be received, revision, or processing before approval.',
            ], 422);
        }

        $action = $request->input('status_action', 'approve');

        DB::transaction(function () use ($applicationForm, $request, $user, $action) {
            if ($applicationForm->status === 'received' || $applicationForm->status === 'revision') {
                $applicationForm->status = 'processing';
                $applicationForm->initial_approval_note = $request->approval_note;
                $applicationForm->approval_note = $request->approval_note;
                $applicationForm->initial_approved_by = $user->id; // First approver
                $applicationForm->initial_approved_at = now(); // First approval time
                $applicationForm->updated_by = $user->id;
            } elseif ($applicationForm->status === 'processing') {
                if ($action === 'reject') {
                    $applicationForm->status = 'rejected';
                    $applicationForm->final_approval_note = $request->approval_note;
                    $applicationForm->approval_note = $request->approval_note;
                    $applicationForm->approved_by = $user->id; // Final approver
                    $applicationForm->approved_at = now();
                    $applicationForm->final_approved_by = $user->id;
                    $applicationForm->final_approved_at = now();
                    $applicationForm->updated_by = $user->id;
                } elseif ($action === 'revision') {
                    // Send back to the first approver (initial_approved_by)
                    $firstApproverId = $applicationForm->initial_approved_by;
                    if (!$firstApproverId) {
                        $firstApproverId = $applicationForm->receive_id;
                    }
                    if (!$firstApproverId) {
                        $firstApproverId = $applicationForm->created_by;
                    }

                    if ($firstApproverId) {
                        $firstApprover = \App\Models\User::find($firstApproverId);
                        if ($firstApprover) {
                            $fromDepartmentId = $applicationForm->current_department_id;
                            $fromSectionId = $applicationForm->current_section_id;

                            // Set status to revision and re-assign to first approver
                            $applicationForm->status = 'revision';
                            $applicationForm->current_department_id = $firstApprover->department_id;
                            $applicationForm->current_section_id = $firstApprover->section_id;
                            $applicationForm->receive_id = $firstApprover->id; // Assigned directly without needing re-receive
                            $applicationForm->current_officer_id = $firstApprover->id;
                            $applicationForm->revision_note = $request->approval_note;
                            $applicationForm->note = $request->approval_note; // update last assignment note
                            $applicationForm->updated_by = $user->id;

                            // Create assignment record to show in history as received
                            \App\Models\ApplicationForm\ApplicationAssign::create([
                                'application_from_id' => $applicationForm->id,
                                'from_department_id' => $fromDepartmentId,
                                'from_section_id' => $fromSectionId,
                                'to_department_id' => $firstApprover->department_id,
                                'to_section_id' => $firstApprover->section_id,
                                'from_user_id' => $user->id,
                                'assigned_by' => $user->id,
                                'note' => $request->approval_note,
                                'is_received' => true,
                                'received_by' => $firstApprover->id,
                                'received_at' => now(),
                            ]);
                        }
                    }
                } else {
                    $applicationForm->status = 'approved';
                    $applicationForm->final_approval_note = $request->approval_note;
                    $applicationForm->approval_note = $request->approval_note;
                    $applicationForm->approved_by = $user->id; // Final approver
                    $applicationForm->approved_at = now();
                    $applicationForm->final_approved_by = $user->id;
                    $applicationForm->final_approved_at = now();
                    $applicationForm->updated_by = $user->id;
                }
            }
            $applicationForm->save();
        });

        if ($applicationForm->status === 'processing') {
            $message = 'Application status updated to processing.';
        } elseif ($applicationForm->status === 'revision') {
            $message = 'Application sent back for revision successfully.';
        } elseif ($applicationForm->status === 'rejected') {
            $message = 'Application rejected successfully.';
        } else {
            $message = 'Application approved successfully.';
        }

        return response()->json([
            'status' => true,
            'message' => $message,
        ], 200);
    }

    private function rules()
    {
        return [
            'date' => 'nullable|date',
            'recipient' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'nid_no' => 'nullable|string|max:30',
            'mobile' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'father_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'form_type' => 'nullable|string|max:100',
            'message' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ];
    }

    private function formFields()
    {
        return [
            'date',
            'recipient',
            'subject',
            'sender',
            'nid_no',
            'mobile',
            'address',
            'father_name',
            'email',
            'form_type',
            'message',
        ];
    }

    private function canViewAllApplications($user): bool
    {
        if (!$user) {
            return false;
        }

        return $user->can('application_form.read');
    }

    private function canCreateApplication($user): bool
    {
        if (!$user) {
            return false;
        }

        return $user->can('application_form.create');
    }

    private function applyDepartmentScope($query, $user): void
    {
        if (empty($user?->department_id)) {
            $query->whereRaw('1 = 0');
            return;
        }

        $query->where('current_department_id', $user->department_id);

        if (!empty($user->section_id)) {
            $query->where(function ($sectionQuery) use ($user) {
                $sectionQuery->whereNull('current_section_id')
                    ->orWhere('current_section_id', $user->section_id);
            });
        }
    }

    private function canAccessApplication($user, ApplicationFrom $applicationForm): bool
    {
        if (!$user) {
            return false;
        }

        if ($this->canViewAllApplications($user)) {
            return true;
        }

        if (empty($user->department_id) || empty($applicationForm->current_department_id)) {
            return false;
        }

        if ((int) $user->department_id !== (int) $applicationForm->current_department_id) {
            return false;
        }

        if (empty($user->section_id)) {
            return true;
        }

        if (!empty($applicationForm->current_section_id)) {
            return (int) $user->section_id === (int) $applicationForm->current_section_id;
        }

        return true;
    }

    private function canAssignApplication($user, ApplicationFrom $applicationForm): bool
    {
        if (!$user) {
            return false;
        } elseif ($applicationForm->status === 'revision') {
            return $user->can('application_form.update');
        } else {
            return $user->can('application_form.update') || $user->can('application_form.read');
        }

    }

    private function canReceiveApplication($user, ApplicationFrom $applicationForm): bool
    {
        if (!in_array($applicationForm->status, ['assigned', 'pending', 'revision'], true)) {
            return false;
        }

        if ($user->can('application_form.update')) {
            return true;
        }

        return $user->can('application_form.update');
    }

    private function canApproveApplication($user, ApplicationFrom $applicationForm): bool
    {
        if (!in_array($applicationForm->status, ['received', 'processing', 'revision'], true)) {
            return false;
        }

        if (!$user) {
            return false;
        }

        if ($applicationForm->status === 'processing') {
            return $user->can('application_form.delete');
        }

        if ($applicationForm->status === 'revision') {
            return $user->can('application_form.update');
        }

        // if ($this->canViewAllApplications($user)) {
        //     return true;
        // }

        return $user->can('application_form.update');
    }

}
