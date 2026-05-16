<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // # Model User - admin dan user biasa
    protected $fillable = ['name', 'username', 'password', 'role', 'email', 'phone', 'address'];

    // # Relasi ke Cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // # Relasi ke Order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // # Relasi ke Pesan
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
