<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Models\Certificate\UnmarriedCertificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;


class UnmarriedCertificateController extends Controller
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
        $data['certificates'] = UnmarriedCertificate::with('user')
        ->whereHas('user', function($q1){
            $q1->where('institute_id', Auth::user()->institute_id);
        })->latest()->get();
        return view('backend.pages.certificate.unmarried.index', $data);
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
        ->where('institute_id', Auth::user()->institute_id)
        ->whereHas('people', function ($q) {$q->whereNotNull('approved_id');})
        ->get();
        return view('backend.pages.certificate.unmarried.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

            $certificate = new UnmarriedCertificate();
            $certificate->user_id = $request->user_id;
            $certificate->created_by = Auth::id();

            try {
                $certificate->save();
                $data['status'] = true;
                $data['message'] = "Certificate generated successfully!";
                $data['result'] = $certificate;
                $data['code'] = 200;
                $data['redirect_url'] = route('unmarried.index');
                // $data['redirect_url'] = route('unmarried.show', $certificate->id);
                return $data;
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th;
                return $data;
            }
        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate\UnmarriedCertificate  $unmarriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data['certificate'] = UnmarriedCertificate::with(array('user' => function($q1){
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
        return view('backend.pages.certificate.unmarried.certificate', $data);
        $html = view('backend.pages.certificate.unmarried.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('unmarried-certificate.pdf');
    }

    public function bn_certificate($id){
        $data['certificate'] = UnmarriedCertificate::with(array('user' => function($q1){
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
        return view('backend.pages.certificate.unmarried.bn_certificate', $data);
        $html = view('backend.pages.certificate.unmarried.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        return $pdf->stream('unmarried-certificate.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\UnmarriedCertificate  $unmarriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(UnmarriedCertificate $unmarriedCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\UnmarriedCertificate  $unmarriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnmarriedCertificate $unmarriedCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\UnmarriedCertificate  $unmarriedCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnmarriedCertificate $unmarriedCertificate)
    {
        //
    }
}
