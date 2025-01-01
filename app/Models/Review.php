<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','phone','email', 'user_id', 'rating', 'message'];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
