@extends('layouts.app')

@section('title', 'Service • Locomotif Jajar')

@section('content')
<div style="display: flex; padding: 50px; gap: 40px; flex-wrap: wrap;">

    {{-- Kiri --}}
    <div style="flex: 1; min-width: 400px;">
        <h1 style="font-size: 44px; text-align: left; margin: 0; font-family: 'ui-sans-serif', 'system-ui', sans-serif; font-weight: 700;">
            Jasa yang <br><span style="color: #167DD3;">Kami Tawarkan</span>
        </h1>
        <p style="font-size: 25px; margin: 20px 0; text-align: left;">
            Kami menawarkan Jasa terpercaya untuk motor kesayangan anda.
        </p>

        <a href="{{ route('booking') }}">
            <button style="width: 390px; height: 80px; background-color: #E2EAF4; font-size: 24px; border: none; border-radius: 12px; font-weight: bold; cursor: pointer;">
                Reservasi Layanan
            </button>
        </a>

        <img 
            src="{{ asset('img/coverservice.jpeg') }}" 
            alt="Cover Service" 
            style="width: 515px; height: 324px; object-fit: cover; border-radius: 10px; margin-top: 30px;"
        />
    </div>

    {{-- Kanan --}}
    <div style="flex: 1; min-width: 400px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <div style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-family: 'ui-sans-serif', 'system-ui', sans-serif; font-weight: 700; text-align: center; border-radius: 12px;">
            UPGRADE <br> KAKI-KAKI <br> MOTOR
        </div>
        <div style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-weight: bold; text-align: center; border-radius: 12px;">
            BUBUT
        </div>
        <div style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-weight: bold; text-align: center; border-radius: 12px;">
            MODIFIKASI <br> MOTOR
        </div>
        <div style="width: 317px; height: 274px; background-color: #E2EAF4; display: flex; justify-content: center; align-items: center; font-size: 37px; font-weight: bold; text-align: center; border-radius: 12px;">
            REPARASI <br> MOTOR
        </div>
    </div>
</div>
@endsection