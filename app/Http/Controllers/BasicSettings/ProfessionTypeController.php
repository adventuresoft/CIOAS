<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Profession;
use App\Models\BasicSettings\ProfessionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfessionTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except('professionTypeOptions');
    }

    public function professionTypeOptions($id)
    {
        $html = '<option value="">Select Profession Type</option>';

        $types = ProfessionType::where('profession_id', $id)->get();
        if(count($types)){
            foreach ($types as $type) {
                $html .= '<option value="'.$type->id.'">'.$type->en_name.'</option>';
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
        $data['types'] = ProfessionType::with('profession')->get();
        return view('backend.pages.basic.profession.type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['professions'] = Profession::get();
        return view('backend.pages.basic.profession.type.create', $data);
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
                'profession_id' => 'required|exists:professions,id',
                'en_name' => 'required|unique:profession_types,en_name',
                'bn_name' => 'required|unique:profession_types,bn_name',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }
            try {

                $query = new ProfessionType();
                $query->profession_id = $request->profession_id;
                $query->en_name = $request->en_name;
                $query->bn_name = $request->bn_name;
                $query->slug = Str::slug($request->en_name, '-');
                $query->status = $request->status ? $request->status : true;
                $query->created_by = Auth::id();

                if ($query->save()) {
                    $data['status'] = true;
                    $data['message'] = "Profession Type Saved Successfully!";
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
     * @param  \App\Models\ProfessionType  $professionType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.profession.type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfessionType  $professionType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['type'] = ProfessionType::find($id);
        $data['professions'] = Profession::get();
        return view('backend.pages.basic.profession.type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfessionType  $professionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'profession_id' => 'required|exists:professions,id',
                'en_name' => 'required|unique:profession_types,en_name,'. $id,
                'bn_name' => 'required|unique:profession_types,bn_name,'. $id,
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = ProfessionType::find($id);

                if ($query) {
                    $query->profession_id = $request->profession_id;
                    $query->en_name = $request->en_name;
                    $query->bn_name = $request->bn_name;
                    $query->slug = Str::slug($request->en_name, '-');
                    $query->status = $request->status ? $request->status : true;
                    $query->updated_by = Auth::id();

                    if ($query->save()) {
                        $data['status'] = true;
                        $data['message'] = "Profession Type Updated Successfully!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                    } else {
                        $data['status'] = false;
                        $data['message'] = "Failed to save data!";
                        return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                    }
                } else {
                    $data['status'] = false;
                    $data['message'] = "Not found!";
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfessionType  $professionType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = ProfessionType::find($id);
            if($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Profession Type Deleted successfully";
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
