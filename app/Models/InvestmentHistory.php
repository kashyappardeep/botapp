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
        'amount',
        'address',
        'status',
        'type',
        'tx_hash',
        'invest_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
