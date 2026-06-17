<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institute;

class CaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'mis_case_id',
        'status',
        'memorial_no',
        'next_hearing_date',
        'next_hearing_time',
        'command_type',
        'command_start_date',
        'command_till_date',
        'command_end_date',
        'command_text',
        'order_law',
        'form_number',
        'command_yes_note',
        'command_yes_file',
        'command_no_file',
        'files',
        'side_note',
        'order_by',
        'hearing_no',
        'date_changed',
    ];

    protected $casts = [
        'next_hearing_date' => 'date',
        'command_start_date' => 'date',
        'command_till_date' => 'date',
        'command_end_date' => 'date',
        'date_changed' => 'boolean',
        'files' => 'array',
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
        return ucfirst($this->status ?: 'Pending');
    }

    /**
     * Get status CSS class name.
     */
    public function getStatusClassAttribute()
    {
        $status = strtolower($this->status);
        if (in_array($status, ['1', 'হয়েছে', 'হмеется', 'approved'])) {
            return 'approved';
        }
        if (in_array($status, ['0', 'হয়নি', 'pending'])) {
            return 'pending';
        }
        if ($status === 'মুলতবি') {
            return 'postponed';
        }
        return $status ?: 'pending';
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


    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }

}

