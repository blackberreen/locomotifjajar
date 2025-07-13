{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Locomotif Jajar')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Heroicons -->
  <script src="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/24/outline/index.js"></script>
</head>
<body class="bg-white text-gray-800">

  {{-- Navbar --}}
  <nav class="px-6 py-4 flex items-center justify-between" style="border-bottom:2px solid #789DBC;">
    <div class="text-[32px] font-bold ml-4">Locomotif</div>
    
    <div class="flex items-center space-x-10">
      <ul class="flex space-x-10">
        <li><a href="{{ route('home') }}" class="text-[20px] hover:text-primary">Beranda</a></li>
        <li><a href="{{ route('service') }}" class="text-[20px] hover:text-primary">Layanan</a></li>
        <li><a href="{{ route('product') }}" class="text-[20px] hover:text-primary">Produk</a></li>
        <li><a href="{{ route('about') }}" class="text-[20px] hover:text-primary">Tentang kami</a></li>
      </ul>

      {{-- User Authentication Section --}}
      <div class="relative">
        @auth
          {{-- User is logged in - Show user dropdown --}}
          <div class="relative group">
            <button class="flex items-center space-x-2 p-2 rounded-full hover:bg-gray-100 transition-colors">
              <div class="w-10 h-10 bg-[#789DBC] rounded-full flex items-center justify-center text-white font-semibold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
              <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            {{-- Dropdown Menu --}}
            <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
              <div class="py-2">
                <div class="px-4 py-2 border-b border-gray-100">
                  <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                  <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Profil
                </a>
                <a href="{{ route('user.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                  Pesanan Saya
                </a>
                <a href="{{ route('user.bookings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                  Reservasi Saya
                </a>
                <hr class="my-1">
                <form method="POST" action="{{ route('user.logout') }}" class="block">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Keluar
                  </button>
                </form>
              </div>
            </div>
          </div>
        @else
          {{-- User is not logged in - Show login/register buttons --}}
          <div class="flex items-center space-x-4">
            <a href="{{ route('user.login') }}" class="text-[16px] text-[#789DBC] hover:text-[#6b8bb3] font-medium">
              Masuk
            </a>
            <a href="{{ route('user.register') }}" class="bg-[#789DBC] text-white px-4 py-2 rounded-lg hover:bg-[#6b8bb3] transition-colors font-medium">
              Daftar
            </a>
          </div>
        @endauth
      </div>
    </div>
  </nav>

  {{-- Flash Messages --}}
  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mx-6 mt-4 rounded">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-6 mt-4 rounded">
      {{ session('error') }}
    </div>
  @endif

  {{-- Konten halaman --}}
  <main class="container mx-auto py-10">
    @yield('content')
  </main>

</body>
</html>