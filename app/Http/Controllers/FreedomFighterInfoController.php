<?php

namespace App\Http\Controllers;

use App\Models\People\FreedomFighterInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FreedomFighterInfoController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['user'] = User::with('freedomFighterInfo')->find($id);
        $data['religions'] = Religion::where('status', true)->get();
        return view('backend.pages.people.tabs.freedom', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validate = Validator::make($request->all(), [
                'user_id' => 'required',
                'is_freedom_fighter' => 'required',
                'type_id' => 'nullable',
                'area_id' => 'nullable',
                'designation_id' => 'nullable',
                'freedom_fighter_id' => 'nullable',
                'commander_name' => 'nullable',

            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $result = DB::transaction(function () use ($request) {

                try {
                    FreedomFighterInfo::updateOrCreate([
                        'user_id' => $request->user_id
                    ], [
                        'is_freedom_fighter' => $request->is_freedom_fighter ?? false,
                        'type_id' => $request->is_freedom_fighter ? $request->type_id : null,
                        'area_id' => $request->is_freedom_fighter ? $request->area_id : null,
                        'designation_id' => $request->is_freedom_fighter ? $request->designation_id : null,
                        'freedom_fighter_id' => $request->is_freedom_fighter ? $request->freedom_fighter_id : null,
                        'commander_name' => $request->is_freedom_fighter ? $request->commander_name : null
                    ]);

                    $data['status'] = true;
                    $data['message'] = "Freedom fighter information submitted successfully!";
                    $data['code'] = 200;
                    return $data;
                } catch (\Throwable $th) {
                    $data['status'] = false;
                    $data['message'] = "Freedom Fighter Information Save Failed!";
                    $data['code'] = 500;
                    $data['errors'] = $th;
                    return $data;
                }
            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\FreedomFighterInfo  $freedomFighterInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FreedomFighterInfo $freedomFighterInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\FreedomFighterInfo  $freedomFighterInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FreedomFighterInfo $freedomFighterInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\FreedomFighterInfo  $freedomFighterInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FreedomFighterInfo $freedomFighterInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\FreedomFighterInfo  $freedomFighterInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FreedomFighterInfo $freedomFighterInfo)
    {
        //
    }
}
