<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'orders';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'product_id',
        'total_order',
        'status_order',
    ];

    /**
     * Relasi ke model User (Many-to-One).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model OrderDetail (One-to-Many).
     */
    public function productOrder()
    {
        return $this->hasMany(ProductOrder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
