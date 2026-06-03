<?php

namespace App\Http\Controllers\ApplicationForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        \App\Models\Inquiry::create($data);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
