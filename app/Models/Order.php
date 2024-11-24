<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    // Menentukan tabel yang digunakan
    protected $table = 'orders';


    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'promo_code_id',
        'product_id',
        'sub_total_amount',
        'grand_total_amount',
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

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_orders', 'order_id', 'product_id');
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }
}
