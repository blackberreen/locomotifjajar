@extends('layouts.app')

@section('title', 'Booking Saya • Locomotif Jajar')

@section('content')
<div style="padding: 24px 40px;">
    <div style="max-width: 1152px; margin: 0 auto;">
        <div style="margin-bottom: 32px;">
            <h1 style="font-size: 44px; font-weight: bold; font-family: sans-serif; text-align: left; margin: 0; color: #111827;">Reservasi Saya</h1>
            <p style="color: #6b7280; font-size: 18px; margin-top: 8px; margin-bottom: 0;">Lihat riwayat dan status reservasi layanan Anda</p>
        </div>
        
        @if(session('success'))
            <div style="background-color: #dcfce7; border: 1px solid #16a34a; color: #15803d; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background-color: #fef2f2; border: 1px solid #dc2626; color: #dc2626; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter/Stats Section -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px; margin-bottom: 32px;">
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 8px 0;">Total Reservasi</h3>
                        <p style="font-size: 24px; font-weight: bold; color: #2563eb; margin: 0;">{{ $bookings->total() }}</p>
                    </div>
                    <div style="color: #3b82f6;">
                        <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 8px 0;">Menunggu</h3>
                        <p style="font-size: 24px; font-weight: bold; color: #d97706; margin: 0;">{{ $bookings->where('is_completed', false)->count() }}</p>
                    </div>
                    <div style="color: #eab308;">
                        <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin: 0 0 8px 0;">Selesai</h3>
                        <p style="font-size: 24px; font-weight: bold; color: #16a34a; margin: 0;">{{ $bookings->where('is_completed', true)->count() }}</p>
                    </div>
                    <div style="color: #22c55e;">
                        <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        @if($bookings->isEmpty())
            <div style="text-align: center; padding: 64px 0;">
                <div style="margin: 0 auto 24px auto;">
                    <svg style="width: 96px; height: 96px; color: #d1d5db; margin: 0 auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <h3 style="font-size: 20px; font-weight: 600; color: #1f2937; margin: 0 0 8px 0;">Belum Ada Booking</h3>
                <p style="color: #6b7280; margin: 0 0 24px 0;">Anda belum memiliki riwayat booking layanan</p>
                <a href="{{ route('booking') }}" style="background-color: #789DBC; color: white; padding: 12px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-block; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#6b8bb3'" onmouseout="this.style.backgroundColor='#789DBC'">
                    Buat Booking Baru
                </a>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 24px;">
                @foreach($bookings as $booking)
                    <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.1)'">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                            <div>
                                <h3 style="font-size: 20px; font-weight: 600; color: #1f2937; margin: 0 0 8px 0;">
                                    Booking #{{ str_pad($booking->bookingid, 6, '0', STR_PAD_LEFT) }}
                                </h3>
                                <p style="color: #6b7280; font-size: 14px; margin: 0;">
                                    <svg style="width: 16px; height: 16px; display: inline; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12l-3-3m0 0l3-3m-3 3h18"/>
                                    </svg>
                                    Dibuat pada {{ $booking->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <span style="display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 9999px; font-size: 14px; font-weight: 500;" class="{{ $booking->status_color }}">
                                    {{ $booking->status_text }}
                                </span>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                            <div style="background-color: #f9fafb; border-radius: 8px; padding: 16px;">
                                <h4 style="font-weight: 600; color: #374151; margin: 0 0 12px 0; display: flex; align-items: center;">
                                    <svg style="width: 16px; height: 16px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Informasi Pelanggan
                                </h4>
                                <div style="display: flex; flex-direction: column; gap: 8px; font-size: 14px; color: #6b7280;">
                                    <p style="margin: 0;"><span style="font-weight: 500;">Nama:</span> {{ $booking->nama }}</p>
                                    <p style="margin: 0;"><span style="font-weight: 500;">Telepon:</span> {{ $booking->nomor_telpon }}</p>
                                    <p style="margin: 0;"><span style="font-weight: 500;">Jenis Motor:</span> {{ $booking->jenis_motor }}</p>
                                </div>
                            </div>

                            <div style="background-color: #f9fafb; border-radius: 8px; padding: 16px;">
                                <h4 style="font-weight: 600; color: #374151; margin: 0 0 12px 0; display: flex; align-items: center;">
                                    <svg style="width: 16px; height: 16px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    Detail Layanan
                                </h4>
                                <div style="display: flex; flex-direction: column; gap: 8px; font-size: 14px; color: #6b7280;">
                                    <p style="margin: 0;"><span style="font-weight: 500;">Jasa:</span> {{ $booking->jasa }}</p>
                                    <p style="margin: 0;"><span style="font-weight: 500;">Tanggal:</span> {{ $booking->tanggal_booking->format('d M Y') }}</p>
                                    @if($booking->keluhan)
                                        <p style="margin: 0;"><span style="font-weight: 500;">Keluhan:</span> {{ Str::limit($booking->keluhan, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="font-size: 14px; color: #6b7280;">
                                    Terakhir diupdate: {{ $booking->updated_at->format('d M Y, H:i') }}
                                </div>
                                <div style="display: flex; gap: 12px;">
                                    @if(!$booking->is_completed)
                                        <form method="POST" action="{{ route('booking.cancel', $booking->bookingid) }}" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')" 
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    style="background-color: #ef4444; color: white; padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer; font-size: 14px; font-weight: 500; transition: background-color 0.2s;"
                                                    onmouseover="this.style.backgroundColor='#dc2626'" 
                                                    onmouseout="this.style.backgroundColor='#ef4444'">
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
                <div style="margin-top: 32px; display: flex; justify-content: center;">
                    {{ $bookings->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection