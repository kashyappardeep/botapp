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
<<<<<<< HEAD
=======
        'tx_hash',
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
        'invest_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
