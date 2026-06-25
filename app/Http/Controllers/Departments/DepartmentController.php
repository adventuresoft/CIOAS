<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department\Department;
use App\DataTables\BasicSettings\DepartmentDataTable;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentDataTable $dataTable)
    {
        return $dataTable->render("backend.pages.basic.department.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.pages.basic.department.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'bn_name' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors' => $validator->errors(),
            ], 400);
        }

        $department = new Department();

        $department->name = $request->name;
        $department->bn_name = $request->bn_name;
        $department->save();

        return response()->json([
            'status' => true,
            'message' => 'Department created successfully.',
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view("backend.pages.basic.department.show", compact("department"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view("backend.pages.basic.department.edit", compact("department"));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'bn_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors' => $validator->errors(),
            ], 400);
        }

        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->bn_name = $request->bn_name;
        $department->save();

        return response()->json([
            'status' => true,
            'message' => 'Department updated successfully.',
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
        $department = Department::find($id);

        $department->delete();

        return response()->json([
            'status' => true,
            'message' => 'Department deleted successfully.',
        ], 200);

    }
}