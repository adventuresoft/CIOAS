<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelRestaurant\HotelCategory;
use App\Models\HotelRestaurant\HotelSubCategory;
use App\Models\HotelRestaurant\HotelOwnerShip;

class HotelCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = HotelCategory::latest()->get();
        return view('backend.pages.hotel-restaurant.category.index', compact('categories'));
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

        dd($request->all());

        // $request->validate([
        //     'en_name' => 'required|unique:hotel_categories,en_name',
        //     'bn_name' => 'required|unique:hotel_categories,bn_name',
        // ]);

        // $category          = new HotelCategory();
        // $category->en_name = $request->en_name;
        // $category->bn_name = $request->bn_name;
        // $category->status  = $request->status ? $request->status : true;
        // $category->save();

        // return response()->json([
        //     'status'  => true,
        //     'message' => 'Hotel Category Created Successfully!',
        // ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
