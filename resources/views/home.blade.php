{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home • Locomotif Jajar')

@section('content')
<div class="home-container" style="display: flex; justify-content: center; align-items: center; padding: 100px 80px; gap: 80px; flex-wrap: nowrap;">
  <!-- Kolom Kiri -->
  <div class="home-content" style="flex: 1; max-width: 750px; text-align: center;">
    <h1 style="font-size: 48px; font-weight: bold; line-height: 1.5; margin-bottom: 40px;">
      <span style="color: #167DD3;">Modifikasi</span> motor anda dengan<br>
      Aman dan Terpercaya di Bengkel<br>
      <span style="color: #167DD3;">Locomotif Jajar.</span>
    </h1>

    <a
      href="https://wa.me/628176820332"
      style="display: inline-block; width: 400px; height: 90px; background-color: #E2EAF4; border-radius: 12px; line-height: 90px; font-size: 26px; font-weight: 600; color: black; text-decoration: none; margin-bottom: 50px;"
      onmouseover="this.style.opacity='0.9'"
      onmouseout="this.style.opacity='1'"
    >
      Mulai mengobrol
    </a>

    <div class="stats-container" style="display: flex; justify-content: center; gap: 32px;">
      <div style="background-color: #E2EAF4; padding: 32px; border-radius: 16px; width: 340px; height: 180px; display: flex; align-items: center; justify-content: center;">
        <p style="margin: 0; font-size: 24px; font-weight: 600;">
          Aman, Cepat, dan<br>Terpercaya sejak 2005
        </p>
      </div>
      <div style="background-color: #E2EAF4; padding: 32px; border-radius: 16px; width: 340px; height: 180px; display: flex; align-items: center; justify-content: center;">
        <p style="margin: 0; font-size: 24px; font-weight: 600;">
          Sudah menangani<br>1000+ motor
        </p>
      </div>
    </div>
  </div>

  <!-- Kolom Kanan (Gambar) -->
  <div class="home-image-container" style="flex: 0 0 auto; display: flex; justify-content: center; align-items: center;">
    <img
      src="{{ asset('img/coverhome.jpeg') }}"
      alt="Cover Home"
      style="width: 425px; height: 648px; border-radius: 12px; object-fit: cover;"
    />
  </div>
</div>

<!-- Media Query Responsive -->
<style>
  @media (max-width: 1024px) {
    .home-container {
      flex-direction: column !important;
      flex-wrap: wrap !important;
      gap: 50px !important;
    }

    .home-image-container img {
      width: 100% !important;
      max-width: 425px !important;
      height: auto !important;
    }

    .home-content h1 {
      font-size: 36px !important;
    }

    .stats-container {
      flex-direction: column !important;
      gap: 20px !important;
    }
  }
</style>
@endsection
