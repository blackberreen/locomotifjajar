<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuktiPembayaran;
use App\Models\OrderShipment;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = BuktiPembayaran::with(['shipping', 'orderDetails', 'shipment']) 
            ->where('status_verifikasi', 'Terverifikasi')
            ->get();

        return view('admin.order', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        if ($request->status_pengiriman === 'sedang_dikirim') {
            $request->validate([
                'status_pengiriman' => 'required|in:belum_dikirim,sedang_dikirim,sudah_dikirim',
                'resi_number' => 'required|string|max:50'
            ], [
                'resi_number.required' => 'Nomor resi wajib diisi untuk status sedang dikirim'
            ]);
        } else {
            $request->validate([
                'status_pengiriman' => 'required|in:belum_dikirim,sedang_dikirim,sudah_dikirim'
            ]);
        }

        $order = BuktiPembayaran::findOrFail($id);
        
        // Find or create shipment record
        $shipment = OrderShipment::firstOrNew(['bukti_pembayaran_id' => $order->id]);
        $shipment->bukti_pembayaran_id = $order->id;
        $shipment->status = $request->status_pengiriman;
        
        // Set resi number if status is sedang_dikirim
        if ($request->status_pengiriman === 'sedang_dikirim') {
            $shipment->resi_number = $request->resi_number;
        }
        
        $shipment->save();

        $statusLabels = [
            'belum_dikirim' => 'Belum Dikirim',
            'sedang_dikirim' => 'Sedang Dikirim', 
            'sudah_dikirim' => 'Sudah Dikirim'
        ];

        $message = 'Status pengiriman diperbarui menjadi: ' . $statusLabels[$request->status_pengiriman];
        if ($request->resi_number) {
            $message .= ' dengan nomor resi: ' . $request->resi_number;
        }

        return redirect()->route('admin.order')->with('success', $message);
    }
}