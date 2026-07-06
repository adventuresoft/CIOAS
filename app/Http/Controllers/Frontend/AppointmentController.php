<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\AppointmentService;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {

        $this->appointmentService = $appointmentService;
    }

    public function officerList()
    {
        $officers = User::whereIn('user_type', ['admin', 'superadmin'])->get();
        return view('frontend.pages.appointment.officer_list', compact('officers'));
    }

    public function calendar($officer_id)
    {
        $officer = User::findOrFail($officer_id);
        return view('frontend.pages.appointment.calendar', compact('officer'));
    }

    public function getAvailableSlots(Request $request, $officer_id)
    {
        $start = $request->start;
        $end = $request->end;

        $slots = $this->appointmentService->getAvailableSlots($officer_id, $start, $end);

        $events = [];
        foreach ($slots as $slot) {
            if ($slot->slot_type == 'emergency') {
                $events[] = [
                    'id' => $slot->id,
                    'title' => 'Emergency Appointment',
                    'start' => $slot->slot_date,
                    'allDay' => true,
                    'color' => '#dc3545',
                    'url' => route('appointment.book', $slot->id)
                ];
            } else {
                $events[] = [
                    'id' => $slot->id,
                    'title' => date('h:i A', strtotime($slot->start_time)),
                    'start' => $slot->slot_date . 'T' . $slot->start_time,
                    'color' => '#28a745',
                    'url' => route('appointment.book', $slot->id)
                ];
            }
        }

        return response()->json($events);
    }

    public function getSlotsByDate(Request $request, $officer_id)
    {
        $date = $request->date;
        $slots = $this->appointmentService->getAvailableSlots($officer_id, $date, $date);
        $regularSlots = [];
        $emergency = [];

        foreach ($slots as $slot) {
            if ($slot->slot_type == 'emergency') {
                $emergency[] = [
                    'id' => $slot->id,
                    'title' => 'Emergency',
                    'url' => route('appointment.book', $slot->id)
                ];
            } else {
                $time = strtotime($slot->start_time);
                $formattedTime = date('h:i A', $time);

                $regularSlots[] = [
                    'id' => $slot->id,
                    'time' => $formattedTime,
                    'url' => route('appointment.book', $slot->id)
                ];
            }
        }

        return response()->json([
            'slots' => $regularSlots,
            'emergency' => $emergency
        ]);
    }

    public function bookForm($slot_id)
    {
        $slot = \App\Models\AppointmentSlot::with('officer')->findOrFail($slot_id);
        return view('frontend.pages.appointment.book', compact('slot'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:appointment_slots,id',
            'name' => 'required|string|max:190',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:190',
            'email' => 'required|email|max:190',
            'nid_number' => 'required|string|max:190',
            'address' => 'required|string|max:1000',
            'purpose' => 'required|string|max:190',
            'description' => 'required|string|max:2000',
        ]);

        try {
            $booking = $this->appointmentService->bookAppointment($request->all());
            return response()->json(['status' => true, 'message' => 'Appointment booked successfully.', 'redirect_url' => route('appointment.officers')]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
