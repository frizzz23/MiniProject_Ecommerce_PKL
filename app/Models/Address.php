<?php

namespace App\Models;

use App\Http\Controllers\RajaOngkirController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'addresses';

    protected $appends = ['city'];
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

    public function orders()
    {
        return $this->hasMany(Order::class, 'addresses_id');
    }


    public function getCityAttribute()
    {
        return City::findByCityId($this->city_id);
    }
}
