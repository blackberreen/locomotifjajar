@extends('layouts.app')

@section('title', 'Product • Locomotif Jajar')

@section('content')
<div style="padding: 2rem 2.5rem;">
  <!-- Cart & Search -->
  <div style="display: flex; justify-content: flex-end; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
    <!-- Cart -->
    <a href="{{ route('cart') }}">
      <img src="{{ asset('icons/cart.svg') }}" alt="Cart" style="width: 62px; height: 56px;">
    </a>

    <!-- Search Bar -->
    <form action="{{ route('product') }}" method="GET" style="display: flex; align-items: center; gap: 0.5rem;">
      <input
        type="text"
        name="search"
        placeholder="Search product..."
        value="{{ request('search') }}"
        style="width: 356px; height: 34px; border-radius: 15px; border: 1px solid #789DBC; padding: 0 1rem; outline: none;"
      >
      <button type="submit" style="font-size: 20px; color: black; background: none; border: none; cursor: pointer; padding: 0.5rem;">Search</button>
    </form>
  </div>

  <!-- Filter Kategori -->
  <div style="display: flex; justify-content: center; gap: 2.5rem; margin-bottom: 1rem; font-size: 24px; font-weight: 600;">
    <a href="{{ route('product') }}" style="text-decoration: none; color: inherit;">All</a>
    <a href="{{ route('product', ['kategori' => 'Oli']) }}" style="text-decoration: none; color: inherit;">Oli</a>
    <a href="{{ route('product', ['kategori' => 'Sparepart']) }}" style="text-decoration: none; color: inherit;">Sparepart</a>
    <a href="{{ route('product', ['kategori' => 'Ban']) }}" style="text-decoration: none; color: inherit;">Ban</a>
    <a href="{{ route('product', ['kategori' => 'Aksesoris']) }}" style="text-decoration: none; color: inherit;">Aksesoris</a>
  </div>

  <!-- Garis Pembatas -->
  <div style="width: 1207px; height: 2px; background-color: black; margin: 0 auto 2.5rem auto;"></div>

  <!-- Grid Produk -->
  <div style="max-width: 1300px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(223px, 1fr)); gap: 48px 50px; justify-items: center;">
    @forelse($products as $product)
    <div style="width: 223px; height: 260px; border: 1px solid black; border-radius: 8px; padding: 1rem; display: flex; flex-direction: column; align-items: center; justify-content: space-between; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
      <!-- Gambar Produk -->
      <div style="width: 84px; height: 125px; background-color: #d1d5db; border-radius: 5px; margin-bottom: 0.5rem; overflow: hidden;">
        <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
      </div>

      <!-- Info Produk -->
      <div style="text-align: center;">
        <h3 style="font-weight: bold; font-size: 16px; margin: 0 0 0.25rem 0;">{{ $product->nama }}</h3>
        <p style="font-size: 14px; margin: 0 0 0.25rem 0;">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
        <p style="font-size: 14px; margin: 0;">Stock: {{ $product->stok }}</p>
      </div>

      <!-- Button Add -->
      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id_produk }}">
        <button type="submit" style="width: 24px; height: 24px; background-color: #779FE5; color: white; border-radius: 50%; border: none; cursor: pointer; font-weight: bold; font-size: 16px; display: flex; align-items: center; justify-content: center;">
            +
        </button>
      </form>
    </div>
    @empty
    <p style="text-align: center; grid-column: 1 / -1; font-size: 18px; color: #6b7280;">Produk tidak ditemukan.</p>
    @endforelse
  </div>
</div>

<style>
  /* Hover effects */
  a:hover {
    text-decoration: underline;
  }
  
  input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
  }
</style>
@endsection