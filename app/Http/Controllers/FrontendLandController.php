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
        $data['records'] = LandRecord::all();
        $data['districts'] = District::where('status', true)->get();

        $lands = null;

        // Check if any search parameter is provided
        if ($request->filled('record') || $request->filled('district_id') || $request->filled('upazila_id') || 
            $request->filled('mouza_id') || $request->filled('dag_no')) {
            
            $query = Land::with(['district', 'upazila', 'mouza', 'record'])->where('status', 1);

            $query->where(function($q) use ($request) {
                $jsonSearch = [];
                if ($request->filled('record')) {
                    $jsonSearch['record_type'] = $request->record;
                }
                if ($request->filled('district_id')) {
                    $jsonSearch['district_id'] = $request->district_id;
                }
                if ($request->filled('upazila_id')) {
                    $jsonSearch['upazila_id'] = $request->upazila_id;
                }
                if ($request->filled('mouza_id')) {
                    $jsonSearch['mouza_id'] = $request->mouza_id;
                }
                if ($request->filled('dag_no')) {
                    $jsonSearch['dag_no'] = $request->dag_no;
                }

                if (!empty($jsonSearch)) {
                    $q->whereJsonContains('locations', $jsonSearch);
                    
                    $q->orWhere(function($subQ) use ($request) {
                        if ($request->filled('record')) {
                            $subQ->where('record_type', $request->record);
                        }
                        if ($request->filled('district_id')) {
                            $subQ->where('district_id', $request->district_id);
                        }
                        if ($request->filled('upazila_id')) {
                            $subQ->where('upazila_id', $request->upazila_id);
                        }
                        if ($request->filled('mouza_id')) {
                            $subQ->where('mouza_id', $request->mouza_id);
                        }
                        if ($request->filled('dag_no')) {
                            $subQ->where('dag_no', $request->dag_no);
                        }
                    });
                }
            });

            $lands = $query->get();
        }

        $data['lands'] = $lands;

        return view('frontend.pages.land_search.index', $data);
    }
}
