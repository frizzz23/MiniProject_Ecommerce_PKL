<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the user's addresses.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    // Relasi dengan Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi ke promo codes melalui used_promo_codes.
     */
    public function promoCodes()
    {
        return $this->belongsToMany(PromoCode::class, 'used_promo_codes', 'user_id', 'promo_code_id')
            ->withPivot('created_at')
            ->withTimestamps();
    }

    /**
     * Relasi langsung ke tabel pivot (used_promo_codes).
     */
    public function usedPromoCodes()
    {
        return $this->hasMany(UsedPromoCode::class);
    }
}
