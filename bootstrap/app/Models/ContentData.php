<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentData extends Model
{
    use HasFactory;

    protected $fillable = ['link', 'linkverify_id', 'telegram_id', 'status', 'type'];
}
