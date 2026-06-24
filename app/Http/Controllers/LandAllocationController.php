<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\LandAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandAllocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $allocations = LandAllocation::with('land')->orderByDesc('id')->get();
        return view('backend.pages.land_allocation.index', compact('allocations'));
    }

    public function create()
    {
        return view('backend.pages.land_allocation.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'land_no'       => 'required|string',
            'total_persons' => 'required|integer|min:1',
            'persons'       => 'required|array|min:1',
            'persons.*.name'             => 'required|string|max:255',
            'persons.*.nid'              => 'nullable|string|max:50',
            'persons.*.phone'            => 'nullable|string|max:20',
            'persons.*.father_name'      => 'nullable|string|max:255',
            'persons.*.present_address'  => 'nullable|string',
            'persons.*.permanent_address'=> 'nullable|string',
            'persons.*.acres'            => 'required|numeric|min:0',
            'persons.*.price_per_acre'   => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        LandAllocation::create([
            'land_no'       => $request->land_no,
            'total_persons' => $request->total_persons,
            'persons'       => $request->persons,
            'created_by'    => auth()->id(),
        ]);

        return redirect()->route('land-allocations.index')
            ->with('success', 'বরাদ্দ সফলভাবে সংরক্ষণ হয়েছে।');
    }

    public function show($id)
    {
        $allocation = LandAllocation::with('land')->findOrFail($id);

        $land = $allocation->land;
        $totalLandAcres = (float)($land->land_amount ?? 0);

        $existingAllocationsSum = LandAllocation::where('land_no', $allocation->land_no)->get()->sum(function($la) {
            return collect($la->persons)->sum(function($p) {
                return (float)($p['acres'] ?? 0);
            });
        });

        return view('backend.pages.land_allocation.show', compact('allocation', 'totalLandAcres', 'existingAllocationsSum'));
    }

    public function destroy($id)
    {
        $allocation = LandAllocation::findOrFail($id);
        $allocation->delete();

        return response()->json([
            'status'  => true,
            'message' => 'বরাদ্দ মুছে ফেলা হয়েছে।',
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
            ->map(fn($l) => ['id' => (string)$l->land_no, 'text' => (string)$l->land_no]);

        return response()->json($lands);
    }

    public function getLandAllocationDetails(Request $request)
    {
        $landNo = $request->input('land_no');
        $land = Land::with(['district', 'upazila', 'mouza', 'type', 'record'])
            ->where('land_no', $landNo)
            ->first();

        if (!$land) {
            return response()->json(['success' => false, 'message' => 'Land record not found']);
        }

        $totalLandAcres = (float)($land->land_amount ?? 0);

        $alreadyAllocated = 0;
        $existingAllocations = LandAllocation::where('land_no', $landNo)->get();
        foreach ($existingAllocations as $allocation) {
            if (is_array($allocation->persons)) {
                foreach ($allocation->persons as $person) {
                    $alreadyAllocated += (float)($person['acres'] ?? 0);
                }
            }
        }

        $remainingLandAcres = $totalLandAcres - $alreadyAllocated;

        return response()->json([
            'success' => true,
            'land_no' => $land->land_no,
            'district_name' => $land->district->name ?? '—',
            'upazila_name' => $land->upazila->name ?? '—',
            'mouza_name' => $land->mouza->name ?? '—',
            'land_type' => $land->type->bn_name ?? '—',
            'record_type' => $land->record->name ?? '—',
            'total_land_acres' => $totalLandAcres,
            'already_allocated_acres' => $alreadyAllocated,
            'remaining_land_acres' => $remainingLandAcres,
            'dag_no'                  => $land->dag_no,
            'khatian_no'              => $land->khatian_no,
            'possession_status'       => $land->possession_status,
            'gazette_no'              => $land->gazette_no,
        ]);
    }
}
