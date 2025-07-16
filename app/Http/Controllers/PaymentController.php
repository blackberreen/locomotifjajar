<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120' // 5MB max
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
                throw new \Exception('Konfigurasi Cloudinary tidak lengkap');
            }

            // Upload file ke Cloudinary
            $uploadedFile = $request->file('bukti_transfer');
            
            Log::info('Starting file upload', [
                'file_name' => $uploadedFile->getClientOriginalName(),
                'file_size' => $uploadedFile->getSize(),
                'mime_type' => $uploadedFile->getMimeType()
            ]);

            // Upload ke Cloudinary
            $uploadResult = $this->cloudinaryService->uploadImage($uploadedFile, [
                'folder' => 'bukti_transfer',
                'use_filename' => true,
                'unique_filename' => true,
                'overwrite' => false
            ]);

            // Hitung total belanja
            $cart = session('cart', []);
            $total = collect($cart)->sum(function ($item) {
                return $item['harga'] * $item['quantity'];
            });

            // Simpan data bukti pembayaran
            $order = BuktiPembayaran::create([
                'shipping_id' => $shipping->id,
                'nama_pembeli' => $shipping->nama,
                'nomor_hp' => $shipping->telepon,
                'total_belanja' => $total,
                'bukti_transfer' => $uploadResult['secure_url'],
                'cloudinary_public_id' => $uploadResult['public_id'],
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
            session()->forget(['cart', 'shipping_data', 'shipping_id', 'order_total']);

            return redirect()->route('payment.confirmation')->with([
                'success' => true,
                'path' => $uploadResult['secure_url']
            ]);

        } catch (\Exception $e) {
            Log::error('Payment Upload Error', [
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