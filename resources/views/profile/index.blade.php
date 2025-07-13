{{-- resources/views/profile/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Profile • Locomotif Jajar')

@section('content')
<div style="max-width: 896px; margin: 0 auto; padding: 0 24px;">
  {{-- Header --}}
  <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 15px; padding: 24px; margin-bottom: 24px;">
    <h1 style="font-size: 24px; font-weight: bold; text-align: center; margin: 0;">Profil Saya</h1>
    <p style="text-align: center; color: #6b7280; margin-top: 8px; margin-bottom: 0;">Kelola informasi profil Anda untuk keamanan akun</p>
  </div>

  {{-- Profile Form --}}
  <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 15px; padding: 32px;">
    <form action="{{ $profile ? route('user.profile.update') : route('user.profile.store') }}" method="POST">
      @csrf
      @if($profile)
        @method('PUT')
      @endif

      <div style="display: grid; grid-template-columns: 1fr; gap: 24px;">
        {{-- Nama Lengkap --}}
        <div style="grid-column: 1 / -1;">
          <label for="nama" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 8px;">Nama Lengkap</label>
          <input 
            type="text" 
            id="nama" 
            name="nama" 
            value="{{ old('nama', $profile->nama ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 12px; background-color: white; outline: none; transition: box-shadow 0.2s;"
            onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
            onblur="this.style.boxShadow='none'"
          >
          @error('nama')
            <p style="color: #ef4444; font-size: 14px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Alamat --}}
        <div style="grid-column: 1 / -1;">
          <label for="alamat" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 8px;">Alamat Lengkap</label>
          <textarea 
            id="alamat" 
            name="alamat" 
            required 
            rows="3"
            style="width: 100%; border: 1px solid #789DBC; border-radius: 6px; padding: 8px 12px; background-color: white; outline: none; transition: box-shadow 0.2s; resize: vertical;"
            onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
            onblur="this.style.boxShadow='none'"
          >{{ old('alamat', $profile->alamat ?? '') }}</textarea>
          @error('alamat')
            <p style="color: #ef4444; font-size: 14px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Provinsi --}}
        <div>
          <label for="provinsi" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 8px;">Provinsi</label>
          <input 
            type="text" 
            id="provinsi" 
            name="provinsi" 
            value="{{ old('provinsi', $profile->provinsi ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 12px; background-color: white; outline: none; transition: box-shadow 0.2s;"
            onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
            onblur="this.style.boxShadow='none'"
          >
          @error('provinsi')
            <p style="color: #ef4444; font-size: 14px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Kota --}}
        <div>
          <label for="kota" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 8px;">Kota</label>
          <input 
            type="text" 
            id="kota" 
            name="kota" 
            value="{{ old('kota', $profile->kota ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 12px; background-color: white; outline: none; transition: box-shadow 0.2s;"
            onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
            onblur="this.style.boxShadow='none'"
          >
          @error('kota')
            <p style="color: #ef4444; font-size: 14px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Kecamatan --}}
        <div>
          <label for="kecamatan" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 8px;">Kecamatan</label>
          <input 
            type="text" 
            id="kecamatan" 
            name="kecamatan" 
            value="{{ old('kecamatan', $profile->kecamatan ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 12px; background-color: white; outline: none; transition: box-shadow 0.2s;"
            onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
            onblur="this.style.boxShadow='none'"
          >
          @error('kecamatan')
            <p style="color: #ef4444; font-size: 14px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Kelurahan --}}
        <div>
          <label for="kelurahan" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 8px;">Kelurahan</label>
          <input 
            type="text" 
            id="kelurahan" 
            name="kelurahan" 
            value="{{ old('kelurahan', $profile->kelurahan ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 12px; background-color: white; outline: none; transition: box-shadow 0.2s;"
            onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
            onblur="this.style.boxShadow='none'"
          >
          @error('kelurahan')
            <p style="color: #ef4444; font-size: 14px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Nomor Telepon --}}
        <div style="grid-column: 1 / -1;">
          <label for="telepon" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 8px;">Nomor Telepon</label>
          <input 
            type="text" 
            id="telepon" 
            name="telepon" 
            value="{{ old('telepon', $profile->telepon ?? '') }}"
            required 
            style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 6px; padding: 0 12px; background-color: white; outline: none; transition: box-shadow 0.2s;"
            onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
            onblur="this.style.boxShadow='none'"
          >
          @error('telepon')
            <p style="color: #ef4444; font-size: 14px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- Submit Button --}}
      <div style="display: flex; justify-content: center; margin-top: 32px;">
        <button 
          type="submit" 
          style="width: 300px; height: 50px; background-color: #789DBC; color: white; border-radius: 8px; font-size: 18px; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s;"
          onmouseover="this.style.backgroundColor='#6b8bb3'"
          onmouseout="this.style.backgroundColor='#789DBC'"
        >
          {{ $profile ? 'Update Profile' : 'Simpan Profile' }}
        </button>
      </div>
    </form>
  </div>

  {{-- Info --}}
  @if(!$profile)
    <div style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 16px; margin-top: 24px;">
      <div style="display: flex; align-items: flex-start;">
        <svg style="width: 20px; height: 20px; color: #2563eb; margin-top: 2px; margin-right: 12px; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <div>
          <h3 style="color: #1e40af; font-weight: 600; margin: 0;">Info</h3>
          <p style="color: #1d4ed8; font-size: 14px; margin: 4px 0 0 0;">
            Setelah mengisi profile, data ini akan otomatis terisi saat Anda melakukan pembelian sehingga mempercepat proses checkout.
          </p>
        </div>
      </div>
    </div>
  @endif
</div>

{{-- Media Query for Responsive Design --}}
<style>
@media (min-width: 768px) {
  .grid-container {
    grid-template-columns: 1fr 1fr;
  }
  .grid-full-width {
    grid-column: 1 / -1;
  }
}
</style>

<script>
// Apply responsive grid classes
document.addEventListener('DOMContentLoaded', function() {
  const gridContainer = document.querySelector('div[style*="display: grid"]');
  if (gridContainer && window.innerWidth >= 768) {
    gridContainer.classList.add('grid-container');
    gridContainer.style.gridTemplateColumns = '1fr 1fr';
    
    // Apply full width to specific elements
    const fullWidthElements = [
      'div:has(#nama)',
      'div:has(#alamat)', 
      'div:has(#telepon)'
    ];
    
    fullWidthElements.forEach(selector => {
      const element = gridContainer.querySelector(selector);
      if (element) {
        element.classList.add('grid-full-width');
        element.style.gridColumn = '1 / -1';
      }
    });
  }
});

// Handle window resize
window.addEventListener('resize', function() {
  const gridContainer = document.querySelector('div[style*="display: grid"]');
  if (gridContainer) {
    if (window.innerWidth >= 768) {
      gridContainer.style.gridTemplateColumns = '1fr 1fr';
    } else {
      gridContainer.style.gridTemplateColumns = '1fr';
    }
  }
});
</script>
@endsection