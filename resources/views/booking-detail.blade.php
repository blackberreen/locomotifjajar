@extends('layouts.app')

@section('title', 'Detail Booking • Locomotif Jajar')

@section('content')
<div class="px-10 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('user.bookings') }}" class="text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-[44px] font-bold font-sans">Detail Booking</h1>
            </div>
            <p class="text-gray-600">Booking ID: #{{ $booking->bookingid }}</p>
        </div>

        <!-- Status Banner -->
        <div class="mb-6">
            <div class="bg-white border border-[#E2EAF4] rounded-xl p-6 shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Status Booking</h3>
                        <p class="text-gray-600">Dibuat pada: {{ $booking->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $booking->status_color }}">
                        {{ $booking->status_text }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <!-- Informasi Pelanggan -->
            <div class="bg-white border border-[#E2EAF4] rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pelanggan</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <p class="text-gray-900">{{ $booking->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <p class="text-gray-900">{{ $booking->nomor_telpon }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Motor</label>
                        <p class="text-gray-900">{{ $booking->jenis_motor }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Layanan -->
            <div class="bg-white border border-[#E2EAF4] rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Layanan</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jasa yang Dipilih</label>
                        <p class="text-gray-900">{{ $booking->jasa }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Booking</label>
                        <p class="text-gray-900">{{ $booking->tanggal_booking->format('d M Y') }}</p>
                    </div>
                    @if($booking->keluhan)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Keluhan</label>
                            <p class="text-gray-900">{{ $booking->keluhan }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        @if(!$booking->is_completed)
            <div class="bg-white border border-[#E2EAF4] rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
                <div class="flex space-x-3">
                    <form method="POST" action="{{ route('booking.cancel', $booking->bookingid) }}" 
                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')" 
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                            Batalkan Booking
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection