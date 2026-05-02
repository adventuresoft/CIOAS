<?php

namespace App\Http\Controllers;

use App\Models\CityCorporation;
use App\Models\Pourashava;
use App\Models\ProjectType;
use App\Models\Thana;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function projectTypeContent(Request $request)
    {
        $institute_type = $request->institute_type;
        $district_id = $request->district_id;

        switch ($institute_type) {
            case 1:
                $data['thanas'] = Thana::where('district_id', $district_id)->get();
                return view('authenticate.pages.load.union', $data);
                break;

            case 2:
                $data['pourashavas'] = Pourashava::where('district_id', $district_id)->get();
                return view('authenticate.pages.load.pourashava', $data);
                break;

            case 3:
                $data['city_corporations'] = CityCorporation::where('district_id', $district_id)->get();
                return view('authenticate.pages.load.city_corporation', $data);
                break;
            
            default:
                return false;
                break;
        }
    }

    public function backendProjectTypeContent(Request $request)
    {
        $institute_type = $request->institute_type;
        $district_id = $request->district_id;

        switch ($institute_type) {
            case 1:
                $data['thanas'] = Thana::where('district_id', $district_id)->get();
                return view('backend.pages.institute.load.union', $data);
                break;

            case 2:
                $data['pourashavas'] = Pourashava::where('district_id', $district_id)->get();
                return view('backend.pages.institute.load.pourashava', $data);
                break;

            case 3:
                $data['city_corporations'] = CityCorporation::where('district_id', $district_id)->get();
                return view('backend.pages.institute.load.city_corporation', $data);
                break;
            
            default:
                return false;
                break;
        }
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
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectType $projectType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectType $projectType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectType $projectType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectType $projectType)
    {
        //
    }
}
