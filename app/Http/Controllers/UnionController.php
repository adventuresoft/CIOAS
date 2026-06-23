<?php

namespace App\Http\Controllers;

use App\Models\Union;
use App\Models\Thana;
use App\Models\District;
use App\Models\Division;
use App\DataTables\UnionDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UnionController extends Controller
{

    public function unionsByThana(Request $request, $id)
    {
        $html = '<option value="0">Select ' . ($request->id ? ucfirst($request->id) : '') . ' Union</option>';

        $unions = Union::where('thana_id', $id)->get();

        if (count($unions)) {
            foreach ($unions as $union) {
                $html .= '<option value="' . $union->id . '">' . $union->bn_name . '</option>';
            }
        }

        return $html;
    }
    public function index(UnionDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.basic.union.index');
    }

    public function create()
    {
        $data['divisions'] = Division::latest()->get();
        return view('backend.pages.basic.union.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name'        => 'required|max:255',
                'bn_name'     => 'required|max:255',
                'thana_id'    => 'required|exists:thanas,id',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $union              = new Union();
            $union->name        = $request->name;
            $union->bn_name     = $request->bn_name;
            $union->url         = Str::slug($request->name);
            $union->thana_id    = $request->thana_id;
            $union->status      = $request->status;
            $union->created_by  = Auth::id();
            
            if ($union->save()) {
                $data['status']  = true;
                $data['message'] = "Union Created Successfully!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
            } else {
                $data['status']  = false;
                $data['message'] = "Failed to save data!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
            }
        } catch (\Exception $e) {
            $data['status']  = false;
            $data['message'] = $e->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function show(Union $union)
    {
        //
    }

    public function edit($id)
    {
        $data['union']  = Union::with('thana.district')->find($id);
        $data['divisions'] = Division::latest()->get();
        
        $data['districts'] = District::where('division_id', $data['union']->thana->district->division_id ?? 0)->get();
        $data['thanas'] = Thana::where('district_id', $data['union']->thana->district_id ?? 0)->get();
        
        return view('backend.pages.basic.union.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name'        => 'required|max:255',
                'bn_name'     => 'required|max:255',
                'thana_id'    => 'required|exists:thanas,id',
                'status'      => 'required|in:0,1',
            ]);

            if ($validate->fails()) {
                $data['status']  = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors']  = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $union = Union::find($id);

            if ($union) {
                $union->name        = $request->name;
                $union->bn_name     = $request->bn_name;
                $union->url         = Str::slug($request->name);
                $union->thana_id    = $request->thana_id;
                $union->status      = $request->status;

                if ($union->save()) {
                    $data['status']  = true;
                    $data['message'] = "Union Updated Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Failed to save data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Union Not Found!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Exception $e) {
            $data['status']  = false;
            $data['message'] = $e->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    public function destroy($id)
    {
        try {
            $union = Union::find($id);

            if ($union) {
                if ($union->delete()) {
                    $data['status']  = true;
                    $data['message'] = "Union Deleted Successfully!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 200)->header('Content-Type', 'application/json');
                } else {
                    $data['status']  = false;
                    $data['message'] = "Failed to delete data!";
                    return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
                }
            } else {
                $data['status']  = false;
                $data['message'] = "Union Not Found!";
                return response(json_encode($data, JSON_PRETTY_PRINT), 404)->header('Content-Type', 'application/json');
            }
        } catch (\Exception $e) {
            $data['status']  = false;
            $data['message'] = $e->getMessage();
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }
}