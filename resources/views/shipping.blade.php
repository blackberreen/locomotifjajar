{{-- resources/views/shipping.blade.php --}}
@extends('layouts.app')

@section('title', 'Form Pengiriman • Locomotif Jajar')

@section('content')
<div class="flex justify-center items-center py-10">
  <div class="w-[800px] bg-white border border-[#E2EAF4] rounded-[15px] p-10">
    <h2 class="text-[20px] text-center font-bold mb-8">Form Pengiriman</h2>

    {{-- Info jika data auto-filled --}}
    @if($profileData)
      <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
        <div class="flex items-start">
          <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <div>
            <h3 class="text-green-800 font-semibold">Data Otomatis Terisi</h3>
            <p class="text-green-700 text-sm mt-1">
              Form telah diisi otomatis berdasarkan profile Anda. Anda dapat mengubahnya jika diperlukan.
            </p>
          </div>
        </div>
      </div>
    @endif

    <form action="{{ route('shipping.store') }}" method="POST" class="flex flex-col items-center">
      @csrf

      <div class="w-[600px] space-y-6 text-left">
        <div>
          <label for="nama" class="text-[20px] font-semibold block mb-2">Nama Lengkap</label>
          <input 
            type="text" 
            id="nama" 
            name="nama" 
            value="{{ old('nama', $profileData['nama'] ?? '') }}"
            required 
            class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('nama')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="alamat" class="text-[20px] font-semibold block mb-2">Alamat</label>
          <textarea 
            id="alamat" 
            name="alamat" 
            required 
            rows="3"
            class="w-full border border-[#789DBC] rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >{{ old('alamat', $profileData['alamat'] ?? '') }}</textarea>
          @error('alamat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex gap-6">
          <div class="w-1/2">
            <label for="provinsi" class="text-[20px] font-semibold block mb-2">Provinsi</label>
            <input 
              type="text" 
              id="provinsi" 
              name="provinsi" 
              value="{{ old('provinsi', $profileData['provinsi'] ?? '') }}"
              required 
              class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
            >
            @error('provinsi')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="w-1/2">
            <label for="kota" class="text-[20px] font-semibold block mb-2">Kota</label>
            <input 
              type="text" 
              id="kota" 
              name="kota" 
              value="{{ old('kota', $profileData['kota'] ?? '') }}"
              required 
              class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
            >
            @error('kota')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="flex gap-6">
          <div class="w-1/2">
            <label for="kecamatan" class="text-[20px] font-semibold block mb-2">Kecamatan</label>
            <input 
              type="text" 
              id="kecamatan" 
              name="kecamatan" 
              value="{{ old('kecamatan', $profileData['kecamatan'] ?? '') }}"
              required 
              class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
            >
            @error('kecamatan')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="w-1/2">
            <label for="kelurahan" class="text-[20px] font-semibold block mb-2">Kelurahan</label>
            <input 
              type="text" 
              id="kelurahan" 
              name="kelurahan" 
              value="{{ old('kelurahan', $profileData['kelurahan'] ?? '') }}"
              required 
              class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
            >
            @error('kelurahan')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div>
          <label for="telepon" class="text-[20px] font-semibold block mb-2">Nomor Telepon</label>
          <input 
            type="text" 
            id="telepon" 
            name="telepon" 
            value="{{ old('telepon', $profileData['telepon'] ?? '') }}"
            required 
            class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('telepon')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="pt-8">
        <button type="submit" class="w-[390px] h-[65px] bg-[#E2EAF4] rounded-lg text-[24px] font-semibold hover:opacity-90 transition">
          Proses Pembayaran
        </button>
      </div>
    </form>

    {{-- Link to Profile --}}
    @auth
      @if(!$profileData)
        <div class="text-center mt-6">
          <p class="text-gray-600 text-sm mb-2">Ingin mempercepat proses checkout di masa depan?</p>
          <a href="{{ route('user.profile') }}" class="text-[#789DBC] hover:text-[#6b8bb3] font-medium">
            Isi Profile Anda →
          </a>
        </div>
      @endif
    @endauth
  </div>
</div>
@endsection