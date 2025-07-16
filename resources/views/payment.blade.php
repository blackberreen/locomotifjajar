@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')

<div style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem;">
    <div style="max-width: 800px; margin: 0 auto; padding: 2.5rem; background: white; border-radius: 1.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
        
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                <svg width="40" height="40" fill="white" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <h1 style="font-size: 2rem; font-weight: bold; color: #1f2937; margin-bottom: 0.5rem;">
                Proses Pembayaran
            </h1>
            <p style="color: #6b7280; font-size: 1.125rem; font-weight: 500;">
                Pembayaran hanya dapat dilakukan dengan metode Transfer
            </p>
        </div>

        <!-- Payment Cards -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Bank Info Card -->
            <div style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 1.5rem; border-radius: 1rem; text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -20px; left: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
                <div style="position: relative; z-index: 1;">
                    <p style="font-weight: bold; font-size: 1.25rem; margin-bottom: 0.5rem;">Bank BCA</p>
                    <p style="font-weight: bold; font-size: 1.5rem; margin-bottom: 0.5rem; letter-spacing: 2px;">7651430961</p>
                    <p style="font-weight: 500; opacity: 0.9;">A/N Ghieta Maureen</p>
                </div>
            </div>

            <!-- Total Amount Card -->
            <div style="background: linear-gradient(135deg, #dc2626, #ef4444); color: white; padding: 1.5rem; border-radius: 1rem; text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -20px; left: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
                <div style="position: relative; z-index: 1;">
                    <p style="font-weight: bold; margin-bottom: 0.5rem;">Total Belanja</p>
                    <p style="font-size: 1.75rem; font-weight: bold; margin-bottom: 0.5rem;">Rp. {{ number_format($total, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Deadline -->
        <div style="background: linear-gradient(135deg, #f59e0b, #fbbf24); color: white; padding: 1.5rem; border-radius: 1rem; text-align: center; margin-bottom: 2rem;">
            <p style="font-weight: bold; font-size: 1.125rem; margin-bottom: 0.5rem;">⏰ Bayar sebelum tanggal 08 Juni 2026</p>
            <p style="font-weight: 500; font-size: 0.9rem; opacity: 0.9;">
                Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.
            </p>
        </div>

        <!-- Important Notice -->
        <div style="background: linear-gradient(135deg, #fee2e2, #fecaca); border: 1px solid #fca5a5; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 0.5rem;">
                <svg width="24" height="24" fill="#dc2626" viewBox="0 0 24 24" style="margin-right: 0.5rem;">
                    <path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99zM11 16h2v2h-2v-2zm0-6h2v4h-2v-4z"/>
                </svg>
                <p style="font-weight: bold; color: #dc2626; font-size: 1.125rem;">PERHATIAN!!</p>
            </div>
            <p style="text-align: center; color: #7f1d1d; font-weight: 500;">
                Semua informasi yang anda berikan bersifat rahasia dan akan diproses dengan aman.
            </p>
        </div>

        <!-- Form Section -->
        <form action="{{ route('payment.store') }}" method="POST" style="background: #f8fafc; padding: 2rem; border-radius: 1rem; border: 1px solid #e2e8f0;">
            @csrf

            <div style="margin-bottom: 2rem;">
                <label for="nama_pemilik_rekening" style="display: block; font-weight: bold; margin-bottom: 0.75rem; color: #374151; font-size: 1.125rem;">
                    Nama Pemilik Rekening
                </label>
                <div style="position: relative;">
                    <input 
                        type="text" 
                        id="nama_pemilik_rekening" 
                        name="nama_pemilik_rekening" 
                        placeholder="Masukkan nama pemilik rekening"
                        value="{{ old('nama_pemilik_rekening') }}"
                        required
                        style="width: 100%; padding: 1rem 1.5rem; border: 2px solid #e5e7eb; border-radius: 0.75rem; font-size: 1rem; transition: all 0.3s ease; background: white;"
                        onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                    >
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" 
                    style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 1rem 2.5rem; border-radius: 0.75rem; font-weight: bold; font-size: 1.125rem; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(59, 130, 246, 0.6)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)'"
                >
                    Kirim Informasi Pembayaran
                </button>
            </div>

            @if($errors->any())
                <div style="margin-top: 1.5rem; padding: 1rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.5rem; text-align: center;">
                    <p style="color: #dc2626; font-weight: 500;">{{ $errors->first() }}</p>
                </div>
            @endif
        </form>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 2rem; padding: 1.5rem; background: linear-gradient(135deg, #f3f4f6, #e5e7eb); border-radius: 1rem;">
            <p style="font-weight: bold; color: #374151; font-size: 1.125rem;">
                Terima kasih telah berbelanja di Locomotif Online Store
            </p>
        </div>

    </div>
</div>

@endsection