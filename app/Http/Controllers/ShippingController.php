<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function form()
    {
        $profileData = null;
        
        // Jika user login, ambil data profile untuk auto-fill
        if (Auth::check()) {
            $user = Auth::user();
            $profile = $user->profile;
            if ($profile) {
                $profileData = [
                    'nama' => $profile->nama,
                    'alamat' => $profile->alamat,
                    'provinsi' => $profile->provinsi,
                    'kota' => $profile->kota,
                    'kecamatan' => $profile->kecamatan,
                    'kelurahan' => $profile->kelurahan,
                    'telepon' => $profile->telepon,
                ];
            }
        }
        
        return view('shipping', compact('profileData'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'telepon' => 'required|string',
        ]);

        // Tambahkan user_id jika user login
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }

        // Simpan data ke database
        $shipping = Shipping::create($validated);

        // Simpan data pengiriman ke session
        Session::put('shipping_data', $validated);
        Session::put('shipping_id', $shipping->id);

        // Ambil data cart dari session
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity']; 
        }

        // Simpan total belanja ke session
        Session::put('order_total', $total);

        // Redirect ke halaman pembayaran
        return redirect()->route('payment.form')->with('success', 'Data pengiriman disimpan.');
    }
}