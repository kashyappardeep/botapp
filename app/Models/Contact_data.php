<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_data extends Model
{
    protected $table = 'content_data';
    use HasFactory;
    protected $fillable = ['telegram_id', 'linkverify_id', 'link', '	status'];

    public function user()
    {
        return $this->hasMany(User::class, 'telegram_id', 'id');
    }
}
