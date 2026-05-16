<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    // # Model Data Pengiriman
    protected $fillable = ['order_id', 'status', 'tracking_number', 'estimated_date', 'notes'];

    protected $casts = ['estimated_date' => 'date'];

    // # Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
