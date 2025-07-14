{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home • Locomotif Jajar')

@section('content')
<div class="home-container" style="display: flex; justify-content: center; align-items: center; padding: 60px 40px; gap: 40px; flex-wrap: wrap;">
  <!-- Kolom Kiri -->
  <div class="home-content" style="flex: 1; max-width: 600px; text-align: center;">
    <h1 style="font-size: 38px; font-weight: bold; line-height: 1.4; margin-bottom: 24px;">
      <span style="color: #167DD3;">Modifikasi</span> motor anda dengan<br>
      Aman dan Terpercaya di Bengkel<br>
      <span style="color: #167DD3;">Locomotif Jajar.</span>
    </h1>

    <a
      href="https://wa.me/628176820332"
      style="display: inline-block; width: 220px; height: 55px; background-color: #E2EAF4; border-radius: 8px; line-height: 55px; font-size: 18px; font-weight: 500; color: black; text-decoration: none; margin-bottom: 28px;"
      onmouseover="this.style.opacity='0.9'"
      onmouseout="this.style.opacity='1'"
    >
      Mulai mengobrol
    </a>

    <div class="stats-container" style="display: flex; justify-content: center; gap: 16px;">
      <div style="background-color: #E2EAF4; padding: 16px; border-radius: 8px; width: 240px; height: 100px; display: flex; align-items: center; justify-content: center;">
        <p style="margin: 0; font-size: 16px; font-weight: 500;">
          Aman, Cepat, dan<br>Terpercaya sejak 2005
        </p>
      </div>
      <div style="background-color: #E2EAF4; padding: 16px; border-radius: 8px; width: 240px; height: 100px; display: flex; align-items: center; justify-content: center;">
        <p style="margin: 0; font-size: 16px; font-weight: 500;">
          Sudah menangani<br>1000+ motor
        </p>
      </div>
    </div>
  </div>

  <!-- Kolom Kanan (Gambar) -->
  <div class="home-image-container" style="flex: 1; max-width: 500px; display: flex; justify-content: center;">
    <img
      src="{{ asset('img/coverhome.jpeg') }}"
      alt="Cover Home"
      style="width: 100%; max-width: 460px; height: auto; border-radius: 8px; object-fit: cover;"
    />
  </div>
</div>
@endsection
