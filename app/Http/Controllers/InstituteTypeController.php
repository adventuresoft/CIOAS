<?php

namespace App\Http\Controllers;

use App\Models\InstituteType;
use Illuminate\Http\Request;

class InstituteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.institute.type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.institute.type.index');
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
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.institute.type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.institute.type.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
