<?php

namespace App\Http\Controllers;

use App\Models\Bridge;
use Illuminate\Http\Request;

class BridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.bridge.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.bridge.create');
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
     * @param  \App\Models\Bridge  $bridge
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bridge  $bridge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.bridge.e');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bridge  $bridge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bridge $bridge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bridge  $bridge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bridge $bridge)
    {
        //
    }
}
