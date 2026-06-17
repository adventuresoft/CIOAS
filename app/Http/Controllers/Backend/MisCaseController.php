<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MisCase;
use App\Models\District;
use App\Models\Thana;
use App\Models\Mouza;
use Illuminate\Support\Facades\Validator;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Arr;
use App\DataTables\MisCaseDataTable;
use Illuminate\Support\Facades\Auth;

class MisCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use FileUploadTrait;

    public function index(MisCaseDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.miscase.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['districts'] = District::where('status', true)->orderBy('name')->get();
        return view('backend.pages.miscase.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return $this->validationErrorResponse($request, $validator);
        }

        $miscase = $this->fillMisCase(new MisCase(), $request);
        $miscase->save();

        // Auto-generate case_no in format: 0005(XI-1)/2026
        $serial = sprintf('%04d', $miscase->id);
        $typeCode = $miscase->case_type_code;
        $year = $miscase->next_hearing_date ? $miscase->next_hearing_date->format('Y') : ($miscase->case_date ? $miscase->case_date->format('Y') : date('Y'));
        $miscase->case_no = "{$serial}({$typeCode})/{$year}";
        $miscase->create_by = Auth::user()->id;
        $miscase->institute_id = Auth::user()->institute_id;
        $miscase->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Missed case created successfully.',
            ], 200);
        }

        return redirect()->route('miscase.index')->with('success', 'Missed case created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $miscase = MisCase::findOrFail($id);
        $locationRows = is_array($miscase->land_info) ? $miscase->land_info : [];
        $districtIds = collect($locationRows)->pluck('district_id')->filter()->unique();
        $thanaIds = collect($locationRows)->pluck('thana_id')->filter()->unique();
        $mouzaIds = collect($locationRows)->pluck('mouza_id')->filter()->unique();
        $locationNames = [
            'districts' => District::whereIn('id', $districtIds)->pluck('name', 'id'),
            'thanas' => Thana::whereIn('id', $thanaIds)->pluck('name', 'id'),
            'mouzas' => Mouza::whereIn('id', $mouzaIds)->pluck('name', 'id'),
        ];

        return view('backend.pages.miscase.show', compact('miscase', 'locationNames'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $miscase = MisCase::findOrFail($id);
        if ($miscase->status === 'closed') {
            return redirect()->route('miscase.index')->with('error', 'অনুমোদিত হওয়ায় এই কেসটি সম্পাদন করা যাবে না।');
        }
        $data = [];
        $data['miscase'] = $miscase;
        $data['districts'] = District::where('status', true)->orderBy('name')->get();

        return view('backend.pages.miscase.edit', $data);
    }

    /**
     * Print the Case History pad.
     */
    public function printCase(string $id)
    {
        $miscase = MisCase::findOrFail($id);

        // Fetch location names maps for rendering
        $locationRows = is_array($miscase->land_info) ? $miscase->land_info : [];
        $districtIds = collect($locationRows)->pluck('district_id')->filter()->unique();
        $thanaIds = collect($locationRows)->pluck('thana_id')->filter()->unique();
        $mouzaIds = collect($locationRows)->pluck('mouza_id')->filter()->unique();
        $locationNames = [
            'districts' => District::whereIn('id', $districtIds)->pluck('name', 'id'),
            'thanas' => Thana::whereIn('id', $thanaIds)->pluck('name', 'id'),
            'mouzas' => Mouza::whereIn('id', $mouzaIds)->pluck('name', 'id'),
        ];

        // Fetch chronological case orders history
        $caseOrders = \App\Models\CaseOrder::with('creator')
            ->where('mis_case_id', $id)
            ->orderBy('hearing_no', 'asc')
            ->get();

        return view('backend.pages.miscase.print', compact('miscase', 'locationNames', 'caseOrders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return $this->validationErrorResponse($request, $validator);
        }

        $miscase = MisCase::findOrFail($id);
        $miscase = $this->fillMisCase($miscase, $request);
        $serial = sprintf('%04d', $miscase->id);
        $typeCode = $miscase->case_type_code;
        $year = $miscase->next_hearing_date ? $miscase->next_hearing_date->format('Y') : ($miscase->case_date ? $miscase->case_date->format('Y') : date('Y'));
        $miscase->case_no = "{$serial}({$typeCode})/{$year}";
        $miscase->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Missed case updated successfully.',
            ], 200);
        }

        return redirect()->route('miscase.index')->with('success', 'Missed case updated successfully');
    }


    public function updateNextHearingDate(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'next_hearing_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please provide a valid next hearing date.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $miscase = MisCase::findOrFail($id);
        $miscase->next_hearing_date = $request->input('next_hearing_date');
        $miscase->save();

        return response()->json([
            'status' => true,
            'message' => 'Next hearing date updated successfully.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $miscase = MisCase::findOrFail($id);
        $this->deleteStoredFiles($miscase->files ?? []);
        $miscase->delete();

        if (request()->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Missed case deleted successfully.',
            ], 200);
        }

        return redirect()->route('miscase.index')->with('success', 'Missed case deleted successfully');
    }

    private function rules(): array
    {
        return [
            'case_no' => 'nullable|string|max:255',
            'case_date' => 'required|date',
            'case_type' => 'nullable|string|max:255',
            'case_category' => 'nullable|string|max:255',
            'case_fee' => 'nullable|numeric',
            'case_reason' => 'nullable|string|max:255',
            'case_details' => 'nullable|string',
            'rejection_reason' => 'nullable|string',
            'next_hearing_date' => 'nullable|date',
            'status' => 'nullable|in:draft,running,closed,rejected',
            'header_one' => 'nullable|string|max:1000',
            'header_two' => 'nullable|string|max:1000',
            'plaintiffs' => 'nullable|array',
            'plaintiffs.*.name' => 'nullable|string|max:255',
            'plaintiffs.*.nid' => 'nullable|string|max:100',
            'plaintiffs.*.father_name' => 'nullable|string|max:255',
            'plaintiffs.*.mobile' => 'nullable|string|max:50',
            'plaintiffs.*.address' => 'nullable|string|max:1000',
            'defendants' => 'nullable|array',
            'defendants.*.name' => 'nullable|string|max:255',
            'defendants.*.nid' => 'nullable|string|max:100',
            'defendants.*.father_name' => 'nullable|string|max:255',
            'defendants.*.mobile' => 'nullable|string|max:50',
            'defendants.*.address' => 'nullable|string|max:1000',
            'notes' => 'nullable|string',
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|file|max:5120',
            'location' => 'nullable|array',
            'location.*.record' => 'nullable|string|max:50',
            'location.*.district_id' => 'nullable|integer',
            'location.*.thana_id' => 'nullable|integer',
            'location.*.mouza_id' => 'nullable|integer',
            'location.*.dag_no' => 'nullable|string|max:255',
            'location.*.khatian' => 'nullable|string|max:255',
            'location.*.record_group' => 'nullable|string|max:255',
            'location.*.total_dag_no' => 'nullable|string|max:255',
            'location.*.total_land' => 'nullable|string|max:255',
            'location.*.record_owner_name' => 'nullable|string|max:255',
        ];
    }

    private function validationErrorResponse(Request $request, $validator)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => false,
                'message' => 'Please check the required information.',
                'errors' => $validator->errors(),
            ], 422);
        }

        return back()->withErrors($validator)->withInput();
    }

    private function fillMisCase(MisCase $miscase, Request $request): MisCase
    {
        // case_no is auto-generated and should not be set from request inputs
        $miscase->case_date = $request->input('case_date');
        $miscase->case_type = $request->input('case_type');
        $miscase->case_category = $request->input('case_category');
        $miscase->case_fee = $request->input('case_fee') ?: 0;
        $miscase->case_reason = $request->input('case_reason');
        $miscase->case_details = $request->input('case_details');
        $miscase->rejection_reason = $request->input('rejection_reason');
        $miscase->next_hearing_date = $request->input('next_hearing_date');
        $miscase->status = $request->input('status') ?: 'draft';
        $miscase->header_one = $request->input('header_one');
        $miscase->header_two = $request->input('header_two');
        $miscase->plaintiffs = $this->cleanPartyRows($request->input('plaintiffs', []));
        $miscase->defendants = $this->cleanPartyRows($request->input('defendants', []));
        $miscase->notes = $request->input('notes');
        $miscase->land_info = $this->cleanLocationRows($request->input('location', []));

        $uploadedFiles = $this->storeUploadedFiles($request);
        if (!empty($uploadedFiles)) {
            $miscase->files = array_values(array_merge($miscase->files ?? [], $uploadedFiles));
        }

        return $miscase;
    }

    private function cleanPartyRows(array $rows): array
    {
        return collect($rows)
            ->map(function ($row) {
                return [
                    'name' => trim(Arr::get($row, 'name', '')),
                    'nid' => trim(Arr::get($row, 'nid', '')),
                    'father_name' => trim(Arr::get($row, 'father_name', '')),
                    'mobile' => trim(Arr::get($row, 'mobile', '')),
                    'address' => trim(Arr::get($row, 'address', '')),
                ];
            })
            ->filter(fn($row) => collect($row)->filter()->isNotEmpty())
            ->values()
            ->all();
    }

    private function cleanLocationRows(array $rows): array
    {
        return collect($rows)
            ->map(function ($row) {
                return [
                    'record' => Arr::get($row, 'record'),
                    'district_id' => Arr::get($row, 'district_id'),
                    'thana_id' => Arr::get($row, 'thana_id'),
                    'mouza_id' => Arr::get($row, 'mouza_id'),
                    'dag_no' => Arr::get($row, 'dag_no'),
                    'khatian' => Arr::get($row, 'khatian'),
                    'record_group' => Arr::get($row, 'record_group'),
                    'total_dag_no' => Arr::get($row, 'total_dag_no'),
                    'total_land' => Arr::get($row, 'total_land'),
                    'record_owner_name' => Arr::get($row, 'record_owner_name'),
                ];
            })
            ->values()
            ->all();
    }

    private function storeUploadedFiles(Request $request): array
    {
        if (!$request->hasFile('documents')) {
            return [];
        }

        $files = [];
        foreach ($request->file('documents') as $document) {
            if (!$document) {
                continue;
            }

            $files[] = [
                'name' => $document->getClientOriginalName(),
                'path' => $this->uploadFile($document, 'uploads/mis-case/', 'miscase_doc_'),
                'uploaded_at' => now()->toDateTimeString(),
            ];
        }

        return $files;
    }

    private function deleteStoredFiles($files): void
    {
        foreach ((array) $files as $file) {
            $path = is_array($file) ? Arr::get($file, 'path') : $file;

            if ($path) {
                $this->deleteFile($path);
            }
        }
    }
}
