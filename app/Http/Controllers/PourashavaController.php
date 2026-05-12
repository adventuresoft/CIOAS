<?php

namespace App\Http\Controllers;

use App\Models\Pourashava;
use Illuminate\Http\Request;

class PourashavaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function pourashavaByDistrict(Request $request, $id)
    {
        $Pourashavas = Pourashava::where('district_id', $id)->get();
        $html        = '<option value="0">Select Pourashava</option>';
        if (count($Pourashavas)) {
            foreach ($Pourashavas as $pourashava) {
                $html .= '<option value="' . $pourashava->id . '">' . $pourashava->name . '</option>';
            }
        }
        return $html;

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
     * @param  \App\Models\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function show(Pourashava $pourashava)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function edit(Pourashava $pourashava)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pourashava $pourashava)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pourashava  $pourashava
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pourashava $pourashava)
    {
        //
    }
}
