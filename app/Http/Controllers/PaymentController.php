<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            $uploadedFile = $request->file('bukti_transfer');

            // Upload ke Cloudinary
            $uploadResult = Cloudinary::uploadFile($uploadedFile->getRealPath(), [
                'folder' => 'bukti_transfer',
            ])->getResult(); // <-- pastikan ini dipanggil untuk mendapatkan array hasil

            // Ambil URL dan public_id dari array hasil upload
            $imageUrl = $uploadResult['secure_url'] ?? null;
            $publicId = $uploadResult['public_id'] ?? null;

            if (!$imageUrl || !$publicId) {
                throw new \Exception('Upload berhasil tapi tidak mendapatkan URL atau Public ID');
            }

            // Hitung total dari keranjang
            $cart = session('cart', []);
            $total = collect($cart)->sum(fn($item) => $item['harga'] * $item['quantity']);

            // Simpan data pembayaran
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

            // Simpan shipment
            OrderShipment::create([
                'bukti_pembayaran_id' => $order->id,
                'status' => 'belum_dikirim'
            ]);

            // Kosongkan session
            session()->forget(['cart', 'shipping_data', 'shipping_id', 'order_total']);

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
