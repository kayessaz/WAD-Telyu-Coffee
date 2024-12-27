<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'hot_price', 'ice_price', 'image_url', 'category'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function History()
    {
        return $this->hasMany(History::class);
    }
}
