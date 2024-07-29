<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [

        'description',
        'amount',
        'type',
        'images',
    ];

    public function userTasks()
    {
        return $this->hasOne(UserTask::class);
    }
}
