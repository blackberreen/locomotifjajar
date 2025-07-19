{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home • Locomotif Jajar')

@section('content')
<div class="home-container" style="display: flex; justify-content: center; align-items: center; padding: 100px 20px; gap: 80px; flex-wrap: wrap; min-height: calc(100vh - 200px);">
  <!-- Kolom Kiri -->
  <div class="home-content" style="flex: 1; min-width: 300px; max-width: 750px; text-align: center; order: 1;">
    <h1 class="home-title" style="font-size: clamp(28px, 5vw, 48px); font-weight: bold; line-height: 1.4; margin-bottom: 40px;">
      <span style="color: #167DD3;">Modifikasi</span> motor anda dengan<br>
      Aman dan Terpercaya di Bengkel<br>
      <span style="color: #167DD3;">Locomotif Jajar.</span>
    </h1>

    <a
      href="https://wa.me/628176820332"
      class="cta-button"
      style="display: inline-block; width: 100%; max-width: 400px; height: 70px; background-color: #E2EAF4; border-radius: 12px; line-height: 70px; font-size: clamp(18px, 3vw, 26px); font-weight: 600; color: black; text-decoration: none; margin-bottom: 50px; transition: all 0.3s ease; box-sizing: border-box; padding: 0 20px;"
      onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-2px)'"
      onmouseout="this.style.opacity='1'; this.style.transform='translateY(0px)'"
    >
      Mulai mengobrol
    </a>

    <div class="stats-container" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
      <div class="stats-card" style="background-color: #E2EAF4; padding: 24px; border-radius: 16px; width: 100%; max-width: 300px; min-height: 140px; display: flex; align-items: center; justify-content: center; box-sizing: border-box;">
        <p style="margin: 0; font-size: clamp(18px, 2.5vw, 24px); font-weight: 600; text-align: center;">
          Aman, Cepat, dan<br>Terpercaya sejak 2005
        </p>
      </div>
      <div class="stats-card" style="background-color: #E2EAF4; padding: 24px; border-radius: 16px; width: 100%; max-width: 300px; min-height: 140px; display: flex; align-items: center; justify-content: center; box-sizing: border-box;">
        <p style="margin: 0; font-size: clamp(18px, 2.5vw, 24px); font-weight: 600; text-align: center;">
          Sudah menangani<br>1000+ motor
        </p>
      </div>
    </div>
  </div>

  <!-- Kolom Kanan (Gambar) -->
  <div class="home-image-container" style="flex: 0 0 auto; display: flex; justify-content: center; align-items: center; order: 2;">
    <img
      src="{{ asset('img/coverhome.jpeg') }}"
      alt="Cover Home"
      class="home-image"
      style="width: 100%; max-width: 425px; height: auto; max-height: 648px; border-radius: 12px; object-fit: cover;"
    />
  </div>
</div>

<!-- Media Query Responsive -->
<style>
  /* Desktop Large */
  @media (min-width: 1200px) {
    .home-container {
      padding: 100px 80px !important;
    }
  }

  /* Tablet dan Desktop Kecil */
  @media (max-width: 1024px) {
    .home-container {
      flex-direction: column !important;
      gap: 50px !important;
      padding: 60px 40px !important;
    }

    .home-content {
      order: 1 !important;
    }

    .home-image-container {
      order: 2 !important;
    }

    .stats-container {
      flex-direction: row !important;
      justify-content: center !important;
      gap: 20px !important;
    }

    .stats-card {
      flex: 1 !important;
      min-width: 250px !important;
      max-width: 300px !important;
    }
  }

  /* Mobile */
  @media (max-width: 768px) {
    .home-container {
      padding: 40px 20px !important;
      gap: 40px !important;
    }

    .home-title {
      margin-bottom: 30px !important;
    }

    .cta-button {
      height: 60px !important;
      line-height: 60px !important;
      margin-bottom: 40px !important;
    }

    .stats-container {
      flex-direction: column !important;
      gap: 15px !important;
    }

    .stats-card {
      max-width: 100% !important;
      min-width: auto !important;
    }

    .home-image {
      max-height: 400px !important;
    }
  }

  /* Mobile Kecil */
  @media (max-width: 480px) {
    .home-container {
      padding: 30px 15px !important;
    }

    .home-title {
      line-height: 1.3 !important;
    }

    .cta-button {
      height: 50px !important;
      line-height: 50px !important;
    }

    .stats-card {
      padding: 20px !important;
      min-height: 120px !important;
    }

    .home-image {
      max-height: 300px !important;
    }
  }

  /* Touch device optimizations */
  @media (hover: none) and (pointer: coarse) {
    .cta-button {
      touch-action: manipulation;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
    }

    .cta-button:active {
      transform: scale(0.98);
      opacity: 0.9;
    }
  }

  /* High DPI screens */
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .home-image {
      image-rendering: -webkit-optimize-contrast;
      image-rendering: crisp-edges;
    }
  }
</style>
@endsection