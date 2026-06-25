<?php

namespace App\Http\Controllers;

use App\Models\InstituteCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstituteCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\App\DataTables\InstituteCategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.institute.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.institute.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $category              = new InstituteCategory();
        $category->name        = $request->name;
        $category->description = $request->description;
        $category->status      = $request->status ?? 1;
        $category->save();

        return response()->json([
            'status'  => true,
            'message' => 'Institute Category created successfully.',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $category = InstituteCategory::find($id);

        if (!$category) {
            return response()->json([
                'status'  => false,
                'message' => 'Institute Category not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $category,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $category = InstituteCategory::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Institute Category not found.');
        }

        return view('backend.pages.institute.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status'      => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $category = InstituteCategory::find($id);

        if (!$category) {
            return response()->json([
                'status'  => false,
                'message' => 'Institute Category not found.',
            ], 404);
        }

        $category->name        = $request->name;
        $category->description = $request->description;
        $category->status      = $request->status;
        $category->save();

        return response()->json([
            'status'  => true,
            'message' => 'Institute Category updated successfully.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = InstituteCategory::find($id);

        if (!$category) {
            return response()->json([
                'status'  => false,
                'message' => 'Institute Category not found.',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Institute Category deleted successfully.',
        ], 200);
    }
}