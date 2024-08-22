<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_data extends Model
{
    use HasFactory;

    protected $table = 'content_data';
    protected $fillable = ['telegram_id', 'linkverify_id', 'link', 'status', 'type'];

    // Relationship with User model
    public function user()
    {
        return $this->hasMany(User::class, 'telegram_id', 'id');
    }

    // Relationship with LinkVerify model
    public function linkVerify()
    {
        return $this->belongsTo(LinkVerify::class, 'linkverify_id', 'id');
    }
}
