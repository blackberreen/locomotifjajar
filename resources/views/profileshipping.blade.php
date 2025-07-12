@extends('layouts.app')

@section('title', 'Alamat Pengiriman • Locomotif Jajar')

@section('content')
<div class="flex justify-center items-center py-10">
  <div class="w-[1000px] bg-white border border-[#E2EAF4] rounded-[15px] p-10">
    <h2 class="text-[24px] text-center font-bold mb-8">Profile Saya</h2>

    <!-- Navigation Tabs -->
    <div class="flex justify-center mb-8">
      <div class="flex bg-[#F8F9FA] rounded-lg p-1">
        <a href="{{ route('profile.index') }}" 
           class="px-6 py-2 rounded-md {{ request()->routeIs('profile.index') ? 'bg-white shadow-sm text-[#789DBC] font-semibold' : 'text-gray-600' }}">
          Info Akun
        </a>
        <a href="{{ route('profile.shipping') }}" 
           class="px-6 py-2 rounded-md {{ request()->routeIs('profile.shipping') ? 'bg-white shadow-sm text-[#789DBC] font-semibold' : 'text-gray-600' }}">
          Alamat Pengiriman
        </a>
      </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
      {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('profile.shipping.update') }}" method="POST" class="flex flex-col items-center">
      @csrf

      <div class="w-[600px] space-y-6 text-left">
        <div>
          <label for="nama" class="text-[20px] font-semibold block mb-2">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" required 
                 value="{{ old('nama', $shippingData->nama ?? '') }}"
                 class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white">
          @error('nama')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="alamat" class="text-[20px] font-semibold block mb-2">Alamat</label>
          <input type="text" id="alamat" name="alamat" required 
                 value="{{ old('alamat', $shippingData->alamat ?? '') }}"
                 class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white">
          @error('alamat')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex gap-6">
          <div class="w-1/2">
            <label for="provinsi" class="text-[20px] font-semibold block mb-2">Provinsi</label>
            <input type="text" id="provinsi" name="provinsi" required 
                   value="{{ old('provinsi', $shippingData->provinsi ?? '') }}"
                   class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white">
            @error('provinsi')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
          <div class="w-1/2">
            <label for="kota" class="text-[20px] font-semibold block mb-2">Kota</label>
            <input type="text" id="kota" name="kota" required 
                   value="{{ old('kota', $shippingData->kota ?? '') }}"
                   class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white">
            @error('kota')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="flex gap-6">
          <div class="w-1/2">
            <label for="kecamatan" class="text-[20px] font-semibold block mb-2">Kecamatan</label>
            <input type="text" id="kecamatan" name="kecamatan" required 
                   value="{{ old('kecamatan', $shippingData->kecamatan ?? '') }}"
                   class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white">
            @error('kecamatan')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
          <div class="w-1/2">
            <label for="kelurahan" class="text-[20px] font-semibold block mb-2">Kelurahan</label>
            <input type="text" id="kelurahan" name="kelurahan" required 
                   value="{{ old('kelurahan', $shippingData->kelurahan ?? '') }}"
                   class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white">
            @error('kelurahan')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div>
          <label for="telepon" class="text-[20px] font-semibold block mb-2">Nomor Telepon</label>
          <input type="text" id="telepon" name="telepon" required 
                 value="{{ old('telepon', $shippingData->telepon ?? '') }}"
                 class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white">
          @error('telepon')
            <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="pt-8">
        <button type="submit" class="w-[390px] h-[65px] bg-[#E2EAF4] rounded-lg text-[24px] font-semibold hover:opacity-90 transition">
          Simpan Alamat Pengiriman
        </button>
      </div>
    </form>
  </div>
</div>
@endsection