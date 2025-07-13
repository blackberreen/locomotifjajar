@extends('layouts.app')

@section('title', 'Booking Saya - Locomotif')

@section('content')
<div style="max-width:96rem; margin:0 auto; padding:0 1rem;">
    <div style="background-color:#fff; border-radius:0.5rem; box-shadow:0 1px 3px rgba(0,0,0,0.1); padding:1.5rem; margin-bottom:1.5rem;">
        <h1 style="font-size:1.5rem; font-weight:bold; color:#1F2937; margin-bottom:0.5rem;">Riwayat Booking Saya</h1>
        <p style="color:#4B5563;">Lihat semua riwayat booking layanan servis motor Anda</p>
    </div>

    @if($bookings->isEmpty())
        <div style="background-color:#fff; border-radius:0.5rem; box-shadow:0 1px 3px rgba(0,0,0,0.1); padding:2rem; text-align:center;">
            <div style="margin-bottom:1rem;">
                <svg style="width:4rem; height:4rem; color:#9CA3AF; margin:0 auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12l-3-3m0 0l3-3m-3 3h18"></path>
                </svg>
            </div>
            <h3 style="font-size:1.125rem; font-weight:600; color:#1F2937; margin-bottom:0.5rem;">Belum Ada Booking</h3>
            <p style="color:#4B5563; margin-bottom:1rem;">Anda belum memiliki riwayat booking layanan servis motor.</p>
            <a href="{{ route('booking') }}"
               style="background-color:#789DBC; color:#fff; padding:0.5rem 1.5rem; border-radius:0.5rem; text-decoration:none; font-weight:500;"
               onmouseover="this.style.backgroundColor='#6b8bb3'"
               onmouseout="this.style.backgroundColor='#789DBC'">
               Booking Sekarang
            </a>
        </div>
    @else
        <div style="display:flex; flex-direction:column; gap:1rem;">
            @foreach($bookings as $booking)
                <div style="background-color:#fff; border-radius:0.5rem; box-shadow:0 1px 3px rgba(0,0,0,0.1); overflow:hidden;">
                    <div style="padding:1.5rem;">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem;">
                            <div>
                                <h3 style="font-size:1.125rem; font-weight:600; color:#1F2937;">Booking #{{ $booking->bookingid }}</h3>
                                <p style="font-size:0.875rem; color:#4B5563;">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div style="text-align:right;">
                                <span class="{{ $booking->status_color }}"
                                      style="display:inline-block; padding:0.25rem 0.75rem; border-radius:9999px; font-size:0.75rem; font-weight:600;">
                                    {{ $booking->status_text }}
                                </span>
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns:1fr; gap:1.5rem; margin-bottom:1rem;">
                            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                                <div style="display:flex; align-items:center;">
                                    <svg style="width:1.25rem; height:1.25rem; color:#6B7280; margin-right:0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span style="color:#374151;">{{ $booking->nama }}</span>
                                </div>
                                <div style="display:flex; align-items:center;">
                                    <svg style="width:1.25rem; height:1.25rem; color:#6B7280; margin-right:0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span style="color:#374151;">{{ $booking->nomor_telpon }}</span>
                                </div>
                                <div style="display:flex; align-items:center;">
                                    <svg style="width:1.25rem; height:1.25rem; color:#6B7280; margin-right:0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span style="color:#374151;">{{ $booking->jenis_motor }}</span>
                                </div>
                            </div>

                            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                                <div style="display:flex; align-items:center;">
                                    <svg style="width:1.25rem; height:1.25rem; color:#6B7280; margin-right:0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span style="color:#374151;">{{ $booking->jasa }}</span>
                                </div>
                                <div style="display:flex; align-items:center;">
                                    <svg style="width:1.25rem; height:1.25rem; color:#6B7280; margin-right:0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12l-3-3m0 0l3-3m-3 3h18"></path>
                                    </svg>
                                    <span style="color:#374151;">{{ $booking->tanggal_booking->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        @if($booking->keluhan)
                            <div style="margin-top:1rem; padding:1rem; background-color:#F9FAFB; border-radius:0.5rem;">
                                <h4 style="font-weight:600; color:#1F2937; margin-bottom:0.5rem;">Keluhan:</h4>
                                <p style="color:#374151;">{{ $booking->keluhan }}</p>
                            </div>
                        @endif

                        <div style="margin-top:1rem; display:flex; justify-content:flex-end; gap:0.5rem;">
                            <a href="{{ route('booking.show', $booking->bookingid) }}"
                               style="background-color:#789DBC; color:white; padding:0.5rem 1rem; border-radius:0.5rem; text-decoration:none; font-weight:500;"
                               onmouseover="this.style.backgroundColor='#6b8bb3'"
                               onmouseout="this.style.backgroundColor='#789DBC'">
                                Lihat Detail
                            </a>

                            @if(!$booking->is_completed)
                                <form method="POST" action="{{ route('booking.cancel', $booking->bookingid) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="background-color:#EF4444; color:white; padding:0.5rem 1rem; border-radius:0.5rem; font-weight:500; border:none; cursor:pointer;"
                                            onmouseover="this.style.backgroundColor='#DC2626'"
                                            onmouseout="this.style.backgroundColor='#EF4444'"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                        Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($bookings->hasPages())
            <div style="margin-top:2rem;">
                {{ $bookings->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
