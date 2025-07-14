{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home • Locomotif Jajar')

@section('content')
<div class="home-container" style="display: flex; align-items: center; justify-content: space-between; padding: 40px 60px; min-height: 70vh; max-width: 1440px; margin: auto;">
  <!-- Konten Kiri -->
  <div class="home-content" style="flex: 1; max-width: 600px;">
    <h1 style="font-size: 45px; font-weight: bold; margin-bottom: 24px; line-height: 1.2; text-align: left;">
      <span style="color: #789DBC;">Modifikasi</span> motor anda dengan<br>
      Aman dan Terpercaya di Bengkel<br>
      <span style="color: #789DBC;">Locomotif Jajar.</span>
    </h1>

    <a
      href="https://wa.me/628176820332"
      class="whatsapp-button"
      style="width: 360px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-weight: 500; background-color: #E2EAF4; text-decoration: none; color: inherit; font-size: 25px; margin-bottom: 32px; transition: opacity 0.3s; cursor: pointer;"
      onmouseover="this.style.opacity='0.9'"
      onmouseout="this.style.opacity='1'"
    >
      Mulai mengobrol
    </a>

    <!-- Dua kotak info berdampingan -->
    <div class="stats-container" style="display: flex; flex-wrap: nowrap; gap: 24px;">
      <div class="stats-box" style="flex: 1; height: 160px; padding: 16px; border-radius: 8px; background-color: #E2EAF4; display: flex; align-items: center; justify-content: center;">
        <p style="font-weight: 600; font-size: 22px; text-align: center; margin: 0;">
          Aman, Cepat, dan Terpercaya sejak 2005
        </p>
      </div>
      <div class="stats-box" style="flex: 1; height: 160px; padding: 16px; border-radius: 8px; background-color: #E2EAF4; display: flex; align-items: center; justify-content: center;">
        <p style="font-weight: 600; font-size: 22px; text-align: center; margin: 0;">
          Sudah menangani 1000+ motor
        </p>
      </div>
    </div>
  </div>

  <!-- Gambar Kanan -->
  <div class="home-image-container" style="flex-shrink: 0; margin-left: 40px;">
    <img
      src="{{ asset('img/coverhome.jpeg') }}"
      alt="Cover Home"
      class="home-image"
      style="width: 480px; height: auto; object-fit: cover; border-radius: 8px;"
    />
  </div>
</div>

<!-- Media Query -->
<style>
@media (max-width: 1024px) {
  .home-container {
    flex-direction: column;
    align-items: center;
    padding: 20px;
    text-align: center;
  }

  .home-content {
    margin-right: 0;
    margin-bottom: 32px;
    max-width: 100%;
  }

  .home-content h1 {
    text-align: center;
    font-size: 36px;
  }

  .whatsapp-button {
    margin: 0 auto 24px auto;
    width: 280px !important;
    height: 60px !important;
    font-size: 20px !important;
  }

  .stats-container {
    flex-direction: column !important;
    gap: 16px;
  }

  .stats-box {
    height: 140px;
  }

  .home-image-container {
    margin-left: 0;
  }

  .home-image {
    width: 100%;
    max-width: 400px;
  }
}

@media (max-width: 600px) {
  .home-content h1 {
    font-size: 28px;
  }

  .whatsapp-button {
    width: 240px;
    height: 55px;
    font-size: 18px;
  }

  .stats-box {
    height: 120px;
  }

  .stats-box p {
    font-size: 16px;
  }
}
</style>
@endsection
