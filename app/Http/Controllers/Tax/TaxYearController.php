<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Models\Tax\TaxYear;
use Illuminate\Http\Request;

class TaxYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.tax.year.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.tax.year.create');
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
     * @param  \App\Models\Tax\TaxYear  $taxYear
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.tax.year.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax\TaxYear  $taxYear
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.tax.year.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax\TaxYear  $taxYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxYear $taxYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax\TaxYear  $taxYear
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
