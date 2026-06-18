<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function upazilasByDistrict(Request $request, $id)
    {
        $html = '<option value="">Select ' . ($request->id ? ucfirst($request->id) : '') . ' Upazila/Circle</option>';

        $upazilas = Upazila::where('district_id', $id)->get();

        if (count($upazilas)) {
            foreach ($upazilas as $upazila) {
                $html .= '<option value="' . $upazila->id . '">' . $upazila->name . '</option>';
            }
        }

        return $html;
    }
}
