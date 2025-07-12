@extends('layouts.app')

@section('title', 'Booking Berhasil • Locomotif Jajar')

@section('content')
<div class="px-10 py-6">
    <div class="max-w-2xl mx-auto text-center">
        <!-- Success Icon -->
        <div class="mb-6">
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-4">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-[44px] font-bold font-sans text-gray-900 mb-2">Booking Berhasil!</h1>
            <p class="text-xl text-gray-600 mb-8">
                Terima kasih! Booking Anda telah berhasil dibuat.
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                <div class="flex items-center justify-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Information -->
        <div class="bg-white border border-[#E2EAF4] rounded-xl p-6 shadow-sm mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Apa Selanjutnya?</h3>
            <div class="text-left space-y-3 text-gray-600">
                <div class="flex items-start">
                    <span class="flex-shrink-0 h-2 w-2 bg-blue-500 rounded-full mt-2 mr-3"></span>
                    <p>Kami akan menghubungi Anda untuk konfirmasi detail booking</p>
                </div>
                <div class="flex items-start">
                    <span class="flex-shrink-0 h-2 w-2 bg-blue-500 rounded-full mt-2 mr-3"></span>
                    <p>Pastikan nomor telepon Anda aktif untuk memudahkan komunikasi</p>
                </div>
                <div class="flex items-start">
                    <span class="flex-shrink-0 h-2 w-2 bg-blue-500 rounded-full mt-2 mr-3"></span>
                    <p>Anda dapat melihat status booking di menu "Reservasi Saya"</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('user.bookings') }}" 
               class="bg-blue-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 transition-colors">
                Lihat Reservasi Saya
            </a>
            <a href="{{ route('home') }}" 
               class="bg-[#E2EAF4] text-black px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                Kembali ke Beranda
            </a>
            
        </div>
    </div>
</div>
@endsection