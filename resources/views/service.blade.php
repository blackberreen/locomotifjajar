@extends('layouts.app')

@section('title', 'Service • Locomotif Jajar')

@section('content')
<div class="service-container" style="display: flex; padding: 50px; gap: 40px; flex-wrap: wrap;">

    {{-- Kiri --}}
    <div class="service-left" style="flex: 1; min-width: 400px;">
        <h1 class="service-title" style="font-size: 44px; text-align: left; margin: 0; font-family: 'ui-sans-serif', 'system-ui', sans-serif; font-weight: 700;">
            Jasa yang <br><span style="color: #167DD3;">Kami Tawarkan</span>
        </h1>
        <p class="service-subtitle" style="font-size: 25px; margin: 20px 0; text-align: left;">
            Kami menawarkan Jasa terpercaya untuk motor kesayangan anda.
        </p>

        <a href="{{ route('booking') }}">
            <button class="reservation-btn" style="width: 390px; height: 80px; background-color: #E2EAF4; font-size: 24px; border: none; border-radius: 12px; font-weight: bold; cursor: pointer;">
                Reservasi Layanan
            </button>
        </a>

        <img 
            src="{{ asset('img/coverservice.jpeg') }}" 
            alt="Cover Service" 
            class="service-image"
            style="width: 515px; height: 324px; object-fit: cover; border-radius: 10px; margin-top: 30px;"
        />
    </div>

    {{-- Kanan --}}
    <div class="service-right" style="flex: 1; min-width: 400px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <div class="service-card" style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-family: 'ui-sans-serif', 'system-ui', sans-serif; font-weight: 700; text-align: center; border-radius: 12px;">
            UPGRADE <br> KAKI-KAKI <br> MOTOR
        </div>
        <div class="service-card" style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-weight: bold; text-align: center; border-radius: 12px;">
            BUBUT
        </div>
        <div class="service-card" style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-weight: bold; text-align: center; border-radius: 12px;">
            MODIFIKASI <br> MOTOR
        </div>
        <div class="service-card" style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-weight: bold; text-align: center; border-radius: 12px;">
            REPARASI <br> MOTOR
        </div>
    </div>
</div>

<style>
/* Responsive Tablet */
@media (max-width: 1024px) {
    .service-container {
        flex-direction: column !important;
        padding: 40px 30px !important;
        gap: 30px !important;
    }
    
    .service-left,
    .service-right {
        min-width: auto !important;
    }
    
    .service-title {
        font-size: 38px !important;
        text-align: center !important;
    }
    
    .service-subtitle {
        font-size: 22px !important;
        text-align: center !important;
    }
    
    .reservation-btn {
        width: 100% !important;
        max-width: 390px !important;
        margin: 0 auto !important;
        display: block !important;
    }
    
    .service-image {
        width: 100% !important;
        max-width: 515px !important;
        height: auto !important;
        margin: 30px auto 0 auto !important;
        display: block !important;
    }
    
    .service-right {
        justify-content: center !important;
    }
    
    .service-card {
        width: 100% !important;
        max-width: 300px !important;
        height: 250px !important;
        font-size: 32px !important;
    }
}

/* Responsive Mobile */
@media (max-width: 768px) {
    .service-container {
        padding: 20px 15px !important;
        gap: 25px !important;
    }
    
    .service-title {
        font-size: 32px !important;
    }
    
    .service-subtitle {
        font-size: 18px !important;
    }
    
    .reservation-btn {
        width: 100% !important;
        height: 60px !important;
        font-size: 20px !important;
    }
    
    .service-right {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }
    
    .service-card {
        width: 100% !important;
        height: 200px !important;
        font-size: 26px !important;
        margin: 0 auto !important;
    }
}

/* Very Small Mobile */
@media (max-width: 480px) {
    .service-title {
        font-size: 28px !important;
    }
    
    .service-subtitle {
        font-size: 16px !important;
    }
    
    .reservation-btn {
        height: 50px !important;
        font-size: 18px !important;
    }
    
    .service-card {
        height: 180px !important;
        font-size: 22px !important;
    }
}
</style>
@endsection