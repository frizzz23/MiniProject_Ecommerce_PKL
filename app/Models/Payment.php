<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'payments';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'order_id',
        'image_payment',
        'payment_method',
        'status',
    ];

    /**
     * Relasi ke model Order (Many-to-One).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
