<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $primaryKey = 'detailid';
    protected $fillable = [
        'bukti_pembayaran_id', 'nama_produk', 'jumlah', 'total'
    ];

    public function pembayaran()
    {
        return $this->belongsTo(BuktiPembayaran::class, 'bukti_pembayaran_id');
    }
}