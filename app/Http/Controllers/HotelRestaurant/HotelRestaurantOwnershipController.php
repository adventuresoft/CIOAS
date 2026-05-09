<?php

namespace App\Http\Controllers\HotelRestaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelRestaurant\HotelRestaurant;
use App\Models\HotelRestaurant\HotelRestaurantOwnership;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\PostOffice;
use App\Models\UnionWard;
use App\Models\Religion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class HotelRestaurantOwnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'hotel_restaurant_id'      => 'required|integer',

            'name.*'                   => 'required|string|max:255',
            'bn_name.*'                => 'nullable|string|max:255',
            'date_of_birth.*'          => 'nullable|date',
            'birth_certificate.*'      => 'nullable|string',
            'nid.*'                    => 'nullable|string',
            'gender.*'                 => 'nullable|string',
            'religion.*'               => 'nullable|string',
            'blood_group.*'            => 'nullable|string',
            'mobile.*'                 => 'required|string|max:20',
            'email.*'                  => 'nullable|email',

            'father_name.*'            => 'nullable|string',
            'father_name_bn.*'         => 'nullable|string',
            'mother_name.*'            => 'nullable|string',
            'mother_name_bn.*'         => 'nullable|string',

            'permanent_division.*'     => 'nullable|string',
            'permanent_district.*'     => 'nullable|string',
            'permanent_thana.*'        => 'nullable|string',
            'permanent_post_office.*'  => 'nullable|string',
            'permanent_village_id.*'   => 'nullable',
            'permanent_ward_id.*'      => 'nullable',

            'present_division.*'       => 'nullable|string',
            'present_district_id.*'    => 'nullable',
            'present_thana_id.*'       => 'nullable',
            'present_post_office_id.*' => 'nullable',
            'present_village_id.*'     => 'nullable',
            'present_ward_id.*'        => 'nullable',
        ]);

        // dd($request->hotel_restaurant_id);


        foreach ($request->name as $key => $name) {


            HotelRestaurantOwnership::updateOrCreate(
                [
                    'id' => $request->owner_id[$key] ?? null
                ],
                [
                    'hotel_restaurant_id'    => $request->hotel_restaurant_id,

                    'name'                   => $request->name[$key] ?? null,
                    'bn_name'                => $request->bn_name[$key] ?? null,
                    'date_of_birth'          => $request->date_of_birth[$key] ?? null,
                    'birth_certificate'      => $request->birth_certificate[$key] ?? null,
                    'nid'                    => $request->nid[$key] ?? null,
                    'gender'                 => $request->gender[$key] ?? null,
                    'religion'               => $request->religion[$key] ?? null,
                    'blood_group'            => $request->blood_group[$key] ?? null,
                    'mobile'                 => $request->mobile[$key] ?? null,
                    'email'                  => $request->email[$key] ?? null,

                    'father_name'            => $request->father_name[$key] ?? null,
                    'father_name_bn'         => $request->father_name_bn[$key] ?? null,
                    'mother_name'            => $request->mother_name[$key] ?? null,
                    'mother_name_bn'         => $request->mother_name_bn[$key] ?? null,

                    'permanent_division'     => $request->permanent_division[$key] ?? null,
                    'permanent_district'     => $request->permanent_district[$key] ?? null,
                    'permanent_thana'        => $request->permanent_thana[$key] ?? null,
                    'permanent_post_office'  => $request->permanent_post_office[$key] ?? null,
                    'permanent_village_id'   => $request->permanent_village_id[$key] ?? null,
                    'permanent_ward_id'      => $request->permanent_ward_id[$key] ?? null,
                    'permanent_road'         => $request->permanent_road[$key] ?? null,
                    'permanent_house'        => $request->permanent_house[$key] ?? null,
                    'permanent_house_bn'     => $request->permanent_house_bn[$key] ?? null,

                    'present_division'       => $request->present_division[$key] ?? null,
                    'present_district_id'    => $request->present_district_id[$key] ?? null,
                    'present_thana_id'       => $request->present_thana_id[$key] ?? null,
                    'present_post_office_id' => $request->present_post_office_id[$key] ?? null,
                    'present_village_id'     => $request->present_village_id[$key] ?? null,
                    'present_ward_id'        => $request->present_ward_id[$key] ?? null,
                    'present_road'           => $request->present_road[$key] ?? null,
                    'present_house'          => $request->present_house[$key] ?? null,
                    'present_house_bn'       => $request->present_house_bn[$key] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['organization'] = HotelRestaurant::find($id);

        $data['ownerships'] = HotelRestaurantOwnership::where('hotel_restaurant_id', $data['organization']->id)->get();

        if ($data['ownerships']->count() > 0) {

            foreach ($data['ownerships'] as $key => $ownership) {

                $data['districts'][$key] = District::where('status', true)
                    ->where('division_id', $ownership->permanent_division)
                    ->get();

                $data['thanas'][$key] = Thana::where('status', true)
                    ->where('district_id', $ownership->permanent_district)
                    ->get();

                $data['present_districts'][$key] = District::where('status', true)
                        ->where('division_id', $ownership->present_division)
                        ->get();

                $data['present_thanas'][$key] = Thana::where('status', true)
                        ->where('district_id', $ownership->present_district_id)
                        ->get();

            }

        }

        $data['religions']      = Religion::where('status', true)->get();
        $data['divisions']      = Division::where('status', true)->get();
        $data['wards']          = UnionWard::where('status', true)->get();
        $data['post_officeses'] = PostOffice::latest()->get();
        // Load villages for the current user's institute
        $institute        = Institute::find(Auth::user()->institute_id);
        $data['villages'] = $institute ? Village::where('union_id', $institute->union_id)->get() : [];

        return view('backend.pages.hotel-restaurant.tabs.ownership', $data);
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