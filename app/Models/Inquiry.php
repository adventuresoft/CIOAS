<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'details',
        'applicant_name',
        'father_name',
        'nid_number',
        'mobile_number',
        'email',
        'address',
        'proof_file',
        'status',
        'comment',
    ];
}
