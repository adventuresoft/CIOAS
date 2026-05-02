<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\CitizenCertificate;
use App\Models\People;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class CitizenCertificateController extends Controller
{

    public function __construct()
    {
        $this->middleware('unionAdmin')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['certificates'] = CitizenCertificate::with('user')
        ->whereHas('user', function($q1){
            $q1->where('institute_id', Auth::user()->institute_id);
        })
        ->latest()
        ->get();
    
        return view('backend.pages.certificate.citizen.index', $data);
    }


    public function create()
    {
        // $data['users'] = User::with('people')
        // ->where('status', true)
        // ->where('role_id', 5)
        // ->where('institute_id', Auth::user()->institute_id)
        // ->get();
        $data['users'] = User::with('people' )
    ->where('status', true)
    ->where('role_id', 5)
    ->where('institute_id', Auth::user()->institute_id)
    ->whereHas('people', function ($q) {
        $q->whereNotNull('approved_id');
    })
    ->get();
        return view('backend.pages.certificate.citizen.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'user_id' => 'required',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $result = DB::transaction(function () use ($request) {


                $certificate = new CitizenCertificate();
                $certificate->user_id = $request->user_id;
                $certificate->created_by = Auth::id();
                $certificate->save();

                if ($certificate) {
                    $data['status'] = true;
                    $data['message'] = "Certificate generated successfully!";
                    $data['result'] = $certificate;
                    $data['code'] = 200;
                    $data['redirect_url'] = route('citizen.index');

                    // $data['redirect_url'] = route('citizen.show', $certificate->id);
                    return $data;
                } else {
                    $data['status'] = false;
                    $data['message'] = "Family comment save failed!";
                    $data['code'] = 500;
                    return $data;
                }
            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate\CitizenCertificate  $citizenCertificate
     * @return \Illuminate\Http\Response
     */
    public function show_backup_18_03_26($id)
    {
        
       
        // $data['user'] = User::with('people', 'familyInfo', 'addressInfo')->find($id);
        $data['certificate'] = CitizenCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->find($id);
        //return view('backend.pages.certificate.citizen.certificate', $data);
        $html = view('backend.pages.certificate.citizen.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true
        ]);
        return $pdf->stream('citizen-certificate.pdf');
    }
    
    
     public function show($id){
         $certificate  = CitizenCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentRoad', 'permanentRoad', 'permanentHouse', 'presentHouse', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->find($id);


        $data['certificate'] = $certificate;
        // return response()->json($data, 200);
        return view('backend.pages.certificate.citizen.certificate', $data);
        $html = view('backend.pages.certificate.citizen.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('citizen-certificate.pdf');
     }

    public function bn_certificate($id){
         $certificate  = CitizenCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentRoad', 'permanentRoad', 'permanentHouse', 'presentHouse', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->find($id);


        // $father_id = $certificate->user->familyInfo->father_nid ?? false;
        // $mother_id = $certificate->user->familyInfo->mother_nid ?? false;

        // if($father_id){
        //    $data['father_bn_name'] = People::where('system_id', $father_id )->first()->bn_name ?? '--';
        // }

        // if($mother_id){
        //     $data['mother_bn_name'] = People::where('system_id', $mother_id )->first()->bn_name ?? '--';
        // }

        $data['certificate'] = $certificate;
        // return response()->json($data, 200);
        return view('backend.pages.certificate.citizen.bn_certificate', $data);
        $html = view('backend.pages.certificate.citizen.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('citizen-certificate.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\CitizenCertificate  $citizenCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(CitizenCertificate $citizenCertificate)
    {
        return view('backend.pages.certificate.citizen.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\CitizenCertificate  $citizenCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CitizenCertificate $citizenCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\CitizenCertificate  $citizenCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(CitizenCertificate $citizenCertificate)
    {
        //
    }
}
