<?php

namespace App\Http\Controllers;

use App\Models\LandCase;
use App\Models\Land;
use Illuminate\Http\Request;
use App\DataTables\LandCaseDataTable;
use Illuminate\Support\Facades\Validator;

class LandCaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(LandCaseDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.land_case.index');
    }

    public function create()
    {
        return view('backend.pages.land_case.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'land_no' => 'required|string',
            'has_case' => 'required|in:0,1',
            'case_no' => 'required_if:has_case,1|nullable|string',
            'court_name' => 'required_if:has_case,1|nullable|string',
            'case_status' => 'required_if:has_case,1|nullable|string',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        LandCase::create([
            'land_no' => $request->land_no,
            'has_case' => $request->has_case,
            'case_no' => $request->has_case == 1 ? $request->case_no : null,
            'court_name' => $request->has_case == 1 ? $request->court_name : null,
            'case_status' => $request->has_case == 1 ? $request->case_status : null,
            'comment' => $request->has_case == 1 ? $request->comment : null,
            'created_by' => auth()->id()
        ]);

        return redirect()->route('land-cases.index')->with('success', 'Land Case Created Successfully');
    }

    public function edit($id)
    {
        $data['landCase'] = LandCase::findOrFail($id);
        return view('backend.pages.land_case.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $landCase = LandCase::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'land_no' => 'required|string',
            'has_case' => 'required|in:0,1',
            'case_no' => 'required_if:has_case,1|nullable|string',
            'court_name' => 'required_if:has_case,1|nullable|string',
            'case_status' => 'required_if:has_case,1|nullable|string',
            'comment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $landCase->update([
            'land_no' => $request->land_no,
            'has_case' => $request->has_case,
            'case_no' => $request->has_case == 1 ? $request->case_no : null,
            'court_name' => $request->has_case == 1 ? $request->court_name : null,
            'case_status' => $request->has_case == 1 ? $request->case_status : null,
            'comment' => $request->has_case == 1 ? $request->comment : null,
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('land-cases.index')->with('success', 'Land Case Updated Successfully');
    }

    public function show($id)
    {
        $landCase = LandCase::findOrFail($id);
        $land = \App\Models\Land::with(['district', 'upazila', 'mouza', 'type', 'record'])
            ->where('land_no', $landCase->land_no)
            ->first();

        return view('backend.pages.land_case.show', compact('landCase', 'land'));
    }

    public function destroy($id)
    {
        $landCase = LandCase::findOrFail($id);
        $landCase->delete();

        return response()->json([
            'status' => true,
            'message' => 'Land Case Deleted Successfully!'
        ]);
    }

    public function searchLandNo(Request $request)
    {
        $term = $request->input('q');

        if (strlen($term) < 3) {
            return response()->json([]);
        }

        $lands = Land::whereNotNull('approved_at')
            ->where('land_no', 'LIKE', '%' . $term . '%')
            ->select('land_no')
            ->limit(20)
            ->get()
            ->map(function ($land) {
                return [
                    'id' => (string) $land->land_no,
                    'text' => (string) $land->land_no,
                ];
            });

        return response()->json($lands);
    }

    public function getLandCaseNo(Request $request)
    {
        $landNo = $request->input('land_no');
        $land = Land::where('land_no', $landNo)->first();

        if (!$land) {
            return response()->json(['case_no' => null]);
        }

        return response()->json(['case_no' => $land->case_no ?? null]);
    }
}
