<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentSlot;
use Illuminate\Support\Facades\Auth;

class AppointmentSlotController extends Controller
{
    public function index()
    {
        return view('backend.pages.appointment.slots');
    }

    public function getSlots(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $slots = AppointmentSlot::where('user_id', Auth::id())
            ->whereBetween('slot_date', [$start, $end])
            ->where('status', true)
            ->get();

        $events = [];
        foreach ($slots as $slot) {
            if ($slot->slot_type == 'emergency') {
                $events[] = [
                    'id' => $slot->id,
                    'title' => 'Emergency Slot (Cap: ' . $slot->capacity . ')',
                    'start' => $slot->slot_date,
                    'allDay' => true,
                    'color' => '#dc3545',
                    'extendedProps' => [
                        'type' => 'emergency'
                    ]
                ];
            } else {
                $events[] = [
                    'id' => $slot->id,
                    'title' => 'Regular Slot ' . date('h:i A', strtotime($slot->start_time)),
                    'start' => $slot->slot_date . 'T' . $slot->start_time,
                    'end' => $slot->end_time ? $slot->slot_date . 'T' . $slot->end_time : null,
                    'color' => '#28a745',
                    'extendedProps' => [
                        'type' => 'regular'
                    ]
                ];
            }
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'slot_date' => 'required|date',
            'slot_type' => 'required|in:regular,emergency',
            'start_time' => 'required_if:slot_type,regular',
            'capacity' => 'required|integer|min:1'
        ]);

        AppointmentSlot::create([
            'user_id' => Auth::id(),
            'slot_date' => $request->slot_date,
            'start_time' => $request->slot_type == 'regular' ? $request->start_time : null,
            'end_time' => $request->slot_type == 'regular' ? $request->end_time : null,
            'slot_type' => $request->slot_type,
            'capacity' => $request->slot_type == 'emergency' ? $request->capacity : 1,
            'status' => true
        ]);

        return response()->json(['status' => true, 'message' => 'Slot created successfully.']);
    }

    public function destroy($id)
    {
        $slot = AppointmentSlot::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        // Cannot delete if already booked
        if ($slot->bookings()->whereIn('status', ['Pending', 'Approved', 'Completed'])->exists()) {
            return response()->json(['status' => false, 'message' => 'Cannot delete a slot with active bookings.'], 400);
        }

        $slot->delete();
        return response()->json(['status' => true, 'message' => 'Slot deleted successfully.']);
    }
}
