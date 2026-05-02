<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\ProfessionCategory;
use App\Models\BasicSettings\ProfessionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfessionCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except('professionCategoryOptions');
    }


    public function professionCategoryOptions($id)
    {
        $html = '<option value="">Select Profession Category</option>';

        $categories = ProfessionCategory::where('profession_type_id', $id)->get();
        if(count($categories)){
            foreach ($categories as $category) {
                $html .= '<option value="'.$category->id.'">'.$category->en_name.'</option>';
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
        $data['categories'] = ProfessionCategory::with(array('type' => function ($q1) {
            $q1->with('profession');
        }))->latest()->get();
        return view('backend.pages.basic.profession.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types'] = ProfessionType::with('profession')->where('status', true)->get();
        return view('backend.pages.basic.profession.category.create', $data);
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
            'profession_type_id' => 'required|integer|exists:profession_types,id',
            'en_name' => 'required',
            'bn_name' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }
        try {
            $query = new ProfessionCategory();
            $query->profession_type_id = $request->profession_type_id;
            $query->en_name = $request->en_name;
            $query->bn_name = $request->bn_name;
            $query->slug = Str::slug($request->en_name, '-');
            $query->status = $request->status ? $request->status : true;
            $query->created_by = Auth::id();

            if ($query->save()) {
                $data['status'] = true;
                $data['message'] = "Profession category Saved Successfully!";
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
     * @param  \App\Models\ProfessionCategory  $professionCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.profession.category.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfessionCategory  $professionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = ProfessionCategory::find($id);
        $data['types'] = ProfessionType::with('profession')->where('status', true)->get();
        return view('backend.pages.basic.profession.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfessionCategory  $professionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            'profession_type_id' => 'required|integer|exists:profession_types,id',
            'en_name' => 'required',
            'bn_name' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }
        try {
            $query = ProfessionCategory::find($id);

            if ($query) {
                $query->profession_type_id = $request->profession_type_id;
                $query->en_name = $request->en_name;
                $query->bn_name = $request->bn_name;
                $query->slug = Str::slug($request->en_name, '-');
                $query->status = $request->status ? $request->status : true;
                $query->created_by = Auth::id();

                if ($query->save()) {
                    $data['status'] = true;
                    $data['message'] = "Profession Category Updated Successfully!";
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
     * @param  \App\Models\ProfessionCategory  $professionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = ProfessionCategory::find($id);
            if ($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Profession Category Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
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
