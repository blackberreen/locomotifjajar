@extends('layouts.app')

@section('title', 'My Orders • Locomotif Jajar')

@section('content')
<div style="max-width: 72rem; margin: 0 auto; padding: 1.5rem;">
  <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem;">
    <h1 style="font-size: 24px; font-weight: bold; text-align: center;">Pesanan Saya</h1>
    <p style="text-align: center; color: #4B5563; margin-top: 0.5rem;">Kelola dan pantau status pesanan Anda</p>
  </div>

  <!-- Tabs -->
  <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 15px; overflow: hidden;">
    <div style="border-bottom: 1px solid #E5E7EB;">
      <nav style="display: flex;">
        <button onclick="showTab('payment-confirmation')" id="tab-payment-confirmation" class="tab-button" style="flex: 1; padding: 1rem 1.5rem; text-align: center; font-weight: 600; border-bottom: 2px solid transparent; transition: color 0.3s;">
          Konfirmasi Pembayaran
        </button>
        <button onclick="showTab('order-status')" id="tab-order-status" class="tab-button" style="flex: 1; padding: 1rem 1.5rem; text-align: center; font-weight: 600; border-bottom: 2px solid transparent; transition: color 0.3s;">
          Status Pesanan
        </button>
      </nav>
    </div>

    <!-- Payment Confirmation Tab -->
    <div id="payment-confirmation" class="tab-content" style="padding: 1.5rem;">
      <!-- Isi akan tergantung dari data $paymentConfirmations -->
      <!-- Tambahkan inline style untuk elemen lainnya jika diperlukan -->
    </div>

    <!-- Order Status Tab -->
    <div id="order-status" class="tab-content hidden" style="padding: 1.5rem;">
      <!-- Isi akan tergantung dari data $orderStatuses -->
      <!-- Tambahkan inline style untuk elemen lainnya jika diperlukan -->
    </div>
  </div>
</div>

<script>
function showTab(tabName) {
  document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
  document.querySelectorAll('.tab-button').forEach(button => {
    button.style.borderBottomColor = 'transparent';
    button.style.color = '';
  });
  document.getElementById(tabName).classList.remove('hidden');
  const activeTab = document.getElementById('tab-' + tabName);
  activeTab.style.borderBottomColor = '#789DBC';
  activeTab.style.color = '#789DBC';
}

document.addEventListener('DOMContentLoaded', function() {
  showTab('payment-confirmation');
});
</script>
@endsection
