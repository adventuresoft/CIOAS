<?php

namespace App\Http\Controllers\License;

use App\Http\Controllers\Controller;
use App\Models\License\LicenseCategory;
use App\Models\License\LicenseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseSubCategoryController extends Controller
{
    public function index(\App\DataTables\BasicSettings\LicenseSubCategoryDataTable $dataTable, $category_id)
    {
        return $dataTable->with('category_id', $category_id)->render('backend.pages.license.subcategory.index', compact('category_id'));
    }

    public function create($category_id)
    {
        return view('backend.pages.license.subcategory.create', compact('category_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_category_id' => 'required|exists:license_categories,id',
            'en_name'             => 'required',
            'bn_name'             => 'required',
        ]);

        LicenseSubCategory::create([
            'license_category_id' => $request->license_category_id,
            'en_name'             => $request->en_name,
            'bn_name'             => $request->bn_name,
            'slug'                => str_replace(' ', '-', $request->en_name),
            'status'              => $request->has('status') ? (bool) $request->status : true,
            'created_by'          => Auth::id(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'License Subcategory Created Successfully!',
        ], 200);
    }

    public function show($id)
    {
        $categories  = LicenseCategory::where('status', true)->latest()->get();
        $subcategory = LicenseSubCategory::findOrFail($id);
        return view('backend.pages.license.subcategory.show', compact('subcategory', 'categories'));
    }

    public function edit($id)
    {
        $categories  = LicenseCategory::where('status', true)->latest()->get();
        $subcategory = LicenseSubCategory::findOrFail($id);
        return view('backend.pages.license.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'license_category_id' => 'required|exists:license_categories,id',
            'en_name'             => 'required',
            'bn_name'             => 'required',
        ]);

        $subcategory                      = LicenseSubCategory::findOrFail($id);
        $subcategory->license_category_id = $request->license_category_id;
        $subcategory->en_name             = $request->en_name;
        $subcategory->bn_name             = $request->bn_name;
        $subcategory->slug                = str_replace(' ', '-', $request->en_name);
        $subcategory->status              = $request->has('status') ? (bool) $request->status : true;
        $subcategory->updated_by          = Auth::id();
        $subcategory->save();

        return response()->json([
            'status'  => true,
            'message' => 'License Subcategory Updated Successfully!',
        ], 200);
    }

    public function destroy($id)
    {
        LicenseSubCategory::findOrFail($id)->delete();

        return response()->json([
            'status'  => true,
            'message' => 'License Subcategory Deleted Successfully!',
        ], 200);
    }

    public function options($id)
    {
        $html = '<option value="">Select Subcategory</option>';

        $subcategories = LicenseSubCategory::where('license_category_id', $id)
            ->where('status', true)
            ->get();

        foreach ($subcategories as $subcategory) {
            $html .= '<option value="' . $subcategory->id . '">' . $subcategory->en_name . '</option>';
        }

        return $html;
    }
}
