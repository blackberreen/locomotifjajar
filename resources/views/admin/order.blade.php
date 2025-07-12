@extends('layouts.admin')

@section('title', 'Order • Locomotif Jajar')

@section('content')
<div class="w-[1265px] h-[750px] bg-white mx-auto border border-gray-300 rounded-2xl p-6 overflow-auto">
    <h1 class="text-[45px] font-bold text-center mb-6">Order</h1>

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

    <table class="w-full text-left border border-gray-300">
        <thead class="bg-[#E2EAF4]">
            <tr class="text-lg">
                <th class="p-3">Nama & Telepon</th>
                <th class="p-3">Alamat Pengiriman</th>
                <th class="p-3">Produk & Jumlah</th>
                <th class="p-3">Status Pengiriman</th>
                <th class="p-3">No. Resi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-t border-gray-200">
                <td class="p-3">
                    <p><strong>Nama:</strong> {{ $order->shipping->nama }}</p>
                    <p><strong>Telp:</strong> {{ $order->shipping->telepon }}</p>
                </td>
                <td class="p-3">
                    {{ $order->shipping->alamat }},
                    {{ $order->shipping->kelurahan }},
                    {{ $order->shipping->kecamatan }},
                    {{ $order->shipping->kota }},
                    {{ $order->shipping->provinsi }}
                </td>
                <td class="p-3">
                    @foreach ($order->orderDetails as $detail)
                         <p>{{ $detail->nama_produk }} x {{ $detail->jumlah }}</p>
                    @endforeach
                </td>

                <td class="p-3">
                    @php
                        $currentStatus = $order->shipment->status ?? 'belum_dikirim';
                    @endphp
                    <form id="statusForm{{ $order->id }}" action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status_pengiriman" class="border rounded p-1" onchange="handleStatusChange({{ $order->id }}, this.value)">
                            <option value="belum_dikirim" {{ $currentStatus == 'belum_dikirim' ? 'selected' : '' }}>Belum Dikirim</option>
                            <option value="sedang_dikirim" {{ $currentStatus == 'sedang_dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                            <option value="sudah_dikirim" {{ $currentStatus == 'sudah_dikirim' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </td>

                <td class="p-3">
                    @if($order->shipment && $order->shipment->resi_number)
                        <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">
                            {{ $order->shipment->resi_number }}
                        </span>
                    @else
                        <span class="text-gray-400 text-sm">Belum ada</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Input Nomor Resi -->
<div id="resiModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-6 rounded-lg max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold mb-4">Input Nomor Resi</h3>
            <p class="text-gray-600 mb-4">Status akan diubah menjadi "Sedang Dikirim". Silakan masukkan nomor resi:</p>
            
            <form id="resiForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status_pengiriman" value="sedang_dikirim">
                <div class="mb-4">
                    <label for="resi_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Resi</label>
                    <input 
                        type="text" 
                        id="resi_number" 
                        name="resi_number" 
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: JNE123456789"
                        required
                    >
                </div>
                
                <div class="flex justify-end gap-2">
                    <button 
                        type="button" 
                        onclick="closeResiModal()"
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentOrderId = null;

function handleStatusChange(orderId, newStatus) {
    if (newStatus === 'sedang_dikirim') {
        // Tampilkan modal untuk input resi saat status diubah ke "sedang_dikirim"
        currentOrderId = orderId;
        document.getElementById('resiForm').action = `/admin/order/update-status/${orderId}`;
        document.getElementById('resiModal').classList.remove('hidden');
    } else {
        // Submit form langsung untuk status selain "sedang_dikirim"
        document.getElementById(`statusForm${orderId}`).submit();
    }
}

function closeResiModal() {
    document.getElementById('resiModal').classList.add('hidden');
    // Reset form dan select dropdown
    if (currentOrderId) {
        const select = document.querySelector(`#statusForm${currentOrderId} select`);
        // Reset ke nilai sebelumnya (perlu logic untuk menyimpan nilai sebelumnya)
        location.reload(); // Sementara reload page
    }
}

// Handle modal form submit
document.getElementById('resiForm').addEventListener('submit', function(e) {
    const resiInput = document.getElementById('resi_number');
    if (!resiInput.value.trim()) {
        e.preventDefault();
        alert('Nomor resi harus diisi!');
        return;
    }
});
</script>
@endsection