<?php

namespace App\Http\Controllers;

use App\Models\Mouza;
use Illuminate\Http\Request;

class MouzaController extends Controller
{

    public function mouzasByThana($thana_id)
    {
        $html = '<option value="">Select Mouza</option>';

        $mouzas = Mouza::where('thana_id', $thana_id)->get();

        if(count($mouzas)) {
            foreach ($mouzas as $mouza) {
               $html .='<option value="'.$mouza->id.'">'.$mouza->name.'</option>';
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
     * @param  \App\Models\Mouza  $mouza
     * @return \Illuminate\Http\Response
     */
    public function show(Mouza $mouza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mouza  $mouza
     * @return \Illuminate\Http\Response
     */
    public function edit(Mouza $mouza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mouza  $mouza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mouza $mouza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mouza  $mouza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mouza $mouza)
    {
        //
    }
}
