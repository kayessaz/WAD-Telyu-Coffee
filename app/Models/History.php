<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'hot_price',
        'ice_price',
        'price',
        'image_url',
        'total_price',
        'payment_method',
        'product_name', // Added product_name column
        'category'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'history_product', 'history_id', 'product_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
