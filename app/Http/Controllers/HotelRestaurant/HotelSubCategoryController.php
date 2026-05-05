<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelRestaurant\HotelCategory;
use App\Models\HotelRestaurant\HotelSubCategory;
use App\Models\HotelRestaurant\HotelOwnerShip;
use Illuminate\Support\Facades\Auth;

class HotelSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = HotelSubCategory::latest()->get();
        return view('backend.pages.hotel-restaurant.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = HotelCategory::latest()->get();

        return view('backend.pages.hotel-restaurant.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'en_name'           => 'required',
            'bn_name'           => 'required',
            'hotel_category_id' => 'required',
        ]);

        $subcategory                    = new HotelSubCategory();
        $subcategory->en_name           = $request->en_name;
        $subcategory->bn_name           = $request->bn_name;
        $subcategory->hotel_category_id = $request->hotel_category_id;
        $subcategory->created_by        = Auth::user()->id;
        $subcategory->slug              = str_replace(' ', '-', $request->en_name);
        $subcategory->save();

        return response()->json([
            'status'  => true,
            'message' => 'Hotel SubCategory Created Successfully!',
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
        $categories  = HotelCategory::latest()->get();
        $subcategory = HotelSubCategory::findOrFail($id);
        return view('backend.pages.hotel-restaurant.subcategory.show', compact('subcategory', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories  = HotelCategory::latest()->get();
        $subcategory = HotelSubCategory::findOrFail($id);
        return view('backend.pages.hotel-restaurant.subcategory.edit', compact('subcategory', 'categories'));
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
            'en_name'           => 'required',
            'bn_name'           => 'required',
            'hotel_category_id' => 'required',
        ]);

        $subcategory                    = HotelSubCategory::findOrFail($id);
        $subcategory->en_name           = $request->en_name;
        $subcategory->bn_name           = $request->bn_name;
        $subcategory->hotel_category_id = $request->hotel_category_id;
        $subcategory->updated_by        = Auth::user()->id;
        $subcategory->slug              = str_replace(' ', '-', $request->en_name);
        $subcategory->save();

        return response()->json([
            'status'  => true,
            'message' => 'Hotel SubCategory Updated Successfully!',
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
        $subcategory = HotelSubCategory::findOrFail($id);
        $subcategory->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Hotel SubCategory Deleted Successfully!',
        ], 200);
    }
}
