<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function upazilasByDistrict(Request $request, $id)
    {
        $html = '<option value="">Select ' . ($request->id ? ucfirst($request->id) : '') . ' Upazila/Circle</option>';

        $query = Upazila::where('district_id', $id);
        if ($request->has('record') && $request->record !== '') {
            $query->where('record', $request->record);
        }
        $upazilas = $query->get();

        if (count($upazilas)) {
            foreach ($upazilas as $upazila) {
                $html .= '<option value="' . $upazila->id . '">' . $upazila->name . '</option>';
            }
        }

        return $html;
    }
}
