@extends('layouts.app')

@section('title', 'Booking • Locomotif Jajar')

@section('content')
<div style="padding: 24px 40px; display: flex; flex-direction: column; gap: 40px; align-items: flex-start;">
  @media (min-width: 1024px) {
    <div style="flex-direction: row;">
  }
  
  <!-- Kiri -->
  <div style="display: flex; flex-direction: column; align-items: flex-start;">
    <h1 style="font-size: 44px; font-weight: bold; font-family: sans-serif; text-align: left; margin-bottom: 12px;">Booking Service</h1>
    <p style="font-size: 20px; font-family: sans-serif; text-align: left; margin-bottom: 16px; line-height: 1.2;">
      Pesan tanpa antri, motor anda langsung <br> kami perbaiki.
    </p>
    <img
      src="{{ asset('img/coverbooking.jpeg') }}"
      alt="Cover Booking"
      style="width: 515px; height: 280px; object-fit: cover; border-radius: 8px;"
    />
  </div>

  <!-- Kanan (Form) -->
  <div style="width: 746px;">
    @if(!Auth::check())
      <!-- Alert untuk user yang belum login -->
      <div style="background-color: #fefce8; border: 1px solid #fef3c7; border-radius: 8px; padding: 24px; margin-bottom: 24px;">
        <div style="display: flex; align-items: center;">
          <div style="flex-shrink: 0;">
            <svg style="height: 20px; width: 20px; color: #f59e0b;" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
          </div>
          <div style="margin-left: 12px;">
            <h3 style="font-size: 14px; font-weight: 500; color: #92400e;">
              Login Diperlukan
            </h3>
            <div style="margin-top: 8px; font-size: 14px; color: #a16207;">
              <p>Untuk melakukan booking, silakan login terlebih dahulu.</p>
            </div>
            <div style="margin-top: 16px;">
              <div style="display: flex; gap: 8px;">
                <a href="{{ route('user.login') }}" style="background-color: #eab308; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; transition: background-color 0.2s;">
                  Login
                </a>
                <a href="{{ route('user.register') }}" style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; transition: background-color 0.2s;">
                  Register
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}" 
          style="border: 1px solid #E2EAF4; border-radius: 12px; padding: 24px; display: flex; flex-direction: column; gap: 16px; {{ !Auth::check() ? 'opacity: 0.5; pointer-events: none;' : '' }}">
      @csrf

      @if(session('error'))
        <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #b91c1c; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px;">
          {{ session('error') }}
        </div>
      @endif

      <!-- Nama -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 4px;">Nama</label>
        <input type="text" name="nama" required 
               value="{{ old('nama', Auth::user()->name ?? '') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 16px;" />
        @error('nama')
          <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Nomor Telpon -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 4px;">Nomor Telpon</label>
        <input type="text" name="nomor_telpon" required 
               value="{{ old('nomor_telpon') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 16px;" />
        @error('nomor_telpon')
          <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jenis Motor -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 4px;">Jenis Motor</label>
        <input type="text" name="jenis_motor" required 
               value="{{ old('jenis_motor') }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 16px;" />
        @error('jenis_motor')
          <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jasa yang Diinginkan -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 4px;">Jasa yang diinginkan</label>
        <select name="jasa" required style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 16px;">
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
          <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Keluhan -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 4px;">Keluhan</label>
        <textarea name="keluhan" 
                  style="width: 100%; height: 80px; border-radius: 20px; border: 1px solid #789DBC; padding: 8px 16px;"
                  placeholder="Jelaskan keluhan atau kebutuhan khusus...">{{ old('keluhan') }}</textarea>
        @error('keluhan')
          <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tanggal Booking -->
      <div>
        <label style="display: block; font-size: 20px; font-family: sans-serif; font-weight: 600; margin-bottom: 4px;">Tanggal Booking</label>
        <input type="date" name="tanggal_booking" required 
               value="{{ old('tanggal_booking') }}"
               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
               style="width: 100%; height: 36px; border-radius: 20px; border: 1px solid #789DBC; padding: 0 16px;" />
        @error('tanggal_booking')
          <span style="color: #ef4444; font-size: 14px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tombol -->
      <button type="submit" 
              style="width: 390px; height: 60px; background-color: #E2EAF4; font-size: 20px; font-weight: bold; font-family: sans-serif; margin-top: 8px; border-radius: 8px; border: none; cursor: pointer; align-self: center; transition: opacity 0.2s; {{ !Auth::check() ? 'cursor: not-allowed;' : '' }}"
              onmouseover="this.style.opacity='0.9'"
              onmouseout="this.style.opacity='1'">
        Booking Service
      </button>
    </form>
  </div>
</div>
@endsection