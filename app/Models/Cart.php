<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'carts';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * Relasi ke model User (Many-to-One).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Product (Many-to-One).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
