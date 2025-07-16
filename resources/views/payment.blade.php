@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')

<div style="min-height: 100vh; background-color: #f9fafb; padding: 2rem;">
    <div style="max-width: 900px; margin: 0 auto; padding: 2rem; background: white; border-radius: 1rem; border: 1px solid #dbeafe;">
        
        <h1 style="font-size: 1.875rem; font-weight: bold; text-align: center; margin-bottom: 1.5rem;">
            Proses Pembayaran
        </h1>

        <p style="text-align: center; font-size: 1.125rem; font-weight: 500;">
            Pembayaran hanya dapat dilakukan dengan metode Transfer ke
        </p>

        <div style="display: flex; justify-content: space-between; gap: 1rem; margin-top: 1.5rem;">
            <div style="flex: 1; border: 1px solid #000; padding: 1rem; text-align: center; border-radius: 0.25rem;">
                <p style="font-weight: bold; font-size: 1.125rem;">Bank BCA</p>
                <p style="font-weight: bold; font-size: 1.25rem;">7651430961</p>
                <p style="font-weight: 500;">A/N Ghieta Maureen</p>
            </div>

            <div style="flex: 1; border: 1px solid #000; padding: 1rem; text-align: center; border-radius: 0.25rem;">
                <p style="font-weight: bold;">Dengan Total Belanjaan anda, yaitu:</p>
                <p style="font-size: 1.5rem; font-weight: bold;">Rp. {{ number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="font-weight: bold;">Bayar sebelum tanggal 08 Juni 2026</p>
            <p style="font-weight: 500; font-size: 0.9rem;">
                Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.
            </p>
        </div>

        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="font-weight: bold; color: #dc2626;">PERHATIAN!!</p>
            <p style="font-weight: 500;">
                Semua informasi yang anda berikan bersifat rahasia.
            </p>
        </div>

        <form action="{{ route('payment.store') }}" method="POST" style="margin-top: 2rem; text-align: center;">
            @csrf

            <div style="margin-bottom: 1.5rem;">
                <label for="nama_pemilik_rekening" style="display: block; font-weight: bold; margin-bottom: 0.5rem;">
                    Nama Pemilik rekening
                </label>
                <input 
                    type="text" 
                    id="nama_pemilik_rekening" 
                    name="nama_pemilik_rekening" 
                    placeholder="Masukkan nama pemilik rekening"
                    value="{{ old('nama_pemilik_rekening') }}"
                    required
                    style="padding: 0.75rem 1rem; border: 1px solid #60a5fa; border-radius: 9999px; width: 300px; font-size: 1rem;"
                >
            </div>

            <button type="submit" 
                style="background-color: #2563eb; color: white; padding: 0.75rem 2rem; border-radius: 0.5rem; font-weight: bold; font-size: 1rem; border: none; cursor: pointer;">
                Kirim Informasi Pembayaran
            </button>

            @if($errors->any())
                <div style="margin-top: 1rem; color: #dc2626;">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>

        <p style="text-align: center; margin-top: 2rem; font-weight: bold;">
            Terima kasih telah berbelanja di Locomotif Online Store.
        </p>

    </div>
</div>

@endsection
