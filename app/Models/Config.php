<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $fillable = [
        'daily_roi',
        'admin_wallet_address',
        'level_of_referral',
        'gateway_key',
    ];
}
