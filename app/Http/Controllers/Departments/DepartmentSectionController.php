<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department\Section;
use Illuminate\Support\Facades\Validator;
use App\DataTables\BasicSettings\DepartmentSectionDataTable;

class DepartmentSectionController extends Controller
{
    public function index(DepartmentSectionDataTable $dataTable, $department_id)
    {
        return $dataTable->render('backend.pages.basic.department.section.index', compact('department_id'));
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

        $section = new Section();
        $section->name          = $request->name;
        $section->bn_name       = $request->bn_name;
        $section->department_id = $request->department_id;
        $section->save();

        return response()->json([
            'status'  => true,
            'message' => 'Section created successfully.',
        ], 200);
    }

    public function show($id)
    {
        $section = Section::findOrFail($id);
        return view('backend.pages.basic.department.section.show', compact('section'));
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('backend.pages.basic.department.section.edit', compact('section'));
    }

    public function update(Request $request, $id)
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

        $section = Section::findOrFail($id);
        $section->name    = $request->name;
        $section->bn_name = $request->bn_name;
        $section->save();

        return response()->json([
            'status'  => true,
            'message' => 'Section updated successfully.',
        ], 200);
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Section deleted successfully.',
        ], 200);
    }

    public function getSectionsByDepartment($department_id)
    {
        $sections = Section::where('department_id', $department_id)->get();
        return response()->json($sections);
    }
}