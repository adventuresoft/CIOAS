<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\CharacterCertificate;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CharacterCertificateController extends Controller
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
        $data['certificates'] = CharacterCertificate::with('user')
        ->whereHas('user', function($q1){
            $q1->where('institute_id', Auth::user()->institute_id);
        })->latest()->get();
        
        return view('backend.pages.certificate.character.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::with('people')
        ->where('status', true)
        ->where('role_id', 5)
           ->whereHas('people', function ($q) {
        $q->whereNotNull('approved_id');
    })
        ->where('institute_id', Auth::user()->institute_id)
        ->get();
        
        return view('backend.pages.certificate.character.create', $data);
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


                $certificate = new CharacterCertificate();
                $certificate->user_id = $request->user_id;
                $certificate->quantity = 1;
                $certificate->created_by = Auth::id();
                $certificate->save();

                if ($certificate) {
                    $data['status'] = true;
                    $data['message'] = "Certificate generated successfully!";
                    $data['result'] = $certificate;
                    $data['code'] = 200;
                    $data['redirect_url'] = route('character.index');

                    // $data['redirect_url'] = route('character.show', $certificate->id);
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
     * @param  \App\Models\Certificate\CharacterCertificate  $characterCertificate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data['certificate'] = CharacterCertificate::with(array('user' => function($q1){
        //     $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
        //         $q2->with('permanentVillage', 'presentWard');
        //     }))->with(array('institute' => function($q3){
        //         $q3->with(array('union'=>function($q4){
        //             $q4->with(array('thana'=>function($q5){
        //                 $q5->with('district');
        //             }));
        //         }));
        //     }));
        // }))->find($id);
        // // return response()->json($data, 200);
        // // return view('backend.pages.certificate.character.show', $data);
        // $html = view('backend.pages.certificate.character.certificate', $data)->render();
        // $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        // ->setOptions([
        //     'defaultFont' => 'sans-serif',
        //     'isHtml5ParserEnabled' => true,
        //     'isRemoteEnabled' => true
        // ]);
        // return $pdf->stream('character-certificate.pdf');
        
        
         $data['certificate'] = CharacterCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->find($id);
        
        // return response()->json($data, 200);
        return view('backend.pages.certificate.character.certificate', $data);
        $html = view('backend.pages.certificate.character.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('character-certificate.pdf');
        
    }

    public function bn_certificate($id){
        $data['certificate'] = CharacterCertificate::with(array('user' => function($q1){
            $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
                $q2->with('permanentVillage', 'presentWard', 'presentArea', 'permanentArea');
            }))->with(array('institute' => function($q3){
                $q3->with(array('union'=>function($q4){
                    $q4->with(array('thana'=>function($q5){
                        $q5->with('district');
                    }));
                }));
            }));
        }))->find($id);
        
        // return response()->json($data, 200);
        return view('backend.pages.certificate.character.bn_certificate', $data);
        $html = view('backend.pages.certificate.character.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('character-certificate.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\CharacterCertificate  $characterCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(CharacterCertificate $characterCertificate)
    {
        return view('backend.pages.certificate.character.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\CharacterCertificate  $characterCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CharacterCertificate $characterCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\CharacterCertificate  $characterCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(CharacterCertificate $characterCertificate)
    {
        //
    }
}
