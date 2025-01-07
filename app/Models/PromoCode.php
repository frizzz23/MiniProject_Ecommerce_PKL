<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    // Menentukan nama tabel
    protected $table = 'promo_codes';

    // Kolom yang dapat diisi
    protected $fillable = [
        'discount_amount',
        'code',
        'quantity',          // Jumlah kode yang tersedia
        'minimum_purchase',  // Minimal pembelian untuk mendapatkan diskon
    ];

    public function usedPromoCodes()
    {
        return $this->hasMany(UsedPromoCode::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'used_promo_codes', 'promo_code_id', 'user_id')
            ->withPivot('created_at')
            ->withTimestamps();;
    }

    /**
     * Kurangi jumlah kode jika tersedia
     *
     * @return bool
     */
    public function decrementQuantity(): bool
    {
        if ($this->quantity > 0) {
            $this->decrement('quantity'); // Mengurangi jumlah dengan cara aman
            return true;
        }

        return false; // Jika tidak ada quantity, kembalikan false
    }
}
