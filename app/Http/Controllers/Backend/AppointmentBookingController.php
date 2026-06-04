<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentBooking;
use App\DataTables\AppointmentBookingDataTable;

class AppointmentBookingController extends Controller
{
    public function index(AppointmentBookingDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.appointment.bookings');
    }

    public function show($id)
    {

        $booking = AppointmentBooking::with(['slot', 'officer', 'user'])->findOrFail($id);
        // We'll return JSON for a modal view instead of a full page to save time, or a view
        return view('backend.pages.appointment.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected,Completed,Cancelled'
        ]);

        $booking = AppointmentBooking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return response()->json(['status' => true, 'message' => 'Booking status updated successfully.']);
    }
}
