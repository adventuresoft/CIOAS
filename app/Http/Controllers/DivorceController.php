<?php

namespace App\Http\Controllers;

use App\Models\Divorce;
use Illuminate\Http\Request;

class DivorceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.divorce.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.divorce.create');
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
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.divorce.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.divorce.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divorce  $divorce
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
