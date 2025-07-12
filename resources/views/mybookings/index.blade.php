{{-- resources/views/user/bookings.blade.php --}}
@extends('layouts.app')

@section('title', 'Booking Saya - Locomotif')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Riwayat Booking Saya</h1>
        <p class="text-gray-600">Lihat semua riwayat booking layanan servis motor Anda</p>
    </div>

    @if($bookings->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="mb-4">
                <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12l-3-3m0 0l3-3m-3 3h18"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Booking</h3>
            <p class="text-gray-600 mb-4">Anda belum memiliki riwayat booking layanan servis motor.</p>
            <a href="{{ route('booking') }}" class="bg-[#789DBC] text-white px-6 py-2 rounded-lg hover:bg-[#6b8bb3] transition-colors font-medium">
                Booking Sekarang
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($bookings as $booking)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Booking #{{ $booking->bookingid }}</h3>
                                <p class="text-sm text-gray-600">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $booking->status_color }}">
                                    {{ $booking->status_text }}
                                </span>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $booking->nama }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $booking->nomor_telpon }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $booking->jenis_motor }}</span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $booking->jasa }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12l-3-3m0 0l3-3m-3 3h18"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $booking->tanggal_booking->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        @if($booking->keluhan)
                            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-800 mb-2">Keluhan:</h4>
                                <p class="text-gray-700">{{ $booking->keluhan }}</p>
                            </div>
                        @endif

                        <div class="mt-4 flex justify-end space-x-2">
                            <a href="{{ route('booking.show', $booking->bookingid) }}" class="bg-[#789DBC] text-white px-4 py-2 rounded-lg hover:bg-[#6b8bb3] transition-colors font-medium">
                                Lihat Detail
                            </a>
                            
                            @if(!$booking->is_completed)
                                <form method="POST" action="{{ route('booking.cancel', $booking->bookingid) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium"
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

        {{-- Pagination --}}
        @if($bookings->hasPages())
            <div class="mt-8">
                {{ $bookings->links() }}
            </div>
        @endif
    @endif
</div>
@endsection