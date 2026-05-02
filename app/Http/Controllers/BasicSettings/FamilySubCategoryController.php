<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\FamilyCategory;
use App\Models\BasicSettings\FamilySubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class FamilySubCategoryController extends Controller
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
        $data['subcategories'] = FamilySubCategory::with('category')->latest()->get();
        return view('backend.pages.basic.family.subcategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = FamilyCategory::where('status', true)->get();
        return view('backend.pages.basic.family.subcategory.create', $data);
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
                'family_category_id' => 'required|integer|exists:family_categories,id',
                'en_name' => 'required|unique:family_sub_categories,en_name',
                'bn_name' => 'required|unique:family_sub_categories,bn_name',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = new FamilySubCategory();
                $query->family_category_id = $request->family_category_id;
                $query->en_name = $request->en_name;
                $query->bn_name = $request->bn_name;
                $query->slug = Str::slug($request->en_name, '-');
                $query->status = $request->status ? $request->status : true;
                $query->created_by = Auth::id();

                if ($query->save()) {
                    $data['status'] = true;
                    $data['message'] = "Family Subcategory Saved Successfully!";
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
     * @param  \App\Models\FamilySubCategory  $familySubCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.basic.family.subcategory.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilySubCategory  $familySubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['subcategory'] = FamilySubCategory::find($id);
        $data['categories'] = FamilyCategory::where('status', true)->get();
        return view('backend.pages.basic.family.subcategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilySubCategory  $familySubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'family_category_id' => 'required|integer|exists:family_categories,id',
                'en_name' => 'required|unique:family_categories,en_name,'. $id,
                'bn_name' => 'required|unique:family_categories,bn_name,'. $id,
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

                $query = FamilySubCategory::find($id);

                if ($query) {
                    $query->family_category_id = $request->family_category_id;
                    $query->en_name = $request->en_name;
                    $query->bn_name = $request->bn_name;
                    $query->slug = Str::slug($request->en_name, '-');
                    $query->status = $request->status ? $request->status : true;
                    $query->created_by = Auth::id();

                    if ($query->save()) {
                        $data['status'] = true;
                        $data['message'] = "Family Subcategory Updated Successfully!";
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
     * @param  \App\Models\FamilySubCategory  $familySubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = FamilySubCategory::find($id);
            if($query) {
                if ($query->delete()) {
                    $data['status'] = true;
                    $data['message'] = "Family Subcategory Deleted successfully";
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
