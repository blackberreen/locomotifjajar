@extends('layouts.app')

@section('title', 'Profile • Locomotif Jajar')

@section('content')
<div style="max-width: 64rem; margin: 0 auto; padding: 1.5rem;">
  <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem;">
    <h1 style="font-size: 24px; font-weight: bold; text-align: center;">Profil Saya</h1>
    <p style="text-align: center; color: #4B5563; margin-top: 0.5rem;">Kelola informasi profil Anda untuk keamanan akun</p>
  </div>

  <div style="background-color: white; border: 1px solid #E2EAF4; border-radius: 15px; padding: 2rem;">
    <form action="{{ $profile ? route('user.profile.update') : route('user.profile.store') }}" method="POST">
      @csrf
      @if($profile)
        @method('PUT')
      @endif

      <div style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 1.5rem;">
        <div style="grid-column: span 2 / span 2;">
          <label for="nama" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 0.5rem;">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" value="{{ old('nama', $profile->nama ?? '') }}" required style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 0.375rem; padding: 0 0.75rem; background-color: white;">
          @error('nama')<p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
        </div>

        <div style="grid-column: span 2 / span 2;">
          <label for="alamat" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 0.5rem;">Alamat Lengkap</label>
          <textarea id="alamat" name="alamat" required rows="3" style="width: 100%; border: 1px solid #789DBC; border-radius: 0.375rem; padding: 0.5rem 0.75rem; background-color: white;">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
          @error('alamat')<p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="provinsi" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 0.5rem;">Provinsi</label>
          <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', $profile->provinsi ?? '') }}" required style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 0.375rem; padding: 0 0.75rem; background-color: white;">
          @error('provinsi')<p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="kota" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 0.5rem;">Kota</label>
          <input type="text" id="kota" name="kota" value="{{ old('kota', $profile->kota ?? '') }}" required style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 0.375rem; padding: 0 0.75rem; background-color: white;">
          @error('kota')<p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="kecamatan" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 0.5rem;">Kecamatan</label>
          <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $profile->kecamatan ?? '') }}" required style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 0.375rem; padding: 0 0.75rem; background-color: white;">
          @error('kecamatan')<p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
        </div>

        <div>
          <label for="kelurahan" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 0.5rem;">Kelurahan</label>
          <input type="text" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $profile->kelurahan ?? '') }}" required style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 0.375rem; padding: 0 0.75rem; background-color: white;">
          @error('kelurahan')<p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
        </div>

        <div style="grid-column: span 2 / span 2;">
          <label for="telepon" style="font-size: 18px; font-weight: 600; display: block; margin-bottom: 0.5rem;">Nomor Telepon</label>
          <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $profile->telepon ?? '') }}" required style="width: 100%; height: 40px; border: 1px solid #789DBC; border-radius: 0.375rem; padding: 0 0.75rem; background-color: white;">
          @error('telepon')<p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
        </div>
      </div>

      <div style="display: flex; justify-content: center; margin-top: 2rem;">
        <button type="submit" style="width: 300px; height: 50px; background-color: #789DBC; color: white; border-radius: 0.5rem; font-size: 18px; font-weight: 600; transition: background-color 0.3s;">
          {{ $profile ? 'Update Profile' : 'Simpan Profile' }}
        </button>
      </div>
    </form>
  </div>

  @if(!$profile)
    <div style="background-color: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 0.5rem; padding: 1rem; margin-top: 1.5rem;">
      <div style="display: flex; align-items: flex-start;">
        <svg style="width: 1.25rem; height: 1.25rem; color: #2563EB; margin-top: 0.125rem; margin-right: 0.75rem;" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <div>
          <h3 style="color: #1D4ED8; font-weight: 600;">Info</h3>
          <p style="color: #1E40AF; font-size: 0.875rem; margin-top: 0.25rem;">
            Setelah mengisi profile, data ini akan otomatis terisi saat Anda melakukan pembelian sehingga mempercepat proses checkout.
          </p>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
