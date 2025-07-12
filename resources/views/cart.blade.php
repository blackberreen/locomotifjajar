@extends('layouts.app')

@section('title', 'Cart • Locomotif Jajar')

@section('content')

@php
$cart = session('cart', []);
$total = 0;
@endphp

<div style="display: flex; gap: 20px; margin-top: 40px; padding: 0 50px;">

    {{-- KOTAK PRODUK --}}
    <div style="width:944px; height:auto; border:1px solid black; background:white;">
        {{-- HEADER --}}
        <div style="width:944px; height:32px; background:#E2EAF4; font-size:20px; font-weight: bold; display:flex; align-items:center; padding-left: 20px;">
            <div style="width:400px;">Produk</div>
            <div style="width:150px;">Harga</div>
            <div style="width:150px;">Jumlah</div>
            <div style="width:150px;">Subtotal</div>
        </div>

        {{-- ISI PRODUK --}}
        @foreach($cart as $id => $item)
            @php
                $subtotal = $item['harga'] * $item['quantity'];
                $total += $subtotal;
            @endphp
            <div style="display:flex; align-items:center; padding:10px 20px;">
                <div style="width:100px; height:100px; margin-right:10px;">
                  <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['nama'] }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div style="width:290px;">
                    <div style="font-size:16px;">{{ $item['nama'] }}</div>
                    {{-- <div style="font-size:13px;">Kategori: {{ $item['kategori'] ?? 'Kategori tidak diketahui' }}</div> --}}
                </div>
                <div style="width:150px;">Rp. {{ number_format($item['harga']) }}</div>
                <div style="width:150px;">
                    <form method="POST" action="{{ route('cart.update') }}" style="display: flex; align-items: center; gap: 5px;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <button name="action" value="minus" style="width:25px;">-</button>
                        <input type="text" value="{{ $item['quantity'] }}" readonly style="width:27px; height:24px; text-align:center;">
                        <button name="action" value="plus" style="width:25px;">+</button>
                    </form>
                </div>
                <div style="width:150px;">Rp. {{ number_format($subtotal) }}</div>
            </div>
            <hr style="width:867px; border:1px solid #C7BABA; margin-left: 20px;">
        @endforeach
    </div>

    {{-- RINGKASAN BELANJA --}}
    <div style="width:372px; height:342px; background:#D9D9D9; padding:30px; font-size:18px; display:flex; flex-direction:column; justify-content:space-between;">
        <div>
            <p style="font-size:18px; text-align:center; font-weight:bold; margin-bottom:20px;">Ringkasan Belanja</p>

            <div style="display:flex; justify-content:space-between; font-size:16px; margin-bottom:10px;">
                <span style="text-align:left; width: 50%;">Subtotal:</span>
                <span style="text-align:right; width: 50%;">Rp. {{ number_format($total) }}</span>
            </div>

            <hr style="width:325px; border:1px solid black; margin: 10px 0;">

            <div style="display:flex; justify-content:space-between; font-size:20px; font-weight:bold; margin-bottom:30px;">
                <span style="text-align:left; width: 50%;">TOTAL:</span>
                <span style="text-align:right; width: 50%;">Rp. {{ number_format($total) }}</span>
            </div>
        </div>

        <a href="{{ route('shipping.form') }}" style="display:flex; justify-content:center;">
            <button style="width:229px; height:44px; background:#B1CBF8; font-size:24px; border:none; border-radius:15px; cursor:pointer;">
                Lanjutkan
            </button>
        </a>
    </div>


</div>

@endsection
