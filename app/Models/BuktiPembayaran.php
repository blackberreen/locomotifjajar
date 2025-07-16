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
        'cloudinary_public_id',
        'status_verifikasi'
    ];

    // ... existing relations

    // Method untuk mendapatkan URL gambar dengan transformasi
    public function getBuktiTransferUrlAttribute()
    {
        if (filter_var($this->bukti_transfer, FILTER_VALIDATE_URL)) {
            return $this->bukti_transfer;
        }
        
        return asset('storage/bukti_transfer/' . $this->bukti_transfer);
    }

    // Method untuk mendapatkan thumbnail (v3.0 syntax)
    public function getThumbnailUrlAttribute()
    {
        if ($this->cloudinary_public_id) {
            try {
                return Cloudinary::getUrl($this->cloudinary_public_id, [
                    'transformation' => [
                        'width' => 300,
                        'height' => 300,
                        'crop' => 'fill',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]
                ]);
            } catch (\Exception $e) {
                \Log::error('Error generating thumbnail: ' . $e->getMessage());
                return $this->bukti_transfer_url;
            }
        }
        
        return $this->bukti_transfer_url;
    }

    // Method untuk mendapatkan URL dengan transformasi custom
    public function getTransformedUrl(array $transformations = [])
    {
        if ($this->cloudinary_public_id) {
            try {
                return Cloudinary::getUrl($this->cloudinary_public_id, [
                    'transformation' => $transformations
                ]);
            } catch (\Exception $e) {
                \Log::error('Error generating transformed URL: ' . $e->getMessage());
                return $this->bukti_transfer_url;
            }
        }
        
        return $this->bukti_transfer_url;
    }

    // Method untuk delete gambar dari Cloudinary (v3.0)
    public function deleteCloudinaryImage()
    {
        if ($this->cloudinary_public_id) {
            try {
                $result = Cloudinary::destroy($this->cloudinary_public_id);
                \Log::info('Cloudinary image deleted', [
                    'public_id' => $this->cloudinary_public_id,
                    'result' => $result
                ]);
                return $result;
            } catch (\Exception $e) {
                \Log::error('Failed to delete Cloudinary image: ' . $e->getMessage());
                return false;
            }
        }
        return true;
    }

    // Override delete method
    public function delete()
    {
        $this->deleteCloudinaryImage();
        return parent::delete();
    }
}