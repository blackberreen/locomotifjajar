@extends('layouts.app')

@section('title', 'Cart • Locomotif Jajar')

@section('content')

@php
$cart = session('cart', []);
$total = 0;
@endphp

<div class="cart-container" style="display: flex; gap: 20px; margin-top: 40px; padding: 0 50px;">

    {{-- KOTAK PRODUK --}}
    <div class="product-section" style="width:944px; height:auto; border:1px solid black; background:white;">
        {{-- HEADER --}}
        <div class="cart-header" style="width:100%; height:32px; background:#E2EAF4; font-size:20px; font-weight: bold; display:flex; align-items:center; padding-left: 20px;">
            <div class="col-product" style="width:400px;">Produk</div>
            <div class="col-price" style="width:150px;">Harga</div>
            <div class="col-quantity" style="width:150px;">Jumlah</div>
            <div class="col-subtotal" style="width:150px;">Subtotal</div>
        </div>

        {{-- ISI PRODUK --}}
        @foreach($cart as $id => $item)
            @php
                $subtotal = $item['harga'] * $item['quantity'];
                $total += $subtotal;
            @endphp
            <div class="cart-item" style="display:flex; align-items:center; padding:10px 20px;">
                <div class="item-image" style="width:100px; height:100px; margin-right:10px;">
                  <img src="{{ asset('img/' . $item['image']) }}" alt="{{ $item['nama'] }}" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div class="item-name" style="width:290px;">
                    <div class="product-name" style="font-size:16px;">{{ $item['nama'] }}</div>
                </div>
                <div class="item-price" style="width:150px;">Rp. {{ number_format($item['harga']) }}</div>
                <div class="item-quantity" style="width:150px;">
                    <form method="POST" action="{{ route('cart.update') }}" class="quantity-form" style="display: flex; align-items: center; gap: 5px;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <button name="action" value="minus" class="qty-btn" style="width:25px;">-</button>
                        <input type="text" value="{{ $item['quantity'] }}" readonly class="qty-input" style="width:27px; height:24px; text-align:center;">
                        <button name="action" value="plus" class="qty-btn" style="width:25px;">+</button>
                    </form>
                </div>
                <div class="item-subtotal" style="width:150px;">Rp. {{ number_format($subtotal) }}</div>
            </div>
            <hr class="item-divider" style="width:867px; border:1px solid #C7BABA; margin-left: 20px;">
        @endforeach
    </div>

    {{-- RINGKASAN BELANJA --}}
    <div class="summary-section" style="width:372px; height:342px; background:#D9D9D9; padding:30px; font-size:18px; display:flex; flex-direction:column; justify-content:space-between;">
        <div>
            <p class="summary-title" style="font-size:18px; text-align:center; font-weight:bold; margin-bottom:20px;">Ringkasan Belanja</p>

            <div class="subtotal-row" style="display:flex; justify-content:space-between; font-size:16px; margin-bottom:10px;">
                <span style="text-align:left; width: 50%;">Subtotal:</span>
                <span style="text-align:right; width: 50%;">Rp. {{ number_format($total) }}</span>
            </div>

            <hr style="width:100%; border:1px solid black; margin: 10px 0;">

            <div class="total-row" style="display:flex; justify-content:space-between; font-size:20px; font-weight:bold; margin-bottom:30px;">
                <span style="text-align:left; width: 50%;">TOTAL:</span>
                <span style="text-align:right; width: 50%;">Rp. {{ number_format($total) }}</span>
            </div>
        </div>

        <a href="{{ route('shipping.form') }}" style="display:flex; justify-content:center;">
            <button class="continue-btn" style="width:229px; height:44px; background:#B1CBF8; font-size:24px; border:none; border-radius:15px; cursor:pointer;">
                Lanjutkan
            </button>
        </a>
    </div>

</div>

<style>
/* Responsive Tablet */
@media (max-width: 1024px) {
    .cart-container {
        flex-direction: column !important;
        padding: 0 30px !important;
        gap: 30px !important;
    }
    
    .product-section {
        width: 100% !important;
    }
    
    .summary-section {
        width: 100% !important;
        max-width: 500px !important;
        margin: 0 auto !important;
        height: auto !important;
    }
    
    .cart-header {
        font-size: 18px !important;
    }
    
    .col-product {
        width: 35% !important;
    }
    .col-price {
        width: 20% !important;
    }
    .col-quantity {
        width: 25% !important;
    }
    .col-subtotal {
        width: 20% !important;
    }
    
    .cart-item {
        flex-wrap: wrap !important;
    }
    
    .item-name {
        width: 35% !important;
    }
    .item-price {
        width: 20% !important;
    }
    .item-quantity {
        width: 25% !important;
    }
    .item-subtotal {
        width: 20% !important;
    }
    
    .item-divider {
        width: calc(100% - 40px) !important;
    }
}

/* Responsive Mobile */
@media (max-width: 768px) {
    .cart-container {
        padding: 0 15px !important;
        margin-top: 20px !important;
    }
    
    .cart-header {
        display: none !important;
    }
    
    .cart-item {
        flex-direction: column !important;
        align-items: flex-start !important;
        padding: 20px !important;
        gap: 10px !important;
    }
    
    .item-image {
        width: 80px !important;
        height: 80px !important;
        margin-right: 0 !important;
        align-self: center !important;
    }
    
    .item-name {
        width: 100% !important;
        text-align: center !important;
    }
    
    .product-name {
        font-size: 18px !important;
        font-weight: bold !important;
    }
    
    .item-price,
    .item-quantity,
    .item-subtotal {
        width: 100% !important;
        text-align: center !important;
        font-size: 16px !important;
    }
    
    .quantity-form {
        justify-content: center !important;
    }
    
    .qty-btn {
        width: 35px !important;
        height: 35px !important;
        font-size: 18px !important;
    }
    
    .qty-input {
        width: 50px !important;
        height: 35px !important;
        font-size: 16px !important;
    }
    
    .item-divider {
        width: calc(100% - 40px) !important;
        margin: 10px 20px !important;
    }
    
    .summary-section {
        padding: 20px !important;
    }
    
    .continue-btn {
        width: 100% !important;
        max-width: 250px !important;
    }
}

/* Very Small Mobile */
@media (max-width: 480px) {
    .cart-container {
        padding: 0 10px !important;
    }
    
    .cart-item {
        padding: 15px !important;
    }
    
    .item-image {
        width: 60px !important;
        height: 60px !important;
    }
    
    .product-name {
        font-size: 16px !important;
    }
    
    .item-price,
    .item-quantity,
    .item-subtotal {
        font-size: 14px !important;
    }
    
    .summary-section {
        padding: 15px !important;
    }
    
    .summary-title {
        font-size: 16px !important;
    }
    
    .subtotal-row,
    .total-row {
        font-size: 14px !important;
    }
    
    .total-row {
        font-size: 16px !important;
    }
    
    .continue-btn {
        font-size: 20px !important;
        height: 40px !important;
    }
}
</style>

@endsection