<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department\Section;
use Illuminate\Support\Facades\Validator;

class DepartmentSectionController extends Controller
{

    public function index(Request $request, $department_id)
    {

        $section_lists = Section::where('department_id', $department_id)->get();

        return view('backend.pages.basic.department.section.index', compact('section_lists'));

    }


    public function create(Request $request, $department_id)
    {

        return view('backend.pages.basic.department.section.create', compact('department_id'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'bn_name' => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $department = new Section();

        $department->name          = $request->name;
        $department->bn_name       = $request->bn_name;
        $department->department_id = $request->department_id;
        $department->save();

        return response()->json([
            'status'  => true,
            'message' => 'Section created successfully.',
        ], 200);
    }

    public function destroy($id)
    {
        $department = Section::find($id);

        $department->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Department deleted successfully.',
        ], 200);

    }

    public function getSectionsByDepartment($department_id)
    {
        $sections = Section::where('department_id', $department_id)->get();
        return response()->json($sections);
    }
}