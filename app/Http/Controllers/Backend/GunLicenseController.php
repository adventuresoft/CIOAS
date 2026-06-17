<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonGunApplication;
use App\Models\OrgGunApplication;
use App\Models\OtherOrgGunApplication;
use Illuminate\Pagination\LengthAwarePaginator;

class GunLicenseController extends Controller
{
    public function index()
    {
        $person = PersonGunApplication::with(['verification', 'interview'])->get()->map(function($item) {
            $item->type = 'person';
            $item->license_type = 'ব্যক্তিগত';
            $item->weapon = $item->weapon_details;
            $item->name = $item->applicant_name;
            $item->has_verification = !is_null($item->verification);
            $item->has_interview = !is_null($item->interview);
            return $item;
        });

        $org = OrgGunApplication::with(['verification', 'interviews'])->get()->map(function($item) {
            $item->type = 'org';
            $item->license_type = 'ব্যাংক/আর্থিক প্রতিষ্ঠান';
            $item->weapon = $item->weapon_nature_requested;
            $item->name = $item->org_name;
            $item->has_verification = !is_null($item->verification);
            $item->has_interview = $item->interviews->count() > 0;
            return $item;
        });

        $other = OtherOrgGunApplication::with(['verification', 'interview'])->get()->map(function($item) {
            $item->type = 'other';
            $item->license_type = 'প্রতিষ্ঠান';
            $item->weapon = 'N/A';
            $item->name = $item->org_name;
            $item->has_verification = !is_null($item->verification);
            $item->has_interview = !is_null($item->interview);
            return $item;
        });

        $merged = $person->concat($org)->concat($other)->sortByDesc('created_at');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $applications = new LengthAwarePaginator($currentItems, $merged->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('backend.pages.gun-license.index', compact('applications'));
    }

    public function create()
    {
        return view('backend.pages.gun-license.select-type');
    }
}
