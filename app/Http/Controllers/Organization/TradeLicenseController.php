<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\OrganizationCategory;
use App\Models\BasicSettings\OrganizationSubCategory;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Organization\TradeLicense;
use App\Models\Tax\TaxYear;
use App\Models\UnionWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TradeLicenseManualPayment;

class TradeLicenseController extends Controller
{
    public function confirmedLicense($id)
    {
        $data['license'] = TradeLicense::find($id);
        return view('backend.pages.organization.trade_license.confirmed', $data);

    }

    public function licenseConfirmation(Request $request, $id)
    {
        $license = TradeLicense::find($id);
        if($license){
            $license->status = $request->status;


            try {
                $license->save();
                $data['status'] = true;
                $data['message'] = "Updated successfully!";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Failed to update";
                $data['errors'] = $th;
                return response()->json($data, 500);
            }


        } else{
            $data['status'] = false;
            $data['message'] = "Nothing found to update";
            return response()->json($data, 404);
        }
    }

    public function preview($id)
    {
        $data['license'] = TradeLicense::with(['organization'=>function($q1){
            $q1->with(['ownership'=>function($q2){
                $q2->with(['user' => function($q3){
                    $q3->with('people');
                }]);
            }]);
        }])->find($id);

        //dd($id);
        // return response()->json($data, 200);
        return view('backend.pages.organization.trade_license.preview', $data);
    }

    public function invoice($id)
    {
        $data['license'] = TradeLicense::find($id);
        return view('backend.pages.organization.trade_license.invoice', $data);
    }

    public function index()
    {
        if (Auth::user()->institute_id) {
            $data['trade_licenses'] = TradeLicense::where('institute_id', Auth::user()->institute_id )->latest()->get();
        } else{
            $data['trade_licenses'] = TradeLicense::latest()->get();
        }

        return view('backend.pages.organization.trade_license.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        return view('backend.pages.organization.trade_license.create', $data);
    }

    public function getTradeLicense()
    {
        $data['tax_years'] = TaxYear::where('status', true)->latest()->get();
        return view('backend.pages.organization.trade_license.get_license', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trade =  new TradeLicense();
        $trade->tax_year_id = $request->tax_year_id;
        $trade->organization_id = $request->organization_id;
        $trade->fees = json_encode($request->fees);
        $trade->institute_id =Auth::user()->institute_id;

        try {
            $trade->save();
            $data['status'] = true;
            $data['license'] = $trade;
            $data['redirect_url'] = route('organizationA.trade-license.invoice', $trade->id );
            $data['message'] = "Saved successfully!";
            return response()->json($data,200);

        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Failed to save!";
            $data['errors'] = $th;
            return response()->json($data,500);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        //  $data['license'] = TradeLicense::with(['organization'=>function($q1){
        //     $q1->with(['ownership'=>function($q2){
        //         $q2->with(['user' => function($q3){
        //             $q3->with('people');
        //         }]);
        //     }]);
        // }])->find($id);
         $data['license'] = TradeLicense::with([
        'organization',
        'organization.subCategory',
        'organization.ownership.user.people',
        'taxYear'
    ])->findOrFail($id);


        return view('backend.pages.organization.trade_license.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.organization.trade_license.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TradeLicense $tradeLicense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization\TradeLicense  $tradeLicense
     * @return \Illuminate\Http\Response
     */
    public function destroy(TradeLicense $tradeLicense)
    {
        //
    }
    
    public function storeManualPayment(Request $request, $id)
{
    $request->validate([
        'payment_details' => 'required|string|max:255',
        'transaction_id' => 'required|string|max:255|unique:trade_license_manual_payments,transaction_id',
        'note' => 'nullable|string|max:1000',
    ]);

    $license = OrganizationTradeLicense::findOrFail($id);

    DB::beginTransaction();
    try {
        TradeLicenseManualPayment::create([
            'trade_license_id' => $license->id,
            'invoice_no' => $license->invoice_no,
            'payment_details' => $request->payment_details,
            'transaction_id' => $request->transaction_id,
            'note' => $request->note,
            'amount' => $license->total_amount ?? 0,
            'created_by' => auth()->id(),
        ]);

        $license->payment_status = 'paid';
        $license->payment_type = 'manual';
        $license->payment_details = $request->payment_details;
        $license->transaction_id = $request->transaction_id;
        $license->payment_note = $request->note;
        $license->paid_at = now();
        $license->save();

        DB::commit();

        return redirect()
            ->route('organizationA.trade-license.index')
            ->with('success', 'Manual payment saved successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}

public function onlinePayment($id)
{
    $license = TradeLicense::findOrFail($id);

    // temporary button / placeholder
    return redirect()->away('https://your-payment-api-link.com');
}
}
