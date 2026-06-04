<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentSlot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'slot_date',
        'start_time',
        'end_time',
        'slot_type',
        'capacity',
        'status',
    ];

    public function officer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(AppointmentBooking::class, 'slot_id');
    }
}
