<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Models\Tax\TaxRate;
use Illuminate\Http\Request;

class TaxRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.tax.rate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.tax.rate.create');
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
     * @param  \App\Models\Tax\TaxRate  $taxRate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.tax.rate.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax\TaxRate  $taxRate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.tax.rate.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax\TaxRate  $taxRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax\TaxRate  $taxRate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
