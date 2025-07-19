@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')

<div style="min-height: 100vh; background-color: #f9fafb; padding: 1rem;">
    <div style="max-width: 900px; margin: 0 auto; padding: 1.5rem; background: white; border-radius: 1rem; border: 1px solid #dbeafe; box-sizing: border-box;">
        
        <h1 style="font-size: clamp(24px, 4vw, 30px); font-weight: bold; text-align: center; margin-bottom: 1.5rem; line-height: 1.3;">
            Proses Pembayaran
        </h1>

        <p style="text-align: center; font-size: clamp(16px, 3vw, 18px); font-weight: 500; margin-bottom: 1.5rem;">
            Pembayaran hanya dapat dilakukan dengan metode Transfer ke
        </p>

        <div class="payment-info" style="display: flex; justify-content: space-between; gap: 1rem; margin-top: 1.5rem; flex-wrap: wrap;">
            <div class="bank-info" style="flex: 1; min-width: 250px; border: 2px solid #000; padding: 1.5rem 1rem; text-align: center; border-radius: 0.5rem; box-sizing: border-box;">
                <p style="font-weight: bold; font-size: clamp(16px, 3vw, 18px); margin-bottom: 0.5rem;">Bank BCA</p>
                <p style="font-weight: bold; font-size: clamp(18px, 4vw, 20px); margin-bottom: 0.5rem; color: #1d4ed8;">7651430961</p>
                <p style="font-weight: 500; font-size: clamp(14px, 2.5vw, 16px);">A/N Ghieta Maureen</p>
            </div>

            <div class="total-info" style="flex: 1; min-width: 250px; border: 2px solid #000; padding: 1.5rem 1rem; text-align: center; border-radius: 0.5rem; box-sizing: border-box;">
                <p style="font-weight: bold; font-size: clamp(14px, 2.5vw, 16px); margin-bottom: 1rem;">Dengan Total Belanjaan anda, yaitu:</p>
                <p style="font-size: clamp(20px, 5vw, 24px); font-weight: bold; color: #dc2626;">Rp. {{ number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 1.5rem; padding: 1rem; background-color: #fef3c7; border-radius: 0.5rem;">
            <p style="font-weight: bold; font-size: clamp(16px, 3vw, 18px); margin-bottom: 0.5rem; color: #92400e;">Bayar sebelum tanggal 08 Juni 2026</p>
            <p style="font-weight: 500; font-size: clamp(12px, 2.5vw, 14px); color: #d97706;">
                Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.
            </p>
        </div>

        <div style="text-align: center; margin-top: 1.5rem; padding: 1rem; background-color: #fef2f2; border-radius: 0.5rem;">
            <p style="font-weight: bold; color: #dc2626; font-size: clamp(16px, 3vw, 18px); margin-bottom: 0.5rem;">PERHATIAN!!</p>
            <p style="font-weight: 500; color: #991b1b; font-size: clamp(14px, 2.5vw, 16px);">
                Semua informasi yang anda berikan bersifat rahasia.
            </p>
        </div>

        <form action="{{ route('payment.store') }}" method="POST" style="margin-top: 2rem;">
            @csrf

            <div style="text-align: center; margin-bottom: 1.5rem;">
                <label for="nama_pemilik_rekening" style="display: block; font-weight: bold; margin-bottom: 0.75rem; font-size: clamp(16px, 3vw, 18px);">
                    Nama Pemilik rekening
                </label>
                <div style="display: flex; justify-content: center;">
                    <input 
                        type="text" 
                        id="nama_pemilik_rekening" 
                        name="nama_pemilik_rekening" 
                        placeholder="Masukkan nama pemilik rekening"
                        value="{{ old('nama_pemilik_rekening') }}"
                        required
                        style="padding: 0.75rem 1rem; border: 2px solid #60a5fa; border-radius: 50px; width: 100%; max-width: 350px; font-size: clamp(14px, 2.5vw, 16px); box-sizing: border-box; outline: none;"
                    >
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" 
                    class="submit-payment-btn"
                    style="background-color: #2563eb; color: white; padding: 0.875rem 2rem; border-radius: 0.5rem; font-weight: bold; font-size: clamp(14px, 3vw, 16px); border: none; cursor: pointer; min-width: 200px; transition: all 0.2s ease; touch-action: manipulation;">
                    Kirim Informasi Pembayaran
                </button>
            </div>

            @if($errors->any())
                <div style="margin-top: 1rem; text-align: center; color: #dc2626; background-color: #fef2f2; padding: 1rem; border-radius: 0.5rem; font-size: clamp(14px, 2.5vw, 16px);">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>

        <p style="text-align: center; margin-top: 2rem; font-weight: bold; font-size: clamp(14px, 3vw, 16px); color: #374151;">
            Terima kasih telah berbelanja di Locomotif Online Store.
        </p>

    </div>
</div>

<style>
    /* Input focus state */
    input:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }

    /* Button hover and active states */
    .submit-payment-btn:hover {
        background-color: #1d4ed8;
        transform: translateY(-1px);
    }

    .submit-payment-btn:active {
        transform: translateY(0px);
        opacity: 0.9;
    }

    /* Mobile responsive styles */
    @media (max-width: 768px) {
        .payment-info {
            flex-direction: column !important;
            gap: 1rem !important;
        }

        .bank-info, .total-info {
            min-width: auto !important;
        }

        input[name="nama_pemilik_rekening"] {
            border-radius: 8px !important;
            padding: 1rem !important;
        }
    }

    @media (max-width: 480px) {
        .payment-info > div {
            padding: 1rem 0.75rem !important;
        }

        .submit-payment-btn {
            width: 100% !important;
            max-width: 100% !important;
            padding: 1rem !important;
        }

        input[name="nama_pemilik_rekening"] {
            font-size: 16px !important; /* Prevents zoom on iOS */
        }
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {
        .submit-payment-btn {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
        }

        input {
            -webkit-appearance: none;
        }
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .bank-info, .total-info {
            border-width: 3px !important;
        }
    }
</style>

@endsection