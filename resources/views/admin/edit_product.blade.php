@extends('layouts.admin')

@section('title', 'Edit Produk • Locomotif Jajar')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-white">
    <form action="{{ route('admin.product.update', $produk->id_produk) }}" method="POST" 
        class="w-[711px] h-auto border border-[#789DBC] rounded-lg p-10 relative bg-white">
        @csrf
        @method('PUT')

        <!-- Icon Silang -->
        <a href="{{ route('admin.product') }}" 
           class="absolute top-4 right-4 text-[#789DBC] hover:text-red-500 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        <h1 class="text-2xl font-bold mb-6">EDIT PRODUK</h1>

        <!-- Nama -->
        <label for="nama" class="block text-[24px] font-semibold text-left mb-1">Nama Produk</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Kategori -->
        <label for="kategori" class="block text-[24px] font-semibold text-left mb-1">Kategori</label>
        <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $produk->kategori) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Harga -->
        <label for="harga" class="block text-[24px] font-semibold text-left mb-1">Harga</label>
        <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Stok -->
        <label for="stok" class="block text-[24px] font-semibold text-left mb-1">Stok Produk</label>
        <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}"
            class="w-[575px] h-[37px] border border-[#789DBC] rounded px-3 mb-5">

        <!-- Gambar Lama -->
        <label class="block text-[24px] font-semibold text-left mb-1">Gambar Produk Saat Ini</label>
        @if($produk->image)
            <img src="{{ asset('img/' . $produk->image) }}" alt="Gambar Produk" 
                class="w-[150px] h-[100px] object-cover border border-gray-300 rounded mb-4">
        @else
            <p class="text-gray-500 mb-4">Tidak ada gambar</p>
        @endif

        <!-- Dropdown Pilih Gambar -->
        <label for="image" class="block text-[24px] font-semibold text-left mb-1">Pilih Gambar Baru</label>
        <select name="image" id="image"
            class="w-[575px] h-[40px] border border-[#789DBC] rounded px-3 mb-8 bg-white text-gray-600">
            <option value="">-- Pilih Gambar --</option>
            @foreach ($imageNames as $img)
                <option value="{{ $img }}" {{ old('image', $produk->image) === $img ? 'selected' : '' }}>
                    {{ $img }}
                </option>
            @endforeach
        </select>

        <!-- Tombol Submit -->
        <button type="submit"
            class="w-[251px] h-[78px] bg-[#E2EAF4] text-black font-semibold rounded shadow hover:bg-[#d1deed]">
            Edit Produk
        </button>
    </form>
</div>
@endsection
