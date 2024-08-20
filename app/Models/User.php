<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function claimHistories()
    {
        return $this->hasMany(ClaimHistory::class);
    }

    public function Referral()
    {
        return $this->hasMany(TransactionHistory::class, 'by', 'id');
    }

    public function UserTask()
    {
        return $this->hasMany(UserTask::class);
    }

    public function investmentHistory()
    {
        return $this->hasMany(InvestmentHistory::class);
    }

    public function TotalInvestment()
    {
        return $this->investmentHistory()->sum('amount');
    }


    public function Contact_data()
    {
        return $this->hasMany(Contact_data::class, 'telegram_id', 'telegram_id');
    }
}
