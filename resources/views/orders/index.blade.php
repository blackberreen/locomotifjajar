{{-- resources/views/orders/index.blade.php --}}
@extends('layouts.app')

@section('title', 'My Orders • Locomotif Jajar')

@section('content')
<div class="max-w-6xl mx-auto px-6">
  {{-- Header --}}
  <div class="bg-white border border-[#E2EAF4] rounded-[15px] p-6 mb-6">
    <h1 class="text-[24px] font-bold text-center">Pesanan Saya</h1>
    <p class="text-center text-gray-600 mt-2">Kelola dan pantau status pesanan Anda</p>
  </div>

  {{-- Tabs --}}
  <div class="bg-white border border-[#E2EAF4] rounded-[15px] overflow-hidden">
    <div class="border-b border-gray-200">
      <nav class="flex">
        <button 
          onclick="showTab('payment-confirmation')" 
          id="tab-payment-confirmation"
          class="tab-button flex-1 py-4 px-6 text-center font-semibold border-b-2 border-transparent hover:text-[#789DBC] transition-colors"
        >
          <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 0h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          Konfirmasi Pembayaran
        </button>
        <button 
          onclick="showTab('order-status')" 
          id="tab-order-status"
          class="tab-button flex-1 py-4 px-6 text-center font-semibold border-b-2 border-transparent hover:text-[#789DBC] transition-colors"
        >
          <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          Status Pesanan
        </button>
      </nav>
    </div>

    {{-- Payment Confirmation Tab --}}
    <div id="payment-confirmation" class="tab-content p-6">
      @if($paymentConfirmations->count() > 0)
        <div class="space-y-4">
          @foreach($paymentConfirmations as $order)
            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
              <div class="flex justify-between items-start mb-4">
                <div>
                  <h3 class="text-[18px] font-semibold">Order #{{ $order->id }}</h3>
                  <p class="text-gray-600 text-sm">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="text-right">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($order->status_verifikasi === 'Menunggu') bg-yellow-100 text-yellow-800
                    @elseif($order->status_verifikasi === 'Terverifikasi') bg-green-100 text-green-800  
                    @else bg-red-100 text-red-800 @endif">
                    {{ $order->status_label }}
                  </span>
                </div>
              </div>

              {{-- Order Details --}}
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h4 class="font-semibold mb-2">Detail Pesanan:</h4>
                  <ul class="text-sm text-gray-600 space-y-1">
                    @foreach($order->orderDetails as $detail)
                      <li>{{ $detail->nama_produk }} ({{ $detail->jumlah }}x)</li>
                    @endforeach
                  </ul>
                </div>
                
                <div>
                  <h4 class="font-semibold mb-2">Informasi Pembeli:</h4>
                  <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>Nama:</strong> {{ $order->nama_pembeli }}</p>
                    <p><strong>No. HP:</strong> {{ $order->nomor_hp }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($order->total_belanja, 0, ',', '.') }}</p>
                  </div>
                </div>
              </div>

              {{-- Shipping Address --}}
              <div class="mt-4 pt-4 border-t border-gray-100">
                <h4 class="font-semibold mb-2">Alamat Pengiriman:</h4>
                <p class="text-sm text-gray-600">
                  {{ $order->shipping->alamat }}, {{ $order->shipping->kelurahan }}, 
                  {{ $order->shipping->kecamatan }}, {{ $order->shipping->kota }}, 
                  {{ $order->shipping->provinsi }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="text-center py-12">
          <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Pesanan</h3>
          <p class="text-gray-500">Anda belum memiliki pesanan apapun.</p>
          <a href="{{ route('product') }}" class="inline-block mt-4 bg-[#789DBC] text-white px-6 py-2 rounded-lg hover:bg-[#6b8bb3] transition-colors">
            Mulai Belanja
          </a>
        </div>
      @endif
    </div>

    {{-- Order Status Tab --}}
    <div id="order-status" class="tab-content p-6 hidden">
      @if($orderStatuses->count() > 0)
        <div class="space-y-4">
          @foreach($orderStatuses as $order)
            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
              <div class="flex justify-between items-start mb-4">
                <div>
                  <h3 class="text-[18px] font-semibold">Order #{{ $order->id }}</h3>
                  <p class="text-gray-600 text-sm">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="text-right">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    Payment Verified
                  </span>
                </div>
              </div>

              {{-- Enhanced Shipping Status --}}
              <div class="bg-gray-50 rounded-lg p-4 mb-4">
                <div class="flex justify-between items-start mb-3">
                  <div class="flex-1">
                    <h4 class="font-semibold text-gray-800 flex items-center">
                      <svg class="w-5 h-5 mr-2 text-[#789DBC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                      </svg>
                      Status Pengiriman
                    </h4>
                    
                    @if($order->shipment)
                      <div class="mt-2">
                        {{-- Status Badge --}}
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                          @if($order->shipment->status === 'belum_dikirim') bg-yellow-100 text-yellow-800
                          @elseif($order->shipment->status === 'sedang_dikirim') bg-blue-100 text-blue-800  
                          @else bg-green-100 text-green-800 @endif">
                          @if($order->shipment->status === 'belum_dikirim')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                          @elseif($order->shipment->status === 'sedang_dikirim')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                          @else
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                          @endif
                          {{ $order->shipment->status_label }}
                        </span>
                        
                        {{-- Tracking Number with Copy Feature --}}
                        @if($order->shipment->resi_number)
                          <div class="mt-3 p-3 bg-white border border-gray-200 rounded-lg">
                            <div class="flex items-center justify-between">
                              <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Nomor Resi</p>
                                <p class="text-lg font-mono font-semibold text-gray-800 mt-1" id="resi-{{ $order->id }}">
                                  {{ $order->shipment->resi_number }}
                                </p>
                              </div>
                              <button 
                                onclick="copyResi('{{ $order->shipment->resi_number }}', {{ $order->id }})"
                                class="flex items-center px-3 py-2 text-sm bg-[#789DBC] text-white rounded-lg hover:bg-[#6b8bb3] transition-colors"
                                title="Salin nomor resi"
                              >
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Salin
                              </button>
                            </div>
                          </div>
                        @endif
                      </div>
                    @else
                      <div class="mt-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                          Menunggu Proses
                        </span>
                      </div>
                    @endif
                  </div>
                </div>
                
                {{-- Enhanced Progress Indicator --}}
                @if($order->shipment)
                  <div class="mt-4">
                    @php
                      $status = $order->shipment->status;
                      $steps = [
                        ['key' => 'belum_dikirim', 'label' => 'Belum Dikirim', 'icon' => 'package'],
                        ['key' => 'sedang_dikirim', 'label' => 'Sedang Dikirim', 'icon' => 'truck'], 
                        ['key' => 'sudah_dikirim', 'label' => 'Selesai', 'icon' => 'check']
                      ];
                      $currentStep = array_search($status, array_column($steps, 'key'));
                    @endphp
                    
                    <div class="flex items-center justify-between">
                      @foreach($steps as $index => $step)
                        <div class="flex flex-col items-center flex-1">
                          {{-- Step Icon --}}
                          <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-colors
                            {{ $index <= $currentStep ? 'bg-[#789DBC] text-white' : 'bg-gray-200 text-gray-400' }}">
                            @if($step['icon'] === 'package')
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                              </svg>
                            @elseif($step['icon'] === 'truck')
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                              </svg>
                            @else
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                              </svg>
                            @endif
                          </div>
                          
                          {{-- Step Label --}}
                          <span class="text-xs text-center font-medium {{ $index <= $currentStep ? 'text-[#789DBC]' : 'text-gray-400' }}">
                            {{ $step['label'] }}
                          </span>
                        </div>
                        
                        {{-- Connector Line --}}
                        @if($index < count($steps) - 1)
                          <div class="flex-1 h-0.5 mx-2 {{ $index < $currentStep ? 'bg-[#789DBC]' : 'bg-gray-200' }}"></div>
                        @endif
                      @endforeach
                    </div>
                  </div>
                @endif
              </div>

              {{-- Order Details --}}
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h4 class="font-semibold mb-2">Detail Pesanan:</h4>
                  <ul class="text-sm text-gray-600 space-y-1">
                    @foreach($order->orderDetails as $detail)
                      <li>{{ $detail->nama_produk }} ({{ $detail->jumlah }}x)</li>
                    @endforeach
                  </ul>
                </div>
                
                <div>
                  <h4 class="font-semibold mb-2">Informasi Pengiriman:</h4>
                  <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>Nama:</strong> {{ $order->nama_pembeli }}</p>
                    <p><strong>No. HP:</strong> {{ $order->nomor_hp }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($order->total_belanja, 0, ',', '.') }}</p>
                  </div>
                </div>
              </div>

              {{-- Shipping Address --}}
              <div class="mt-4 pt-4 border-t border-gray-100">
                <h4 class="font-semibold mb-2">Alamat Pengiriman:</h4>
                <p class="text-sm text-gray-600">
                  {{ $order->shipping->alamat }}, {{ $order->shipping->kelurahan }}, 
                  {{ $order->shipping->kecamatan }}, {{ $order->shipping->kota }}, 
                  {{ $order->shipping->provinsi }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="text-center py-12">
          <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Pesanan Terverifikasi</h3>
          <p class="text-gray-500">Pesanan yang sudah terverifikasi akan muncul di sini.</p>
        </div>
      @endif
    </div>
  </div>
</div>

<script>
function showTab(tabName) {
  // Hide all tab contents
  document.querySelectorAll('.tab-content').forEach(tab => {
    tab.classList.add('hidden');
  });
  
  // Remove active class from all buttons
  document.querySelectorAll('.tab-button').forEach(button => {
    button.classList.remove('border-[#789DBC]', 'text-[#789DBC]');
  });
  
  // Show selected tab
  document.getElementById(tabName).classList.remove('hidden');
  
  // Add active class to selected button
  document.getElementById('tab-' + tabName).classList.add('border-[#789DBC]', 'text-[#789DBC]');
}

function copyResi(resiNumber, orderId) {
  // Copy to clipboard
  navigator.clipboard.writeText(resiNumber).then(function() {
    // Show success feedback
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    
    button.innerHTML = `
      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
      Tersalin!
    `;
    button.classList.remove('bg-[#789DBC]', 'hover:bg-[#6b8bb3]');
    button.classList.add('bg-green-500', 'hover:bg-green-600');
    
    setTimeout(() => {
      button.innerHTML = originalText;
      button.classList.remove('bg-green-500', 'hover:bg-green-600');
      button.classList.add('bg-[#789DBC]', 'hover:bg-[#6b8bb3]');
    }, 2000);
  }).catch(function(err) {
    console.error('Could not copy text: ', err);
    alert('Gagal menyalin nomor resi');
  });
}

// Initialize first tab as active
document.addEventListener('DOMContentLoaded', function() {
  showTab('payment-confirmation');
});
</script>
@endsection