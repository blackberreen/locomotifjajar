<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_id',
        'nama_pembeli',
        'nomor_hp',
        'total_belanja',
        'bukti_transfer', // Sekarang berisi nama pemilik rekening
        'status_verifikasi',
        'status_pengiriman'
    ];

    // Relasi ke Shipping
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

    // Method untuk mendapatkan nama pemilik rekening
    public function getNamaPemilikRekeningAttribute()
    {
        return $this->bukti_transfer; // Kolom bukti_transfer sekarang berisi nama pemilik rekening
    }

    // Accessor untuk backward compatibility jika ada yang masih menggunakan bukti_transfer_url
    public function getBuktiTransferUrlAttribute()
    {
        return $this->bukti_transfer; // Sekarang berisi nama pemilik rekening
    }
}