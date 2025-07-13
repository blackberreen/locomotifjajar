@extends('layouts.app')

@section('title', 'Detail Booking • Locomotif Jajar')

@section('content')
<div style="padding: 24px 40px;">
    <div style="max-width: 1024px; margin: 0 auto;">
        <!-- Header -->
        <div style="margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                <a href="{{ route('user.bookings') }}" style="color: #2563eb; text-decoration: none; transition: color 0.2s;"
                   onmouseover="this.style.color='#1d4ed8'"
                   onmouseout="this.style.color='#2563eb'">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 style="font-size: 44px; font-weight: bold; font-family: sans-serif; margin: 0;">Detail Booking</h1>
            </div>
            <p style="color: #6b7280; margin: 0;">Booking ID: #{{ $booking->bookingid }}</p>
        </div>

        <!-- Status Banner -->
        <div style="margin-bottom: 24px;">
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 8px 0;">Status Booking</h3>
                        <p style="color: #6b7280; margin: 0;">Dibuat pada: {{ $booking->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <span style="display: inline-flex; align-items: center; padding: 8px 16px; border-radius: 50px; font-size: 14px; font-weight: 500; {{ $booking->status_color }}">
                        {{ $booking->status_text }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 24px;">
            <!-- Informasi Pelanggan -->
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 16px 0;">Informasi Pelanggan</h3>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Nama</label>
                        <p style="color: #111827; margin: 0;">{{ $booking->nama }}</p>
                    </div>
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Nomor Telepon</label>
                        <p style="color: #111827; margin: 0;">{{ $booking->nomor_telpon }}</p>
                    </div>
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Jenis Motor</label>
                        <p style="color: #111827; margin: 0;">{{ $booking->jenis_motor }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Layanan -->
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 16px 0;">Detail Layanan</h3>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Jasa yang Dipilih</label>
                        <p style="color: #111827; margin: 0;">{{ $booking->jasa }}</p>
                    </div>
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Tanggal Booking</label>
                        <p style="color: #111827; margin: 0;">{{ $booking->tanggal_booking->format('d M Y') }}</p>
                    </div>
                    @if($booking->keluhan)
                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Keluhan</label>
                            <p style="color: #111827; margin: 0;">{{ $booking->keluhan }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        @if(!$booking->is_completed)
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 16px 0;">Aksi</h3>
                <div style="display: flex; gap: 12px;">
                    <form method="POST" action="{{ route('booking.cancel', $booking->bookingid) }}" 
                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')" 
                          style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                style="background-color: #ef4444; color: white; padding: 8px 24px; border-radius: 8px; border: none; cursor: pointer; transition: background-color 0.2s;"
                                onmouseover="this.style.backgroundColor='#dc2626'"
                                onmouseout="this.style.backgroundColor='#ef4444'">
                            Batalkan Booking
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
@media (min-width: 768px) {
    .detail-grid {
        grid-template-columns: 1fr 1fr;
    }
} 
</style>
@endsection