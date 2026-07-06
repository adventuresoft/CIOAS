<?php

namespace App\Http\Controllers\License;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License\License;
use App\Models\LicenseOwnership;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\PostOffice;
use App\Models\UnionWard;
use App\Models\Union;
use App\Models\Pourashava;
use App\Models\CityCorporation;
use App\Models\Religion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use \App\Traits\FileUploadTrait;

class LicenseOwnershipController extends Controller
{

    use FileUploadTrait;
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
            'license_id'               => 'required|integer',

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
            'image.*'                  => 'nullable|image|max:2048',

            'father_name.*'            => 'nullable|string',
            'father_name_bn.*'         => 'nullable|string',
            'mother_name.*'            => 'nullable|string',
            'mother_name_bn.*'         => 'nullable|string',

            'permanent_division.*'     => 'nullable|string',
            'permanent_district.*'     => 'nullable|string',
            'permanent_thana.*'        => 'nullable|string',
            'permanent_post_office.*'  => 'nullable|string',
            'permanent_location_type.*'=> 'nullable|string',
            'permanent_city_id.*'      => 'nullable',
            'permanent_pos_id.*'       => 'nullable',
            'permanent_union_id.*'     => 'nullable',
            'permanent_village_id.*'   => 'nullable',
            'permanent_ward_id.*'      => 'nullable',

            'present_division.*'       => 'nullable|string',
            'present_district_id.*'    => 'nullable',
            'present_thana_id.*'       => 'nullable',
            'present_post_office_id.*' => 'nullable',
            'present_location_type.*'  => 'nullable|string',
            'present_city_id.*'        => 'nullable',
            'present_pos_id.*'         => 'nullable',
            'present_union_id.*'       => 'nullable',
            'present_village_id.*'     => 'nullable',
            'present_ward_id.*'        => 'nullable',
        ]);

        // dd($request->hotel_restaurant_id);


        $license = License::findOrFail($request->license_id);

        foreach ($request->name as $key => $name) {
            $ownerId   = $request->owner_id[$key] ?? null;
            $imagePath = null;
            $signaturePath = null;

            if ($ownerId && $ownershipRecord = LicenseOwnership::find($ownerId)) {
                $imagePath = $ownershipRecord->photo;
                $signaturePath = $ownershipRecord->signature;
            }

            if ($request->hasFile('image') && isset($request->file('image')[$key])) {
                $imageFile = $request->file('image')[$key];

                if ($imageFile) {
                    if (!empty($imagePath)) {
                        $this->deleteFile($imagePath);
                    }

                    $imagePath = $this->uploadFile(
                        $imageFile,
                        'uploads/license/ownership/photo/',
                        'owner_'
                    );
                }
            }

            if ($request->hasFile('signature') && isset($request->file('signature')[$key])) {
                $signatureFile = $request->file('signature')[$key];

                if ($signatureFile) {
                    if (!empty($signaturePath)) {
                        $this->deleteFile($signaturePath);
                    }

                    $signaturePath = $this->uploadFile(
                        $signatureFile,
                        'uploads/license/ownership/signature/',
                        'sign_'
                    );
                }
            }

            LicenseOwnership::updateOrCreate(
                [
                    'id' => $ownerId
                ],
                [
                    'application_id'         => $license->application_id, // Store the application_id of the license

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
                    'photo'                  => $imagePath,
                    'signature'              => $signaturePath,

                    'father_name'            => $request->father_name[$key] ?? null,
                    'father_name_bn'         => $request->father_name_bn[$key] ?? null,
                    'mother_name'            => $request->mother_name[$key] ?? null,
                    'mother_name_bn'         => $request->mother_name_bn[$key] ?? null,

                    'permanent_division'     => $request->permanent_division[$key] ?? null,
                    'permanent_district'     => $request->permanent_district[$key] ?? null,
                    'permanent_thana'        => $request->permanent_thana[$key] ?? null,
                    'permanent_post_office'  => $request->permanent_post_office[$key] ?? null,
                    'permanent_location_type'=> $request->permanent_location_type[$key] ?? null,
                    'permanent_city_id'      => $request->permanent_city_id[$key] ?? null,
                    'permanent_pos_id'       => $request->permanent_pos_id[$key] ?? null,
                    'permanent_union_id'     => $request->permanent_union_id[$key] ?? null,
                    'permanent_village_id'   => $request->permanent_village_id[$key] ?? null,
                    'permanent_ward_id'      => $request->permanent_ward_id[$key] ?? null,
                    'permanent_road'         => $request->permanent_road[$key] ?? null,
                    'permanent_house'        => $request->permanent_house[$key] ?? null,
                    'permanent_house_bn'     => $request->permanent_house_bn[$key] ?? null,

                    'present_division'       => $request->present_division[$key] ?? null,
                    'present_district_id'    => $request->present_district_id[$key] ?? null,
                    'present_thana_id'       => $request->present_thana_id[$key] ?? null,
                    'present_post_office_id' => $request->present_post_office_id[$key] ?? null,
                    'present_location_type'  => $request->present_location_type[$key] ?? null,
                    'present_city_id'        => $request->present_city_id[$key] ?? null,
                    'present_pos_id'         => $request->present_pos_id[$key] ?? null,
                    'present_union_id'       => $request->present_union_id[$key] ?? null,
                    'present_village_id'     => $request->present_village_id[$key] ?? null,
                    'present_ward_id'        => $request->present_ward_id[$key] ?? null,
                    'present_road'           => $request->present_road[$key] ?? null,
                    'present_house'          => $request->present_house[$key] ?? null,
                    'present_house_bn'       => $request->present_house_bn[$key] ?? null,
                ]
            );
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Saved successfully',
            ]);
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
        $data['organization'] = License::find($id);

        if (!$data['organization']) {
            return redirect()->back()->with('error', 'License not found');
        }

        $data['ownerships'] = LicenseOwnership::where('application_id', $data['organization']->application_id)->get();

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

                $data['post_officeses'][$key] = PostOffice::where('status', true)
                    ->where('thana_id', $ownership->permanent_thana)
                    ->get();

                $data['present_post_officeses'][$key] = PostOffice::where('status', true)
                    ->where('thana_id', $ownership->present_thana_id)
                    ->get();
                $data['cities'][$key] = CityCorporation::where('status', true)
                    ->where('district_id', $ownership->permanent_district)
                    ->get();

                $data['pourashavas'][$key] = Pourashava::where('status', true)
                    ->where('district_id', $ownership->permanent_district)
                    ->get();

                $data['unions'][$key] = Union::where('status', true)
                    ->where('thana_id', $ownership->permanent_thana)
                    ->get();

                $data['villages'][$key] = [];
                if ($ownership->permanent_location_type == 'city_type' && $ownership->permanent_city_id) {
                    $data['villages'][$key] = Village::where('city_id', $ownership->permanent_city_id)->get();
                } elseif ($ownership->permanent_location_type == 'pos_type' && $ownership->permanent_pos_id) {
                    $data['villages'][$key] = Village::where('pos_id', $ownership->permanent_pos_id)->get();
                } elseif ($ownership->permanent_location_type == 'union_type' && $ownership->permanent_union_id) {
                    $data['villages'][$key] = Village::where('union_id', $ownership->permanent_union_id)->get();
                }

                $data['present_cities'][$key] = CityCorporation::where('status', true)
                    ->where('district_id', $ownership->present_district_id)
                    ->get();

                $data['present_pourashavas'][$key] = Pourashava::where('status', true)
                    ->where('district_id', $ownership->present_district_id)
                    ->get();

                $data['present_unions'][$key] = Union::where('status', true)
                    ->where('thana_id', $ownership->present_thana_id)
                    ->get();

                $data['present_villages'][$key] = [];
                if ($ownership->present_location_type == 'city_type' && $ownership->present_city_id) {
                    $data['present_villages'][$key] = Village::where('city_id', $ownership->present_city_id)->get();
                } elseif ($ownership->present_location_type == 'pos_type' && $ownership->present_pos_id) {
                    $data['present_villages'][$key] = Village::where('pos_id', $ownership->present_pos_id)->get();
                } elseif ($ownership->present_location_type == 'union_type' && $ownership->present_union_id) {
                    $data['present_villages'][$key] = Village::where('union_id', $ownership->present_union_id)->get();
                }
            }

        } else {
            $data['post_officeses'] = [];
            $data['present_post_officeses'] = [];
        }

        $data['religions']      = Religion::where('status', true)->get();
        $data['divisions']      = Division::where('status', true)->get();
        $data['wards']          = \App\Models\Ward::all();

        return view('backend.pages.license.ownership.edit', $data);
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

