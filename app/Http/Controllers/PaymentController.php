<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\BuktiPembayaran;
use App\Models\Shipping;
use App\Models\OrderDetail;
use App\Models\OrderShipment;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PaymentController extends Controller
{
    public function showForm()
    {
        $total = session('order_total', 0);
        return view('payment', compact('total'));
    }

    public function storeProof(Request $request)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $shippingId = session('shipping_id');
        $shipping = Shipping::find($shippingId);
        
        if (!$shipping) {
            return back()->with('error', 'Data pengiriman tidak ditemukan.');
        }

        try {
            // Validasi konfigurasi Cloudinary terlebih dahulu
            $cloudName = config('cloudinary.cloud_name');
            $apiKey = config('cloudinary.api_key');
            $apiSecret = config('cloudinary.api_secret');

            if (empty($cloudName) || empty($apiKey) || empty($apiSecret)) {
                throw new \Exception('Konfigurasi Cloudinary tidak lengkap. Pastikan CLOUDINARY_CLOUD_NAME, CLOUDINARY_API_KEY, dan CLOUDINARY_API_SECRET sudah diset.');
            }

            \Log::info('Cloudinary Config Check:', [
                'cloud_name' => $cloudName,
                'api_key' => $apiKey,
                'api_secret' => $apiSecret ? '***SET***' : 'NOT_SET'
            ]);

            // Upload file ke Cloudinary
            $uploadedFile = $request->file('bukti_transfer');
            
            \Log::info('File Info:', [
                'name' => $uploadedFile->getClientOriginalName(),
                'size' => $uploadedFile->getSize(),
                'mime' => $uploadedFile->getMimeType(),
                'path' => $uploadedFile->getRealPath()
            ]);

            // Pastikan file exists dan readable
            if (!file_exists($uploadedFile->getRealPath())) {
                throw new \Exception('File tidak ditemukan atau tidak dapat dibaca.');
            }

            // Upload dengan parameter yang lebih spesifik
            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'bukti_transfer',
                'resource_type' => 'image',
                'use_filename' => true,
                'unique_filename' => true,
                'overwrite' => false
            ]);

            \Log::info('Upload Result:', [
                'result' => $uploadResult,
                'type' => gettype($uploadResult),
                'is_null' => is_null($uploadResult)
            ]);

            // Cek apakah upload berhasil
            if (is_null($uploadResult)) {
                throw new \Exception('Upload gagal - hasil upload null. Periksa kredensial Cloudinary.');
            }

            // Ekstrak URL dan public_id dari hasil upload
            $imageUrl = null;
            $publicId = null;

            // Handle berbagai format response dari Cloudinary
            if (is_array($uploadResult)) {
                $imageUrl = $uploadResult['secure_url'] ?? $uploadResult['url'] ?? null;
                $publicId = $uploadResult['public_id'] ?? null;
            } elseif (is_object($uploadResult)) {
                // Untuk objek, coba berbagai property yang mungkin ada
                $imageUrl = $uploadResult->secure_url ?? $uploadResult->url ?? null;
                $publicId = $uploadResult->public_id ?? null;
                
                // Jika masih null, coba method getter
                if (!$imageUrl && method_exists($uploadResult, 'getSecureUrl')) {
                    $imageUrl = $uploadResult->getSecureUrl();
                }
                if (!$publicId && method_exists($uploadResult, 'getPublicId')) {
                    $publicId = $uploadResult->getPublicId();
                }
            }

            \Log::info('Extracted Values:', [
                'imageUrl' => $imageUrl,
                'publicId' => $publicId
            ]);

            // Validasi hasil ekstraksi
            if (empty($imageUrl)) {
                throw new \Exception('Gagal mendapatkan URL gambar dari Cloudinary. Response: ' . json_encode($uploadResult));
            }

            if (empty($publicId)) {
                throw new \Exception('Gagal mendapatkan Public ID dari Cloudinary. Response: ' . json_encode($uploadResult));
            }

            // Hitung total belanja
            $cart = session('cart', []);
            $total = collect($cart)->sum(function ($item) {
                return $item['harga'] * $item['quantity'];
            });

            // Simpan data bukti pembayaran dengan URL Cloudinary
            $order = BuktiPembayaran::create([
                'shipping_id' => $shipping->id,
                'nama_pembeli' => $shipping->nama,
                'nomor_hp' => $shipping->telepon,
                'total_belanja' => $total,
                'bukti_transfer' => $imageUrl,
                'cloudinary_public_id' => $publicId,
                'status_verifikasi' => 'Menunggu'
            ]);

            // Simpan detail pesanan
            foreach ($cart as $item) {
                OrderDetail::create([
                    'bukti_pembayaran_id' => $order->id,
                    'nama_produk' => $item['nama'],
                    'jumlah' => $item['quantity']
                ]);
            }

            // Buat entry shipment
            OrderShipment::create([
                'bukti_pembayaran_id' => $order->id,
                'status' => 'belum_dikirim'
            ]);

            // Bersihkan session
            session()->forget('cart');
            session()->forget('shipping_data');
            session()->forget('shipping_id');
            session()->forget('order_total');

            return redirect()->route('payment.confirmation')->with([
                'success' => true,
                'path' => $imageUrl
            ]);

        } catch (\Exception $e) {
            \Log::error('Payment Upload Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return back()->with('error', 'Gagal upload gambar: ' . $e->getMessage());
        }
    }

    public function showConfirmation()
    {
        return view('payment_confirmation');
    }
}