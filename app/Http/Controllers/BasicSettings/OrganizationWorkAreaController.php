<?php


namespace App\Http\Controllers\BasicSettings;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationSubCategory;
use App\Models\BasicSettings\OrganizationWorkArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrganizationWorkAreaController extends Controller
{
    public function options($id)
    {
        $areas = OrganizationWorkArea::where('organization_subcategory_id', $id)->get();

        $html = '<option value="">Select Work Area</option>';

        if(count($areas)){
            foreach ($areas as $area) {
                $html .='<option value="'.$area->id.'">'.$area->en_name.'</option>';
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
        $data['areas'] = OrganizationWorkArea::latest()->get();
        return view('backend.pages.basic.organization.work_area.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = OrganizationCategory::latest()->get();
        return view('backend.pages.basic.organization.work_area.create', $data);
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
            'organization_category_id' => 'required|integer|exists:organization_categories,id',
            'organization_subcategory_id' => 'required|integer|exists:organization_sub_categories,id',
            'en_name' => 'required',
            'bn_name' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $query = new OrganizationWorkArea();
        $query->organization_category_id = $request->organization_category_id;
        $query->organization_subcategory_id = $request->organization_subcategory_id;

        $query->en_name = $request->en_name;
        $query->bn_name = $request->bn_name;
        $query->slug = Str::slug($request->en_name, '-');
        $query->status = $request->status ? $request->status : true;
        $query->created_by = Auth::id();

        try {
            $query->save();
            $data['status'] = true;
            $data['message'] = "Organization Work Area Saved Successfully!";
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
     * @param  \App\Models\OrganizationWorkArea  $organizationWorkArea
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['area'] = OrganizationWorkArea::find($id);
        return view('backend.pages.basic.organization.work_area.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationWorkArea  $organizationWorkArea
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $data['categories'] = OrganizationCategory::latest()->get();
        $data['area'] = OrganizationWorkArea::find($id);
        $data['subcategories'] = OrganizationSubCategory::where('organization_category_id', $data['area']->organization_category_id )->get();
        return view('backend.pages.basic.organization.work_area.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationWorkArea  $organizationWorkArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'organization_category_id' => 'required|integer|exists:organization_categories,id',
            'organization_subcategory_id' => 'required|integer|exists:organization_sub_categories,id',            'en_name' => 'required',
            'bn_name' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $query = OrganizationWorkArea::find($id);

        if ($query) {
            $query->organization_category_id = $request->organization_category_id;
            $query->organization_subcategory_id = $request->organization_subcategory_id;
            $query->en_name = $request->en_name;
            $query->bn_name = $request->bn_name;
            $query->slug = Str::slug($request->en_name, '-');
            $query->status = $request->status ? $request->status : true;
            $query->created_by = Auth::id();

            try {
                $query->save();
                $data['status'] = true;
                $data['message'] = "Organization Work Area Updated Successfully!";
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
     * @param  \App\Models\OrganizationWorkArea  $organizationWorkArea
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = OrganizationWorkArea::find($id);
            if($query) {

                try {
                    $query->delete();
                    $data['status'] = true;
                    $data['message'] = "Organization Work Area Deleted successfully";
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
