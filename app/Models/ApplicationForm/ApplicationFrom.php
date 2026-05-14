<?php

namespace App\Models\ApplicationForm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationFrom extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'recipient',
        'subject',
        'sender',
        'nid_no',
        'mobile',
        'message',
        'attachment',
        'created_by',
        'updated_by',
    ];
}
