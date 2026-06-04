<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slot_id',
        'user_id',
        'officer_id',
        'name',
        'date_of_birth',
        'phone',
        'email',
        'nid_number',
        'address',
        'purpose',
        'description',
        'attachment',
        'booking_type',
        'status',
    ];

    public function slot()
    {
        return $this->belongsTo(AppointmentSlot::class, 'slot_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }
}
