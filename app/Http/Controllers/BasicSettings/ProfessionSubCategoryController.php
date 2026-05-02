<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Profession;
use App\Models\BasicSettings\ProfessionCategory;
use App\Models\BasicSettings\ProfessionSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfessionSubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except('professionSubcategoryOptions');
    }

    public function professionSubcategoryOptions($id)
    {
        $html = '<option value="">Select Profession Category</option>';

        $subcategories = ProfessionSubCategory::where('profession_category_id', $id)->get();
        if(count($subcategories)){
            foreach ($subcategories as $subcategory) {
                $html .= '<option value="'.$subcategory->id.'">'.$subcategory->en_name.'</option>';
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
        $data['subcategories'] = ProfessionSubCategory::with(array('category'=>function($q1){
            $q1->with(array('type'=>function($q2){
                $q2->with('profession');
            }));
        }))->latest()->get();
        return view('backend.pages.basic.profession.subcategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['professions'] = Profession::get();
        return view('backend.pages.basic.profession.subcategory.create', $data);
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
                'profession_category_id' => 'required|integer|exists:profession_categories,id',
                'en_name' => 'required',
                'bn_name' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = new ProfessionSubCategory();
                $query->profession_category_id = $request->profession_category_id;
                $query->en_name = $request->en_name;
                $query->bn_name = $request->bn_name;
                $query->slug = Str::slug($request->en_name, '-');
                $query->status = $request->status ? $request->status : true;
                $query->created_by = Auth::id();

                if ($query->save()) {
                    $data['status'] = true;
                    $data['message'] = "Profession Subcategory Saved Successfully!";
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
     * @param  \App\Models\ProfessionSubCategory  $professionSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.profession.subcategory.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfessionSubCategory  $professionSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['subcategory'] = ProfessionSubCategory::with(array('category'=>function($q1){
            $q1->with(array('type' => function($q2){
                $q2->with('profession');
            }));
        }))->find($id);
        $data['professions'] = Profession::get();
        return view('backend.pages.basic.profession.subcategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfessionSubCategory  $professionSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'profession_category_id' => 'required|integer|exists:profession_categories,id',
                'en_name' => 'required',
                'bn_name' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = ProfessionSubCategory::find($id);

                if ($query) {
                    $query->profession_category_id = $request->profession_category_id;
                    $query->en_name = $request->en_name;
                    $query->bn_name = $request->bn_name;
                    $query->slug = Str::slug($request->en_name, '-');
                    $query->status = $request->status ? $request->status : true;
                    $query->created_by = Auth::id();

                    if ($query->save()) {
                        $data['status'] = true;
                        $data['message'] = "Profession Subcategory Updated Successfully!";
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
     * @param  \App\Models\ProfessionSubCategory  $professionSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = ProfessionSubCategory::find($id);
            if($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Profession Subcategory Deleted successfully";
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
