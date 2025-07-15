@extends('layouts.app')

@section('title', 'Booking • Locomotif Jajar')

@section('content')
<div style="padding: 1.5rem 2.5rem; display: flex; flex-direction: column; gap: 2.5rem; align-items: flex-start;">
  <!-- Kiri -->
  <div style="display: flex; flex-direction: column; align-items: flex-start;">
    <h1 style="font-size: 44px; font-weight: bold; font-family: sans-serif; text-align: left; margin-bottom: 0.75rem;">Booking Service</h1>
    <p style="font-size: 20px; font-family: sans-serif; text-align: left; margin-bottom: 1rem; line-height: 1.2;">
      Pesan tanpa antri, motor anda langsung <br> kami perbaiki.
    </p>
    <img
      src="{{ asset('img/coverbooking.jpeg') }}"
      alt="Cover Booking"
      style="width: 515px; height: 280px; object-fit: cover; border-radius: 0.5rem;"
    />
  </div>

  <!-- Kanan (Form) -->
  <div style="width: 746px;">
    @if(!Auth::check())
      <!-- Alert untuk user yang belum login -->
      <div style="background-color: #fefce8; border: 1px solid #fde68a; border-radius: 0.5rem; padding: 1.5rem; margin-bottom: 1.5rem;">
        <div style="display: flex; align-items: center;">
          <div style="flex-shrink: 0;">
            <svg style="height: 1.25rem; width: 1.25rem; color: #fbbf24;" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
          </div>
          <div style="margin-left: 0.75rem;">
            <h3 style="font-size: 0.875rem; font-weight: 500; color: #92400e;">
              Login Diperlukan
            </h3>
            <div style="margin-top: 0.5rem; font-size: 0.875rem; color: #b45309;">
              <p>Untuk melakukan booking, silakan login terlebih dahulu.</p>
            </div>
            <div style="margin-top: 1rem;">
              <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('user.login') }}" style="background-color: #eab308; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#ca8a04'" onmouseout="this.style.backgroundColor='#eab308'">
                  Login
                </a>
                <a href="{{ route('user.register') }}" style="background-color: #6b7280; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#4b5563'" onmouseout="this.style.backgroundColor='#6b7280'">
                  Register
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}" 
          style="border: 1px solid #E2EAF4; border-radius: 0.75rem; padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; {{ !Auth::check() ? 'opacity: 0.5; pointer-events: none;' : '' }}">
      @csrf

      @if(session('error'))
        <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #dc2626; padding: 0.75rem 1rem; border-radius: 0.25rem; margin-bottom: 1rem;">
          {{ session('error') }}
        </div>
      @endif

      <!-- Nama -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Nama</label>
        <input type="text" name="nama" required 
               value="{{ old('nama', Auth::user()->name ?? '') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem; box-sizing: border-box; font-size: 16px; font-family: sans-serif;" />
        @error('nama')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Nomor Telpon -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Nomor Telpon</label>
        <input type="text" name="nomor_telpon" required 
               value="{{ old('nomor_telpon') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem; box-sizing: border-box; font-size: 16px; font-family: sans-serif;" />
        @error('nomor_telpon')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jenis Motor -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Jenis Motor</label>
        <input type="text" name="jenis_motor" required 
               value="{{ old('jenis_motor') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem; box-sizing: border-box; font-size: 16px; font-family: sans-serif;" />
        @error('jenis_motor')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jasa yang Diinginkan -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Jasa yang diinginkan</label>
        <select name="jasa" required style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem; box-sizing: border-box; font-size: 16px; font-family: sans-serif; appearance: none; background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIiIGhlaWdodD0iOCIgdmlld0JveD0iMCAwIDEyIDgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xIDFMNiA2TDExIDEiIHN0cm9rZT0iIzc4OURCQyIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPC9zdmc+'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 12px 8px;">
          <option value="">Pilih Jasa</option>
          <option value="Upgrade Kaki-kaki Motor" {{ old('jasa') == 'Upgrade Kaki-kaki Motor' ? 'selected' : '' }}>
            Upgrade Kaki-kaki Motor
          </option>
          <option value="Bubut" {{ old('jasa') == 'Bubut' ? 'selected' : '' }}>
            Bubut
          </option>
          <option value="Modifikasi Motor" {{ old('jasa') == 'Modifikasi Motor' ? 'selected' : '' }}>
            Modifikasi Motor
          </option>
          <option value="Reparasi Motor" {{ old('jasa') == 'Reparasi Motor' ? 'selected' : '' }}>
            Reparasi Motor
          </option>
        </select>
        @error('jasa')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Keluhan -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Keluhan</label>
        <textarea name="keluhan" 
                  style="width: 100%; height: 80px; border-radius: 20px; border: 1px solid #789DBC; padding: 0.5rem 1rem; box-sizing: border-box; font-size: 16px; font-family: sans-serif; resize: vertical;"
                  placeholder="Jelaskan keluhan atau kebutuhan khusus...">{{ old('keluhan') }}</textarea>
        @error('keluhan')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tanggal Booking -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Tanggal Booking</label>
        <input type="date" name="tanggal_booking" required 
               value="{{ old('tanggal_booking') }}"
               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem; box-sizing: border-box; font-size: 16px; font-family: sans-serif;" />
        @error('tanggal_booking')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tombol -->
      <button type="submit" 
              style="width: 390px; height: 60px; background-color: #E2EAF4; font-size: 20px; font-weight: bold; font-family: sans-serif; margin-top: 0.5rem; border-radius: 0.5rem; border: none; align-self: center; {{ !Auth::check() ? 'cursor: not-allowed;' : 'cursor: pointer;' }}">
        Booking Service
      </button>
    </form>
  </div>
</div>

<!-- Media Query untuk Responsif -->
<style>
@media (min-width: 1024px) {
  .container-booking {
    flex-direction: row !important;
  }
}

/* Responsive untuk mobile */
@media (max-width: 768px) {
  div[style*="padding: 1.5rem 2.5rem"] {
    padding: 1rem !important;
  }
  
  div[style*="width: 746px"] {
    width: 100% !important;
  }
  
  img[style*="width: 515px"] {
    width: 100% !important;
    height: auto !important;
  }
  
  button[style*="width: 390px"] {
    width: 100% !important;
  }
  
  h1[style*="font-size: 44px"] {
    font-size: 32px !important;
  }
  
  p[style*="font-size: 20px"] {
    font-size: 18px !important;
  }
  
  label[style*="font-size: 20px"] {
    font-size: 18px !important;
  }
}

/* Fix untuk input dan select consistency */
input[type="text"],
input[type="date"],
select,
textarea {
  outline: none;
  transition: border-color 0.2s;
}

input[type="text"]:focus,
input[type="date"]:focus,
select:focus,
textarea:focus {
  border-color: #4a90e2;
}

/* Custom styling untuk select dropdown */
select option {
  font-size: 16px;
  font-family: sans-serif;
  padding: 0.5rem;
}

/* Styling untuk textarea */
textarea::placeholder {
  font-size: 16px;
  font-family: sans-serif;
  color: #9ca3af;
}
</style>

<!-- Script untuk menambahkan class responsif -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const container = document.querySelector('[style*="flex-direction: column"]');
  if (container) {
    container.classList.add('container-booking');
  }
});
</script>
@endsection