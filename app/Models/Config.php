<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $table = 'configs';
    protected $fillable = [
        'daily_roi',
        'admin_wallet_address',
        'level_of_referral',
        'gateway_key',
        'task_amount',
        'content_reward',
        'min_withdrawal',
        'min_investment'

    ];
}
