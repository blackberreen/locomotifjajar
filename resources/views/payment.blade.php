@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')

<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Proses Pembayaran</h1>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <p class="text-lg text-gray-700 mb-4">
                Pembayaran hanya dapat dilakukan dengan metode Transfer ke
            </p>

            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <div class="flex items-center">
                    <div class="bg-blue-600 text-white px-3 py-1 rounded mr-4">
                        <i class="fas fa-university"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Bank BCA</h3>
                        <p class="text-xl font-bold">7651430961</p>
                        <p class="text-gray-600">A/N Ghieta Maureen</p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 p-4 rounded-lg mb-6">
                <p class="text-lg font-semibold mb-2">Dengan Total Belanjaan anda, yaitu:</p>
                <div class="text-2xl font-bold text-green-600">
                    Rp. {{ number_format($total, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-4">
                <p class="text-orange-700">
                    <i class="fas fa-clock mr-2"></i>
                    Pembayaran dilakukan maksimal 1 hari setelah proses pembelian
                </p>
            </div>

            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                <p class="text-red-700">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.
                </p>
            </div>

            <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
                <h3 class="text-xl font-bold mb-2">PERHATIAN!!</h3>
                <p class="text-lg">Semua informasi yang anda kirimkan bersifat rahasia</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('payment.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="nama_pemilik_rekening" class="block text-lg font-medium text-gray-700 mb-2">
                        Nama Pemilik Rekening
                    </label>
                    <input 
                        type="text" 
                        id="nama_pemilik_rekening" 
                        name="nama_pemilik_rekening" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg"
                        placeholder="Masukkan nama pemilik rekening"
                        value="{{ old('nama_pemilik_rekening') }}"
                        required
                    >
                </div>

                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors text-lg font-semibold"
                    >
                        Kirim Informasi Pembayaran
                    </button>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-600 font-medium">{{ $errors->first() }}</p>
                    </div>
                @endif
            </form>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 mt-6">
            <p class="text-center text-gray-600 text-lg">
                Terima kasih telah berbelanja di Locomotif Online Store.
            </p>
        </div>
    </div>
</div>

@endsection