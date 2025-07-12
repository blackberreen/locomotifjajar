@extends('layouts.app')

@section('title', 'Product • Locomotif Jajar')

@section('content')
<div class="px-10 py-8">
  <!-- Cart & Search -->
  <div class="flex justify-end items-center gap-4 mb-6">
    <!-- Cart -->
    <a href="{{ route('cart') }}">
      <img src="{{ asset('icons/cart.svg') }}" alt="Cart" class="w-[62px] h-[56px] text-[#779FE5]">
    </a>

    <!-- Search Bar -->
    <form action="{{ route('product') }}" method="GET" class="flex items-center gap-2">
      <input
        type="text"
        name="search"
        placeholder="Search product..."
        value="{{ request('search') }}"
        class="w-[356px] h-[34px] rounded-[15px] border border-[#789DBC] px-4"
      >
      <button type="submit" class="text-[20px] text-black">Search</button>
    </form>
  </div>

  <!-- Filter Kategori -->
  <div class="flex justify-center gap-10 mb-4 text-[24px] font-semibold">
    <a href="{{ route('product') }}" class="hover:underline">All</a>
    <a href="{{ route('product', ['kategori' => 'Oli']) }}" class="hover:underline">Oli</a>
    <a href="{{ route('product', ['kategori' => 'Sparepart']) }}" class="hover:underline">Sparepart</a>
    <a href="{{ route('product', ['kategori' => 'Ban']) }}" class="hover:underline">Ban</a>
    <a href="{{ route('product', ['kategori' => 'Aksesoris']) }}" class="hover:underline">Aksesoris</a>
  </div>

  <!-- Garis Pembatas -->
  <div class="w-[1207px] h-[2px] bg-black mx-auto mb-10"></div>

  <!-- Grid Produk -->
  <div class="max-w-[1300px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-[48px] gap-y-[50px] justify-items-center">
    @forelse($products as $product)
    <div class="w-[223px] h-[260px] border border-black rounded-lg p-4 flex flex-col items-center justify-between shadow-md">
      <!-- Gambar Produk -->
      <div class="w-[84px] h-[125px] bg-gray-300 rounded-[5px] mb-2 overflow-hidden">
        <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover">
      </div>

      <!-- Info Produk -->
      <div class="text-center">
        <h3 class="font-bold text-[16px]">{{ $product->nama }}</h3>
        <p class="text-[14px]">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
        <p class="text-[14px]">Stock: {{ $product->stok }}</p>
      </div>

      <!-- Button Add -->
      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id_produk }}">
        <button type="submit" class="w-6 h-6 bg-[#779FE5] text-white rounded-full text-center font-bold hover:scale-110 transition">
            +
        </button>
      </form>
    </div>
    @empty
    <p class="text-center col-span-4">Produk tidak ditemukan.</p>
    @endforelse
  </div>
</div>
@endsection

