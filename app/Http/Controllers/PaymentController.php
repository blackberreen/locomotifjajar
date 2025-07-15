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
            // Method 1: Upload langsung dengan file
            $uploadedFile = $request->file('bukti_transfer');
            
            $uploadResult = Cloudinary::uploadFile($uploadedFile, [
                'folder' => 'bukti_transfer',
                'resource_type' => 'image'
            ]);

            // Debug: Cek hasil upload
            \Log::info('Cloudinary Upload Result:', ['result' => $uploadResult]);

            // Ambil URL dan public_id dari hasil upload
            $imageUrl = $uploadResult->getSecurePath();
            $publicId = $uploadResult->getPublicId();

            // Validasi hasil upload
            if (!$imageUrl || !$publicId) {
                throw new \Exception('Upload berhasil tapi tidak mendapatkan URL atau Public ID');
            }

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
            \Log::error('Cloudinary Upload Error:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal upload gambar: ' . $e->getMessage());
        }
    }

    public function showConfirmation()
    {
        return view('payment_confirmation');
    }
}