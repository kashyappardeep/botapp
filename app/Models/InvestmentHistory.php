<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentHistory extends Model
{
    use HasFactory;
    protected $table = 'investment_history';

    protected $fillable = [
        'user_id',
        'telegram_id',
        'amount',
        'tx_hash',
        'order_id',
        'invest_at'
    ];
}
