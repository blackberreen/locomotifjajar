<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the bookings for the user.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }
    
    /**
     * Get the latest booking for the user.
     */
    public function latestBooking()
    {
        return $this->hasOne(Booking::class, 'user_id', 'id')->latest();
    }

    /**
     * Get pending bookings for the user.
     */
    public function pendingBookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id')->where('is_completed', false);
    }

    /**
     * Get completed bookings for the user.
     */
    public function completedBookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id')->where('is_completed', true);
    }
    
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }

    public function latestShipping()
    {
        return $this->hasOne(Shipping::class)->latest();
    }

    // Relasi ke UserProfile
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    // Relasi ke BuktiPembayaran melalui shipping
    public function buktiPembayarans()
    {
        return $this->hasManyThrough(BuktiPembayaran::class, Shipping::class);
    }
}