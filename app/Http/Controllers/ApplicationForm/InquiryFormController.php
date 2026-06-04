<?php

namespace App\Http\Controllers\ApplicationForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\InquiryDataTable;
use App\Models\Inquiry;

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
        $inquiry = \App\Models\Inquiry::findOrFail($id);
        return view('backend.pages.Inquiry.edit', compact('inquiry'));
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
            'status' => 'required|string',
            'comment' => 'nullable|string'
        ]);

        $inquiry->update([
            'status' => $request->status,
            'comment' => $request->comment
        ]);

        return response()->json([
            'message' => 'Inquiry status and comment updated successfully!',
            'redirect' => route('inquiry.formlist')
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
