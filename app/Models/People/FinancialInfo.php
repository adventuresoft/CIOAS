<?php

namespace App\Models\People;

use App\Models\BasicSettings\AccountType;
use App\Models\BasicSettings\Bank;
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

    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'account_type', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
