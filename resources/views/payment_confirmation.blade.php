@extends('layouts.app')

@section('title', 'payment_confirmation • Locomotif Jajar')

@section('content')
<div style="width: 800px; margin: 100px auto; padding: 30px; background-color: white; border-radius: 15px; border: 2px solid #E2EAF4; text-align: center;">
    <p style="font-size: 24px;">Pesanan anda akan kami proses, harap menunggu konfirmasi admin.</p>
    <p style="font-size: 20px;">Hubungi nomor <strong>08176820332</strong> jika anda tidak mendapatkan verifikasi melalui admin kami.</p>

    <a href="{{ route('home') }}">
        <button style="margin-top: 30px; padding: 15px 30px; font-size: 20px; background-color: #E2EAF4; border: none; border-radius: 10px;">
            Selesai
        </button>
    </a>
</div>


@endsection
