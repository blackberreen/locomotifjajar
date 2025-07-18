<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}