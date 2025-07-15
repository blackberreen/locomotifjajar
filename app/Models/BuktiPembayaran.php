<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BuktiPembayaran extends Model
{
    protected $fillable = [
        'shipping_id', 
        'nama_pembeli', 
        'nomor_hp', 
        'total_belanja', 
        'bukti_transfer', 
        'cloudinary_public_id', // Tambahkan field ini
        'status_verifikasi'
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

    // Method untuk mendapatkan URL gambar
    public function getBuktiTransferUrlAttribute()
    {
        // Jika sudah berupa URL (dari Cloudinary), return langsung
        if (filter_var($this->bukti_transfer, FILTER_VALIDATE_URL)) {
            return $this->bukti_transfer;
        }
        
        // Jika masih berupa nama file (untuk backward compatibility)
        return asset('storage/bukti_transfer/' . $this->bukti_transfer);
    }

    // Method untuk delete gambar dari Cloudinary
    public function deleteCloudinaryImage()
    {
        if ($this->cloudinary_public_id) {
            try {
                Cloudinary::destroy($this->cloudinary_public_id);
            } catch (\Exception $e) {
                // Log error jika diperlukan
                \Log::error('Failed to delete Cloudinary image: ' . $e->getMessage());
            }
        }
    }

    // Override delete method untuk hapus gambar dari Cloudinary
    public function delete()
    {
        $this->deleteCloudinaryImage();
        return parent::delete();
    }
}