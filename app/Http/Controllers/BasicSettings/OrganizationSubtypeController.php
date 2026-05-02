<?php

namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\Organization\OrganizationSubtype;
use App\Models\Organization\OrganizationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrganizationSubtypeController extends Controller
{
    public function options($id)
    {
        $types = OrganizationSubtype::where('organization_type_id', $id)->get();
        $html = '<option value="">Select Subtype</option>';
        if (count($types)) {
            foreach ($types as $type) {
                $html .='<option value="'.$type->id.'">'.$type->en_name.'</option>';
            }
        }

        return $html;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['organization_subtypes'] = OrganizationSubtype::with('subtype')->latest()->get();
        return view('backend.pages.basic.organization.subtype.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['types'] = OrganizationType::where('status', true)->get();
        return view('backend.pages.basic.organization.subtype.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'organization_type_id' => 'required|integer|exists:organization_types,id',
            'en_name' => 'required',
            'bn_name' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Validation failed! Please check your inputs...";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $query = new OrganizationSubtype();
        $query->organization_type_id = $request->organization_type_id;
        $query->en_name = $request->en_name;
        $query->bn_name = $request->bn_name;
        $query->slug = Str::slug($request->en_name, '-');
        $query->status = $request->status ? $request->status : true;
        $query->created_by = Auth::id();

        try {
            $query->save();
            $data['status'] = true;
            $data['message'] = "Organization Subtype Saved Successfully!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization\OrganizationSubtype  $organizationSubtype
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationSubtype $organizationSubtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization\OrganizationSubtype  $organizationSubtype
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $data['subtype'] = OrganizationSubtype::find($id);
        $data['types'] = OrganizationType::where('status', true)->get();
        return view('backend.pages.basic.organization.subtype.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization\OrganizationSubtype  $organizationSubtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validate = Validator::make($request->all(), [
            'organization_type_id' => 'required|integer|exists:organization_types,id',
            'en_name' => 'required',
            'bn_name' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Validation failed! Please check your inputs...";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $query = OrganizationSubtype::find($id);

        if ($query) {
            $query->organization_type_id = $request->organization_type_id;
            $query->en_name = $request->en_name;
            $query->bn_name = $request->bn_name;
            $query->slug = Str::slug($request->en_name, '-');
            $query->status = $request->status ? $request->status : true;
            $query->created_by = Auth::id();

            try {
                $query->save();
                $data['status'] = true;
                $data['message'] = "Organization Subtype Updated Successfully!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th;
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } else {
            $data['status'] = false;
            $data['message'] = "Not found!";
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization\OrganizationSubtype  $organizationSubtype
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $query = OrganizationSubtype::find($id);
            if($query) {

                try {
                    $query->delete();
                    $data['status'] = true;
                    $data['message'] = "Organization Subcategory Deleted successfully";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } catch (\Throwable $th) {
                    $data['status'] = false;
                    $data['message'] = "Something went wrong! Please try again...";
                    $data['errors'] = $th;
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }


            }else {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
       
    }
}
