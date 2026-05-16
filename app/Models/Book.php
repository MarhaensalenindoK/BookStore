<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // # Model Data Buku
    protected $fillable = ['category_id', 'title', 'author', 'publisher', 'year', 'stock', 'price', 'description', 'cover_image'];

    // # Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // # Relasi ke Cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // # Relasi ke Order Items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
