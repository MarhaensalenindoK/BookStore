<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // # Model Kategori Buku
    protected $fillable = ['name', 'slug', 'description'];

    // # Relasi ke Buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
