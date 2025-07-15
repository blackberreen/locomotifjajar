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
        \Log::info('Cloudinary ENV', [
            'cloud_name' => config('cloudinary.cloudinary.cloud_name'),
            'api_key' => config('cloudinary.cloudinary.api_key'),
            'api_secret' => config('cloudinary.cloudinary.api_secret') ? 'SET' : 'NOT SET'
        ]);
        try {
            // Debug: Cek konfigurasi Cloudinary
            \Log::info('Cloudinary Config:', [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret') ? '***SET***' : 'NOT_SET'
            ]);

            // Upload file ke Cloudinary
            $uploadedFile = $request->file('bukti_transfer');
            
            \Log::info('File Info:', [
                'name' => $uploadedFile->getClientOriginalName(),
                'size' => $uploadedFile->getSize(),
                'mime' => $uploadedFile->getMimeType(),
                'path' => $uploadedFile->getRealPath()
            ]);

            $uploadResult = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'bukti_transfer',
                'resource_type' => 'image'
            ]);

            // Debug: Cek hasil upload secara detail
            \Log::info('Upload Result Debug:', [
                'type' => gettype($uploadResult),
                'is_null' => is_null($uploadResult),
                'is_array' => is_array($uploadResult),
                'is_object' => is_object($uploadResult),
                'content' => $uploadResult
            ]);

            // Cek apakah uploadResult null
            if (is_null($uploadResult)) {
                throw new \Exception('Upload result is null - kemungkinan masalah kredensial Cloudinary');
            }

            // Validasi hasil upload - cek apakah array atau objek
            $imageUrl = null;
            $publicId = null;

            if (is_array($uploadResult)) {
                $imageUrl = $uploadResult['secure_url'] ?? null;
                $publicId = $uploadResult['public_id'] ?? null;
            } elseif (is_object($uploadResult)) {
                // Coba beberapa method yang mungkin ada
                if (method_exists($uploadResult, 'getSecurePath')) {
                    $imageUrl = $uploadResult->getSecurePath();
                } elseif (method_exists($uploadResult, 'getSecureUrl')) {
                    $imageUrl = $uploadResult->getSecureUrl();
                } elseif (isset($uploadResult->secure_url)) {
                    $imageUrl = $uploadResult->secure_url;
                }

                if (method_exists($uploadResult, 'getPublicId')) {
                    $publicId = $uploadResult->getPublicId();
                } elseif (isset($uploadResult->public_id)) {
                    $publicId = $uploadResult->public_id;
                }
            }

            \Log::info('Extracted Values:', [
                'imageUrl' => $imageUrl,
                'publicId' => $publicId
            ]);

            // Validasi hasil upload
            if (!$imageUrl || !$publicId) {
                throw new \Exception('Upload berhasil tapi tidak mendapatkan URL atau Public ID. URL: ' . $imageUrl . ', Public ID: ' . $publicId);
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
                'bukti_transfer' => $imageUrl, // Simpan URL Cloudinary
                'cloudinary_public_id' => $publicId, // Simpan public_id untuk keperluan delete
                'status_verifikasi' => 'Menunggu'
            ]);

            // Simpan detail pesanan (order_details)
            foreach ($cart as $item) {
                OrderDetail::create([
                    'bukti_pembayaran_id' => $order->id,
                    'nama_produk' => $item['nama'],
                    'jumlah' => $item['quantity']
                ]);
            }

            // Buat entry shipment dengan status default
            OrderShipment::create([
                'bukti_pembayaran_id' => $order->id,
                'status' => 'belum_dikirim'
            ]);

            // Kosongkan keranjang setelah checkout
            session()->forget('cart');
            session()->forget('shipping_data');
            session()->forget('shipping_id');
            session()->forget('order_total');

            return redirect()->route('payment.confirmation')->with([
                'success' => true,
                'path' => $imageUrl
            ]);

        } catch (\Exception $e) {
            \Log::error('Cloudinary Upload Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Gagal upload gambar: ' . $e->getMessage());
        }
    }

    public function showConfirmation()
    {
        return view('payment_confirmation');
    }
}