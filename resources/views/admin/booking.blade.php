@extends('layouts.admin')

@section('content')
<div class="px-10 py-10">
    <h1 class="text-[45px] font-bold mb-8">Booking Services</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tab Navigation -->
    <div class="flex border-b border-gray-300 mb-6">
        <button onclick="showTab('pending')" 
                id="tab-pending" 
                class="px-6 py-3 font-semibold text-gray-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 transition-colors active-tab text-lg">
            Pending 
            <span class="bg-yellow-500 text-white text-sm px-2 py-1 rounded-full ml-2">{{ $pending->count() }}</span>
        </button>
        <button onclick="showTab('selesai')" 
                id="tab-selesai" 
                class="px-6 py-3 font-semibold text-gray-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 transition-colors text-lg">
            Selesai 
            <span class="bg-green-500 text-white text-sm px-2 py-1 rounded-full ml-2">{{ $selesai->count() }}</span>
        </button>
    </div>

    <!-- Tab Content: Pending -->
    <div id="content-pending" class="tab-content">
        <div class="max-h-[650px] w-full overflow-y-auto border-2 border-[#789DBC] rounded-md">
            <table class="w-full border-collapse">
                <thead class="bg-[#f0f4f8] sticky top-0">
                    <tr>
                        <th class="text-left text-[22px] p-3">Info</th>
                        <th class="text-left text-[22px] p-3">Keluhan</th>
                        <th class="text-left text-[22px] p-3">Service</th>
                        <th class="text-left text-[22px] p-3">Tgl Booking</th>
                        <th class="text-left text-[22px] p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pending as $booking)
                        <tr class="border-t border-gray-200">
                            <td class="p-3">
                                <div class="space-y-1">
                                    <p class="text-[16px]"><strong>Nama:</strong> {{ $booking->nama }}</p>
                                    <p class="text-[16px]"><strong>No Telp:</strong> {{ $booking->nomor_telpon }}</p>
                                    <p class="text-[16px]"><strong>Jenis Motor:</strong> {{ $booking->jenis_motor }}</p>
                                </div>
                            </td>
                            <td class="p-3 text-[16px] align-top">{{ $booking->keluhan }}</td>
                            <td class="p-3 text-[16px] align-top">{{ $booking->jasa }}</td>
                            <td class="p-3 text-[16px] align-top">{{ $booking->tanggal_booking->format('d/m/Y') }}</td>
                            <td class="p-3 align-top">
                                <form action="{{ route('admin.booking.updateStatus', $booking->id) }}" method="POST" class="booking-form">
                                    @csrf
                                    <button type="submit" name="is_completed" value="1"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors text-sm font-medium">
                                        Tandai Selesai
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500 text-lg">
                                Tidak ada booking yang pending
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab Content: Selesai -->
    <div id="content-selesai" class="tab-content hidden">
        <div class="max-h-[650px] w-full overflow-y-auto border-2 border-[#789DBC] rounded-md">
            <table class="w-full border-collapse">
                <thead class="bg-[#f0f4f8] sticky top-0">
                    <tr>
                        <th class="text-left text-[22px] p-3">Info</th>
                        <th class="text-left text-[22px] p-3">Keluhan</th>
                        <th class="text-left text-[22px] p-3">Service</th>
                        <th class="text-left text-[22px] p-3">Tgl Booking</th>
                        <th class="text-left text-[22px] p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($selesai as $booking)
                        <tr class="border-t border-gray-200 bg-green-50">
                            <td class="p-3">
                                <div class="space-y-1">
                                    <p class="text-[16px]"><strong>Nama:</strong> {{ $booking->nama }}</p>
                                    <p class="text-[16px]"><strong>No Telp:</strong> {{ $booking->nomor_telpon }}</p>
                                    <p class="text-[16px]"><strong>Jenis Motor:</strong> {{ $booking->jenis_motor }}</p>
                                </div>
                            </td>
                            <td class="p-3 text-[16px] align-top">{{ $booking->keluhan }}</td>
                            <td class="p-3 text-[16px] align-top">{{ $booking->jasa }}</td>
                            <td class="p-3 text-[16px] align-top">{{ $booking->tanggal_booking->format('d/m/Y') }}</td>
                            <td class="p-3 text-[16px] align-top">
                                <span class="px-3 py-1 rounded text-sm bg-green-100 text-green-800 font-medium">
                                    Selesai
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500 text-lg">
                                Belum ada booking yang selesai
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script Tabs -->
<script>
    // Tab functions
    function showTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tabs
        const tabs = document.querySelectorAll('[id^="tab-"]');
        tabs.forEach(tab => {
            tab.classList.remove('active-tab', 'text-blue-600', 'border-blue-600');
            tab.classList.add('text-gray-600', 'border-transparent');
        });

        // Show selected tab content
        document.getElementById('content-' + tabName).classList.remove('hidden');
        
        // Add active class to selected tab
        const activeTab = document.getElementById('tab-' + tabName);
        activeTab.classList.add('active-tab', 'text-blue-600', 'border-blue-600');
        activeTab.classList.remove('text-gray-600', 'border-transparent');
    }

    // Initialize with first tab active
    document.addEventListener('DOMContentLoaded', function() {
        showTab('pending');
    });
</script>

<style>
    .active-tab {
        color: #2563eb !important;
        border-bottom-color: #2563eb !important;
    }
</style>
@endsection