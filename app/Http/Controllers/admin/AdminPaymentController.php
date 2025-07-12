<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuktiPembayaran;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPaymentController extends Controller
{
    public function index()
    {

        $belumDiverifikasi = BuktiPembayaran::with('shipping')
            ->where('status_verifikasi', 'Menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        $terverifikasi = BuktiPembayaran::with('shipping')
            ->where('status_verifikasi', 'Terverifikasi')
            ->orderBy('updated_at', 'desc')
            ->get();

        $ditolak = BuktiPembayaran::with('shipping')
            ->where('status_verifikasi', 'Ditolak')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.payment', compact('belumDiverifikasi', 'terverifikasi', 'ditolak'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $request->validate([
                'status_verifikasi' => 'required|in:Terverifikasi,Ditolak',
            ]);

            $pembayaran = BuktiPembayaran::findOrFail($id);
            $pembayaran->status_verifikasi = $request->status_verifikasi;
            $pembayaran->save();


            $message = $request->status_verifikasi === 'Terverifikasi' 
                ? 'Pembayaran berhasil diverifikasi!' 
                : 'Pembayaran ditolak.';

            return redirect()->route('admin.payment')->with('success', $message);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return redirect()->route('admin.payment')->with('error', 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all()));
        } catch (\Exception $e) {

            return redirect()->route('admin.payment')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}