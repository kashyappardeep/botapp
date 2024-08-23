<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTaskUserlist extends Model
{
    use HasFactory;
    protected $table = 'daily_tasks_userlist';

    protected $fillable = [
        'daily_task_id',
        'user_id',
        'status',
        'daily_task_id',
        'link',
        'amount',
        'type',
    ];

    public function daily_task()
    {
        return $this->belongsTo(DailyTask::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
