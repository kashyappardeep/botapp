<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;
    protected $table = 'users_tasks';
    protected $fillable = [

        'user_id',
        'task_id',
        'amount',
        'type',
    ];
}
