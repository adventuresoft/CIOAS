<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\LandDetail;
use App\Models\LandDocument;
use App\Models\LandLocation;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Mouza;
use App\DataTables\LandDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LandDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.land.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['districts'] = District::orderBy('name')->get();
        return view('backend.pages.land.create', $data);
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
            'land_type' => 'required|string',
            'record_type' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'mouza_id' => 'required|exists:mouzas,id',
            'details' => 'required|array|min:1',
            'details.*.dag_no' => 'required|string',
            'details.*.khatian_no' => 'required|string',
            'details.*.recorded_owner_name' => 'nullable|string',
            'details.*.recorded_class' => 'required|string',
            'details.*.actual_class' => 'required|string',
            'details.*.total_land' => 'required|numeric|min:0',
            'details.*.land_amount' => 'required|numeric|min:0',
            'details.*.possession_status' => 'required|string',
            'details.*.case_no' => 'nullable|string',
            'details.*.gazette_no' => 'nullable|string',
            'details.*.remarks' => 'nullable|string',
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'required_with:attachments.*.file|nullable|string',
            'attachments.*.file' => 'required_with:attachments.*.name|nullable|file|max:5120',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors' => $validate->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $land = Land::create([
                'land_type' => $request->land_type,
                'status' => 0, // Pending
                'created_by' => auth()->id()
            ]);

            if ($request->filled('district_id')) {
                LandLocation::create([
                    'land_id' => $land->id,
                    'record_type' => $request->record_type,
                    'district_id' => $request->district_id,
                    'upazila_id' => $request->upazila_id,
                    'mouza_id' => $request->mouza_id,
                ]);
            }

            if ($request->has('location') && is_array($request->location)) {
                foreach ($request->location as $loc) {
                    // Only save if at least some data is provided
                    if (!empty($loc['district_id']) || !empty($loc['dag_no'])) {
                        LandLocation::create([
                            'land_id' => $land->id,
                            'record_type' => $loc['record'] ?? null,
                            'district_id' => $loc['district_id'] ?? null,
                            'upazila_id' => $loc['thana_id'] ?? null,
                            'mouza_id' => $loc['mouza_id'] ?? null,
                            'record_group' => $loc['record_group'] ?? null,
                            'dag_no' => $loc['dag_no'] ?? null,
                            'khatian_no' => $loc['khatian'] ?? null,
                            'total_dag_no' => $loc['total_dag_no'] ?? null,
                            'total_land' => $loc['total_land'] ?? null,
                            'owner_name' => $loc['record_owner_name'] ?? null,
                        ]);
                    }
                }
            }

            foreach ($request->details as $row) {
                LandDetail::create([
                    'land_id' => $land->id,
                    'dag_no' => $row['dag_no'],
                    'khatian_no' => $row['khatian_no'],
                    'recorded_owner_name' => $row['recorded_owner_name'] ?? null,
                    'recorded_class' => $row['recorded_class'],
                    'actual_class' => $row['actual_class'],
                    'total_land' => $row['total_land'],
                    'land_amount' => $row['land_amount'],
                    'possession_status' => $row['possession_status'],
                    'case_no' => $row['case_no'] ?? null,
                    'gazette_no' => $row['gazette_no'] ?? null,
                    'remarks' => $row['remarks'] ?? null,
                ]);
            }

            if ($request->has('attachments')) {
                foreach ($request->attachments as $attachment) {
                    if (isset($attachment['file']) && $attachment['file']->isValid()) {
                        $path = $attachment['file']->store('lands', 'public');
                        LandDocument::create([
                            'land_id' => $land->id,
                            'document_name' => $attachment['name'],
                            'file_path' => $path
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Land Record Saved Successfully!',
                'redirect_url' => route('land.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['land'] = Land::with(['district', 'upazila', 'mouza', 'details', 'documents'])->findOrFail($id);
        return view('backend.pages.land.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $land = Land::with(['details', 'documents'])->findOrFail($id);

        $data['land'] = $land;
        $data['districts'] = District::orderBy('name')->get();
        $data['upazilas'] = Upazila::where('district_id', $land->district_id)->get();
        $data['mouzas'] = Mouza::where('upazila_id', $land->upazila_id)->get();

        return view('backend.pages.land.edit', $data);
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
        $land = Land::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'land_type' => 'required|string',
            'record_type' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'mouza_id' => 'required|exists:mouzas,id',
            'details' => 'required|array|min:1',
            'details.*.dag_no' => 'required|string',
            'details.*.khatian_no' => 'required|string',
            'details.*.recorded_owner_name' => 'nullable|string',
            'details.*.recorded_class' => 'required|string',
            'details.*.actual_class' => 'required|string',
            'details.*.total_land' => 'required|numeric|min:0',
            'details.*.land_amount' => 'required|numeric|min:0',
            'details.*.possession_status' => 'required|string',
            'details.*.case_no' => 'nullable|string',
            'details.*.gazette_no' => 'nullable|string',
            'details.*.remarks' => 'nullable|string',
            'attachments' => 'nullable|array',
            'attachments.*.name' => 'required_with:attachments|string',
            'attachments.*.file' => 'nullable|file|max:5120',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Invalid Entry.',
                'errors' => $validate->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $land->update([
                'land_type' => $request->land_type,
                'record_type' => $request->record_type,
                'district_id' => $request->district_id,
                'upazila_id' => $request->upazila_id,
                'mouza_id' => $request->mouza_id
            ]);

            // Delete old details
            $land->details()->delete();

            foreach ($request->details as $row) {
                LandDetail::create([
                    'land_id' => $land->id,
                    'dag_no' => $row['dag_no'],
                    'khatian_no' => $row['khatian_no'],
                    'recorded_owner_name' => $row['recorded_owner_name'] ?? null,
                    'recorded_class' => $row['recorded_class'],
                    'actual_class' => $row['actual_class'],
                    'total_land' => $row['total_land'],
                    'land_amount' => $row['land_amount'],
                    'possession_status' => $row['possession_status'],
                    'case_no' => $row['case_no'] ?? null,
                    'gazette_no' => $row['gazette_no'] ?? null,
                    'remarks' => $row['remarks'] ?? null,
                ]);
            }

            // Handle deleted document removal if any are requested
            if ($request->has('remove_documents')) {
                foreach ($request->remove_documents as $docId) {
                    $doc = LandDocument::find($docId);
                    if ($doc) {
                        Storage::disk('public')->delete($doc->file_path);
                        $doc->delete();
                    }
                }
            }

            // Handle new attachments
            if ($request->has('attachments')) {
                foreach ($request->attachments as $attachment) {
                    if (isset($attachment['file']) && $attachment['file']->isValid()) {
                        $path = $attachment['file']->store('lands', 'public');
                        LandDocument::create([
                            'land_id' => $land->id,
                            'document_name' => $attachment['name'],
                            'file_path' => $path
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Land Record Updated Successfully!',
                'redirect_url' => route('land.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $land = Land::findOrFail($id);

        DB::beginTransaction();

        try {
            // Delete files from storage
            foreach ($land->documents as $doc) {
                Storage::disk('public')->delete($doc->file_path);
            }

            $land->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Land Record Deleted Successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Approve the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $land = Land::findOrFail($request->id);

        $land->update([
            'status' => 1,
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Land Record Approved Successfully!'
        ]);
    }
}
