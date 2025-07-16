@extends('layouts.admin')

@section('title', 'Payment • Locomotif Jajar')

@section('content')
<div class="w-[986px] h-[750px] bg-white mx-auto border border-gray-300 rounded-2xl p-6 overflow-auto">
    <h1 class="text-[45px] font-bold text-center mb-6">Payment</h1>

    @if(session('success'))
        <div class="text-green-600 text-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="text-red-600 text-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tab Navigation -->
    <div class="flex border-b border-gray-300 mb-6">
        <button onclick="showTab('belum-verifikasi')" 
                id="tab-belum-verifikasi" 
                class="px-4 py-2 font-semibold text-gray-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 transition-colors active-tab">
            Belum Diverifikasi 
            <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full ml-1">{{ $belumDiverifikasi->count() }}</span>
        </button>
        <button onclick="showTab('terverifikasi')" 
                id="tab-terverifikasi" 
                class="px-4 py-2 font-semibold text-gray-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 transition-colors">
            Terverifikasi 
            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full ml-1">{{ $terverifikasi->count() }}</span>
        </button>
        <button onclick="showTab('ditolak')" 
                id="tab-ditolak" 
                class="px-4 py-2 font-semibold text-gray-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 transition-colors">
            Ditolak 
            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-1">{{ $ditolak->count() }}</span>
        </button>
    </div>

    <!-- Tab Content: Belum Diverifikasi -->
    <div id="content-belum-verifikasi" class="tab-content">
        <table class="w-full text-left border border-gray-300">
            <thead class="bg-[#E2EAF4]">
                <tr class="text-lg">
                    <th class="p-3">Informasi</th>
                    <th class="p-3">Total Belanja</th>
                    <th class="p-3">Nama Pemilik Rekening</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($belumDiverifikasi as $data)
                <tr class="border-t border-gray-200 hover:bg-gray-50 transition-colors">
                    <td class="p-3">
                        <div class="space-y-1">
                            <p><strong>Nama:</strong> {{ $data->shipping->nama ?? '-' }}</p>
                            <p><strong>Telp:</strong> {{ $data->shipping->telepon ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="font-semibold text-gray-800">Rp. {{ number_format($data->total_belanja, 0, ',', '.') }}</span>
                    </td>
                    <td class="p-3">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-3 rounded-lg border border-blue-200">
                            <p class="font-semibold text-gray-800">{{ $data->bukti_transfer ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <form action="{{ route('admin.payment.update', $data->id) }}" method="POST">
                            @csrf
                            <div class="flex gap-2">
                                <button type="submit" name="status_verifikasi" value="Terverifikasi" 
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors shadow-sm hover:shadow-md">
                                    Verifikasi
                                </button>
                                <button type="submit" name="status_verifikasi" value="Ditolak" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors shadow-sm hover:shadow-md">
                                    Tolak
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        <div class="py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="mt-2 text-sm">Tidak ada pembayaran yang menunggu verifikasi</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tab Content: Terverifikasi -->
    <div id="content-terverifikasi" class="tab-content hidden">
        <table class="w-full text-left border border-gray-300">
            <thead class="bg-[#E2EAF4]">
                <tr class="text-lg">
                    <th class="p-3">Informasi</th>
                    <th class="p-3">Total Belanja</th>
                    <th class="p-3">Nama Pemilik Rekening</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($terverifikasi as $data)
                <tr class="border-t border-gray-200 hover:bg-gray-50 transition-colors">
                    <td class="p-3">
                        <div class="space-y-1">
                            <p><strong>Nama:</strong> {{ $data->shipping->nama ?? '-' }}</p>
                            <p><strong>Telp:</strong> {{ $data->shipping->telepon ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="font-semibold text-gray-800">Rp. {{ number_format($data->total_belanja, 0, ',', '.') }}</span>
                    </td>
                    <td class="p-3">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-3 rounded-lg border border-green-200">
                            <p class="font-semibold text-gray-800">{{ $data->bukti_transfer ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-sm">
                            ✓ Terverifikasi
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        <div class="py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-sm">Belum ada pembayaran yang terverifikasi</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tab Content: Ditolak -->
    <div id="content-ditolak" class="tab-content hidden">
        <table class="w-full text-left border border-gray-300">
            <thead class="bg-[#E2EAF4]">
                <tr class="text-lg">
                    <th class="p-3">Informasi</th>
                    <th class="p-3">Total Belanja</th>
                    <th class="p-3">Nama Pemilik Rekening</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ditolak as $data)
                <tr class="border-t border-gray-200 hover:bg-gray-50 transition-colors">
                    <td class="p-3">
                        <div class="space-y-1">
                            <p><strong>Nama:</strong> {{ $data->shipping->nama ?? '-' }}</p>
                            <p><strong>Telp:</strong> {{ $data->shipping->telepon ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="font-semibold text-gray-800">Rp. {{ number_format($data->total_belanja, 0, ',', '.') }}</span>
                    </td>
                    <td class="p-3">
                        <div class="bg-gradient-to-r from-red-50 to-rose-50 p-3 rounded-lg border border-red-200">
                            <p class="font-semibold text-gray-800">{{ $data->bukti_transfer ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="bg-red-600 text-white px-4 py-2 rounded-lg shadow-sm">
                            ✗ Ditolak
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        <div class="py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-sm">Belum ada pembayaran yang ditolak</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
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
        showTab('belum-verifikasi');
    });
</script>

<style>
    .active-tab {
        color: #2563eb !important;
        border-bottom-color: #2563eb !important;
    }
    
    /* Smooth transitions for hover effects */
    .transition-colors {
        transition: color 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
    }
    
    /* Enhanced button styling */
    button:hover {
        transform: translateY(-1px);
        transition: transform 0.2s ease;
    }
    
    /* Table row hover effects */
    tr:hover {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection