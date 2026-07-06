<?php

namespace App\Http\Controllers\License;

use App\Http\Controllers\Controller;
use App\Models\License\LicenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseCategoryController extends Controller
{
    public function index(\App\DataTables\BasicSettings\LicenseCategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.license.category.index');
    }

    public function create()
    {
        return view('backend.pages.license.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'en_name' => 'required|unique:license_categories,en_name',
            'bn_name' => 'required|unique:license_categories,bn_name',
        ]);

        LicenseCategory::create([
            'en_name' => $request->en_name,
            'bn_name' => $request->bn_name,
            'slug' => str_replace(' ', '-', $request->en_name),
            'status' => $request->has('status') ? (bool) $request->status : true,
            'created_by' => Auth::id(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'License Category Created Successfully!',
        ], 200);
    }

    public function show($id)
    {
        $category = LicenseCategory::findOrFail($id);
        return view('backend.pages.license.category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = LicenseCategory::findOrFail($id);
        return view('backend.pages.license.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'en_name' => 'required|unique:license_categories,en_name,' . $id,
            'bn_name' => 'required|unique:license_categories,bn_name,' . $id,
        ]);

        $category = LicenseCategory::findOrFail($id);
        $category->en_name = $request->en_name;
        $category->bn_name = $request->bn_name;
        $category->slug = str_replace(' ', '-', $request->en_name);
        $category->status = $request->has('status') ? (bool) $request->status : true;
        $category->updated_by = Auth::id();
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'License Category Updated Successfully!',
        ], 200);
    }

    public function destroy($id)
    {
        $subcategories = LicenseCategory::findOrFail($id);

        $subcategories->subcategories()->delete();

        $subcategories->delete();

        return response()->json([
            'status' => true,
            'message' => 'License Category Deleted Successfully!',
        ], 200);
    }
}
