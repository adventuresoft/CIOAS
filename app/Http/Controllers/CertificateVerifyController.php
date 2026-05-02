<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificateVerifyController extends Controller
{
    
     protected $modelMap = [
        'character_certificates' => \App\Models\Certificate\CharacterCertificate::class,
        'death_certificates' => \App\Models\Certificate\DeathCertificate::class,
    ];
    
    public function index_backup()
    {
        return view('frontend.pages.certificate.verify');
    }
    
    public function index(Request $request)
{
    $system_id = $request->system_id;
    $data = null;
    
    if ($system_id) {

    $request->validate([
            'system_id' => 'required'
        ]);
        $system_id = $request->system_id;

        //  certificate code extract (01 / 02)
        $code = substr($system_id, 8, 2);
        
        //  find table from certificate_types
        $type = DB::table('certificate_types')
            ->where('code', $code)
            ->first();

        if (!$type) {
            return back()->with('error', 'Invalid certificate code!');
        }

        // search only specific table
        // $data = DB::table($type->table_name)
        //     ->where('system_id', $system_id)
        //     ->first();
        $table = $type->table_name;

         $modelClass = $this->modelMap[$table] ?? null;
         
         if (!$modelClass) {
            return back()->with('error', 'Model not found!');
        }
        
          $data = $modelClass::with('user')
            ->where('system_id', $system_id)
            ->first();

        if (!$data) {
            return back()->with('error', 'No certificate found!');
        }

    }

    return view('frontend.pages.certificate.verify', compact('data', 'system_id'));
}

    public function search(Request $request)
    {
        $request->validate([
            'system_id' => 'required'
        ]);
        $system_id = $request->system_id;

        //  certificate code extract (01 / 02)
        $code = substr($system_id, 8, 2);
        
        //  find table from certificate_types
        $type = DB::table('certificate_types')
            ->where('code', $code)
            ->first();

        if (!$type) {
            return back()->with('error', 'Invalid certificate code!');
        }

        // search only specific table
        // $data = DB::table($type->table_name)
        //     ->where('system_id', $system_id)
        //     ->first();
        $table = $type->table_name;

         $modelClass = $this->modelMap[$table] ?? null;
         
         if (!$modelClass) {
            return back()->with('error', 'Model not found!');
        }
        
          $data = $modelClass::with('user')
            ->where('system_id', $system_id)
            ->first();

        if (!$data) {
            return back()->with('error', 'No certificate found!');
        }

        return view('frontend.pages.certificate.verify', compact('data', 'system_id'));
    }
}