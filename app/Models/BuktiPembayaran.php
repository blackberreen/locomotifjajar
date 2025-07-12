<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class BuktiPembayaran extends Model
{
    protected $fillable = [
        'shipping_id', 'nama_pembeli', 'nomor_hp', 'total_belanja', 'bukti_transfer', 'status_verifikasi'
    ];

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(\App\Models\OrderDetail::class, 'bukti_pembayaran_id');
    }

    // Relasi ke OrderShipment
    public function shipment()
    {
        return $this->hasOne(OrderShipment::class, 'bukti_pembayaran_id');
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status_verifikasi) {
            'Menunggu' => 'Menunggu Konfirmasi',
            'Terverifikasi' => 'Terverifikasi',
            'Ditolak' => 'Gagal',
            default => 'Unknown'
        };
    }
}