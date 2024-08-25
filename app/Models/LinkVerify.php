<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkVerify extends Model
{
    use HasFactory;

    protected $table = 'linkverify';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'type', 'status'];

    // Relationship with User model (if needed)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with ContactData model
    public function contactData()
    {
        return $this->hasMany(Contact_data::class, 'linkverify_id', 'id');
    }
}
