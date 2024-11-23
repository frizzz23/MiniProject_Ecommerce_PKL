<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name_product',
        'description_product',
        'image_product',
        'stock_product',
        'price_product',
        'category_id',
    ];

    /**
     * Relasi ke model Category (Many-to-One).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
