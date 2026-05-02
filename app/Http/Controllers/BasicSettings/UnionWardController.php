<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\UnionWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UnionWardController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['wards'] = UnionWard::latest()->get();
        return view('backend.pages.basic.ward.union.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.basic.ward.union.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'en_ward_no' => 'required|integer|unique:city_corporation_wards,en_ward_no',
                'bn_ward_no' => 'required|unique:city_corporation_wards,bn_ward_no',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }


                $ward = new UnionWard();
                $ward->en_ward_no = $request->en_ward_no;
                $ward->bn_ward_no = $request->bn_ward_no;
                $ward->status = $request->status ? $request->status : true;
                $ward->created_by = Auth::id();

                if ($ward->save()) {
                    $data['status'] = true;
                    $data['message'] = "Union Ward Saved Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnionWard  $unionWard
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.ward.union.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnionWard  $unionWard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['ward'] = UnionWard::find($id);
        return view('backend.pages.basic.ward.union.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnionWard  $unionWard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'en_ward_no' => 'required|integer|unique:city_corporation_wards,en_ward_no,'. $id,
                'bn_ward_no' => 'required|unique:city_corporation_wards,bn_ward_no,'. $id,
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }


                $ward =  UnionWard::find($id);

                if($ward) {
                    $ward->en_ward_no = $request->en_ward_no;
                    $ward->bn_ward_no = $request->bn_ward_no;
                    $ward->status = $request->status ? $request->status : true;
                    $ward->updated_by = Auth::id();
    
                    if ($ward->save()) {
                        $data['status'] = true;
                        $data['message'] = "Union Ward Updated Successfully!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Failed to save data!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Ward not found!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
                }

               

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnionWard  $unionWard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ward = UnionWard::find($id);
            if($ward) {
                if ($ward->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Union Ward Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            }else {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }
}
