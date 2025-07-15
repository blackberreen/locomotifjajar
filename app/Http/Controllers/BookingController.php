<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Show the booking form.
     */
    public function index()
    {
        return view('booking');
    }

    /**
     * Display a listing of the user's bookings.
     */
    public function myBookings()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('user.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $bookings = Booking::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookinglist', compact('bookings'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('user.login')
                ->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telpon' => 'required|string|max:20',
            'jenis_motor' => 'required|string|max:255',
            'jasa' => 'required|string|max:255',
            'keluhan' => 'nullable|string|max:1000',
            'tanggal_booking' => 'required|date|after:today',
        ]);

        try {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'nomor_telpon' => $request->nomor_telpon,
                'jenis_motor' => $request->jenis_motor,
                'jasa' => $request->jasa,
                'keluhan' => $request->keluhan,
                'tanggal_booking' => $request->tanggal_booking,
                'is_completed' => false,
            ]);

            return redirect()->route('booking.success')
                ->with('success', 'Booking berhasil dibuat dengan ID #' . str_pad($booking->id, 6, '0', STR_PAD_LEFT) . '!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat booking. Silakan coba lagi.');
        }
    }

    /**
     * Show booking success page.
     */
    public function success()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        return view('booking-success');
    }

    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('user.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$booking) {
            return redirect()->route('user.bookings')
                ->with('error', 'Booking tidak ditemukan.');
        }

        return view('booking-detail', compact('booking'));
    }

    /**
     * Cancel the specified booking.
     */
    public function cancel($id)
    {
        // Debug log
        \Log::info('Cancel method called with ID: ' . $id);
    
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('user.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi ID tidak kosong
        if (empty($id)) {
            return redirect()->route('user.bookings')
                ->with('error', 'ID booking tidak valid.');
        }

        // Cari booking dengan id (bukan bookingid)
        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $id)  // Menggunakan id sebagai field pencarian
            ->where('is_completed', false)
            ->first();

        if (!$booking) {
            return redirect()->route('user.bookings')
                ->with('error', 'Booking tidak ditemukan atau sudah selesai.');
        }

        try {
            $booking->delete();
            return redirect()->route('user.bookings')
                ->with('success', 'Booking berhasil dibatalkan!');
        } catch (\Exception $e) {
            \Log::error('Error canceling booking: ' . $e->getMessage());
            return redirect()->route('user.bookings')
                ->with('error', 'Terjadi kesalahan saat membatalkan booking.');
        }
    }

    /**
     * Get booking statistics for user
     */
    public function getBookingStats()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $stats = [
            'total' => Booking::where('user_id', Auth::id())->count(),
            'pending' => Booking::where('user_id', Auth::id())->where('is_completed', false)->count(),
            'completed' => Booking::where('user_id', Auth::id())->where('is_completed', true)->count(),
        ];

        return response()->json($stats);
    }
}