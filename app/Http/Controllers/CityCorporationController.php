<?php

namespace App\Http\Controllers;

use App\Models\CityCorporation;
use Illuminate\Http\Request;

class CityCorporationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cityByDistrict(Request $request, $id)
    {

        $city_ids = CityCorporation::where('district_id', $id)->get();

        $html = '<option value="">Select City Corporation</option>';

        if (count($city_ids)) {
            foreach ($city_ids as $city) {
                $html .= '<option value="' . $city->id . '">' . $city->bn_name . '</option>';
            }
        }

        return $html;

    }
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
     * @param  \App\Models\CityCorporation  $cityCorporation
     * @return \Illuminate\Http\Response
     */
    public function show(CityCorporation $cityCorporation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CityCorporation  $cityCorporation
     * @return \Illuminate\Http\Response
     */
    public function edit(CityCorporation $cityCorporation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CityCorporation  $cityCorporation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CityCorporation $cityCorporation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CityCorporation  $cityCorporation
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityCorporation $cityCorporation)
    {
        //
    }


}
