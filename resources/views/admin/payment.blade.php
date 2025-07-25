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
                <tr class="border-t border-gray-200">
                    <td class="p-3">
                        <p><strong>Nama:</strong> {{ $data->shipping->nama ?? '-' }}</p>
                        <p><strong>Telp:</strong> {{ $data->shipping->telepon ?? '-' }}</p>
                    </td>
                    <td class="p-3">Rp. {{ number_format($data->total_belanja, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <div class="bg-gray-100 p-3 rounded-lg">
                            <p class="font-semibold text-gray-800">{{ $data->bukti_transfer ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <form action="{{ route('admin.payment.update', $data->id) }}" method="POST">
                            @csrf
                            <div class="flex gap-2">
                                <button type="submit" name="status_verifikasi" value="Terverifikasi" 
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition-colors">
                                    Verifikasi
                                </button>
                                <button type="submit" name="status_verifikasi" value="Ditolak" 
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors">
                                    Tolak
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        Tidak ada pembayaran yang menunggu verifikasi
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
                <tr class="border-t border-gray-200">
                    <td class="p-3">
                        <p><strong>Nama:</strong> {{ $data->shipping->nama ?? '-' }}</p>
                        <p><strong>Telp:</strong> {{ $data->shipping->telepon ?? '-' }}</p>
                    </td>
                    <td class="p-3">Rp. {{ number_format($data->total_belanja, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <div class="bg-gray-100 p-3 rounded-lg">
                            <p class="font-semibold text-gray-800">{{ $data->bukti_transfer ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="bg-green-600 text-white px-4 py-2 rounded">
                            Terverifikasi
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        Belum ada pembayaran yang terverifikasi
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
                <tr class="border-t border-gray-200">
                    <td class="p-3">
                        <p><strong>Nama:</strong> {{ $data->shipping->nama ?? '-' }}</p>
                        <p><strong>Telp:</strong> {{ $data->shipping->telepon ?? '-' }}</p>
                    </td>
                    <td class="p-3">Rp. {{ number_format($data->total_belanja, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <div class="bg-gray-100 p-3 rounded-lg">
                            <p class="font-semibold text-gray-800">{{ $data->bukti_transfer ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="p-3">
                        <span class="bg-red-600 text-white px-4 py-2 rounded">
                            Ditolak
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        Belum ada pembayaran yang ditolak
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
</style>
@endsection