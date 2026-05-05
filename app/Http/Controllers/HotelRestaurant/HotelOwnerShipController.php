<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelRestaurant\HotelOwnerShip;

class HotelOwnerShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ownership = HotelOwnerShip::latest()->get();
        return view('backend.pages.hotel-restaurant.ownership.index', compact('ownership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.hotel-restaurant.ownership.create');
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
            'en_name' => 'required|unique:hotel_categories,en_name',
            'bn_name' => 'required|unique:hotel_categories,bn_name',
        ]);

        $category             = new HotelOwnerShip();
        $category->en_name    = $request->en_name;
        $category->bn_name    = $request->bn_name;
        $category->status     = $request->status ? $request->status : true;
        $category->created_by = Auth()->user()->id;
        $category->slug       = str_replace(' ', '-', $request->en_name);
        $category->save();

        return response()->json([
            'status'  => true,
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
        $ownership = HotelOwnerShip::findOrFail($id);

        return view('backend.pages.hotel-restaurant.ownership.show', compact('ownership'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ownership = HotelOwnerShip::findOrFail($id);

        return view('backend.pages.hotel-restaurant.ownership.edit', compact('ownership'));
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

        $ownership             = HotelOwnerShip::findOrFail($id);
        $ownership->en_name    = $request->en_name;
        $ownership->bn_name    = $request->bn_name;
        $ownership->status     = $request->status ? $request->status : true;
        $ownership->updated_by = Auth()->user()->id;
        $ownership->slug       = str_replace(' ', '-', $request->en_name);
        $ownership->save();
        return response()->json([
            'status'  => true,
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
        $ownership = HotelOwnerShip::findOrFail($id);
        $ownership->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Hotel Ownership Deleted Successfully!',
        ], 200);
    }
}
