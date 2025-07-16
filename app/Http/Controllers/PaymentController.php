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
use App\Services\CloudinaryService;

class PaymentController extends Controller
{
    protected $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }
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
            // Validasi konfigurasi Cloudinary
            $configStatus = $this->cloudinaryService->getConfigStatus();
            
            if (!$configStatus['configured']) {
                throw new \Exception('Konfigurasi Cloudinary tidak lengkap: ' . json_encode($configStatus));
            }

            \Log::info('Cloudinary Config Status:', $configStatus);

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

            // Upload ke Cloudinary menggunakan service
            $uploadResult = $this->cloudinaryService->uploadImage($uploadedFile, [
                'folder' => 'bukti_transfer',
                'use_filename' => true,
                'unique_filename' => true,
                'overwrite' => false
            ]);

            \Log::info('Upload Result:', [
                'result' => $uploadResult,
                'type' => gettype($uploadResult)
            ]);

            // Cek apakah upload berhasil
            if (is_null($uploadResult) || !isset($uploadResult['secure_url'])) {
                throw new \Exception('Upload gagal - hasil upload null atau tidak valid. Response: ' . json_encode($uploadResult));
            }

            $imageUrl = $uploadResult['secure_url'];
            $publicId = $uploadResult['public_id'] ?? null;

            \Log::info('Extracted Values:', [
                'imageUrl' => $imageUrl,
                'publicId' => $publicId
            ]);

            // Validasi hasil ekstraksi
            if (empty($imageUrl)) {
                throw new \Exception('Gagal mendapatkan URL gambar dari Cloudinary.');
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