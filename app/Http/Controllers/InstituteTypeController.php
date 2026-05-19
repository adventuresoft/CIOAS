<?php

namespace App\Http\Controllers;

use App\Models\InstituteType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class InstituteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institute = InstituteType::all();
        return view('backend.pages.institute.type.index', compact('institute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        return view('backend.pages.institute.type.create');
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
            'name'        => 'required|string|max:255',
            'description' => 'string|max:255',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $institute = new InstituteType();

        $institute->name        = $request->name;
        $institute->description = $request->description;
        $institute->status = 1;
        $institute->save();

        return response()->json([
            'status'  => true,
            'message' => 'Section created successfully.',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function show(InstituteType $instituteType)
    {
        return view('backend.pages.institute.type.show', compact('instituteType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $institute = InstituteType::find($id);

        return view('backend.pages.institute.type.edit', compact('institute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $institute = InstituteType::find($id);

        $institute->name        = $request->name;
        $institute->description = $request->description;
        $institute->save();

        return response()->json([
            'status'  => true,
            'message' => 'Institute Type updated successfully.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $institute = InstituteType::find($id);

        $institute->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Institute Type deleted successfully.',
        ], 200);
    }
}
