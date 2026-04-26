<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.index');
    }


    public function testHttpRequest()
    {
        $response = Http::get('https://api.github.com/octocat', [
            'key1' => "test", 
            'key2' => 'Test',
        ]);
        
        if ($response->failed()) {
            $data['status'] = false;
            $data['message'] = "failed";
            $data['response'] = $response;
            return response()->json($data, 500);
           // return failure
        } else {
            $data['status'] = true;
            $data['message'] = "success";
            $data['response'] = $response;
            return response()->json($data, 500);
           // return success
        }
    }

}
