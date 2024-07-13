<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model

{
    protected $table = 'transactions_history';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'to',
        'by',
        'type',
        'level'
    ];
}
