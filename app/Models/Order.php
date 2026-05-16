<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // # Model Pesanan
    protected $fillable = ['user_id', 'order_code', 'status', 'total_price', 'shipping_address', 'payment_method', 'notes'];

    // # Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // # Relasi ke Item Pesanan
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // # Relasi ke Pengiriman
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }
}
