<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\BirthCertificate;
use Illuminate\Http\Request;

class BirthCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('unionAdmin')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.certificate.birth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.certificate.birth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate\BirthCertificate  $birthCertificate
     * @return \Illuminate\Http\Response
     */
    public function show(BirthCertificate $birthCertificate)
    {
        return view('backend.pages.certificate.birth.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\BirthCertificate  $birthCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(BirthCertificate $birthCertificate)
    {
        return view('backend.pages.certificate.birth.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\BirthCertificate  $birthCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BirthCertificate $birthCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\BirthCertificate  $birthCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(BirthCertificate $birthCertificate)
    {
        //
    }
}
