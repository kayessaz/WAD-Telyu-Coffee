<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'hot_price',
        'ice_price',
        'price',
        'image_url',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function histories()
    {
        return $this->belongsToMany(History::class, 'history_product', 'product_id', 'history_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'history_product')
                    ->withPivot('quantity', 'total_price', 'payment_method')
                    ->withTimestamps();
    }
}
