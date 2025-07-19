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
<body style="background-color: white; color: #1f2937; font-family: 'Instrument Sans', sans-serif; margin: 0; padding: 0;">

  {{-- Navbar --}}
  <nav style="
    padding: 1rem 1.5rem; 
    display: flex; 
    align-items: center; 
    justify-content: space-between; 
    border-bottom: 2px solid #789DBC;
    position: relative;
    flex-wrap: wrap;
  ">
    <div style="font-size: 32px; font-weight: bold; margin-left: 1rem;" class="logo">Locomotif</div>
    
    <!-- Hamburger Menu Button (Hidden on desktop) -->
    <button 
      id="mobile-menu-btn" 
      style="
        display: none;
        flex-direction: column;
        justify-content: space-around;
        width: 30px;
        height: 30px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
      "
      onclick="toggleMobileMenu()"
    >
      <div style="width: 100%; height: 3px; background-color: #1f2937; transition: 0.3s;"></div>
      <div style="width: 100%; height: 3px; background-color: #1f2937; transition: 0.3s;"></div>
      <div style="width: 100%; height: 3px; background-color: #1f2937; transition: 0.3s;"></div>
    </button>
    
    <div 
      id="nav-content"
      style="
        display: flex; 
        align-items: center; 
        gap: 2.5rem;
        flex-wrap: wrap;
      "
    >
      <ul 
        id="nav-menu"
        style="
          display: flex; 
          gap: 2.5rem; 
          list-style: none; 
          padding: 0; 
          margin: 0;
          flex-wrap: wrap;
        "
      >
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
          <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('user.login') }}" style="font-size: 16px; color: #789DBC; text-decoration: none; font-weight: 500;">
              Masuk
            </a>
            <a href="{{ route('user.register') }}" style="background-color: #789DBC; color: white; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 500; transition: background-color 0.2s; white-space: nowrap;">
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
  <main style="max-width: 1200px; margin: 0 auto; padding: 2.5rem 1rem;">
    @yield('content')
  </main>

  {{-- Responsive Styles --}}
  <style>
    /* Mobile Styles */
    @media (max-width: 768px) {
      nav {
        flex-wrap: wrap !important;
        padding: 1rem !important;
      }
      
      .logo {
        font-size: 24px !important;
        margin-left: 0 !important;
      }
      
      #mobile-menu-btn {
        display: flex !important;
      }
      
      #nav-content {
        display: none !important;
        width: 100% !important;
        order: 3 !important;
        margin-top: 1rem !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        background: white !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 8px !important;
        padding: 1rem !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
      }
      
      #nav-content.show {
        display: flex !important;
      }
      
      #nav-menu {
        flex-direction: column !important;
        gap: 1rem !important;
        width: 100% !important;
        margin-bottom: 1rem !important;
      }
      
      #nav-menu li a {
        font-size: 18px !important;
        padding: 0.5rem 0 !important;
        display: block !important;
      }
      
      main {
        padding: 1.5rem 1rem !important;
      }

      /* Fix dropdown positioning on mobile */
      .dropdown-menu {
        right: auto !important;
        left: 0 !important;
        width: 180px !important;
        margin-left: 0 !important;
      }

      /* Adjust user dropdown container on mobile */
      .user-dropdown {
        width: 100% !important;
      }

      /* Ensure dropdown doesn't go off-screen */
      @media (max-width: 480px) {
        .dropdown-menu {
          width: 160px !important;
        }
      }
    }

    /* Small mobile screens */
    @media (max-width: 320px) {
      .dropdown-menu {
        width: 140px !important;
        font-size: 12px !important;
      }
      
      .dropdown-menu a {
        font-size: 12px !important;
        padding: 0.4rem 0.8rem !important;
      }
      
      .dropdown-menu button {
        font-size: 12px !important;
        padding: 0.4rem 0.8rem !important;
      }
    }

    /* Tablet Styles */
    @media (max-width: 1024px) and (min-width: 769px) {
      nav {
        padding: 1rem !important;
      }
      
      .logo {
        font-size: 28px !important;
        margin-left: 0.5rem !important;
      }
      
      #nav-menu {
        gap: 1.5rem !important;
      }
      
      #nav-menu li a {
        font-size: 18px !important;
      }
    }

    /* Flash message responsive */
    @media (max-width: 768px) {
      div[style*="margin: 1rem 1.5rem"] {
        margin: 1rem !important;
        padding: 0.5rem 0.75rem !important;
        font-size: 14px !important;
      }
    }

    /* Hover effects for dropdown items */
    .dropdown-menu a:hover,
    .dropdown-menu button:hover {
      background-color: #f9fafb !important;
    }
  </style>

  {{-- JavaScript untuk dropdown dan mobile menu --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userDropdown = document.querySelector('.user-dropdown');
      const dropdownMenu = document.querySelector('.dropdown-menu');
      
      if (userDropdown && dropdownMenu) {
        // Desktop hover events
        if (window.innerWidth > 768) {
          userDropdown.addEventListener('mouseenter', function() {
            dropdownMenu.style.opacity = '1';
            dropdownMenu.style.visibility = 'visible';
          });
          
          userDropdown.addEventListener('mouseleave', function() {
            dropdownMenu.style.opacity = '0';
            dropdownMenu.style.visibility = 'hidden';
          });
        } else {
          // Mobile click events
          const dropdownButton = userDropdown.querySelector('button');
          dropdownButton.addEventListener('click', function(e) {
            e.stopPropagation();
            if (dropdownMenu.style.visibility === 'visible') {
              dropdownMenu.style.opacity = '0';
              dropdownMenu.style.visibility = 'hidden';
            } else {
              dropdownMenu.style.opacity = '1';
              dropdownMenu.style.visibility = 'visible';
            }
          });
        }
      }
      
      // Close dropdown when clicking outside (mobile)
      document.addEventListener('click', function(event) {
        if (dropdownMenu && !userDropdown.contains(event.target)) {
          dropdownMenu.style.opacity = '0';
          dropdownMenu.style.visibility = 'hidden';
        }
      });
      
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

    // Mobile Menu Toggle Function
    function toggleMobileMenu() {
      const navContent = document.getElementById('nav-content');
      const menuBtn = document.getElementById('mobile-menu-btn');
      
      if (navContent.classList.contains('show')) {
        navContent.classList.remove('show');
        // Reset hamburger icon
        menuBtn.children[0].style.transform = 'rotate(0)';
        menuBtn.children[1].style.opacity = '1';
        menuBtn.children[2].style.transform = 'rotate(0)';
      } else {
        navContent.classList.add('show');
        // Animate to X icon
        menuBtn.children[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
        menuBtn.children[1].style.opacity = '0';
        menuBtn.children[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
      }
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
      const navContent = document.getElementById('nav-content');
      const menuBtn = document.getElementById('mobile-menu-btn');
      const nav = document.querySelector('nav');
      
      if (!nav.contains(event.target) && navContent.classList.contains('show')) {
        navContent.classList.remove('show');
        menuBtn.children[0].style.transform = 'rotate(0)';
        menuBtn.children[1].style.opacity = '1';
        menuBtn.children[2].style.transform = 'rotate(0)';
      }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
      const dropdownMenu = document.querySelector('.dropdown-menu');
      if (dropdownMenu) {
        dropdownMenu.style.opacity = '0';
        dropdownMenu.style.visibility = 'hidden';
      }
    });
  </script>

</body>
</html>