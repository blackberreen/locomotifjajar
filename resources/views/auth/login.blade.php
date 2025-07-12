@extends('layouts.app')

@section('title', 'Login - Locomotif')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Masuk ke akun Anda
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Atau
        <a href="{{ route('user.register') }}" class="font-medium text-[#789DBC] hover:text-[#6b8bb3]">
          daftar akun baru
        </a>
      </p>
    </div>

    <form class="mt-8 space-y-6" action="{{ route('user.login') }}" method="POST">
      @csrf
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="email" class="sr-only">Email address</label>
          <input id="email" 
                 name="email" 
                 type="email" 
                 autocomplete="email" 
                 required 
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] focus:z-10 sm:text-sm" 
                 placeholder="Alamat Email"
                 value="{{ old('email') }}">
          @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" 
                 name="password" 
                 type="password" 
                 autocomplete="current-password" 
                 required 
                 class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-[#789DBC] focus:border-[#789DBC] focus:z-10 sm:text-sm" 
                 placeholder="Password">
          @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember-me" 
                 name="remember" 
                 type="checkbox" 
                 class="h-4 w-4 text-[#789DBC] focus:ring-[#789DBC] border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-gray-900">
            Ingat saya
          </label>
        </div>

        <div class="text-sm">
          <a href="#" class="font-medium text-[#789DBC] hover:text-[#6b8bb3]">
            Lupa password?
          </a>
        </div>
      </div>

      <div>
        <button type="submit" 
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#789DBC] hover:bg-[#6b8bb3] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#789DBC]">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-[#6b8bb3] group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
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