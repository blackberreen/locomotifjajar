@extends('layouts.app')

@section('title', 'Register - Locomotif')

@section('content')
<div style="min-height:100vh; display:flex; align-items:center; justify-content:center; background-color:#F9FAFB; padding:48px 16px;">
  <div style="max-width:28rem; width:100%;">
    <div>
      <h2 style="margin-top:24px; text-align:center; font-size:1.875rem; font-weight:800; color:#1F2937;">Buat akun baru</h2>
      <p style="margin-top:8px; text-align:center; font-size:0.875rem; color:#4B5563;">
        Atau
        <a href="{{ route('user.login') }}" style="font-weight:500; color:#789DBC; text-decoration:none;" onmouseover="this.style.color='#6b8bb3'" onmouseout="this.style.color='#789DBC'">
          masuk ke akun yang sudah ada
        </a>
      </p>
    </div>

    <form style="margin-top:32px;" action="{{ route('user.register') }}" method="POST">
      @csrf
      <div style="margin-bottom:16px;">
        <label for="name" style="display:block; font-size:0.875rem; font-weight:500; color:#374151;">Nama Lengkap</label>
        <input id="name" name="name" type="text" required autocomplete="name"
          style="margin-top:4px; width:100%; padding:8px 12px; border:1px solid #D1D5DB; border-radius:0.375rem; color:#111827;" 
          placeholder="Masukkan nama lengkap"
          value="{{ old('name') }}">
        @error('name')
          <p style="margin-top:4px; font-size:0.875rem; color:#DC2626;">{{ $message }}</p>
        @enderror
      </div>

      <div style="margin-bottom:16px;">
        <label for="email" style="display:block; font-size:0.875rem; font-weight:500; color:#374151;">Email</label>
        <input id="email" name="email" type="email" required autocomplete="email"
          style="margin-top:4px; width:100%; padding:8px 12px; border:1px solid #D1D5DB; border-radius:0.375rem; color:#111827;" 
          placeholder="Masukkan alamat email"
          value="{{ old('email') }}">
        @error('email')
          <p style="margin-top:4px; font-size:0.875rem; color:#DC2626;">{{ $message }}</p>
        @enderror
      </div>

      <div style="margin-bottom:16px;">
        <label for="phone" style="display:block; font-size:0.875rem; font-weight:500; color:#374151;">Nomor Telepon</label>
        <input id="phone" name="phone" type="tel" required autocomplete="tel"
          style="margin-top:4px; width:100%; padding:8px 12px; border:1px solid #D1D5DB; border-radius:0.375rem; color:#111827;" 
          placeholder="Contoh: 08123456789"
          value="{{ old('phone') }}">
        @error('phone')
          <p style="margin-top:4px; font-size:0.875rem; color:#DC2626;">{{ $message }}</p>
        @enderror
      </div>

      <div style="margin-bottom:16px;">
        <label for="address" style="display:block; font-size:0.875rem; font-weight:500; color:#374151;">Alamat</label>
        <textarea id="address" name="address" rows="3" required
          style="margin-top:4px; width:100%; padding:8px 12px; border:1px solid #D1D5DB; border-radius:0.375rem; color:#111827;" 
          placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
        @error('address')
          <p style="margin-top:4px; font-size:0.875rem; color:#DC2626;">{{ $message }}</p>
        @enderror
      </div>

      <div style="margin-bottom:16px;">
        <label for="password" style="display:block; font-size:0.875rem; font-weight:500; color:#374151;">Password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password"
          style="margin-top:4px; width:100%; padding:8px 12px; border:1px solid #D1D5DB; border-radius:0.375rem; color:#111827;" 
          placeholder="Minimal 8 karakter">
        @error('password')
          <p style="margin-top:4px; font-size:0.875rem; color:#DC2626;">{{ $message }}</p>
        @enderror
      </div>

      <div style="margin-bottom:24px;">
        <label for="password_confirmation" style="display:block; font-size:0.875rem; font-weight:500; color:#374151;">Konfirmasi Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
          style="margin-top:4px; width:100%; padding:8px 12px; border:1px solid #D1D5DB; border-radius:0.375rem; color:#111827;" 
          placeholder="Ulangi password">
      </div>

      <div>
        <button type="submit" 
          style="display:flex; align-items:center; justify-content:center; width:100%; padding:8px 16px; background-color:#789DBC; color:white; border:none; border-radius:0.375rem; font-weight:500; font-size:0.875rem; cursor:pointer;"
          onmouseover="this.style.backgroundColor='#6b8bb3'" 
          onmouseout="this.style.backgroundColor='#789DBC'">
          <span style="display:flex; align-items:center; margin-right:8px;">
            <svg style="width:20px; height:20px; color:#6b8bb3;" fill="currentColor" viewBox="0 0 20 20">
              <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
            </svg>
          </span>
          Daftar
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
