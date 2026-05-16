<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // # Model Pesan User ke Admin
    protected $fillable = ['user_id', 'subject', 'body', 'reply', 'replied_at'];

    protected $casts = ['replied_at' => 'datetime'];

    // # Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
