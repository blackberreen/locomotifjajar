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
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem;" />
        @error('nama')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Nomor Telpon -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Nomor Telpon</label>
        <input type="text" name="nomor_telpon" required 
               value="{{ old('nomor_telpon') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem;" />
        @error('nomor_telpon')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jenis Motor -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Jenis Motor</label>
        <input type="text" name="jenis_motor" required 
               value="{{ old('jenis_motor') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem;" />
        @error('jenis_motor')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jasa yang Diinginkan -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 0.25rem;">Jasa yang diinginkan</label>
        <select name="jasa" required style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem;">
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
                  style="width: 100%; height: 80px; border-radius: 20px; border: 1px solid #789DBC; padding: 0.5rem 1rem;"
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
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 1rem;" />
        @error('tanggal_booking')
          <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tombol -->
      <button type="submit" 
              style="width: 390px; height: 60px; background-color: #E2EAF4; font-size: 20px; font-weight: bold; font-family: sans-serif; margin-top: 0.5rem; border-radius: 0.5rem; border: none; align-self: center; transition: opacity 0.2s; {{ !Auth::check() ? 'cursor: not-allowed;' : 'cursor: pointer;' }}"
              onmouseover="if({{ Auth::check() ? 'true' : 'false' }}) this.style.opacity='0.9'"
              onmouseout="this.style.opacity='1'">
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