<?php

namespace App\Http\Controllers;

use App\Models\Certificate\DeathCertificate;
use App\Models\Certificate\Succession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class SuccessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['certificates'] = Succession::with('user')
        ->whereHas('user', function($q1){
            $q1->where('institute_id', Auth::user()->institute_id);
        })
        ->with('deathPerson.user')
        ->latest()->get();
        return view('backend.pages.certificate.succession.index', $data);
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
        ->whereHas('people', function ($q) {$q->whereNotNull('approved_id');})
        ->get();
        return view('backend.pages.certificate.succession.create', $data);
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
                'applicant_id' => 'required|exists:users,system_id',
                'death_certificate_id' => 'required|exists:death_certificates,system_id',
            ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Invalid input contains! Please check your entries...";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $user = User::where('system_id', $request->applicant_id)->first();
        $death_certificate = DeathCertificate::where('system_id', $request->death_certificate_id)->first();
        if (!$user || !$death_certificate) {
            $data['status'] = false;
            $data['message'] = "Invalid input contains! Please check your entries...";
            $data['errors'] = [];
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        try {
            $new_succession = new Succession();
            $new_succession->user_id = $user->id;
            $new_succession->death_certificate_id  = $death_certificate->id;
            $new_succession->members = $request->members ? json_encode($request->members) : NULL;
            $new_succession->created_by = Auth::id();
            $new_succession->save();
            $data['status'] = true;
            $data['message'] = "Submitted successfully!";
            $data['redirect_url'] = route('succession.index');
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to save data!";
            $data['errors'] = $th->getMessage();
            return response()->json($data, 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate\Succession  $succession
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  $data['certificate'] = Succession::with(array('user' => function($q1){
        //     $q1->with('people', 'familyInfo' )->with(array('addressInfo'=>function($q2){
        //         $q2->with('permanentVillage', 'presentWard');
        //     }))->with(array('institute' => function($q3){
        //         $q3->with(array('union'=>function($q4){
        //             $q4->with(array('thana'=>function($q5){
        //                 $q5->with('district');
        //             }));
        //         }));
        //     }));
        // }))
        // ->with('deathPerson.user.familyInfo', 'deathPerson.user.addressInfo')->find($id);
        // // return view('backend.pages.certificate.succession.certificate', $data);
        // $html = view('backend.pages.certificate.succession.certificate', $data)->render();
        // $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait')
        // ->setOptions([
        //     'defaultFont' => 'sans-serif',
        //     'isHtml5ParserEnabled' => true,
        //     'isRemoteEnabled' => true,
        //     'enable_remote' => true
        // ]);
        // return $pdf->stream('death-certificate.pdf');
        
        $data['certificate'] = Succession::with(array('user' => function($q1){
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
        return view('backend.pages.certificate.succession.certificate', $data);
        $html = view('backend.pages.certificate.succession.certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true
        ]);
        return $pdf->stream('citizen-certificate.pdf');
    }

    public function bn_certificate($id)
    {
        $data['certificate'] = Succession::with(array('user' => function($q1){
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
        return view('backend.pages.certificate.succession.bn_certificate', $data);
        $html = view('backend.pages.certificate.succession.bn_certificate', $data)->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true
        ]);
        return $pdf->stream('citizen-certificate.pdf');

        // $data['certificate'] = User::with('people', 'familyInfo', 'addressInfo')->find($id);
        // return view('backend.pages.certificate.death.bn_certificate', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate\Succession  $succession
     * @return \Illuminate\Http\Response
     */
    public function edit(Succession $succession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate\Succession  $succession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Succession $succession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate\Succession  $succession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Succession $succession)
    {
        //
    }
}
