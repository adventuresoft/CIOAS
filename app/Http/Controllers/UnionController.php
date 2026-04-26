<?php

namespace App\Http\Controllers;

use App\Models\Union;
use Illuminate\Http\Request;

class UnionController extends Controller
{

    public function unionsByThana(Request $request, $id)
    {
        $html = '<option value="">Select '.($request->id ? ucfirst($request->id) : '').' Union</option>';

        $unions = Union::where('thana_id', $id)->get();

        if(count($unions)) {
            foreach ($unions as $union) {
               $html .='<option value="'.$union->id.'">'.$union->name.'</option>';
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
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
    public function show(Union $union)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
    public function edit(Union $union)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Union $union)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Union  $union
     * @return \Illuminate\Http\Response
     */
    public function destroy(Union $union)
    {
        //
    }
}
