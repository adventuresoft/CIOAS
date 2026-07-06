<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelRestaurant\HotelCategory;
use App\Models\HotelRestaurant\HotelSubCategory;
use App\Models\HotelRestaurant\HotelOwnerShip;
use Illuminate\Support\Facades\Auth;

class HotelCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\App\DataTables\BasicSettings\HotelCategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.hotel-restaurant.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.hotel-restaurant.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'en_name' => 'required|unique:hotel_categories,en_name',
            'bn_name' => 'required|unique:hotel_categories,bn_name',
        ]);

        $category = new HotelCategory();
        $category->en_name = $request->en_name;
        $category->bn_name = $request->bn_name;
        $category->status = $request->status ? $request->status : true;
        $category->created_by = Auth()->user()->id;
        $category->slug = str_replace(' ', '-', $request->en_name);
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Hotel Category Created Successfully!',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = HotelCategory::findOrFail($id);

        return view('backend.pages.hotel-restaurant.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = HotelCategory::findOrFail($id);
        return view('backend.pages.hotel-restaurant.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'en_name' => 'required|unique:hotel_categories,en_name,' . $id,
            'bn_name' => 'required|unique:hotel_categories,bn_name,' . $id,
        ]);

        $category = HotelCategory::findOrFail($id);
        $category->en_name = $request->en_name;
        $category->bn_name = $request->bn_name;
        $category->status = $request->status ? $request->status : true;
        $category->updated_by = Auth()->user()->id;
        $category->slug = str_replace(' ', '-', $request->en_name);
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Hotel Category Updated Successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = HotelCategory::findOrFail($id);

        $category->subCategory()->delete();
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Hotel Category Deleted Successfully!',
        ], 200);
    }
}
