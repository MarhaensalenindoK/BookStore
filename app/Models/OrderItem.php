<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // # Model Detail Item Pesanan
    protected $fillable = ['order_id', 'book_id', 'quantity', 'price'];

    // # Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // # Relasi ke Buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
