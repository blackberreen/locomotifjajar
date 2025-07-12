@extends('layouts.app')

@section('title', 'Booking Saya • Locomotif Jajar')

@section('content')
<div class="px-10 py-6">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-[44px] font-bold font-sans text-left">Reservasi Saya</h1>
            <p class="text-gray-600 text-lg mt-2">Lihat riwayat dan status reservasi layanan Anda</p>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter/Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white border border-[#E2EAF4] rounded-xl p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Total Reservasi</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $bookings->total() }}</p>
                    </div>
                    <div class="text-blue-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-[#E2EAF4] rounded-xl p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Menunggu</h3>
                        <p class="text-2xl font-bold text-yellow-600">{{ $bookings->where('is_completed', false)->count() }}</p>
                    </div>
                    <div class="text-yellow-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-[#E2EAF4] rounded-xl p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Selesai</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $bookings->where('is_completed', true)->count() }}</p>
                    </div>
                    <div class="text-green-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        @if($bookings->isEmpty())
            <div class="text-center py-16">
                <div class="mx-auto mb-6">
                    <svg class="w-24 h-24 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Booking</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki riwayat booking layanan</p>
                <a href="{{ route('booking') }}" class="bg-[#789DBC] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#6b8bb3] transition-colors">
                    Buat Booking Baru
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="bg-white border border-[#E2EAF4] rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">
                                    Booking #{{ str_pad($booking->bookingid, 6, '0', STR_PAD_LEFT) }}
                                </h3>
                                <p class="text-gray-600 text-sm">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12l-3-3m0 0l3-3m-3 3h18"/>
                                    </svg>
                                    Dibuat pada {{ $booking->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $booking->status_color }}">
                                    {{ $booking->status_text }}
                                </span>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Informasi Pelanggan
                                </h4>
                                <div class="space-y-2 text-sm text-gray-600">
                                    <p><span class="font-medium">Nama:</span> {{ $booking->nama }}</p>
                                    <p><span class="font-medium">Telepon:</span> {{ $booking->nomor_telpon }}</p>
                                    <p><span class="font-medium">Jenis Motor:</span> {{ $booking->jenis_motor }}</p>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    Detail Layanan
                                </h4>
                                <div class="space-y-2 text-sm text-gray-600">
                                    <p><span class="font-medium">Jasa:</span> {{ $booking->jasa }}</p>
                                    <p><span class="font-medium">Tanggal:</span> {{ $booking->tanggal_booking->format('d M Y') }}</p>
                                    @if($booking->keluhan)
                                        <p><span class="font-medium">Keluhan:</span> {{ Str::limit($booking->keluhan, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    Terakhir diupdate: {{ $booking->updated_at->format('d M Y, H:i') }}
                                </div>
                                <div class="flex space-x-3">
                                    
                                    @if(!$booking->is_completed)
                                        <form method="POST" action="{{ route('booking.cancel', $booking->bookingid) }}" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')" 
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
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
                <div class="mt-8 flex justify-center">
                    {{ $bookings->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection