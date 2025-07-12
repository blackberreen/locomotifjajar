@extends('layouts.app')

@section('title', 'Register - Locomotif')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Buat akun baru
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Atau
        <a href="{{ route('user.login') }}" class="font-medium text-[#789DBC] hover:text-[#6b8bb3]">
          masuk ke akun yang sudah ada
        </a>
      </p>
    </div>

    <form class="mt-8 space-y-6" action="{{ route('user.register') }}" method="POST">
      @csrf
      <div class="space-y-4">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input id="name" 
                 name="name" 
                 type="text" 
                 autocomplete="name" 
                 required 
                 class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] sm:text-sm" 
                 placeholder="Masukkan nama lengkap"
                 value="{{ old('name') }}">
          @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input id="email" 
                 name="email" 
                 type="email" 
                 autocomplete="email" 
                 required 
                 class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] sm:text-sm" 
                 placeholder="Masukkan alamat email"
                 value="{{ old('email') }}">
          @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
          <input id="phone" 
                 name="phone" 
                 type="tel" 
                 autocomplete="tel" 
                 required 
                 class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] sm:text-sm" 
                 placeholder="Contoh: 08123456789"
                 value="{{ old('phone') }}">
          @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
          <textarea id="address" 
                    name="address" 
                    rows="3" 
                    required 
                    class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] sm:text-sm" 
                    placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
          @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input id="password" 
                 name="password" 
                 type="password" 
                 autocomplete="new-password" 
                 required 
                 class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] sm:text-sm" 
                 placeholder="Minimal 8 karakter">
          @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
          <input id="password_confirmation" 
                 name="password_confirmation" 
                 type="password" 
                 autocomplete="new-password" 
                 required 
                 class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] sm:text-sm" 
                 placeholder="Ulangi password">
        </div>
      </div>

      <div>
        <button type="submit" 
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#789DBC] hover:bg-[#6b8bb3] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#789DBC]">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-[#6b8bb3] group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
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