{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home • Locomotif Jajar')

@section('content')
<div style="display: flex; align-items: center; justify-content: space-between; padding: 40px 80px; min-height: 70vh;">
  <!-- Konten Kiri -->
  <div style="flex: 1; max-width: 600px; margin-right: 40px;">
    <h1 style="font-size: 45px; font-weight: bold; margin-bottom: 24px; line-height: 1.2; text-align: left;">
      <span style="color: #789DBC;">Modifikasi</span> motor anda dengan<br>
      Aman dan Terpercaya di Bengkel<br>
      <span style="color: #789DBC;">Locomotif Jajar.</span>
    </h1>

    <a
      href="https://wa.me/628176820332"
      style="width: 360px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-weight: 500; background-color: #E2EAF4; text-decoration: none; color: inherit; font-size: 25px; margin-bottom: 32px; transition: opacity 0.3s; cursor: pointer;"
      onmouseover="this.style.opacity='0.9'"
      onmouseout="this.style.opacity='1'"
    >
      Mulai mengobrol
    </a>

    <div style="display: flex; gap: 24px;">
      <div style="flex: 1; min-width: 280px; height: 181px; padding: 16px; border-radius: 8px; background-color: #E2EAF4; display: flex; align-items: center; justify-content: center;">
        <p style="font-weight: 600; font-size: 25px; text-align: center; margin: 0;">
          Aman, Cepat, dan Terpercaya sejak 2005
        </p>
      </div>
      <div style="flex: 1; min-width: 280px; height: 181px; padding: 16px; border-radius: 8px; background-color: #E2EAF4; display: flex; align-items: center; justify-content: center;">
        <p style="font-weight: 600; font-size: 25px; text-align: center; margin: 0;">
          Sudah menangani 1000+ motor
        </p>
      </div>
    </div>
  </div>

  <!-- Foto Kanan -->
  <div style="flex: 0 0 auto;">
    <img
      src="{{ asset('img/coverhome.jpeg') }}"
      alt="Cover Home"
      style="width: 525px; height: 548px; object-fit: cover; border-radius: 8px;"
    />
  </div>
</div>

<!-- Media Query untuk Responsif -->
<style>
@media (max-width: 1024px) {
  .home-container {
    flex-direction: column !important;
    padding: 20px !important;
    text-align: center !important;
  }
  
  .home-content {
    margin-right: 0 !important;
    margin-bottom: 40px !important;
    max-width: 100% !important;
  }
  
  .home-content h1 {
    text-align: center !important;
  }
  
  .home-image {
    width: 100% !important;
    max-width: 400px !important;
    height: auto !important;
  }
}

@media (max-width: 768px) {
  .home-container {
    padding: 20px !important;
  }
  
  .home-content h1 {
    font-size: 32px !important;
  }
  
  .whatsapp-button {
    width: 280px !important;
    height: 60px !important;
    font-size: 20px !important;
  }
  
  .stats-box {
    height: 150px !important;
    min-width: 220px !important;
  }
  
  .stats-box p {
    font-size: 18px !important;
  }
}

@media (max-width: 600px) {
  .stats-container {
    gap: 12px !important;
  }
  
  .stats-box {
    min-width: 200px !important;
  }
  
  .stats-box p {
    font-size: 16px !important;
  }
}
</style>

<!-- Script untuk menambahkan class responsif -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const container = document.querySelector('[style*="display: flex"][style*="justify-content: space-between"]');
  const content = document.querySelector('[style*="flex: 1"]');
  const image = document.querySelector('img[alt="Cover Home"]');
  const whatsappBtn = document.querySelector('a[href*="wa.me"]');
  const statsContainer = document.querySelector('[style*="gap: 24px"]');
  const statsBoxes = document.querySelectorAll('[style*="flex: 1"]');
  
  if (container) container.classList.add('home-container');
  if (content) content.classList.add('home-content');
  if (image) image.classList.add('home-image');
  if (whatsappBtn) whatsappBtn.classList.add('whatsapp-button');
  if (statsContainer) statsContainer.classList.add('stats-container');
  if (statsBoxes) statsBoxes.forEach(box => box.classList.add('stats-box'));
});
</script>
@endsection