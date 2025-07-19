@extends('layouts.app')

@section('title', 'payment_confirmation • Locomotif Jajar')

@section('content')
<div style="
    width: 90%; 
    max-width: 800px; 
    margin: 50px auto; 
    padding: 20px; 
    background-color: white; 
    border-radius: 15px; 
    border: 2px solid #E2EAF4; 
    text-align: center;
    box-sizing: border-box;
">
    <p style="
        font-size: clamp(18px, 3vw, 24px); 
        line-height: 1.4; 
        margin-bottom: 20px;
        color: #333;
    ">
        Pesanan anda akan kami proses, harap menunggu konfirmasi admin.
    </p>
    
    <p style="
        font-size: clamp(16px, 2.5vw, 20px); 
        line-height: 1.4; 
        margin-bottom: 30px;
        color: #555;
    ">
        Hubungi nomor <strong style="color: #007bff;">08176820332</strong> jika anda tidak mendapatkan verifikasi melalui admin kami.
    </p>

    <a href="{{ route('home') }}">
        <button style="
            margin-top: 10px; 
            padding: 15px 30px; 
            font-size: clamp(16px, 2.5vw, 20px); 
            background-color: #E2EAF4; 
            border: none; 
            border-radius: 10px; 
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            max-width: 200px;
            box-sizing: border-box;
        " 
        onmouseover="this.style.backgroundColor='#d1dce8'" 
        onmouseout="this.style.backgroundColor='#E2EAF4'">
            Selesai
        </button>
    </a>
</div>

<style>
    /* Media queries untuk responsivitas tambahan */
    @media (max-width: 768px) {
        body {
            margin: 0;
            padding: 10px;
        }
    }
    
    @media (max-width: 480px) {
        div[style*="margin: 50px auto"] {
            margin: 20px auto !important;
            padding: 15px !important;
        }
    }
</style>

@endsection