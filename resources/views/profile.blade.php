@extends('layouts.app')

@section('title', 'Profile • Locomotif Jajar')

@section('content')
<div class="flex justify-center items-center py-10">
  <div class="w-[1000px] bg-white border border-[#E2EAF4] rounded-[15px] p-10">
    <h2 class="text-[24px] text-center font-bold mb-8">Profil Saya</h2>

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

    <!-- Content Area -->
    <div class="flex flex-col items-center">
      <div class="w-[600px] space-y-6 text-left">
        <div>
          <label class="text-[20px] font-semibold block mb-2">Nama</label>
          <div class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-gray-50 flex items-center">
            {{ $user->name }}
          </div>
        </div>

        <div>
          <label class="text-[20px] font-semibold block mb-2">Email</label>
          <div class="w-full h-[33px] border border-[#789DBC] rounded-md px-3 bg-gray-50 flex items-center">
            {{ $user->email }}
          </div>
        </div>

        @if($shippingData)
        <div>
          <label class="text-[20px] font-semibold block mb-2">Alamat Pengiriman Tersimpan</label>
          <div class="w-full border border-[#789DBC] rounded-md p-3 bg-gray-50">
            <p><strong>{{ $shippingData->nama }}</strong></p>
            <p>{{ $shippingData->alamat }}</p>
            <p>{{ $shippingData->kelurahan }}, {{ $shippingData->kecamatan }}</p>
            <p>{{ $shippingData->kota }}, {{ $shippingData->provinsi }}</p>
            <p>{{ $shippingData->telepon }}</p>
          </div>
        </div>
        @endif
      </div>

      <div class="pt-8">
        <a href="{{ route('profile.edit') }}" 
           class="w-[390px] h-[65px] bg-[#E2EAF4] rounded-lg text-[24px] font-semibold hover:opacity-90 transition flex items-center justify-center">
          Edit Profile
        </a>
      </div>
    </div>
  </div>
</div>
@endsection