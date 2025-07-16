<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\BuktiPembayaran;
use App\Models\Shipping;
use App\Models\OrderDetail;
use App\Models\OrderShipment;

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
            'nama_pemilik_rekening' => 'required|string|max:255'
        ], [
            'nama_pemilik_rekening.required' => 'Nama pemilik rekening wajib diisi',
            'nama_pemilik_rekening.string' => 'Nama pemilik rekening harus berupa teks',
            'nama_pemilik_rekening.max' => 'Nama pemilik rekening maksimal 255 karakter'
        ]);

        $shippingId = session('shipping_id');
        $shipping = Shipping::find($shippingId);
        
        if (!$shipping) {
            return back()->with('error', 'Data pengiriman tidak ditemukan.');
        }

        try {
            // Hitung total belanja
            $cart = session('cart', []);
            $total = collect($cart)->sum(function ($item) {
                return $item['harga'] * $item['quantity'];
            });

            // Simpan data bukti pembayaran dengan nama pemilik rekening
            $order = BuktiPembayaran::create([
                'shipping_id' => $shipping->id,
                'nama_pembeli' => $shipping->nama,
                'nomor_hp' => $shipping->telepon,
                'total_belanja' => $total,
                'bukti_transfer' => $request->nama_pemilik_rekening, // Menyimpan nama pemilik rekening
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
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening
            ]);

        } catch (\Exception $e) {
            \Log::error('Payment Processing Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function showConfirmation()
    {
        return view('payment_confirmation');
    }
}