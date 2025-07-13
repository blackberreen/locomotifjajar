@extends('layouts.app')

@section('title', 'Booking Berhasil • Locomotif Jajar')

@section('content')
<div style="padding: 24px 40px;">
    <div style="max-width: 512px; margin: 0 auto; text-align: center;">
        <!-- Success Icon -->
        <div style="margin-bottom: 24px;">
            <div style="margin: 0 auto; display: flex; align-items: center; justify-content: center; height: 80px; width: 80px; border-radius: 50%; background-color: #dcfce7; margin-bottom: 16px;">
                <svg style="height: 40px; width: 40px; color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 style="font-size: 44px; font-weight: bold; font-family: sans-serif; color: #111827; margin-bottom: 8px;">Booking Berhasil!</h1>
            <p style="font-size: 20px; color: #4b5563; margin-bottom: 32px;">
                Terima kasih! Booking Anda telah berhasil dibuat.
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 24px; margin-bottom: 32px;">
                <div style="display: flex; align-items: center; justify-content: center;">
                    <div style="flex-shrink: 0;">
                        <svg style="height: 20px; width: 20px; color: #4ade80;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div style="margin-left: 12px;">
                        <p style="font-size: 14px; font-weight: 500; color: #166534;">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Information -->
        <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 32px;">
            <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin-bottom: 16px;">Apa Selanjutnya?</h3>
            <div style="text-align: left; color: #4b5563;">
                <div style="display: flex; align-items: flex-start; margin-bottom: 12px;">
                    <span style="flex-shrink: 0; height: 8px; width: 8px; background-color: #3b82f6; border-radius: 50%; margin-top: 8px; margin-right: 12px;"></span>
                    <p style="margin: 0;">Kami akan menghubungi Anda untuk konfirmasi detail booking</p>
                </div>
                <div style="display: flex; align-items: flex-start; margin-bottom: 12px;">
                    <span style="flex-shrink: 0; height: 8px; width: 8px; background-color: #3b82f6; border-radius: 50%; margin-top: 8px; margin-right: 12px;"></span>
                    <p style="margin: 0;">Pastikan nomor telepon Anda aktif untuk memudahkan komunikasi</p>
                </div>
                <div style="display: flex; align-items: flex-start;">
                    <span style="flex-shrink: 0; height: 8px; width: 8px; background-color: #3b82f6; border-radius: 50%; margin-top: 8px; margin-right: 12px;"></span>
                    <p style="margin: 0;">Anda dapat melihat status booking di menu "Reservasi Saya"</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; flex-direction: column; gap: 16px; justify-content: center;">
            <a href="{{ route('user.bookings') }}" 
               style="background-color: #3b82f6; color: white; padding: 12px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background-color 0.2s;"
               onmouseover="this.style.backgroundColor='#2563eb'"
               onmouseout="this.style.backgroundColor='#3b82f6'">
                Lihat Reservasi Saya
            </a>
            <a href="{{ route('home') }}" 
               style="background-color: #E2EAF4; color: black; padding: 12px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: opacity 0.2s;"
               onmouseover="this.style.opacity='0.9'"
               onmouseout="this.style.opacity='1'">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<style>
@media (min-width: 640px) {
    .action-buttons {
        flex-direction: row;
    }
}
</style>
@endsection