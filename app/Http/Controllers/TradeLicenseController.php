<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradeLicenseController extends Controller
{
    public function index() {}
    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
    
    public function invoice($id) {}
    public function preview($id) {}
    public function confirmedLicense($id) {}
    public function licenseConfirmation(Request $request, $id) {}
    public function getTradeLicense() {}
    public function storeManualPayment(Request $request, $id) {}
    public function onlinePayment($id) {}
}
