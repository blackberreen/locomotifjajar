@extends('layouts.admin')

@section('title', 'Payment • Locomotif Jajar')

@section('content')
<div style="width: 986px; height: 750px; background-color: white; margin: auto; border: 1px solid #D1D5DB; border-radius: 1rem; padding: 1.5rem; overflow: auto;">
    <h1 style="font-size: 45px; font-weight: bold; text-align: center; margin-bottom: 1.5rem;">Payment</h1>

    @if(session('success'))
        <div style="color: #16A34A; font-size: 1.125rem; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color: #DC2626; font-size: 1.125rem; margin-bottom: 1rem;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tab Navigation -->
    <div style="display: flex; border-bottom: 1px solid #D1D5DB; margin-bottom: 1.5rem;">
        <button onclick="showTab('belum-verifikasi')" 
                id="tab-belum-verifikasi" 
                style="padding: 0.5rem 1rem; font-weight: 600; color: #4B5563; border-bottom: 2px solid transparent; cursor: pointer;"
                class="active-tab">
            Belum Diverifikasi 
            <span style="background-color: #F59E0B; color: white; font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 9999px; margin-left: 0.25rem;">
                {{ $belumDiverifikasi->count() }}
            </span>
        </button>
        <button onclick="showTab('terverifikasi')" 
                id="tab-terverifikasi" 
                style="padding: 0.5rem 1rem; font-weight: 600; color: #4B5563; border-bottom: 2px solid transparent; cursor: pointer;">
            Terverifikasi 
            <span style="background-color: #10B981; color: white; font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 9999px; margin-left: 0.25rem;">
                {{ $terverifikasi->count() }}
            </span>
        </button>
        <button onclick="showTab('ditolak')" 
                id="tab-ditolak" 
                style="padding: 0.5rem 1rem; font-weight: 600; color: #4B5563; border-bottom: 2px solid transparent; cursor: pointer;">
            Ditolak 
            <span style="background-color: #EF4444; color: white; font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 9999px; margin-left: 0.25rem;">
                {{ $ditolak->count() }}
            </span>
        </button>
    </div>

    <!-- Tab Content: Belum Diverifikasi -->
    <div id="content-belum-verifikasi" class="tab-content">
        <table style="width: 100%; text-align: left; border: 1px solid #D1D5DB;">
            <thead style="background-color: #E2EAF4;">
                <tr style="font-size: 1.125rem;">
                    <th style="padding: 0.75rem;">Informasi</th>
                    <th style="padding: 0.75rem;">Total Belanja</th>
                    <th style="padding: 0.75rem;">Nama Pemilik Rekening</th>
                    <th style="padding: 0.75rem;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($belumDiverifikasi as $data)
                <tr style="border-top: 1px solid #E5E7EB;">
                    <td style="padding: 0.75rem;">
                        <p><strong>Nama:</strong> {{ $data->shipping->nama ?? '-' }}</p>
                        <p><strong>Telp:</strong> {{ $data->shipping->telepon ?? '-' }}</p>
                    </td>
                    <td style="padding: 0.75rem;">Rp. {{ number_format($data->total_belanja, 0, ',', '.') }}</td>
                    <td style="padding: 0.75rem;">
                        <div style="background-color: #EFF6FF; border: 1px solid #BFDBFE; padding: 0.75rem; border-radius: 0.5rem; color: #1F2937;">
                            {{ $data->bukti_transfer ?? '-' }}
                        </div>
                    </td>
                    <td style="padding: 0.75rem;">
                        <form action="{{ route('admin.payment.update', $data->id) }}" method="POST">
                            @csrf
                            <div style="display: flex; gap: 0.5rem;">
                                <button type="submit" name="status_verifikasi" value="Terverifikasi" 
                                        style="background-color: #10B981; color: white; padding: 0.5rem 0.75rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                                    Verifikasi
                                </button>
                                <button type="submit" name="status_verifikasi" value="Ditolak" 
                                        style="background-color: #EF4444; color: white; padding: 0.5rem 0.75rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                                    Tolak
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 1.5rem; text-align: center; color: #6B7280;">
                        Tidak ada pembayaran yang menunggu verifikasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tab Content: Terverifikasi dan Ditolak -->
    <!-- Salin struktur dari bagian Belum Diverifikasi dan ganti teks/tampilan sesuai status -->

</div>

<!-- Script Tabs -->
<script>
    function showTab(tabName) {
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => content.classList.add('hidden'));

        const tabs = document.querySelectorAll('[id^="tab-"]');
        tabs.forEach(tab => {
            tab.style.color = '#4B5563';
            tab.style.borderBottomColor = 'transparent';
        });

        document.getElementById('content-' + tabName).classList.remove('hidden');
        const activeTab = document.getElementById('tab-' + tabName);
        activeTab.style.color = '#2563EB';
        activeTab.style.borderBottomColor = '#2563EB';
    }

    document.addEventListener('DOMContentLoaded', function() {
        showTab('belum-verifikasi');
    });
</script>
@endsection
