{{-- resources/views/profile/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Profile • Locomotif Jajar')

@section('content')
<div class="max-w-4xl mx-auto px-6">
  {{-- Header --}}
  <div class="bg-white border border-[#E2EAF4] rounded-[15px] p-6 mb-6">
    <h1 class="text-[24px] font-bold text-center">Profil Saya</h1>
    <p class="text-center text-gray-600 mt-2">Kelola informasi profil Anda untuk keamanan akun</p>
  </div>

  {{-- Profile Form --}}
  <div class="bg-white border border-[#E2EAF4] rounded-[15px] p-8">
    <form action="{{ $profile ? route('user.profile.update') : route('user.profile.store') }}" method="POST">
      @csrf
      @if($profile)
        @method('PUT')
      @endif

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Nama Lengkap --}}
        <div class="md:col-span-2">
          <label for="nama" class="text-[18px] font-semibold block mb-2">Nama Lengkap</label>
          <input 
            type="text" 
            id="nama" 
            name="nama" 
            value="{{ old('nama', $profile->nama ?? '') }}"
            required 
            class="w-full h-[40px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('nama')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Alamat --}}
        <div class="md:col-span-2">
          <label for="alamat" class="text-[18px] font-semibold block mb-2">Alamat Lengkap</label>
          <textarea 
            id="alamat" 
            name="alamat" 
            required 
            rows="3"
            class="w-full border border-[#789DBC] rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >{{ old('alamat', $profile->alamat ?? '') }}</textarea>
          @error('alamat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Provinsi --}}
        <div>
          <label for="provinsi" class="text-[18px] font-semibold block mb-2">Provinsi</label>
          <input 
            type="text" 
            id="provinsi" 
            name="provinsi" 
            value="{{ old('provinsi', $profile->provinsi ?? '') }}"
            required 
            class="w-full h-[40px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('provinsi')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Kota --}}
        <div>
          <label for="kota" class="text-[18px] font-semibold block mb-2">Kota</label>
          <input 
            type="text" 
            id="kota" 
            name="kota" 
            value="{{ old('kota', $profile->kota ?? '') }}"
            required 
            class="w-full h-[40px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('kota')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Kecamatan --}}
        <div>
          <label for="kecamatan" class="text-[18px] font-semibold block mb-2">Kecamatan</label>
          <input 
            type="text" 
            id="kecamatan" 
            name="kecamatan" 
            value="{{ old('kecamatan', $profile->kecamatan ?? '') }}"
            required 
            class="w-full h-[40px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('kecamatan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Kelurahan --}}
        <div>
          <label for="kelurahan" class="text-[18px] font-semibold block mb-2">Kelurahan</label>
          <input 
            type="text" 
            id="kelurahan" 
            name="kelurahan" 
            value="{{ old('kelurahan', $profile->kelurahan ?? '') }}"
            required 
            class="w-full h-[40px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('kelurahan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Nomor Telepon --}}
        <div class="md:col-span-2">
          <label for="telepon" class="text-[18px] font-semibold block mb-2">Nomor Telepon</label>
          <input 
            type="text" 
            id="telepon" 
            name="telepon" 
            value="{{ old('telepon', $profile->telepon ?? '') }}"
            required 
            class="w-full h-[40px] border border-[#789DBC] rounded-md px-3 bg-white focus:outline-none focus:ring-2 focus:ring-[#789DBC]"
          >
          @error('telepon')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- Submit Button --}}
      <div class="flex justify-center mt-8">
        <button 
          type="submit" 
          class="w-[300px] h-[50px] bg-[#789DBC] text-white rounded-lg text-[18px] font-semibold hover:bg-[#6b8bb3] transition-colors"
        >
          {{ $profile ? 'Update Profile' : 'Simpan Profile' }}
        </button>
      </div>
    </form>
  </div>

  {{-- Info --}}
  @if(!$profile)
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
      <div class="flex items-start">
        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <div>
          <h3 class="text-blue-800 font-semibold">Info</h3>
          <p class="text-blue-700 text-sm mt-1">
            Setelah mengisi profile, data ini akan otomatis terisi saat Anda melakukan pembelian sehingga mempercepat proses checkout.
          </p>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection