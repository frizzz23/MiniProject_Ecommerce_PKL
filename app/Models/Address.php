<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'addresses';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'address',
        'no_telepon',
        'city_id',
        'mark',
    ];

    /**
     * Relasi ke model User (Many-to-One).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class,);
    }
}
