@extends('layouts.app')

@section('title', 'Booking • Locomotif Jajar')

@section('content')
<div class="px-10 py-6 flex flex-col lg:flex-row gap-10 items-start">
  <!-- Kiri -->
  <div class="flex flex-col items-start">
    <h1 class="text-[44px] font-bold font-sans text-left mb-3">Booking Service</h1>
    <p class="text-[20px] font-sans text-left mb-4 leading-tight">
      Pesan tanpa antri, motor anda langsung <br> kami perbaiki.
    </p>
    <img
      src="{{ asset('img/coverbooking.jpeg') }}"
      alt="Cover Booking"
      class="w-[515px] h-[280px] object-cover rounded-lg"
    />
  </div>

  <!-- Kanan (Form) -->
  <div class="w-[746px]">
    @if(!Auth::check())
      <!-- Alert untuk user yang belum login -->
      <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-medium text-yellow-800">
              Login Diperlukan
            </h3>
            <div class="mt-2 text-sm text-yellow-700">
              <p>Untuk melakukan booking, silakan login terlebih dahulu.</p>
            </div>
            <div class="mt-4">
              <div class="flex space-x-2">
                <a href="{{ route('user.login') }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                  Login
                </a>
                <a href="{{ route('user.register') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                  Register
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}" 
          class="border border-[#E2EAF4] rounded-xl p-6 flex flex-col gap-4 {{ !Auth::check() ? 'opacity-50 pointer-events-none' : '' }}">
      @csrf

      @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          {{ session('error') }}
        </div>
      @endif

      <!-- Nama -->
      <div>
        <label class="block text-[20px] font-sans font-semibold mb-1">Nama</label>
        <input type="text" name="nama" required 
               value="{{ old('nama', Auth::user()->name ?? '') }}"
               class="w-full h-[36px] rounded-[20px] border border-[#789DBC] px-4" />
        @error('nama')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Nomor Telpon -->
      <div>
        <label class="block text-[20px] font-sans font-semibold mb-1">Nomor Telpon</label>
        <input type="text" name="nomor_telpon" required 
               value="{{ old('nomor_telpon') }}"
               class="w-full h-[36px] rounded-[20px] border border-[#789DBC] px-4" />
        @error('nomor_telpon')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jenis Motor -->
      <div>
        <label class="block text-[20px] font-sans font-semibold mb-1">Jenis Motor</label>
        <input type="text" name="jenis_motor" required 
               value="{{ old('jenis_motor') }}"
               class="w-full h-[36px] rounded-[20px] border border-[#789DBC] px-4" />
        @error('jenis_motor')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jasa yang Diinginkan -->
      <div>
        <label class="block text-[20px] font-sans font-semibold mb-1">Jasa yang diinginkan</label>
        <select name="jasa" required class="w-full h-[36px] rounded-[20px] border border-[#789DBC] px-4">
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
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Keluhan -->
      <div>
        <label class="block text-[20px] font-sans font-semibold mb-1">Keluhan</label>
        <textarea name="keluhan" 
                  class="w-full h-[80px] rounded-[20px] border border-[#789DBC] px-4 py-2"
                  placeholder="Jelaskan keluhan atau kebutuhan khusus...">{{ old('keluhan') }}</textarea>
        @error('keluhan')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tanggal Booking -->
      <div>
        <label class="block text-[20px] font-sans font-semibold mb-1">Tanggal Booking</label>
        <input type="date" name="tanggal_booking" required 
               value="{{ old('tanggal_booking') }}"
               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
               class="w-full h-[36px] rounded-[20px] border border-[#789DBC] px-4" />
        @error('tanggal_booking')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tombol -->
      <button type="submit" 
              class="w-[390px] h-[60px] bg-[#E2EAF4] text-[20px] font-bold font-sans mt-2 rounded-lg hover:opacity-90 self-center {{ !Auth::check() ? 'cursor-not-allowed' : '' }}">
        Booking Service
      </button>
    </form>
  </div>
</div>
@endsection