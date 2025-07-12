<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        // Pisahkan data berdasarkan status completion
        $pending = Booking::where('is_completed', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        $selesai = Booking::where('is_completed', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.booking', compact('pending', 'selesai'));
    }

    public function updateStatus(Request $request, $bookingid)
    {
        $booking = Booking::findOrFail($bookingid);
        
        // Set status selesai jika ada input 
        if ($request->has('is_completed')) {
            $booking->is_completed = 1;
            $message = 'Booking berhasil ditandai sebagai selesai';
        } else {
            $booking->is_completed = 0;
            $message = 'Status booking berhasil diupdate';
        }
        
        $booking->save();

        return redirect()->route('admin.booking')->with('success', $message);
    }
}