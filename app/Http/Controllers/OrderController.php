<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuktiPembayaran;
use App\Models\OrderShipment;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $orders = BuktiPembayaran::whereHas('shipping', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['shipping', 'orderDetails', 'shipment'])
        ->orderBy('created_at', 'desc')
        ->get();

        $paymentConfirmations = $orders->filter(function($order) {
            return in_array($order->status_verifikasi, ['Menunggu', 'Terverifikasi', 'Ditolak']);
        });
        
        $orderStatuses = $orders->filter(function($order) {
            return $order->status_verifikasi === 'Terverifikasi';
        });

        return view('orders.index', compact('paymentConfirmations', 'orderStatuses'));
    }

    public function paymentConfirmation()
    {
        $user = Auth::user();
        
        $orders = BuktiPembayaran::whereHas('shipping', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['shipping', 'orderDetails'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('orders.payment_confirmation', compact('orders'));
    }

    public function orderStatus()
    {
        $user = Auth::user();
        
        $orders = BuktiPembayaran::whereHas('shipping', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('status_verifikasi', 'Terverifikasi')
        ->with(['shipping', 'orderDetails', 'shipment'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('orders.order_status', compact('orders'));
    }
}