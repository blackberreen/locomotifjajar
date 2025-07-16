@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')

<div style="min-height: 100vh; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); padding: 2rem;">
    <div style="max-width: 900px; margin: 0 auto; padding: 2.5rem; background: white; border-radius: 1.5rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border: 1px solid #e0f2fe;">
        
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 2.25rem; font-weight: 700; color: #1e40af; margin-bottom: 0.75rem; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">
                Proses Pembayaran
            </h1>
            <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #3b82f6, #1d4ed8); margin: 0 auto; border-radius: 2px;"></div>
        </div>

        <!-- Instruction -->
        <div style="text-align: center; margin-bottom: 2rem; padding: 1.5rem; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-radius: 1rem; border-left: 4px solid #3b82f6;">
            <p style="font-size: 1.25rem; font-weight: 600; color: #1e40af; margin: 0;">
                Pembayaran hanya dapat dilakukan dengan metode Transfer ke
            </p>
        </div>

        <!-- Payment Info Cards -->
        <div style="display: flex; justify-content: space-between; gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Bank Info Card -->
            <div style="flex: 1; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); padding: 2rem; text-align: center; border-radius: 1rem; border: 2px solid #3b82f6; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease;">
                <div style="margin-bottom: 1rem;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                        <span style="color: white; font-weight: bold; font-size: 1.5rem;">BCA</span>
                    </div>
                </div>
                <p style="font-weight: 700; font-size: 1.25rem; color: #1e40af; margin-bottom: 0.5rem;">Bank BCA</p>
                <p style="font-weight: 800; font-size: 1.75rem; color: #dc2626; margin-bottom: 0.5rem; font-family: 'Courier New', monospace; letter-spacing: 1px;">7651430961</p>
                <p style="font-weight: 600; color: #64748b; font-size: 1.1rem;">A/N Ghieta Maureen</p>
            </div>

            <!-- Total Amount Card -->
            <div style="flex: 1; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 2rem; text-align: center; border-radius: 1rem; border: 2px solid #f59e0b; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                <div style="margin-bottom: 1rem;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
                        <span style="color: white; font-weight: bold; font-size: 1.5rem;">Rp</span>
                    </div>
                </div>
                <p style="font-weight: 700; font-size: 1.1rem; color: #92400e; margin-bottom: 0.75rem;">Total Belanjaan Anda</p>
                <p style="font-size: 2rem; font-weight: 800; color: #dc2626; font-family: 'Courier New', monospace;">Rp. {{ number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Payment Deadline -->
        <div style="text-align: center; margin-bottom: 2rem; padding: 1.5rem; background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%); border-radius: 1rem; border-left: 4px solid #dc2626;">
            <p style="font-weight: 700; font-size: 1.25rem; color: #dc2626; margin-bottom: 0.5rem;">
                Bayar sebelum tanggal 08 Juni 2026
            </p>
            <p style="font-weight: 500; font-size: 1rem; color: #7f1d1d; margin: 0;">
                Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.
            </p>
        </div>

        <!-- Warning Notice -->
        <div style="text-align: center; margin-bottom: 2rem; padding: 1.5rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); border-radius: 1rem; border-left: 4px solid #f59e0b;">
            <p style="font-weight: 700; color: #dc2626; font-size: 1.25rem; margin-bottom: 0.5rem;">
                PERHATIAN!!
            </p>
            <p style="font-weight: 600; color: #92400e; font-size: 1.1rem; margin: 0;">
                Semua informasi yang anda berikan bersifat rahasia.
            </p>
        </div>

        <!-- Payment Form -->
        <form action="{{ route('payment.store') }}" method="POST" style="margin-bottom: 2rem;">
            @csrf

            <div style="text-align: center; margin-bottom: 2rem;">
                <label for="nama_pemilik_rekening" style="display: block; font-weight: 700; margin-bottom: 1rem; font-size: 1.25rem; color: #1e40af;">
                    Nama Pemilik Rekening
                </label>
                <div style="position: relative; display: inline-block;">
                    <input 
                        type="text" 
                        id="nama_pemilik_rekening" 
                        name="nama_pemilik_rekening" 
                        placeholder="Masukkan nama pemilik rekening"
                        value="{{ old('nama_pemilik_rekening') }}"
                        required
                        style="padding: 1rem 1.5rem; border: 2px solid #3b82f6; border-radius: 9999px; width: 350px; font-size: 1.1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: all 0.2s ease; background: white;"
                        onFocus="this.style.borderColor='#1d4ed8'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)'"
                        onBlur="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1)'"
                    >
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" 
                    style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 1rem 2.5rem; border-radius: 0.75rem; font-weight: 700; font-size: 1.1rem; border: none; cursor: pointer; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); transition: all 0.2s ease; position: relative; overflow: hidden;"
                    onMouseOver="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1)'"
                    onMouseOut="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'"
                >
                    <span style="position: relative; z-index: 1;">📧 Kirim Informasi Pembayaran</span>
                </button>
            </div>

            @if($errors->any())
                <div style="margin-top: 1.5rem; text-align: center; padding: 1rem; background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%); border-radius: 0.75rem; border-left: 4px solid #dc2626;">
                    <p style="color: #dc2626; font-weight: 600; margin: 0;">
                        ❌ {{ $errors->first() }}
                    </p>
                </div>
            @endif
        </form>

        <!-- Footer Message -->
        <div style="text-align: center; padding: 1.5rem; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 1rem; border-left: 4px solid #16a34a;">
            <p style="font-weight: 700; color: #15803d; font-size: 1.2rem; margin: 0;">
                Terima kasih telah berbelanja di Locomotif Online Store
            </p>
        </div>

    </div>
</div>

@endsection