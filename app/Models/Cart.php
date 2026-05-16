<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // # Model Keranjang Belanja
    protected $fillable = ['user_id', 'book_id', 'quantity'];

    // # Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // # Relasi ke Buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
