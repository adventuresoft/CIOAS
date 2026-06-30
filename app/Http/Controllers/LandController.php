<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Mouza;
use App\Models\LandClass;
use App\Models\LandCase;
use App\Models\LandType;
use App\Models\LandRecord;
use App\DataTables\LandDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Traits\FileUploadTrait;

class LandController extends Controller
{
    use FileUploadTrait;

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
        $landTypes = \App\Models\LandType::all();
        $records = \App\Models\LandRecord::all();
        $districts = \App\Models\District::orderBy('name')->get();
        $mouzas = \App\Models\Mouza::orderBy('name')->get();

        return $dataTable->render('backend.pages.land.index', compact('landTypes', 'records', 'districts', 'mouzas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['districts'] = District::orderBy('name')->get();
        $data['records'] = LandRecord::all();
        $data['landTypes'] = LandType::all();
        $data['recordGroups'] = LandClass::all();
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
            'land_type' => 'required',
            'record_type' => 'required',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'mouza_id' => 'required|exists:mouzas,id',
            'details.0.dag_no' => 'required',
            'details.0.khatian_no' => 'required',
            'details.0.recorded_class' => 'required',
            'details.0.actual_class' => 'required',
            'details.0.total_land' => 'required|numeric|min:0',
            'details.0.land_amount' => 'required|numeric|min:0',
            'details.0.possession_status' => 'required',
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
            $latest_land = Land::orderBy('id', 'desc')->first();
            $old_land_info = $latest_land ? $latest_land->land_no : null;

            if ($old_land_info && str_contains($old_land_info, '-')) {
                $parts = explode('-', $old_land_info);
                $old_land = isset($parts[2]) ? (int) $parts[2] : 0;
            } else {
                $old_land = 0;
            }

            $new_land = str_pad($old_land + 1, 4, '0', STR_PAD_LEFT);

            $district = District::find($request->district_id);
            $district_code = $district ? $district->code : '00';

            $upazila = Upazila::find($request->upazila_id);
            $upazila_code = $upazila ? $upazila->code : '00';

            $mouza = Mouza::find($request->mouza_id);
            $mouza_code = $mouza ? $mouza->code : '000';

            $land_type_model = LandType::find($request->land_type);
            $land_type_code = $land_type_model ? str_pad($land_type_model->id, 2, '0', STR_PAD_LEFT) : '00';

            $land_no = $district_code . $upazila_code . $mouza_code . '-' . $land_type_code . '-' . $new_land;

            // Extract first (only) detail row
            $detailRow = $request->input('details.0', []);

            $land = Land::create([
                'land_no'             => $land_no,
                'land_type'           => $request->land_type,
                'record_type'         => $request->record_type,
                'district_id'         => $request->district_id,
                'upazila_id'          => $request->upazila_id,
                'mouza_id'            => $request->mouza_id,
                'dag_no'              => $detailRow['dag_no'] ?? null,
                'khatian_no'          => $detailRow['khatian_no'] ?? null,
                'recorded_owner_name' => $detailRow['recorded_owner_name'] ?? null,
                'recorded_class'      => $detailRow['recorded_class'] ?? null,
                'actual_class'        => $detailRow['actual_class'] ?? null,
                'total_land'          => $detailRow['total_land'] ?? null,
                'land_amount'         => $detailRow['land_amount'] ?? null,
                'possession_status'   => $detailRow['possession_status'] ?? null,
                'case_no'             => $detailRow['case_no'] ?? null,
                'gazette_no'          => $detailRow['gazette_no'] ?? null,
                'remarks'             => $detailRow['remarks'] ?? null,
                'status'              => 0, // Pending
                'created_by'          => auth()->id()
            ]);

            $locations = [];
            if ($request->has('location')) {
                foreach ($request->location as $loc) {
                    if (!empty($loc['district_id']) || !empty($loc['dag_no'])) {
                        $locations[] = [
                            'record_type' => $loc['record'] ?? null,
                            'district_id' => $loc['district_id'] ?? null,
                            'upazila_id'  => $loc['thana_id'] ?? null,
                            'mouza_id'    => $loc['mouza_id'] ?? null,
                            'record_group'=> $loc['record_group'] ?? null,
                            'dag_no'      => $loc['dag_no'] ?? null,
                            'khatian_no'  => $loc['khatian'] ?? null,
                            'total_dag_no'=> $loc['total_dag_no'] ?? null,
                            'total_land'  => $loc['total_land'] ?? null,
                            'owner_name'  => $loc['record_owner_name'] ?? null,
                        ];
                    }
                }
            }

            $documents = [];
            if ($request->has('attachments')) {
                foreach ($request->attachments as $attachment) {
                    if (isset($attachment['file']) && $attachment['file']->isValid()) {
                        $path = $this->uploadFile($attachment['file'], 'uploads/lands/');
                        $documents[] = [
                            'document_name' => $attachment['name'] ?? null,
                            'file_path'     => $path
                        ];
                    }
                }
            }

            $land->update([
                'locations' => $locations,
                'documents' => $documents,
            ]);

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
        $data['land'] = Land::with(['district', 'upazila', 'mouza', 'case'])->findOrFail($id);
        $data['recordGroups'] = LandClass::all();
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
        $land = Land::findOrFail($id);

        $data['land'] = $land;
        $data['districts'] = District::orderBy('name')->get();
        $data['upazilas'] = Upazila::where('district_id', $land->district_id)->get();
        $data['mouzas'] = Mouza::where('upazila_id', $land->upazila_id)->get();
        $data['records'] = LandRecord::all();
        $data['landTypes'] = LandType::all();
        $data['recordGroups'] = LandClass::all();

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
            'land_type' => 'required',
            'record_type' => 'required',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'mouza_id' => 'required|exists:mouzas,id',
            'details.0.dag_no' => 'required',
            'details.0.khatian_no' => 'required',
            'details.0.recorded_class' => 'required',
            'details.0.actual_class' => 'required',
            'details.0.total_land' => 'required|numeric|min:0',
            'details.0.land_amount' => 'required|numeric|min:0',
            'details.0.possession_status' => 'required',
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
            $detailRow = $request->input('details.0', []);

            $locations = [];
            if ($request->has('location')) {
                foreach ($request->location as $loc) {
                    if (!empty($loc['district_id']) || !empty($loc['dag_no'])) {
                        $locations[] = [
                            'record_type' => $loc['record'] ?? null,
                            'district_id' => $loc['district_id'] ?? null,
                            'upazila_id'  => $loc['thana_id'] ?? null,
                            'mouza_id'    => $loc['mouza_id'] ?? null,
                            'record_group'=> $loc['record_group'] ?? null,
                            'dag_no'      => $loc['dag_no'] ?? null,
                            'khatian_no'  => $loc['khatian'] ?? null,
                            'total_dag_no'=> $loc['total_dag_no'] ?? null,
                            'total_land'  => $loc['total_land'] ?? null,
                            'owner_name'  => $loc['record_owner_name'] ?? null,
                        ];
                    }
                }
            }

            $documents = is_array($land->documents) ? $land->documents : [];

            // Handle deleted document removal if any are requested
            if ($request->has('remove_documents')) {
                foreach ($request->remove_documents as $docPath) {
                    $documents = array_filter($documents, function ($doc) use ($docPath) {
                        return $doc['file_path'] !== $docPath;
                    });
                    Storage::disk('public')->delete($docPath);
                }
                $documents = array_values($documents);
            }

            // Handle new attachments
            if ($request->has('attachments')) {
                foreach ($request->attachments as $attachment) {
                    if (isset($attachment['file']) && $attachment['file']->isValid()) {
                        $path = $this->uploadFile($attachment['file'], 'uploads/lands/');
                        $documents[] = [
                            'document_name' => $attachment['name'] ?? null,
                            'file_path'     => $path
                        ];
                    }
                }
            }

            $land->update([
                'land_type'           => $request->land_type,
                'record_type'         => $request->record_type,
                'district_id'         => $request->district_id,
                'upazila_id'          => $request->upazila_id,
                'mouza_id'            => $request->mouza_id,
                'dag_no'              => $detailRow['dag_no'] ?? null,
                'khatian_no'          => $detailRow['khatian_no'] ?? null,
                'recorded_owner_name' => $detailRow['recorded_owner_name'] ?? null,
                'recorded_class'      => $detailRow['recorded_class'] ?? null,
                'actual_class'        => $detailRow['actual_class'] ?? null,
                'total_land'          => $detailRow['total_land'] ?? null,
                'land_amount'         => $detailRow['land_amount'] ?? null,
                'possession_status'   => $detailRow['possession_status'] ?? null,
                'case_no'             => $detailRow['case_no'] ?? null,
                'gazette_no'          => $detailRow['gazette_no'] ?? null,
                'remarks'             => $detailRow['remarks'] ?? null,
                'locations'           => $locations,
                'documents'           => $documents,
            ]);

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
            // Delete associated documents from storage
            if (is_array($land->documents)) {
                foreach ($land->documents as $doc) {
                    Storage::disk('public')->delete($doc['file_path']);
                }
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
