<?php

namespace App\Services;

use App\Models\AppointmentSlot;
use App\Models\AppointmentBooking;
use Illuminate\Support\Facades\DB;
use Exception;

class AppointmentService
{
    /**
     * Book an appointment with pessimistic locking to prevent race conditions.
     */
    public function bookAppointment(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Lock the slot row for update
            $slot = AppointmentSlot::where('id', $data['slot_id'])
                ->where('status', true)
                ->lockForUpdate()
                ->first();

            if (!$slot) {
                throw new Exception("Selected slot is no longer available.");
            }

            // Check expiry
            if ($slot->slot_date < date('Y-m-d') || ($slot->slot_date == date('Y-m-d') && $slot->start_time && $slot->start_time < date('H:i:s'))) {
                throw new Exception("This slot has expired.");
            }

            // Check capacity
            $currentBookingsCount = AppointmentBooking::where('slot_id', $slot->id)
                ->whereIn('status', ['Pending', 'Approved', 'Completed'])
                ->count();

            if ($currentBookingsCount >= $slot->capacity) {
                // If capacity reached, mark slot as unavailable
                $slot->update(['status' => false]);
                throw new Exception("This slot is fully booked.");
            }

            // Create booking
            $booking = AppointmentBooking::create([
                'slot_id' => $slot->id,
                'user_id' => auth()->id() ?? null,
                'officer_id' => $slot->user_id,
                'name' => $data['name'],
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'phone' => $data['phone'],
                'email' => $data['email'] ?? null,
                'nid_number' => $data['nid_number'] ?? null,
                'address' => $data['address'] ?? null,
                'purpose' => $data['purpose'] ?? null,
                'description' => $data['description'] ?? null,
                'attachment' => $data['attachment'] ?? null,
                'booking_type' => $slot->slot_type,
                'status' => 'Pending',
            ]);

            // Update slot status if capacity is reached after this booking
            if ($currentBookingsCount + 1 >= $slot->capacity) {
                $slot->update(['status' => false]);
            }

            return $booking;
        });
    }

    /**
     * Get available slots for a specific officer and date.
     */
    public function getAvailableSlots($officer_id, $start_date, $end_date)
    {
        return AppointmentSlot::where('user_id', $officer_id)
            ->where('status', true)
            ->whereBetween('slot_date', [$start_date, $end_date])
            ->where(function ($query) {
                // Not expired
                $query->where('slot_date', '>', date('Y-m-d'))
                    ->orWhere(function ($q) {
                    $q->where('slot_date', date('Y-m-d'))
                        ->where(function ($sq) {
                            $sq->whereNull('start_time')
                                ->orWhere('start_time', '>', date('H:i:s'));
                        });
                });
            })
            ->get();
    }
}
