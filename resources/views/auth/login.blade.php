@extends('layouts.app')

@section('title', 'Login - Locomotif')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #f9fafb; padding: 48px 0; padding-left: 16px; padding-right: 16px;">
  <div style="max-width: 400px; width: 100%; display: flex; flex-direction: column; gap: 32px;">
    <div>
      <h2 style="margin-top: 24px; text-align: center; font-size: 30px; font-weight: 800; color: #111827; margin-bottom: 8px;">
        Masuk ke akun Anda
      </h2>
      <p style="margin-top: 8px; text-align: center; font-size: 14px; color: #6b7280; margin-bottom: 0;">
        Atau
        <a href="{{ route('user.register') }}" style="font-weight: 500; color: #789DBC; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#6b8bb3'" onmouseout="this.style.color='#789DBC'">
          daftar akun baru
        </a>
      </p>
    </div>

    <form style="margin-top: 32px; display: flex; flex-direction: column; gap: 24px;" action="{{ route('user.login') }}" method="POST">
      @csrf
      <div style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <div>
          <label for="email" style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">Email address</label>
          <input id="email" 
                 name="email" 
                 type="email" 
                 autocomplete="email" 
                 required 
                 style="appearance: none; border-radius: 0; position: relative; display: block; width: 100%; padding: 12px; border: 1px solid #d1d5db; background-color: white; color: #111827; border-top-left-radius: 6px; border-top-right-radius: 6px; outline: none; font-size: 14px; box-sizing: border-box;" 
                 placeholder="Alamat Email"
                 value="{{ old('email') }}"
                 onfocus="this.style.borderColor='#789DBC'; this.style.boxShadow='0 0 0 1px #789DBC';"
                 onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
          @error('email')
            <p style="margin-top: 4px; font-size: 14px; color: #dc2626;">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="password" style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">Password</label>
          <input id="password" 
                 name="password" 
                 type="password" 
                 autocomplete="current-password" 
                 required 
                 style="appearance: none; border-radius: 0; position: relative; display: block; width: 100%; padding: 12px; border: 1px solid #d1d5db; background-color: white; color: #111827; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px; outline: none; font-size: 14px; box-sizing: border-box; margin-top: -1px;" 
                 placeholder="Password"
                 onfocus="this.style.borderColor='#789DBC'; this.style.boxShadow='0 0 0 1px #789DBC';"
                 onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
          @error('password')
            <p style="margin-top: 4px; font-size: 14px; color: #dc2626;">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div style="display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center;">
          <input id="remember-me" 
                 name="remember" 
                 type="checkbox" 
                 style="height: 16px; width: 16px; color: #789DBC; border: 1px solid #d1d5db; border-radius: 4px; margin-right: 8px;"
                 onfocus="this.style.boxShadow='0 0 0 2px #789DBC';"
                 onblur="this.style.boxShadow='none';">
          <label for="remember-me" style="margin-left: 8px; display: block; font-size: 14px; color: #111827;">
            Ingat saya
          </label>
        </div>

        <div style="font-size: 14px;">
          <a href="#" style="font-weight: 500; color: #789DBC; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#6b8bb3'" onmouseout="this.style.color='#789DBC'">
            Lupa password?
          </a>
        </div>
      </div>

      <div>
        <button type="submit" 
                style="position: relative; width: 100%; display: flex; justify-content: center; padding: 12px 16px; border: none; font-size: 14px; font-weight: 500; border-radius: 6px; color: white; background-color: #789DBC; cursor: pointer; outline: none; transition: background-color 0.2s; box-sizing: border-box;"
                onmouseover="this.style.backgroundColor='#6b8bb3'"
                onmouseout="this.style.backgroundColor='#789DBC'"
                onfocus="this.style.boxShadow='0 0 0 2px rgba(120, 157, 188, 0.5)'"
                onblur="this.style.boxShadow='none'">
          <span style="position: absolute; left: 0; top: 0; bottom: 0; display: flex; align-items: center; padding-left: 12px;">
            <svg style="height: 20px; width: 20px; color: #6b8bb3;" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
          </span>
          Masuk
        </button>
      </div>
    </form>
  </div>
</div>
@endsection