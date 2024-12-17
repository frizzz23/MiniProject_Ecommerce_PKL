<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    /**
     * Menentukan tabel yang digunakan.
     */
    protected $table = 'orders';

    /**
     * Menentukan kolom yang dapat diisi.
     */
    protected $fillable = [
        'user_id',
        'promo_code_id',
        'postage_id',
        'addresses_id',
        'sub_total_amount',
        'grand_total_amount',
        'status_order',
        'snap_token'
    ];

    /**
     * Relasi ke model User (Many-to-One).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function addresses()
    {
        return $this->belongsTo(Address::class, 'addresses_id', 'id');
    }

    /**
     * Relasi ke model ProductOrder (One-to-Many).
     */
    public function productOrders()
    {
        return $this->hasMany(ProductOrder::class, 'order_id', 'id');
    }

    /**
     * Relasi Many-to-Many ke model Product melalui tabel perantara product_orders.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders', 'order_id', 'product_id')
            ->withPivot('quantity'); // Menambahkan kolom tambahan dari tabel pivot jika ada.
    }


    public function postage(){
        return $this->belongsTo(Postage::class, 'postage_id', 'id');
    }

    /**
     * Relasi ke model PromoCode (Many-to-One).
     */
    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'id');
    }
}
