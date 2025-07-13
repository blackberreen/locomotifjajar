{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home • Locomotif Jajar')

@section('content')
  <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center; text-align: center;">
    <div style="width: 100%; max-width: 66.666667%; display: flex; flex-direction: column; align-items: center;">
      <h1 style="font-size: 45px; font-weight: bold; margin-bottom: 24px; line-height: 1.2;">
        <span style="color: #789DBC;">Modifikasi</span> motor anda dengan<br>
        Aman dan Terpercaya di Bengkel<br>
        <span style="color: #789DBC;">Locomotif Jajar.</span>
      </h1>

      <a
        href="https://wa.me/628176820332"
        style="width: 360px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-weight: 500; background-color: #E2EAF4; text-decoration: none; color: inherit; font-size: 25px; margin-bottom: 32px; transition: opacity 0.3s;"
        onmouseover="this.style.opacity='0.9'"
        onmouseout="this.style.opacity='1'"
      >
        Mulai mengobrol
      </a>

      <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 24px;">
        <div style="width: 289px; height: 181px; padding: 16px; border-radius: 8px; background-color: #E2EAF4; display: flex; align-items: center; justify-content: center;">
          <p style="font-weight: 600; font-size: 25px; text-align: center; margin: 0;">Aman, Cepat, dan Terpercaya sejak 2005</p>
        </div>
        <div style="width: 289px; height: 181px; padding: 16px; border-radius: 8px; background-color: #E2EAF4; display: flex; align-items: center; justify-content: center;">
          <p style="font-weight: 600; font-size: 25px; text-align: center; margin: 0;">Sudah menangani 1000+ motor</p>
        </div>
      </div>
    </div>

    <div style="width: 100%; max-width: 33.333333%; margin-top: 40px; display: flex; justify-content: center;">
      <img
        src="{{ asset('img/coverhome.jpeg') }}"
        alt="Cover Home"
        style="width: 525px; height: 548px; object-fit: cover; border-radius: 8px;"
      />
    </div>
  </div>

  @media (max-width: 1024px) {
    <style>
      div[style*="max-width: 66.666667%"] {
        max-width: 100% !important;
      }
      div[style*="max-width: 33.333333%"] {
        max-width: 100% !important;
        margin-top: 40px !important;
      }
    </style>
  }
@endsection