<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\AppointmentBooking;
use App\Models\HotelRestaurant\HotelRestaurant;
use App\Models\Inquiry;
use App\Models\ApplicationForm\ApplicationFrom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['staffs'] = Staff::count();
        $data['appointments'] = AppointmentBooking::count();
        $data['hotel_restaurants'] = HotelRestaurant::count();
        $data['inquiries'] = Inquiry::count();
        $data['letters'] = ApplicationFrom::count();
        $data['vehicles'] = \App\Models\Vehicle::count();
        $data['case_orders'] = \App\Models\CaseOrder::count();
        $data['mis_cases'] = \App\Models\MisCase::count();
        $data['gun_licenses'] = \App\Models\PersonGunApplication::count() + \App\Models\OrgGunApplication::count() + \App\Models\OtherOrgGunApplication::count();
        
        // return response()->json($data, 200);
        return view('backend.pages.index', $data);
    }
}
