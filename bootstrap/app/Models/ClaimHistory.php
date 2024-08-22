<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimHistory extends Model
{
    use HasFactory;
    protected $table = 'claim_historys';

    protected $fillable = [
        'user_id', 'telegram_id', 'amount', 'type', 'last_claim_timestamp'
    ];
}
