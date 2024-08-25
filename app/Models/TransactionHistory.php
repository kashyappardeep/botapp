<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;
    protected $table = 'transactions_history';

    protected $fillable = [
        'user_id',
        'to',
        'by',
        'level',
        'amount',
        'type',
        'task_id',
        'address',
<<<<<<< HEAD
        'status'
=======
        'status',
        'tx_hash',
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Withdraw()
    {
        return $this->belongsTo(Withdraw::class, 'user_id', 'id');
    }
    public function userBy()
    {
        return $this->belongsTo(User::class, 'by', 'id');
    }
}
