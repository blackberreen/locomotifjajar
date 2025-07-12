<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'bookingid';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'nama',
        'nomor_telpon',
        'jenis_motor',
        'jasa',
        'keluhan',
        'tanggal_booking',
        'is_completed',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
        'is_completed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope a query to only include completed bookings.
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    /**
     * Get the booking status text.
     */
    public function getStatusTextAttribute()
    {
        return $this->is_completed ? 'Selesai' : 'Menunggu';
    }

    /**
     * Get the booking status color class.
     */
    public function getStatusColorAttribute()
    {
        return $this->is_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
    }

    /**
     * Get formatted booking ID for display
     */
    public function getFormattedIdAttribute()
    {
        return str_pad($this->bookingid, 6, '0', STR_PAD_LEFT);
    }
}