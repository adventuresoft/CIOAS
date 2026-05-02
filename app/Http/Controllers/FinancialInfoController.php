<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\AccountType;
use App\Models\BasicSettings\Bank;
use App\Models\People\FinancialInfo;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['user'] = User::with('financialInfos')->find($id);
        $data['account_types'] = AccountType::where('status', true)->latest()->get();
        $data['banks'] = Bank::where('status', true)->latest()->get();
        return view('backend.pages.people.tabs.financial', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $result = DB::transaction(function () use ($request) {
                $user_id = $request->user_id;
                $account_no = $request->account_no;
                $account_type = $request->account_type_id;
                $bank_id = $request->bank_id;
                $account_balance = $request->account_balance;

                $account_noU = $request->account_noU;
                $account_typeU = $request->account_typeU;
                $bank_idU = $request->bank_idU;
                $account_balanceU = $request->account_balanceU;

                // try {
                    if (!empty($account_no)) {
                        foreach ($account_no as $key => $acc_no) {
                            $financialInfo = new FinancialInfo();
                            $financialInfo->account_no = $acc_no;
                            $financialInfo->account_type_id = $account_type[$key];
                            $financialInfo->bank_id = $bank_id[$key];
                            $financialInfo->account_balance = $account_balance[$key];
                            $financialInfo->user_id = $user_id;
                            $financialInfo->save();
                        }
                    }
    
                    if (!empty($account_noU)) {
                        foreach ($account_noU as $index => $acc) {
                            $financialInfo = FinancialInfo::find($index);
                            $financialInfo->account_no = $acc;
                            $financialInfo->account_type_id = $account_typeU[$index];
                            $financialInfo->bank_id = $bank_idU[$index];
                            $financialInfo->account_balance = $account_balanceU[$index];
                            $financialInfo->save();
                        }
                    }

                    $data['status'] = true;
                    $data['message'] = "Financial data submitted successfully!";
                    $data['code'] = 200;
                    return $data;
                // } catch (\Throwable $th) {
                //     $data['code'] = 500;
                //     $data['status'] = false;
                //     $data['message'] = "Something went wrong! Please try again...";
                //     $data['errors'] = $th;
                //     return $data;
                // }

               

                


            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialInfo $financialInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialInfo $financialInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialInfo $financialInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\FinancialInfo  $financialInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialInfo $financialInfo)
    {
        //
    }
}
