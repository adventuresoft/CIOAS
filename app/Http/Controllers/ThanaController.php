<?php

namespace App\Http\Controllers;

use App\Models\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{

    public function thanasByDistrict(Request $request, $id)
    {
        $html = '<option value="">Select '.($request->id ? ucfirst($request->id) : '').' Thana</option>';

        $thanas = Thana::where('district_id', $id)->get();

        if(count($thanas)) {
            foreach ($thanas as $thana) {
               $html .='<option value="'.$thana->id.'">'.$thana->name.'</option>';
            }
        }

        return $html;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thana  $thana
     * @return \Illuminate\Http\Response
     */
    public function show(Thana $thana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thana  $thana
     * @return \Illuminate\Http\Response
     */
    public function edit(Thana $thana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thana  $thana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thana $thana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thana  $thana
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thana $thana)
    {
        //
    }
}
