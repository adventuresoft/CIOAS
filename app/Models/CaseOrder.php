<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'mis_case_id',
        'status',
        'next_hearing_date',
        'next_hearing_time',
        'command_type',
        'command_text',
        'command_yes_note',
        'command_yes_file',
        'command_no_file',
        'side_note',
        'order_by',
        'hearing_no',
        'date_changed',
    ];

    protected $casts = [
        'next_hearing_date' => 'date',
        'date_changed'      => 'boolean',
    ];

    /**
     * Belongs to MisCase
     */
    public function misCase()
    {
        return $this->belongsTo(MisCase::class, 'mis_case_id');
    }

    /**
     * Belongs to User (Creator/Submitter)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'order_by');
    }

    /**
     * Get status text label.
     */
    public function getStatusLabelAttribute()
    {
        if ($this->status === '1') {
            return 'Approved';
        }
        if ($this->status === '0') {
            return 'Pending';
        }
        return $this->status ?: 'Pending';
    }

    /**
     * Get status CSS class name.
     */
    public function getStatusClassAttribute()
    {
        if ($this->status === '1' || $this->status === 'হয়েছে' || $this->status === 'হмеется') {
            return 'approved';
        }
        if ($this->status === '0' || $this->status === 'হয়নি') {
            return 'pending';
        }
        if ($this->status === 'মুলতবি') {
            return 'postponed';
        }
        return 'pending';
    }

    /**
     * Get command type label.
     */
    public function getCommandTypeLabelAttribute()
    {
        if ($this->command_type === 'yes') {
            return 'Yes';
        }
        if ($this->command_type === 'no') {
            return 'No';
        }
        if ($this->command_type === 'notice') {
            return 'Notice';
        }
        if ($this->command_type === 'order') {
            return 'Order';
        }
        return $this->command_type;
    }
}

