<?php

namespace App\Http\Controllers\ApplicationForm;

use App\Models\ApplicationForm\ApplicationFrom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ApplicationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicationForms = ApplicationFrom::latest()->get();
        return view('backend.pages.application-form.index', compact('applicationForms'));
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

        if ($request->hasFile('attachment')) {
            $applicationForm->attachment = $this->uploadFile('uploads/application-form/', $request->file('attachment'), $applicationForm->id);
        }

        $applicationForm->save();

        return response()->json([
            'status'  => true,
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
        $applicationForm = ApplicationFrom::findOrFail($id);
        return view('backend.pages.application-form.view', compact('applicationForm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $request->validate($this->rules());

        $applicationForm = ApplicationFrom::findOrFail($id);
        $applicationForm->fill($request->only($this->formFields()));
        $applicationForm->updated_by = optional(auth()->user())->id;

        if ($request->hasFile('attachment')) {
            $this->deleteAttachment($applicationForm->attachment);
            $applicationForm->attachment = $this->uploadAttachment($request->file('attachment'));
        }

        $applicationForm->save();

        return response()->json([
            'status'  => true,
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
        $this->deleteAttachment($applicationForm->attachment);
        $applicationForm->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Application Form Deleted Successfully!',
        ], 200);
    }

    private function rules()
    {
        return [
            'date'       => 'nullable|date',
            'recipient'  => 'required|string|max:255',
            'subject'    => 'required|string|max:255',
            'sender'     => 'required|string|max:255',
            'nid_no'     => 'nullable|string|max:30',
            'mobile'     => 'nullable|string|max:20',
            'message'    => 'nullable|string',
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
            'message',
        ];
    }

    private function uploadAttachment($file)
    {
        $directory = 'uploads/application-form/';
        $filename  = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        File::ensureDirectoryExists(public_path($directory));
        $file->move(public_path($directory), $filename);

        return $directory . $filename;
    }

    private function deleteAttachment($attachment)
    {
        if ($attachment && File::exists(public_path($attachment))) {
            File::delete(public_path($attachment));
        }
    }
}
