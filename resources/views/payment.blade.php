@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6 text-center">Proses Pembayaran</h1>

    <div class="bg-white shadow-md rounded-xl p-6 space-y-6">

        <div>
            <p class="text-lg font-semibold mb-2">Pembayaran hanya dapat dilakukan dengan metode Transfer ke</p>
            <div class="bg-gray-100 p-4 rounded-lg">
                <p class="text-xl font-bold">Bank BCA</p>
                <p class="text-lg">7651430961</p>
                <p class="text-md text-gray-700">A/N Ghieta Maureen</p>
            </div>
        </div>

        <div>
            <p class="text-lg font-semibold mb-2">Dengan Total Belanjaan anda, yaitu:</p>
            <div class="bg-gray-100 p-4 rounded-lg text-2xl font-bold text-green-700">
                Rp. {{ number_format($total, 0, ',', '.') }}
            </div>
        </div>

        <div class="text-sm text-red-600">
            Pembayaran dilakukan maksimal 1 hari setelah proses pembelian.
        </div>
        <div class="text-sm text-red-600">
            Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-bold mb-2 text-yellow-700">PERHATIAN!!</h2>
            <p class="mb-4 text-gray-700">Semua informasi yang anda kirimkan bersifat rahasia</p>

            <form action="{{ route('payment.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nama_rekening" class="block font-semibold mb-1">Nama Pemilik Rekening</label>
                    <input type="text" name="nama_rekening" id="nama_rekening"
                        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan nama sesuai di rekening">
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md">
                    Kirim Informasi Pembayaran
                </button>

                @if($errors->any())
                    <div class="text-red-600 text-sm mt-2">
                        {{ $errors->first() }}
                    </div>
                @endif
            </form>
        </div>

        <div class="text-center text-gray-600 mt-8">
            Terima kasih telah berbelanja di Locomotif Online Store.
        </div>

    </div>
</div>

@endsection
