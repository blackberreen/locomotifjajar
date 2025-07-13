@extends('layouts.app')

@section('title', 'about • Locomotif Jajar')

@section('content')
<div style="display: flex; flex-direction: column; align-items: center; padding: 48px 24px;">
    <!-- OUR STORY Title -->
    <h1 style="font-size: 40px; font-weight: bold; margin-bottom: 24px; text-align: center;">
        <span style="color: #167DD3;">OUR</span> STORY
    </h1>

    <!-- Description -->
    <p style="font-size: 24px; text-align: center; max-width: 896px; line-height: 1.625; margin-bottom: 40px;">
        Pendiri bengkel kami, yaitu Bapak Muhamad Deni, mendirikan bengkel ini dengan ide dari guru las nya dahulu.
        Banyaknya pasang surut yang dialami beliau, tidak menggoyahkan keinginan beliau untuk terus memajukan bengkel yang berdiri sejak 1998 ini.
        Berkat kegigihan beliau, kepercayaan pelanggan, dan kehendak Tuhan, Bengkel Locomotif Jajar ini sudah berdiri selama 20 Tahun.
    </p>

    <img 
        src="{{ asset('img/coveraboutus.jpeg') }}" 
        alt="Sejarah Bengkel Locomotif Jajar" 
        style="width: 891px; height: 383px; object-fit: cover; border-radius: 6px;"
    />
</div>

<!-- Media Query untuk Responsif -->
<style>
@media (max-width: 1024px) {
    .about-container {
        padding: 32px 16px !important;
    }
    
    .about-title {
        font-size: 32px !important;
    }
    
    .about-description {
        font-size: 20px !important;
        max-width: 100% !important;
    }
    
    .about-image {
        width: 100% !important;
        max-width: 600px !important;
        height: auto !important;
    }
}

@media (max-width: 768px) {
    .about-container {
        padding: 24px 12px !important;
    }
    
    .about-title {
        font-size: 28px !important;
        margin-bottom: 16px !important;
    }
    
    .about-description {
        font-size: 18px !important;
        margin-bottom: 24px !important;
    }
    
    .about-image {
        max-width: 100% !important;
        border-radius: 4px !important;
    }
}

@media (max-width: 480px) {
    .about-container {
        padding: 20px 8px !important;
    }
    
    .about-title {
        font-size: 24px !important;
    }
    
    .about-description {
        font-size: 16px !important;
        line-height: 1.5 !important;
    }
}
</style>

<!-- Script untuk menambahkan class responsif -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('[style*="display: flex"][style*="flex-direction: column"]');
    const title = document.querySelector('h1[style*="font-size: 40px"]');
    const description = document.querySelector('p[style*="font-size: 24px"]');
    const image = document.querySelector('img[alt="Sejarah Bengkel Locomotif Jajar"]');
    
    if (container) container.classList.add('about-container');
    if (title) title.classList.add('about-title');
    if (description) description.classList.add('about-description');
    if (image) image.classList.add('about-image');
});
</script>
@endsection