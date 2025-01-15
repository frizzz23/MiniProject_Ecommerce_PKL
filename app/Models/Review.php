<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'reviews';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'rating',
        'comment',
    ];

    /**
     * Relasi ke model Product (Many-to-One).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke model User (Many-to-One).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Order (Many-to-One).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
