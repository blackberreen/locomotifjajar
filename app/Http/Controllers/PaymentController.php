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

        $namaFile = Str::random(10) . '.' . $request->file('bukti_transfer')->getClientOriginalExtension();
        $path = $request->file('bukti_transfer')->storeAs('bukti_transfer', $namaFile, 'public');

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
            'bukti_transfer' => $namaFile,
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
            'path' => $namaFile
        ]);
    }

    public function showConfirmation()
    {
        return view('payment_confirmation');
    }
}