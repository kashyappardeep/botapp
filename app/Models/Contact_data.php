<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_data extends Model
{
    protected $table = 'content_data';
    use HasFactory;
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
