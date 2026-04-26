<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInfo extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $table = 'financial_infos';
    protected $fillable = ['user_id',
    'account_no',
    'account_type',
    'bank_id',
    'account_balance'
    ];
}
