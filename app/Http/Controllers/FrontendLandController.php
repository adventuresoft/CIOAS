<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Land;
use App\Models\LandRecord;
use App\Models\District;
use App\Models\LandAllocation;

class FrontendLandController extends Controller
{
    public function index(Request $request)
    {
        $data['records'] = LandRecord::where('status', true)->get();
        $data['districts'] = District::where('status', true)->get();

        $lands = null;

        // Check if any search parameter is provided
        if ($request->filled('record') || $request->filled('district_id') || $request->filled('upazila_id') || 
            $request->filled('mouza_id') || $request->filled('dag_no') || $request->filled('name') || 
            $request->filled('nid') || $request->filled('mobile')) {
            
            $query = Land::with(['district', 'upazila', 'mouza', 'record'])->where('status', 1);

            if ($request->filled('record')) {
                $query->where('record_type', $request->record);
            }
            if ($request->filled('district_id')) {
                $query->where('district_id', $request->district_id);
            }
            if ($request->filled('upazila_id')) {
                $query->where('upazila_id', $request->upazila_id);
            }
            if ($request->filled('mouza_id')) {
                $query->where('mouza_id', $request->mouza_id);
            }
            if ($request->filled('dag_no')) {
                $query->where('dag_no', $request->dag_no);
            }

            if ($request->filled('name') || $request->filled('nid') || $request->filled('mobile')) {
                $name = $request->name;
                $nid = $request->nid;
                $mobile = $request->mobile;

                $landNosFromAllocations = LandAllocation::where(function($q) use ($name, $nid, $mobile) {
                    if ($name) {
                        $q->where('persons', 'LIKE', '%' . $name . '%');
                    }
                    if ($nid) {
                        $q->where('persons', 'LIKE', '%' . $nid . '%');
                    }
                    if ($mobile) {
                        $q->where('persons', 'LIKE', '%' . $mobile . '%');
                    }
                })->pluck('land_no')->toArray();

                $query->where(function($q) use ($name, $landNosFromAllocations) {
                    if ($name) {
                        $q->where('recorded_owner_name', 'LIKE', '%' . $name . '%');
                    }
                    if (!empty($landNosFromAllocations)) {
                        $q->orWhereIn('land_no', $landNosFromAllocations);
                    }
                });
            }

            $lands = $query->get();
        }

        $data['lands'] = $lands;

        return view('frontend.pages.land_search.index', $data);
    }
}
