<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $table = 'withdraw';
    use HasFactory;
    protected $fillable = ['user_id', 'address', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function TransactionHistory()
    {
        return $this->hasMany(TransactionHistory::class, 'user_id', 'id');
    }
}
