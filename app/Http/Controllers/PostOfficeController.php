<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostOffice;

class PostOfficeController extends Controller
{
    public function postOfficeByThana(Request $request, $id)
    {

        $postOffice = PostOffice::where('thana_id', $id)->get();

        $html = '<option value="0">Select Post Office</option>';

        if (count($postOffice)) {
            foreach ($postOffice as $office) {
                $html .= '<option value="' . $office->id . '">' . $office->bn_name . '</option>';
            }
        }

        return $html;

    }
}