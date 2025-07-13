<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Locomotif Jajar')</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- Vite Assets --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Heroicons --}}
  <script src="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/24/outline/index.js"></script>
</head>
<body style="background-color: white; color: #1f2937; font-family: 'Instrument Sans', sans-serif;">

  {{-- Navbar --}}
  <nav style="padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #789DBC;">
    <div style="font-size: 32px; font-weight: bold; margin-left: 1rem;">Locomotif</div>
    
    <div style="display: flex; align-items: center; gap: 2.5rem;">
      <ul style="display: flex; gap: 2.5rem; list-style: none; padding: 0; margin: 0;">
        <li><a href="{{ route('home') }}" style="font-size: 20px; text-decoration: none; color: inherit;">Beranda</a></li>
        <li><a href="{{ route('service') }}" style="font-size: 20px; text-decoration: none; color: inherit;">Layanan</a></li>
        <li><a href="{{ route('product') }}" style="font-size: 20px; text-decoration: none; color: inherit;">Produk</a></li>
        <li><a href="{{ route('about') }}" style="font-size: 20px; text-decoration: none; color: inherit;">Tentang kami</a></li>
      </ul>

      {{-- User Authentication Section --}}
      <div style="position: relative;">
        @auth
          {{-- User is logged in - Show user dropdown --}}
          <div style="position: relative; display: inline-block;" class="user-dropdown">
            <button style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; border-radius: 9999px; background: none; border: none; cursor: pointer; transition: background-color 0.2s;">
              <div style="width: 40px; height: 40px; background-color: #789DBC; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
              <svg style="width: 16px; height: 16px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            {{-- Dropdown Menu --}}
            <div style="position: absolute; right: 0; top: 100%; margin-top: 0.5rem; width: 192px; background: white; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); opacity: 0; visibility: hidden; z-index: 50; transition: opacity 0.2s, visibility 0.2s;" class="dropdown-menu">
              <div style="padding: 0.5rem 0;">
                <div style="padding: 0.5rem 1rem; border-bottom: 1px solid #f3f4f6;">
                  <p style="font-size: 14px; font-weight: 600; color: #1f2937; margin: 0;">{{ auth()->user()->name }}</p>
                  <p style="font-size: 12px; color: #6b7280; margin: 0;">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('user.profile') }}" style="display: block; padding: 0.5rem 1rem; font-size: 14px; color: #374151; text-decoration: none;">
                  <svg style="width: 16px; height: 16px; display: inline; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Profil
                </a>
                <a href="{{ route('user.orders') }}" style="display: block; padding: 0.5rem 1rem; font-size: 14px; color: #374151; text-decoration: none;">
                  <svg style="width: 16px; height: 16px; display: inline; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                  Pesanan Saya
                </a>
                <a href="{{ route('user.bookings') }}" style="display: block; padding: 0.5rem 1rem; font-size: 14px; color: #374151; text-decoration: none;">
                  <svg style="width: 16px; height: 16px; display: inline; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                  Reservasi Saya
                </a>
                <hr style="margin: 0.25rem 0;">
                <form method="POST" action="{{ route('user.logout') }}" style="display: block; margin: 0;">
                  @csrf
                  <button type="submit" style="width: 100%; text-align: left; padding: 0.5rem 1rem; font-size: 14px; color: #dc2626; background: none; border: none; cursor: pointer;">
                    <svg style="width: 16px; height: 16px; display: inline; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
          <div style="display: flex; align-items: center; gap: 1rem;">
            <a href="{{ route('user.login') }}" style="font-size: 16px; color: #789DBC; text-decoration: none; font-weight: 500;">
              Masuk
            </a>
            <a href="{{ route('user.register') }}" style="background-color: #789DBC; color: white; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background-color 0.2s;">
              Daftar
            </a>
          </div>
        @endauth
      </div>
    </div>
  </nav>

  {{-- Flash Messages --}}
  @if(session('success'))
    <div style="background-color: #dcfce7; border: 1px solid #22c55e; color: #15803d; padding: 0.75rem 1rem; margin: 1rem 1.5rem; border-radius: 4px;">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="background-color: #fef2f2; border: 1px solid #ef4444; color: #dc2626; padding: 0.75rem 1rem; margin: 1rem 1.5rem; border-radius: 4px;">
      {{ session('error') }}
    </div>
  @endif

  {{-- Konten halaman --}}
  <main style="max-width: 1200px; margin: 0 auto; padding: 2.5rem 0;">
    @yield('content')
  </main>

  {{-- JavaScript untuk dropdown --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userDropdown = document.querySelector('.user-dropdown');
      const dropdownMenu = document.querySelector('.dropdown-menu');
      
      if (userDropdown && dropdownMenu) {
        userDropdown.addEventListener('mouseenter', function() {
          dropdownMenu.style.opacity = '1';
          dropdownMenu.style.visibility = 'visible';
        });
        
        userDropdown.addEventListener('mouseleave', function() {
          dropdownMenu.style.opacity = '0';
          dropdownMenu.style.visibility = 'hidden';
        });
      }
      
      // Hover effects
      const buttons = document.querySelectorAll('button');
      buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
          this.style.backgroundColor = '#f3f4f6';
        });
        button.addEventListener('mouseleave', function() {
          this.style.backgroundColor = '';
        });
      });
      
      console.log('Locomotif App Loaded');
    });
  </script>

</body>
</html>