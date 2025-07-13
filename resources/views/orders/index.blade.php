{{-- resources/views/orders/index.blade.php --}}
@extends('layouts.app')

@section('title', 'My Orders • Locomotif Jajar')

@section('content')
<div style="max-width: 1152px; margin: 0 auto; padding: 0 24px;">
  {{-- Header --}}
  <div style="background-color: #ffffff; border: 1px solid #E2EAF4; border-radius: 15px; padding: 24px; margin-bottom: 24px;">
    <h1 style="font-size: 24px; font-weight: bold; text-align: center; margin: 0;">Pesanan Saya</h1>
    <p style="text-align: center; color: #6b7280; margin: 8px 0 0 0;">Kelola dan pantau status pesanan Anda</p>
  </div>

  {{-- Tabs --}}
  <div style="background-color: #ffffff; border: 1px solid #E2EAF4; border-radius: 15px; overflow: hidden;">
    <div style="border-bottom: 1px solid #e5e7eb;">
      <nav style="display: flex;">
        <button 
          onclick="showTab('payment-confirmation')" 
          id="tab-payment-confirmation"
          class="tab-button"
          style="flex: 1; padding: 16px 24px; text-align: center; font-weight: 600; border-bottom: 2px solid transparent; transition: all 0.2s; cursor: pointer; background: none; border-left: none; border-right: none; border-top: none;"
        >
          <svg style="width: 20px; height: 20px; display: inline; margin-right: 8px; vertical-align: middle;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 0h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          Konfirmasi Pembayaran
        </button>
        <button 
          onclick="showTab('order-status')" 
          id="tab-order-status"
          class="tab-button"
          style="flex: 1; padding: 16px 24px; text-align: center; font-weight: 600; border-bottom: 2px solid transparent; transition: all 0.2s; cursor: pointer; background: none; border-left: none; border-right: none; border-top: none;"
        >
          <svg style="width: 20px; height: 20px; display: inline; margin-right: 8px; vertical-align: middle;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          Status Pesanan
        </button>
      </nav>
    </div>

    {{-- Payment Confirmation Tab --}}
    <div id="payment-confirmation" class="tab-content" style="padding: 24px;">
      @if($paymentConfirmations->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 16px;">
          @foreach($paymentConfirmations as $order)
            <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px; transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)'" onmouseout="this.style.boxShadow=''">
              <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                <div>
                  <h3 style="font-size: 18px; font-weight: 600; margin: 0;">Order #{{ $order->id }}</h3>
                  <p style="color: #6b7280; font-size: 14px; margin: 0;">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div style="text-align: right;">
                  <span style="display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 500; 
                    @if($order->status_verifikasi === 'Menunggu') background-color: #fef3c7; color: #92400e;
                    @elseif($order->status_verifikasi === 'Terverifikasi') background-color: #d1fae5; color: #065f46;
                    @else background-color: #fee2e2; color: #991b1b; @endif">
                    {{ $order->status_label }}
                  </span>
                </div>
              </div>

              {{-- Order Details --}}
              <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-bottom: 16px;">
                @media (min-width: 768px) {
                  <style>
                    .order-grid { grid-template-columns: 1fr 1fr; }
                  </style>
                }
                <div class="order-grid" style="display: grid; grid-template-columns: 1fr; gap: 24px;">
                  <div>
                    <h4 style="font-weight: 600; margin: 0 0 8px 0;">Detail Pesanan:</h4>
                    <ul style="font-size: 14px; color: #6b7280; margin: 0; padding: 0; list-style: none;">
                      @foreach($order->orderDetails as $detail)
                        <li style="margin-bottom: 4px;">{{ $detail->nama_produk }} ({{ $detail->jumlah }}x)</li>
                      @endforeach
                    </ul>
                  </div>
                  
                  <div>
                    <h4 style="font-weight: 600; margin: 0 0 8px 0;">Informasi Pembeli:</h4>
                    <div style="font-size: 14px; color: #6b7280;">
                      <p style="margin: 0 0 4px 0;"><strong>Nama:</strong> {{ $order->nama_pembeli }}</p>
                      <p style="margin: 0 0 4px 0;"><strong>No. HP:</strong> {{ $order->nomor_hp }}</p>
                      <p style="margin: 0 0 4px 0;"><strong>Total:</strong> Rp {{ number_format($order->total_belanja, 0, ',', '.') }}</p>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Shipping Address --}}
              <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #f3f4f6;">
                <h4 style="font-weight: 600; margin: 0 0 8px 0;">Alamat Pengiriman:</h4>
                <p style="font-size: 14px; color: #6b7280; margin: 0;">
                  {{ $order->shipping->alamat }}, {{ $order->shipping->kelurahan }}, 
                  {{ $order->shipping->kecamatan }}, {{ $order->shipping->kota }}, 
                  {{ $order->shipping->provinsi }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div style="text-align: center; padding: 48px 0;">
          <svg style="width: 64px; height: 64px; color: #9ca3af; margin: 0 auto 16px auto; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          <h3 style="font-size: 18px; font-weight: 600; color: #6b7280; margin: 0 0 8px 0;">Belum Ada Pesanan</h3>
          <p style="color: #6b7280; margin: 0 0 16px 0;">Anda belum memiliki pesanan apapun.</p>
          <a href="{{ route('product') }}" style="display: inline-block; background-color: #789DBC; color: white; padding: 8px 24px; border-radius: 8px; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#6b8bb3'" onmouseout="this.style.backgroundColor='#789DBC'">
            Mulai Belanja
          </a>
        </div>
      @endif
    </div>

    {{-- Order Status Tab --}}
    <div id="order-status" class="tab-content" style="padding: 24px; display: none;">
      @if($orderStatuses->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 16px;">
          @foreach($orderStatuses as $order)
            <div style="border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px; transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)'" onmouseout="this.style.boxShadow=''">
              <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                <div>
                  <h3 style="font-size: 18px; font-weight: 600; margin: 0;">Order #{{ $order->id }}</h3>
                  <p style="color: #6b7280; font-size: 14px; margin: 0;">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div style="text-align: right;">
                  <span style="display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 500; background-color: #d1fae5; color: #065f46;">
                    Payment Verified
                  </span>
                </div>
              </div>

              {{-- Enhanced Shipping Status --}}
              <div style="background-color: #f9fafb; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                  <div style="flex: 1;">
                    <h4 style="font-weight: 600; color: #1f2937; display: flex; align-items: center; margin: 0;">
                      <svg style="width: 20px; height: 20px; margin-right: 8px; color: #789DBC;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                      </svg>
                      Status Pengiriman
                    </h4>
                    
                    @if($order->shipment)
                      <div style="margin-top: 8px;">
                        {{-- Status Badge --}}
                        <span style="display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 500;
                          @if($order->shipment->status === 'belum_dikirim') background-color: #fef3c7; color: #92400e;
                          @elseif($order->shipment->status === 'sedang_dikirim') background-color: #dbeafe; color: #1e40af;
                          @else background-color: #d1fae5; color: #065f46; @endif">
                          @if($order->shipment->status === 'belum_dikirim')
                            <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                          @elseif($order->shipment->status === 'sedang_dikirim')
                            <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                          @else
                            <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                          @endif
                          {{ $order->shipment->status_label }}
                        </span>
                        
                        {{-- Tracking Number with Copy Feature --}}
                        @if($order->shipment->resi_number)
                          <div style="margin-top: 12px; padding: 12px; background-color: white; border: 1px solid #e5e7eb; border-radius: 8px;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                              <div>
                                <p style="font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 500; margin: 0;">Nomor Resi</p>
                                <p style="font-size: 18px; font-family: monospace; font-weight: 600; color: #1f2937; margin: 4px 0 0 0;" id="resi-{{ $order->id }}">
                                  {{ $order->shipment->resi_number }}
                                </p>
                              </div>
                              <button 
                                onclick="copyResi('{{ $order->shipment->resi_number }}', {{ $order->id }})"
                                style="display: flex; align-items: center; padding: 8px 12px; font-size: 14px; background-color: #789DBC; color: white; border-radius: 8px; border: none; cursor: pointer; transition: background-color 0.2s;"
                                title="Salin nomor resi"
                                onmouseover="this.style.backgroundColor='#6b8bb3'"
                                onmouseout="this.style.backgroundColor='#789DBC'"
                              >
                                <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Salin
                              </button>
                            </div>
                          </div>
                        @endif
                      </div>
                    @else
                      <div style="margin-top: 8px;">
                        <span style="display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 500; background-color: #f3f4f6; color: #1f2937;">
                          <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                  <div style="margin-top: 16px;">
                    @php
                      $status = $order->shipment->status;
                      $steps = [
                        ['key' => 'belum_dikirim', 'label' => 'Belum Dikirim', 'icon' => 'package'],
                        ['key' => 'sedang_dikirim', 'label' => 'Sedang Dikirim', 'icon' => 'truck'], 
                        ['key' => 'sudah_dikirim', 'label' => 'Selesai', 'icon' => 'check']
                      ];
                      $currentStep = array_search($status, array_column($steps, 'key'));
                    @endphp
                    
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                      @foreach($steps as $index => $step)
                        <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
                          {{-- Step Icon --}}
                          <div style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 8px; transition: background-color 0.2s; {{ $index <= $currentStep ? 'background-color: #789DBC; color: white;' : 'background-color: #e5e7eb; color: #9ca3af;' }}">
                            @if($step['icon'] === 'package')
                              <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                              </svg>
                            @elseif($step['icon'] === 'truck')
                              <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                              </svg>
                            @else
                              <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                              </svg>
                            @endif
                          </div>
                          
                          {{-- Step Label --}}
                          <span style="font-size: 12px; text-align: center; font-weight: 500; {{ $index <= $currentStep ? 'color: #789DBC;' : 'color: #9ca3af;' }}">
                            {{ $step['label'] }}
                          </span>
                        </div>
                        
                        {{-- Connector Line --}}
                        @if($index < count($steps) - 1)
                          <div style="flex: 1; height: 2px; margin: 0 8px; {{ $index < $currentStep ? 'background-color: #789DBC;' : 'background-color: #e5e7eb;' }}"></div>
                        @endif
                      @endforeach
                    </div>
                  </div>
                @endif
              </div>

              {{-- Order Details --}}
              <div class="order-grid" style="display: grid; grid-template-columns: 1fr; gap: 24px;">
                <div>
                  <h4 style="font-weight: 600; margin: 0 0 8px 0;">Detail Pesanan:</h4>
                  <ul style="font-size: 14px; color: #6b7280; margin: 0; padding: 0; list-style: none;">
                    @foreach($order->orderDetails as $detail)
                      <li style="margin-bottom: 4px;">{{ $detail->nama_produk }} ({{ $detail->jumlah }}x)</li>
                    @endforeach
                  </ul>
                </div>
                
                <div>
                  <h4 style="font-weight: 600; margin: 0 0 8px 0;">Informasi Pengiriman:</h4>
                  <div style="font-size: 14px; color: #6b7280;">
                    <p style="margin: 0 0 4px 0;"><strong>Nama:</strong> {{ $order->nama_pembeli }}</p>
                    <p style="margin: 0 0 4px 0;"><strong>No. HP:</strong> {{ $order->nomor_hp }}</p>
                    <p style="margin: 0 0 4px 0;"><strong>Total:</strong> Rp {{ number_format($order->total_belanja, 0, ',', '.') }}</p>
                  </div>
                </div>
              </div>

              {{-- Shipping Address --}}
              <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #f3f4f6;">
                <h4 style="font-weight: 600; margin: 0 0 8px 0;">Alamat Pengiriman:</h4>
                <p style="font-size: 14px; color: #6b7280; margin: 0;">
                  {{ $order->shipping->alamat }}, {{ $order->shipping->kelurahan }}, 
                  {{ $order->shipping->kecamatan }}, {{ $order->shipping->kota }}, 
                  {{ $order->shipping->provinsi }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div style="text-align: center; padding: 48px 0;">
          <svg style="width: 64px; height: 64px; color: #9ca3af; margin: 0 auto 16px auto; display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          <h3 style="font-size: 18px; font-weight: 600; color: #6b7280; margin: 0 0 8px 0;">Belum Ada Pesanan Terverifikasi</h3>
          <p style="color: #6b7280; margin: 0;">Pesanan yang sudah terverifikasi akan muncul di sini.</p>
        </div>
      @endif
    </div>
  </div>
</div>

<style>
  @media (min-width: 768px) {
    .order-grid {
      grid-template-columns: 1fr 1fr !important;
    }
  }
  
  /* Tab button hover styles */
  .tab-button:hover {
    color: #789DBC !important;
    background-color: #f8fafc;
  }
  
  /* Active tab styles */
  .tab-button.active {
    color: #789DBC !important;
    border-bottom-color: #789DBC !important;
  }
</style>

<script>
function showTab(tabName) {
  // Hide all tab contents
  const allTabs = document.querySelectorAll('.tab-content');
  allTabs.forEach(tab => {
    tab.style.display = 'none';
  });
  
  // Remove active class from all buttons and reset styles
  const allButtons = document.querySelectorAll('.tab-button');
  allButtons.forEach(button => {
    button.classList.remove('active');
    button.style.borderBottomColor = 'transparent';
    button.style.color = '#6b7280';
  });
  
  // Show selected tab
  const selectedTab = document.getElementById(tabName);
  if (selectedTab) {
    selectedTab.style.display = 'block';
  }
  
  // Add active class to selected button
  const selectedButton = document.getElementById('tab-' + tabName);
  if (selectedButton) {
    selectedButton.classList.add('active');
    selectedButton.style.borderBottomColor = '#789DBC';
    selectedButton.style.color = '#789DBC';
  }
}

function copyResi(resiNumber, orderId) {
  // Copy to clipboard
  navigator.clipboard.writeText(resiNumber).then(function() {
    // Show success feedback
    const button = event.target.closest('button');
    const originalHTML = button.innerHTML;
    
    button.innerHTML = `
      <svg style="width: 16px; height: 16px; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
      Tersalin!
    `;
    button.style.backgroundColor = '#10b981';
    button.onmouseover = function() { this.style.backgroundColor = '#059669'; };
    button.onmouseout = function() { this.style.backgroundColor = '#10b981'; };
    
    setTimeout(() => {
      button.innerHTML = originalHTML;
      button.style.backgroundColor = '#789DBC';
      button.onmouseover = function() { this.style.backgroundColor = '#6b8bb3'; };
      button.onmouseout = function() { this.style.backgroundColor = '#789DBC'; };
    }, 2000);
  }).catch(function(err) {
    console.error('Could not copy text: ', err);
    alert('Gagal menyalin nomor resi');
  });
}

// Initialize first tab as active when page loads
document.addEventListener('DOMContentLoaded', function() {
  showTab('payment-confirmation');
});
</script>
@endsection