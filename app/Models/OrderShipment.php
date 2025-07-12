<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
    protected $primaryKey = 'shipmentid';
    protected $fillable = [
        'bukti_pembayaran_id',
        'resi_number',
        'status'
    ];

    public function buktiPembayaran()
    {
        return $this->belongsTo(BuktiPembayaran::class, 'bukti_pembayaran_id');
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'belum_dikirim' => 'Belum Dikirim',
            'sedang_dikirim' => 'Sedang Dikirim', 
            'sudah_dikirim' => 'Sudah Dikirim',
            default => 'Unknown'
        };
    }
}