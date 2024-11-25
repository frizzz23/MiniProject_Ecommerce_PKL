<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $table = 'product_orders';
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
    ];

    /**
     * Relasi ke model Product (Many-to-One).
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke model Order (Many-to-One).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
