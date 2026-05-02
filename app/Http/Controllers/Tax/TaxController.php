<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Models\BasicSettings\Village;
use App\Models\Institute;
use App\Models\Tax\Tax;
use App\Models\Tax\TaxYear;
use App\Models\Union;
use App\Models\UnionWard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['taxes'] = Tax::with(array('user'=>function($q1){
            $q1->with('people', 'familyInfo');
        }))->where('institute_id', Auth::user()->institute_id)->get();
        return view('backend.pages.tax.index', $data);
    }

    public function taxReceipt($id)
    {
        $data['tax'] = Tax::with(array('user'=>function($q1){
            $q1->with('people', 'familyInfo');
        }))->find($id);
        return view('backend.pages.tax.receipt', $data);
    }

    public function taxReceived()
    {
        $data['taxes'] = Tax::with(array('user'=>function($q1){
            $q1->with('people', 'familyInfo');
        }))->where('institute_id', Auth::user()->institute_id)->get();
        return view('backend.pages.tax.received', $data);
    }

    public function taxConfirmed($id)
    {
        $data['tax'] = Tax::with(array('user'=>function($q1){
            $q1->with('people', 'familyInfo');
        }))->find($id);
        return view('backend.pages.tax.confirm_received', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institute = Institute::find(Auth::user()->institute_id);
        $data['tax_years'] = TaxYear::latest()->get();
        $data['union_wards'] = UnionWard::get();
        $data['villages'] = Village::where('union_id', $institute->union_id ?? 0 )->get();
        return view('backend.pages.tax.create', $data);
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
            'user_system_id' => 'required',
        ]);

        if ($validate->fails()) {
            $data['status'] = false;
            $data['message'] = "Sorry! Invalid Entry.";
            $data['errors'] = $validate->errors();
            return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
        }

        $result = DB::transaction(function () use ($request) {

            $tax = new Tax();
            $tax->institute_id = Auth::user()->institute_id;
            $tax->tax_year_id = $request->tax_year_id;
            $tax->village_id = $request->village_id;
            $tax->ward_id = $request->ward_id;
            $tax->area_id = $request->area_id;
            $tax->house_id = $request->house_id;
            $tax->user_id = $request->user_id;
            $tax->user_system_id = $request->user_system_id;

            $tax->previous_residence_tax = $request->previous_residence_tax;
            $tax->previous_income_tax = $request->previous_income_tax;
            $tax->previous_entertainment_institute_tax = $request->previous_entertainment_institute_tax;
            $tax->previous_license_tax = $request->previous_license_tax;
            $tax->previous_bazar_tax = $request->previous_bazar_tax;
            $tax->previous_land_tax = $request->previous_land_tax;
            $tax->previous_auction_tax = $request->previous_auction_tax;
            $tax->previous_fine = $request->previous_fine;
            $tax->previous_others = $request->previous_others;
            $tax->previous_extra = $request->previous_extra;

            $tax->residence_tax = $request->residence_tax;
            $tax->income_tax = $request->income_tax;
            $tax->entertainment_institute_tax = $request->entertainment_institute_tax;
            $tax->license_tax = $request->license_tax;
            $tax->bazar_tax = $request->bazar_tax;
            $tax->land_tax = $request->land_tax;
            $tax->auction_tax = $request->auction_tax;
            $tax->fine = $request->fine;
            $tax->others = $request->others;
            $tax->extra = $request->extra;

            try {
                $tax->save();
                $data['status'] = true;
                $data['message'] = "Tax generated successfully!";
                $data['result'] = $tax;
                $data['code'] = 200;
                // $data['redirect_url'] = route('age.index');
                $data['redirect_url'] = route('tax.show', $tax->id);
                return $data;
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] = $th;
                $data['code'] = 500;
                return $data;
            }
        });

        return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
    }

    public function taxStatus(Request $request)
    {
        $tax = Tax::find($request->id);
        if($tax){
            try {
                $tax->status = $request->status;
                $tax->save();
                $data['status'] = true;
                $data['message'] = "Tax status updated successfully!";
                return response()->json($data, 200);
            } catch (\Throwable $th) {
                $data['status'] = false;
                $data['message'] = "Something went wrong! Please try again...";
                $data['errors'] =  $th;
                return response()->json($data, 500);
            }
        }else {
            $data['status'] = false;
            $data['message'] = "Nothing found to update";
            return response()->json($data, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['tax'] = Tax::with(array('user'=>function($q1){
            $q1->with('people', 'familyInfo');
        }))->find($id);
        return view('backend.pages.tax.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.pages.tax.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
