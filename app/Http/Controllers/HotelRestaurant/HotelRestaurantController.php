<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationOwnershipType;
use App\Models\BasicSettings\OrganizationWorkArea;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\Union;
use App\Models\PostOffice;
use App\Models\HotelRestaurant\HotelRestaurant;
use App\Models\Organization\OrganizationType;
use App\Models\Organization\OrganizationOwnership;
use App\Models\Road;
use App\Models\People\AddressInfo;
use App\Models\User;
use App\Models\UnionWard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HotelRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['organizations'] = HotelRestaurant::with('category')->latest()->get();

        // dd($data);

        return view('backend.pages.HotelRestaurant.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types']           = OrganizationType::where('status', true)->latest()->get();
        $data['categories']      = OrganizationCategory::where('status', true)->latest()->get();
        $data['ownership_types'] = OrganizationOwnershipType::where('status', true)->latest()->get();
        $data['wards']           = UnionWard::where('status', true)->get();
        $data['roads']           = Road::where('institute_id', Auth::user()->institute_id)->get();
        $data['divisions']       = Division::where('status', true)->get();
        // dd($data['divisions']);

        $data['post_officeses'] = PostOffice::latest()->get();
        $institute              = Institute::find(Auth::user()->institute_id);
        if ($institute) {
            $data['villages'] = Village::where('union_id', $institute->union_id)->get();

        } else {
            $data['villages'] = [];
        }

        return view('backend.pages.HotelRestaurant.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
