@extends('layouts.app')

@section('title', 'Payment • Locomotif Jajar')

@section('content')

    <h1>Proses Pembayaran</h1>

    <p>Pembayaran hanya dapat dilakukan dengan metode Transfer ke</p>

    <div>
        <h3>Bank BCA</h3>
        <p>7651430961</p>
        <p>A/N Ghieta Maureen</p>
    </div>

    <div>
        <p>Dengan Total Belanjaan anda, yaitu:</p>
        <h2>Rp. {{ number_format($total_belanja, 0, ',', '.') }}</h2>
    </div>

    <p>Pembayaran dilakukan maksimal 1 hari setelah proses pembelian</p>

    <p>Pesanan otomatis gagal jika pembeli membayar lewat dari tanggal yang ditentukan.</p>

    <h3>PERHATIAN!!</h3>

    <p>Semua informasi yang anda kirimkan bersifat rahasia</p>

    <form action="{{ route('payment.submit') }}" method="POST">
        @csrf

        <label for="account_name">Nama Pemilik Rekening</label><br>
        <input type="text" id="account_name" name="account_name" required><br><br>

        <button type="submit">Kirim Bukti Pembayaran</button>

        @if($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif
    </form>

    <p>Terima kasih telah berbelanja di Locomotif Online Store.</p>

@endsection