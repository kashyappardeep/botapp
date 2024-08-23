<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTask extends Model
{
    use HasFactory;
    protected $table = 'daily_tasks';

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'amount',
        'description',
        'type',
        'status',
    ];
}
