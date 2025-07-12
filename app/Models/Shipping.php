<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'user_id', 
        'nama',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'telepon'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu shipping bisa punya satu bukti pembayaran
    public function buktiPembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class, 'shipping_id');
    }
}
