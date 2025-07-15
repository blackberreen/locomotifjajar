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
            <p style="color: #6b7280; margin: 0;">Booking ID: #{{ $booking->id }}</p>
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
        <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 24px;" class="detail-grid">
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

        <!-- Informasi Tambahan -->
        <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 16px 0;">Informasi Tambahan</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Tanggal Dibuat</label>
                    <p style="color: #111827; margin: 0;">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Terakhir Diupdate</label>
                    <p style="color: #111827; margin: 0;">{{ $booking->updated_at->format('d M Y, H:i') }}</p>
                </div>
                @if($booking->harga)
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Estimasi Harga</label>
                        <p style="color: #111827; margin: 0; font-weight: 600;">Rp {{ number_format($booking->harga, 0, ',', '.') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Timeline Status (jika ada) -->
        @if($booking->status_history)
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 16px 0;">Timeline Status</h3>
                <div style="position: relative; padding-left: 24px;">
                    @foreach($booking->status_history as $history)
                        <div style="position: relative; padding-bottom: 16px; border-left: 2px solid #e5e7eb; margin-left: 8px;">
                            <div style="position: absolute; left: -6px; top: 0; width: 12px; height: 12px; background-color: #3b82f6; border-radius: 50%;"></div>
                            <div style="margin-left: 16px;">
                                <p style="font-weight: 600; color: #111827; margin: 0;">{{ $history['status'] }}</p>
                                <p style="color: #6b7280; font-size: 14px; margin: 4px 0 0 0;">{{ $history['created_at'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Actions -->
        @if(!$booking->is_completed)
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 16px 0;">Aksi</h3>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <!-- Edit Booking (jika masih pending) -->
                    @if($booking->status == 'pending')
                        <a href="{{ route('booking.edit', $booking->id) }}" 
                           style="background-color: #3b82f6; color: white; padding: 8px 24px; border-radius: 8px; text-decoration: none; transition: background-color 0.2s; display: inline-flex; align-items: center; gap: 8px;"
                           onmouseover="this.style.backgroundColor='#2563eb'"
                           onmouseout="this.style.backgroundColor='#3b82f6'">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Booking
                        </a>
                    @endif
                    
                    <!-- Cancel Booking -->
                    <form method="POST" action="{{ route('booking.cancel', $booking->id) }}" 
                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')" 
                          style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                style="background-color: #ef4444; color: white; padding: 8px 24px; border-radius: 8px; border: none; cursor: pointer; transition: background-color 0.2s; display: inline-flex; align-items: center; gap: 8px;"
                                onmouseover="this.style.backgroundColor='#dc2626'"
                                onmouseout="this.style.backgroundColor='#ef4444'">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batalkan Booking
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Completed Booking Actions -->
        @if($booking->is_completed)
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 16px 0;">Booking Selesai</h3>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <!-- Download Invoice -->
                    <a href="{{ route('booking.invoice', $booking->id) }}" 
                       style="background-color: #10b981; color: white; padding: 8px 24px; border-radius: 8px; text-decoration: none; transition: background-color 0.2s; display: inline-flex; align-items: center; gap: 8px;"
                       onmouseover="this.style.backgroundColor='#059669'"
                       onmouseout="this.style.backgroundColor='#10b981'">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Invoice
                    </a>
                    
                    <!-- Give Rating -->
                    @if(!$booking->rating)
                        <a href="{{ route('booking.rating', $booking->id) }}" 
                           style="background-color: #f59e0b; color: white; padding: 8px 24px; border-radius: 8px; text-decoration: none; transition: background-color 0.2s; display: inline-flex; align-items: center; gap: 8px;"
                           onmouseover="this.style.backgroundColor='#d97706'"
                           onmouseout="this.style.backgroundColor='#f59e0b'">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            Berikan Rating
                        </a>
                    @endif
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

@media (max-width: 768px) {
    div[style*="padding: 24px 40px"] {
        padding: 16px 20px !important;
    }
    
    h1[style*="font-size: 44px"] {
        font-size: 32px !important;
    }
    
    div[style*="padding: 24px"] {
        padding: 16px !important;
    }
}
</style>
@endsection